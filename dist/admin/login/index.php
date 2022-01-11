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

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];


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
        setcookie("admin", json_encode(array("email" => $admin[0]["email"], "id" => $admin[0]["id"])), time() + 60 * 60 * 24 * 7, "/"); // expire in 7 days
        header("HTTP/1.1 301 Moved Permanently");
        header("location:/CSC12/dist/admin/");
        exit();
      }
    }
  }
?>
<!DOCTYPE html>
<html lang="en">

<<<<<<< Updated upstream
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../style.css">
  <title>CSC12</title>
</head>

<body>

  <body class="flex items-center justify-center h-[100vh] min-w-[700px] bg-[#E5E5E5]">

    <div class="main w-full flex flex-col items-center justify-center">

      <h2 class="text-[36px] font-bold text-[#5D5FEF] mb-[40px] ">
        Login as
        <span class="relative">
          <div class="absolute top-[-2px] bottom-0 right-0 left-[-5px] z-[-1] bg-[#FCDDEC] rotate-[351.29deg] w-[135px] h-[58px] hidden sm:block "></div>
          Admin
        </span>
      </h2>

      <!-- we may not need this -->
      <!-- ALERT DIV -->
      <div class="w-full max-w-[500px] pointer-events-none bg-[#e5e5e5b9] backdrop-blur-sm sticky top-[10px] mb-[20px] ">
        <div id="alert" class="hidden font-bold bg-[transparent] w-[100%] p-[5px] mr-auto border border-red-500 text-red-500 " role="alert">
          Alert
        </div>
      </div>
=======
<?php include_once "/xampp/htdocs/CSC12/dist/templates/header.php" ?>

  <nav class="flex space-between" >
    <div class="">
      <img src="/CSC12/dist/res/images/logo.svg" alt="Logo">
    </div>

      <a class="block ml-auto font-bold hover:border-4 hover:border-red-400 " href="/CSC12/dist/">
        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M20 11H7.83L13.42 5.41L12 4L4 12L12 20L13.41 18.59L7.83 13H20V11Z" fill="#5D5FEF"/>
        </svg>
      </a>
  </nav>

  <div class="main h-full w-full max-w-[500px] mx-auto mt-[50px] flex flex-col items-center justify-center">

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
>>>>>>> Stashed changes

      <!-- LOGIN FORM -->
      <form class="w-full max-w-[500px] " action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="e.preventDefault()">

        <div class="w-full max-w-[500px] mb-[20px]">
          <label for="email" class="block">Email</label>
          <input required class="w-full outline-0 rounded-lg p-[10px] px-[20px] border border-[#BDBDBD]" type="email" name="email" id="email" placeholder="email" value="<?php echo ($email) ?>">
          <?php
          echo ("<p class='text-red-500'>" . $email_error . "</p>");        ?>
        </div>

        <div class="w-full max-w-[500px] mb-[40px] ">
          <label for="password" class="block">Password</label>
          <input required class="w-full outline-0 rounded-lg p-[10px] px-[20px] border border-[#BDBDBD]" type="text" name="password" id="password" placeholder="password" required minlength='6' value="<?php echo ($password) ?>">
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
        // echo ("<p class='text-green-700'>" . $user . "</p>");
        ?>

        <?php
        if ($user) {
          include_once '/xampp/htdocs/CSC12/dist/views/popup.php';
          showPopup($user);
        }
        ?>
      </form>
    </div>
  </body>

</html>
