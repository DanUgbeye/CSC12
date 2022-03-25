<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="/CSC12/dist/style.css">
    <title>CSC 12</title>
  </head>

  <body class="min-h-[100vh] bg-[#E5E5E5] p-[15px] sm:py-[46px] sm:px-[63px]">


    <nav class="flex " >
      <div class="">
        <img src="/CSC12/dist/res/images/logo.svg" alt="Logo">
      </div>

      <!-- back button -->
      <a class=" px-[10px] rounded-md tracking-wider font-medium flex gap-[5px] items-center py-[5px] ml-auto text-[#5D5FEF] text-center hover:bg-gray-300 hover:font-semibold " href="/CSC12/dist/">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M20 11H7.83L13.42 5.41L12 4L4 12L12 20L13.41 18.59L7.83 13H20V11Z" fill="#5D5FEF"/>
        </svg>
        back
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

        <!-- LOGIN FORM -->
        <form class="w-full max-w-[350px] " action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="e.preventDefault()">

          <div class="w-full max-w-[500px] mb-[20px]">
            <label for="email" class="block">Email</label>
            <input required class="w-full outline-0 rounded-lg p-[10px] px-[20px] border border-[#BDBDBD]" type="email" name="email" id="email" placeholder="email" value="<?php echo ($email) ?>">
            <?php
            echo ("<p class='text-red-500'>" . $email_error . "</p>");        ?>
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

          <input type="submit" name="submit" value="Login" id=" admin-login" class="bg-[#2F80ED] hover:bg-[#4091FE] w-full max-w-[500px] mb-[20px] p-[10px] rounded-lg text-lg font-semibold text-[white] cursor-pointer" />

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