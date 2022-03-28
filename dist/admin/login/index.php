<?php

  // if a cookie exists, redirect to the home page
  if (isset($_COOKIE["admin"])) {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: /CSC12/dist/admin/index.php");
    exit();
  } elseif (isset($_COOKIE["student"])) {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: /CSC12/dist/student/index.php");
    exit();
  }

  $email_error = "";
  $password_error = "";
  $user_error = "";
  $user = "";

  $email = $password = "";

  if(isset($_POST['submit'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email)) {
      $email_error =  ("please specify an email address");
    }
    if (empty($password)) {
      $password_error = ("no password provided");
    } elseif (strlen($password) < 6) {
      $password_error = ("password should be at least 6 characters long");
    }

    require_once "/xampp/htdocs/CSC12/dist/lib/dbConnect.php";
    $adminOps = new adminDb();
    $res = $adminOps->adminLogin($email, MD5($password));
    $adminData = $res['status'] ? $res['result'] : "";

    if (!$res['status']) {
      $user_error = "incorrect user credentials";
    } else {
      $user = "login sucessful";
      setcookie("admin", json_encode(array('email' => $adminData["email"], 'id' => $adminData["id"])), time() + 60 * 60 * 24 * 7, "/"); // expire in 7 days
      header("location:/CSC12/dist/admin/");
      exit();
    }

    // $conn = mysqli_connect("localhost", "deedee", "123456", "csc12");

    // if (!$conn) {
    //   echo ("connection error" . mysqli_connect_error());
    // }

    // $sql = "SELECT `password`, `email`, `id` FROM `admin` WHERE `email`='" . $email . "'";
    // $result = mysqli_query($conn, $sql);

    // // change result into an array
    // $admin = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // // if no admin is found
    // if (count($admin) < 1) {
    //   $user_error = "no user found";
    // } else {

    //   // free memory
    //   mysqli_free_result($result);

    //   // check if passwords match
    //   $password_match = MD5($password) === $admin[0]['password'];
    //   if (!$password_match) {
    //     $user_error = "Incorrect login credentials";
    //   } else {
    //     $user = "login sucessful";
    //     setcookie("admin", json_encode(array("email" => $admin[0]["email"], "id" => $admin[0]["id"])), time() + 60 * 60 * 24 * 7, "/"); // expire in 7 days
    //     header("HTTP/1.1 301 Moved Permanently");
    //     header("location:/CSC12/dist/admin/");
    //     exit();
    //   }
    // }
  }
?>

<?php
  //including the admin login page from views folder
  require_once('/xampp/htdocs/CSC12/dist/views/pages/adminLoginPage.php');

?>
