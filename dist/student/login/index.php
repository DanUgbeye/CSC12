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

<?php
  //including the student login page from views folder
  require_once('/xampp/htdocs/CSC12/dist/views/pages/studentLoginPage.php');

?>