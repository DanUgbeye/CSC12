<?php
session_start();
if (!empty($_SESSION['adminId'])) {
  header("Location: ../admin/");
  exit;
}

$email_error = "";
$password_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

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

    <h2 class="text-[36px] font-bold text-[#5D5FEF] mb-[40px] ">
      Login as
      <span class="relative">
        <div class="absolute top-[-2px] bottom-0 right-0 left-[-5px] z-[-1] bg-[#FCDDEC] rotate-[351.29deg] w-[135px] h-[58px] hidden sm:block "></div>
        Admin
      </span>
    </h2>

    <!-- ALERT DIV -->
    <div class="w-full max-w-[500px] pointer-events-none bg-[#e5e5e5b9] backdrop-blur-sm sticky top-[10px] mb-[20px] ">
      <div id="alert" class="hidden font-bold bg-[transparent] w-[100%] p-[5px] mr-auto border border-red-500 text-red-500 " role="alert">
        Alert
      </div>
    </div>

    <!-- LOGIN FORM -->
    <form class="w-full max-w-[500px] " action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

      <div class="w-full max-w-[500px] mb-[20px]">
        <label for="email" class="block">Email</label>
        <input required class="w-full outline-0 rounded-lg p-[10px] px-[20px] border border-[#BDBDBD]" type="email" name="email" id="email" placeholder="email">
      </div>

      <div class="w-full max-w-[500px] mb-[40px] ">
        <label for="password" class="block">Password</label>
        <input required class="w-full outline-0 rounded-lg p-[10px] px-[20px] border border-[#BDBDBD]" type="password" name="password" id="password" placeholder="password">
        <?php
        $length = strlen($password_error);
        if ($length > 0) {
          echo ("<p class='text-red-200'>" . $password_error . "</p>");
        }
        ?>
      </div>

      <input type="submit" text="Login" id=" admin-login" type="submit" class="bg-[#2F80ED] hover:bg-[#4091FE] w-full max-w-[500px] mb-[20px] p-[10px] rounded-lg font-[500] text-[white]" onsubmit="(e)=>e.preventDefault();" />

    </form>


  </div>

  <script src="/CSC12/dist/scripts/ui.js"></script>
  <!-- <script src="/CSC12/dist/scripts/login.js"></script>
    <script src="/CSC12/dist/scripts/student.js"></script>
    <script src="/CSC12/dist/app.js"></script> -->

</body>

</html>