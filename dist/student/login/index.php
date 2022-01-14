<?php
  session_start();

  // if a cookie exists, redirect to the home page
  if (isset($_COOKIE["admin"])) {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: /CSC12/dist/admin/");
    exit();
  } elseif (isset($_COOKIE["student"])) {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: /CSC12/dist/student/");
    exit();
  }

  $matric_no = $pin = "";
  $matric_error = $pin_error = $user_error = $user = "";

  if (isset($_POST["submit"])) {
    $matric_no = $_POST["matric-no"];
    $pin = $_POST["pin"];

    if (!$matric_no) {
      $matric_error = "no matric number provided";
    } elseif (strlen($matric_no) != 12 && strlen($matric_no) != 14) {
      $matric_error = "invalid matric number";
    } elseif (!$pin) {
      $pin_error = "no pin provided";
    } elseif (strlen($pin) != 12) {
      $pin_error = "invalid pin";
    } else {

      $conn = mysqli_connect("localhost", "deedee", "123456", "csc12");
  
      if (!$conn) {
        echo ("connection error: " . mysqli_connect_error());
      }
  
      $sql = "SELECT `pin`, `matric_no`, `id` FROM `students` WHERE `matric_no`='" . $matric_no . "'";
      $result = mysqli_query($conn, $sql);
  
      // change result into an array
      $student = mysqli_fetch_all($result, MYSQLI_ASSOC);
  
      // if no student is found
      if (count($student) < 1) {
        $user_error = "no user found";
      } else {
  
        // free memory
        mysqli_free_result($result);
  
        // check if pins match
        $pin_match = $pin === $student[0]['pin'];
        if (!$pin_match) {
          $user_error = "incorrect user credentials";
        } else {
          $user = "login sucessful";
          setcookie("student", json_encode(array('matric_no' => $student[0]["matric_no"], 'id' => $student[0]["id"])), time() + 60 * 60 * 24 * 7, "/"); // expire in 7 days
          header("location:/CSC12/dist/student/");
          exit();
        }
      }

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

    <div class="main h-full w-full max-w-[500px] mx-auto mt-[50px] flex flex-col items-center justify-center">

      <h2 class="text-[36px] font-bold text-[#5D5FEF] mb-[40px] ">Student Login</h2>

      <?php
        //this displays the error
        if(!empty($user_error)) {
          require_once "/xampp/htdocs/CSC12/dist/views/alert.php";
          showAlert($user_error);
        }

      ?>

      <form class="w-full max-w-[500px] " action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" onsubmit="(e)=>e.preventDefault()">

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

        <input name="submit" type="submit" id="student-login" value="login" class="bg-[#2F80ED] hover:bg-[#4091FE] w-full max-w-[500px] mb-[20px] p-[10px] rounded-lg font-[500] text-[white] " />
        <?php //echo ("<p class='text-red-500'>" . $user_error . "</p>") ?>

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