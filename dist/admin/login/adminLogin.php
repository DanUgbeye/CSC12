<?php

    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $hashed_password = hash('md5', $password);

        // if (empty($email)) {
        //     echo ("please specify an email address");
        // }
        // if (empty($password)) {
        //     echo ("no password provided");
        // } elseif (strlen($password) < 6) {
        //     echo ("password should be at least 6 characters long");
        // }

        require_once('../../lib/dbConnect.php');
        $dbConnect = new dbConnect();

        $res_data = $dbConnect->adminLogin($email, $hashed_password);
        if($res_data['status']){
            $_SESSION['adminId'] = $res_data['result']['username'];
            header("Location: /CSC12/dist/admin/");
            exit;      
        }else {
            $message = 'Invalid email or password!';
            $_SESSION['message'] = $message;
            header('Location: /CSC12/dist/admin/login/');
            exit;
        }

    
    }
