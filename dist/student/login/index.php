<?php
  session_start();
  if(!empty($_SESSION['studentId'])) {
    header("Location: /CSC12/dist/student/");
    exit;
  }
?>

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

    <nav>
      <div class="">
        <img src="/CSC12/dist/res/images/logo.svg" alt="">
      </div>
    </nav>

    <div class="main h-full w-full mt-[50px] flex flex-col items-center justify-center">

      <h2 class="text-[36px] font-bold text-[#5D5FEF] mb-[40px] ">Student Login</h2>
      
      <!-- ALERT DIV -->
      <div class="w-full max-w-[500px] pointer-events-none bg-[#e5e5e5b9] backdrop-blur-sm sticky top-[10px] mb-[20px] ">
        <div id="alert" class="hidden font-bold bg-[transparent] w-[100%] p-[5px] mr-auto border border-red-500 text-red-500 " role="alert" >
          Alert
        </div>
      </div>

      <form class="w-full max-w-[500px] " action="" method="post">

        <div class="w-full max-w-[500px] mb-[20px] ">
          <label for="matric-no" class="block">Matric No</label>
          <input class="w-full outline-0 rounded-lg p-[10px] border border-[#BDBDBD]" type="text" name="matric-no" id="matric-no" placeholder="matric no">
        </div>

  
        <div class="w-full max-w-[500px] mb-[20px] ">
          <label for="pin" class="block">Pin</label>
          <input class="w-full outline-0 rounded-lg p-[10px] border border-[#BDBDBD]" type="text" name="pin" id="pin" placeholder="0000-0000-0000-0000">
        </div>
  
        <button type="submit" id="student-login" class="bg-[#2F80ED] hover:bg-[#4091FE] w-full max-w-[500px] mb-[20px] p-[10px] rounded-lg font-[500] text-[white] ">
          Login
        </button>

      </form>


    </div>

    <script src="/CSC12/dist/scripts/ui.js"></script>
    <!-- <script src="/CSC12/dist/scripts/login.js"></script>
    <script src="/CSC12/dist/scripts/student.js"></script>
    <script src="/CSC12/dist/app.js"></script> -->

  </body>
</html>
