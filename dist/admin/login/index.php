<?php
  session_start();

  include_once "/xampp/htdocs/CSC12/dist/templates/header.php" 
?>


<div class="main h-full w-full mt-[50px] flex flex-col items-center justify-center">

  <h2 class="text-[36px] font-bold text-[#5D5FEF] mb-[40px] ">
    Login as
    <span class="relative">
      <div class="absolute top-[-2px] bottom-0 right-0 left-[-5px] z-[-1] bg-[#FCDDEC] rotate-[351.29deg] w-[135px] h-[58px] hidden sm:block "></div>
      Admin
    </span>
  </h2>

  <?php
    if(!empty($_SESSION['error_messsage'])) {
      require_once('/xamp/CSC12/dist/views/alert.php');
      showAlert($_SESSION['error_message']);
    }

  ?>

  <!-- LOGIN FORM -->
  <form class="w-full max-w-[500px] " action="adminLogin.php" method="post" onsubmit="">

    <div class="w-full max-w-[500px] mb-[20px]">
      <label for="email" class="block">Email</label>
      <input required class="w-full outline-0 rounded-lg p-[10px] px-[20px] border border-[#BDBDBD]" type="email" name="email" id="email" placeholder="email" value="<?php //echo ($email) ?>">
      <?php
      // echo ("<p class='text-red-500'>" . $email_error . "</p>");        ?>
    </div>

    <div class="w-full max-w-[500px] mb-[40px] ">
      <label for="password" class="block">Password</label>
      <input required class="w-full outline-0 rounded-lg p-[10px] px-[20px] border border-[#BDBDBD]" type="password" name="password" id="password" placeholder="password" required minlength='6' value="<?php //echo ($password) ?>">
      <?php
      // $length = strlen($password_error);
      // if ($length > 0 && $length < 6) {
      //   echo ("<p class='text-red-500'>" . $password_error . "</p>");
      // }
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
      // if($user) {
      //   include_once '/xampp/htdocs/CSC12/dist/views/popup.php';
      //   showPopup($user);
      // }
    ?>
  </form>
</div>