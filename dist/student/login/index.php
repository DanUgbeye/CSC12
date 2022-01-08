<?php
session_start();
if (!empty($_SESSION['studentId'])) {
  header("Location: /CSC12/dist/student/");
  exit;
}

$matric_no = $pin = "";
$matric_error = $pin_error = $user_error = "";

if (isset($_POST["submit"])) {
  $matric_no = $_POST["matric-no"];
  $pin = $_POST["pin"];

  if (!$matric_no) {
    $matric_error = "no usernae provided";
  } elseif (strlen($matric_no) != 12 || strlen($matric_no) != 14) {
    $matric_error = "invalid matric number";
  } elseif (!$pin) {
    $pin_error = "no pin provided";
  } elseif (strlen($pin) != 12) {
    $pin_error = "invalid pin";
  }

  $conn = mysqli_connect("localhost", "deedee", "123456", "csc12");

  if (!$conn) {
    echo ("connection error" . mysqli_connect_error());
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

    // check if passwords match
    $password_match = MD5($password) === $student[0]['password'];
    if (!$password_match) {
      $user_error = "incorrect user credentials";
    } else {
      $user = "login sucessfull";
      // setcookie("student", json_encode($student[0]),  60 * 60 * 60 * 7); // expire in 7 days
      header("location:/CSC12/dist/student/");
      exit();
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include_once "/xampp/htdocs/CSC12/dist/templates/header.php" ?>

<div class="main h-full w-full mt-[50px] flex flex-col items-center justify-center">

  <h2 class="text-[36px] font-bold text-[#5D5FEF] mb-[40px] ">Student Login</h2>

  <!-- ALERT DIV -->
  <div class="w-full max-w-[500px] pointer-events-none bg-[#e5e5e5b9] backdrop-blur-sm sticky top-[10px] mb-[20px] ">
    <div id="alert" class="hidden font-bold bg-[transparent] w-[100%] p-[5px] mr-auto border border-red-500 text-red-500 " role="alert">
      Alert
    </div>
  </div>

  <form class="w-full max-w-[500px] " action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" onsubmit="(e)=>e.preventDefault()">

    <div class="w-full max-w-[500px] mb-[20px] ">
      <label for="matric-no" class="block">Matric No</label>
      <input class="w-full outline-0 rounded-lg p-[10px] border border-[#BDBDBD]" type="text" name="matric-no" id="matric-no" placeholder="matric no" value="<?php echo ($matric_no) ?>" minlength="12" maxlength="14" required>
      <?php echo ("<p class='text-red-500'>" . $matric_error . "</p>") ?>
    </div>

    <div class="w-full max-w-[500px] mb-[20px] ">
      <label for="pin" class="block">Pin</label>
      <input class="w-full outline-0 rounded-lg p-[10px] border border-[#BDBDBD]" type="text" name="pin" id="pin" placeholder="0000-0000-0000-0000" value="<?php echo ($pin) ?>" minlength="12" maxlength="12" required>
      <?php echo ("<p class='text-red-500'>" . $pin_error . "</p>") ?>
    </div>

    <input name="submit" type="submit" id="student-login" value="submit" class="bg-[#2F80ED] hover:bg-[#4091FE] w-full max-w-[500px] mb-[20px] p-[10px] rounded-lg font-[500] text-[white] " />
    <?php echo ("<p class='text-red-500'>" . $user_error . "</p>") ?>

  </form>


</div>

<script src="/CSC12/dist/scripts/ui.js"></script>
<!-- <script src="/CSC12/dist/scripts/login.js"></script>
    <script src="/CSC12/dist/scripts/student.js"></script>
    <script src="/CSC12/dist/app.js"></script> -->

</body>

</html>