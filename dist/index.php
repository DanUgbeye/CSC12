<?php
  session_start();
  if(!empty($_SESSION['adminId'])) {
    header("Location: admin/");
    exit;
  } elseif(!empty($_SESSION['studentId'])) {
    header("Location: student/");
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

  <body class="max-h-[100vh] overflow-hidden bg-[#E5E5E5] p-[35px] sm:p-[40px]">

    <nav>
      <div class="">
        <!-- CSC12 Icon -->
        <img src="/CSC12/dist/res/images/logo.svg" alt="">
      </div>
    </nav>

    <div class="h-[500px] w-full  my-auto">

      <h2 class="text-[36px] mt-[20vh] text-center font-bold text-[#5D5FEF] mb-[40px] ">Login</h2>
      
      <button id="login-admin" class="mx-auto mb-[20px] border border-[#5D5FEF] rounded-lg hover:rounded-lg overflow-hidden flex items-center  ">
        <a class="p-[20px] hover:bg-[#5D5FEF] text-[18px] flex gap-[15px]" href="/CSC12/dist/admin/login/">
          <span class="h-[25px] w-[25px]  ">
            <img src="/CSC12/dist/res/images/admin.svg" alt="">
          </span> 
          Login as an admin
        </a>
        
      </button>

      <button id="login-student" class="mx-auto mb-[20px] border border-[#5D5FEF] rounded-lg hover:rounded-lg overflow-hidden flex items-center ">
        <a class="p-[20px] hover:bg-[#5D5FEF] text-[18px]  flex gap-[15px]" href="/CSC12/dist/student/login/">
          <span class="h-[25px] w-[25px]  ">
            <img src="/CSC12/dist/res/images/student.svg" alt="">
          </span> 
          Login as a student
        </a>
      </button>
    </div>


    <script src="/CSC12/dist/scripts/ui.js"></script>
    <!-- <script src="./scripts/login.js"></script> -->
    <!-- <script src="./scripts/student.js"></script> -->
    <!-- <script src="./app.js"></script> -->
    
  </body>
</html>
