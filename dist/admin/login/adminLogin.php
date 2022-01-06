<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email)) {
        echo ("please specify an email address");
    }
    if (empty($password)) {
        echo ("no password provided");
    } elseif (strlen($password) < 6) {
        echo ("password should be at least 6 characters long");
    }

    
}
