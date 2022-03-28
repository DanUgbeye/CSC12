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

          <a class=" px-[10px] tracking-wider font-medium rounded-md flex gap-[5px] items-center py-[5px] ml-auto text-[#5D5FEF] hover:bg-gray-300 hover:font-semibold " href="/CSC12/dist/">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M20 11H7.83L13.42 5.41L12 4L4 12L12 20L13.41 18.59L7.83 13H20V11Z" fill="#5D5FEF"/>
            </svg>
            back
          </a>
      </nav>

      <div class="main h-full w-full max-w-[350px] mx-auto mt-[50px] flex flex-col items-center justify-center">

        <h2 class="text-[36px] font-bold text-[#5D5FEF] mb-[40px] ">Student Login</h2>

        <?php
          //this displays the error
          if(!empty($user_error)) {
            require_once "/xampp/htdocs/CSC12/dist/views/alert.php";
            showAlert($user_error);
          }

        ?>

        <form class="w-full max-w-[350px] " action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" onsubmit="(e)=>e.preventDefault()">

          <div class="w-full max-w-[500px] mb-[20px] ">
            <label for="matric-no" class="block">Matric No</label>
            <input class="w-full outline-0 rounded-lg p-[10px] border border-[#BDBDBD]" type="text" name="matric-no" id="matric-no" placeholder="matric no" value="<?php echo ($matric_no) ?>" minlength="12" maxlength="14" required>
            <?php echo ("<p class='text-red-500'>" . $matric_error . "</p>") ?>
          </div>

          <div class="w-full max-w-[500px] mb-[20px] ">
            <label for="pin" class="block">Pin</label>
            <input class="w-full outline-0 rounded-lg p-[10px] border border-[#BDBDBD]" type="text" name="pin" id="pin" placeholder="000-000-000-000" value="<?php echo ($pin) ?>" minlength="12" maxlength="12" required>
            <?php echo ("<p class='text-red-500'>" . $pin_error . "</p>") ?>
          </div>

          <input name="submit" type="submit" id="student-login" value="login" class="bg-[#2F80ED] hover:bg-[#4091FE] w-full max-w-[500px] mb-[20px] p-[10px] text-lg font-semibold rounded-lg text-[white] " />

        </form>

        <?php
          // this displays the login successful message
            if ($user) {
              include_once '/xampp/htdocs/CSC12/dist/views/popup.php';
              showPopup($user);
            }
          ?>
      </div>

    </body>

</html>