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

  if (isset($_POST['submit'])) {


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

    $conn = mysqli_connect("localhost", "deedee", "123456", "csc12");

    if (!$conn) {
      echo ("connection error" . mysqli_connect_error());
    }

    $sql = "SELECT `password`, `email`, `id` FROM `admin` WHERE `email`='" . $email . "'";
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
        $user_error = "Incorrect login credentials";
      } else {
        $user = "login sucessful";
        setcookie("admin", json_encode(array("email" => $admin[0]["email"], "id" => $admin[0]["id"])),  time() + 60 * 60 * 24 * 7, "/"); // expire in 7 days
        header("HTTP/1.1 301 Moved Permanently");
        header("location:/CSC12/dist/admin/");
        exit();
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<?php include_once "/xampp/htdocs/CSC12/dist/templates/header.php" ?>

<div class="main h-full w-full mt-[50px] flex flex-col items-center justify-center">

  <h2 class="text-[36px] font-bold text-[#5D5FEF] mb-[40px] ">
    Login as
    <span class="relative">
      <div class="absolute top-[-2px] bottom-0 right-0 left-[-5px] z-[-1] bg-[#FCDDEC] rotate-[351.29deg] w-[135px] h-[58px] hidden sm:block "></div>
      Admin
    </span>
  </h2>

  <?php
    //this displays the error
    if(!empty($user_error)) {
      require_once "/xampp/htdocs/CSC12/dist/views/alert.php";
      showAlert($user_error);
    }

  ?>

  <!-- LOGIN FORM -->
  <form class="w-full max-w-[500px] " action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="e.preventDefault()">

    <div class="w-full max-w-[500px] mb-[20px]">
      <label for="email" class="block">Email</label>
      <input required class="w-full outline-0 rounded-lg p-[10px] px-[20px] border border-[#BDBDBD]" type="email" name="email" id="email" placeholder="email" value="<?php //echo ($email) ?>">
      <?php
        // echo ("<p class='text-red-500'>" . $email_error . "</p>");
      ?>
    </div>

    <div class="w-full max-w-[500px] mb-[40px] ">
      <label for="password" class="block">Password</label>
      <input required class="w-full outline-0 rounded-lg p-[10px] px-[20px] border border-[#BDBDBD]" type="password" name="password" id="password" placeholder="password" required minlength='6' value="<?php echo ($password) ?>">
      <?php
      $length = strlen($password_error);
      if ($length > 0 && $length < 6) {
        echo ("<p class='text-red-500'>" . $password_error . "</p>");
      }
      ?>
    </div>

    <input type="submit" name="submit" value="Login" id=" admin-login" class="bg-[#2F80ED] hover:bg-[#4091FE] w-full max-w-[500px] mb-[20px] p-[10px] rounded-lg font-[500] text-[white] cursor-pointer" />

    <?php
      // echo ("<p class='text-red-500'>" . $user_error . "</p>");
    ?>
    <?php
      echo ("<p class='text-green-700'>" . $user . "</p>");
    ?>

    <?php
    // this displays the login successful message
      if ($user) {
        include_once '/xampp/htdocs/CSC12/dist/views/popup.php';
        showPopup($user);
      }
    ?>
  </form>
</div>