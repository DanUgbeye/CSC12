<?php

    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $email = $_POST['email'];
        $password = $_POST['password'];

        if(empty($email) || empty($password)) {

            if(empty($email) && empty($password)){
                $email_error =  "please enter an email and a password";
                $_SESSION['error_message'] = $email_error;
                header('Location: /CSC12/dist/admin/login/');
                exit;
            }
            if(empty($email)){
                $email_error =  ("please enter an email address");
                $_SESSION['error_message'] = $email_error;
                header('Location: /CSC12/dist/admin/login/');
                exit;
            }
            if(empty($password)) {
                $password_error = ("enter your password");
                $_SESSION['error_message'] = $password_error;
                header('Location: /CSC12/dist/admin/login/');
                exit;
            } elseif (strlen($password) < 6) {
                $password_error = ("password should be at least 6 characters long");
                $_SESSION['error_message'] = $password_error;
                header('Location: /CSC12/dist/admin/login/');
                exit;
            }
        }

        $hashed_password = hash('md5', $password);

        require_once('../../lib/dbConnect.php');
        $dbConnect = new adminDb();

        $res = $dbConnect->adminLogin($email, $hashed_password);
        if($res['status']){
            $admminProfile = $res['result'];
            echo $adminProfile;
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
?>

<?php
// session_start();


// N63V]9I5A(m3_dQy 

$email_error = "";
$password_error = "";
$user_error = "";
$user = "";

$email = $password = "";

if (isset($_POST['submit'])) {


  $email = $_POST['email'];
  $password = $_POST['password'];

  

  $conn = mysqli_connect("localhost", "deedee", "123456", "csc12");

  if (!$conn) {
    echo ("connection error" . mysqli_connect_error());
  }

  $sql = "SELECT `password` FROM `admin` WHERE `email`='" . $email . "'";
  $result = mysqli_query($conn, $sql);

  // change result into an array
  $admin = mysqli_fetch_all($result, MYSQLI_ASSOC);

  // if no admin is found
  if (count($admin) < 1) {
    $user_error = "no user found";
  } else {

    // free memory
    mysqli_free_result($result);

    // check if passwords match
    $password_match = MD5($password) === $admin[0]['password'];
    if (!$password_match) {
      $user_error = "incorrect user credentials";
    } else {
      $user = "login sucessfull";
    }
    // print_r($admin);
  }
}

?>