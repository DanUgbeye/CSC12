<?php
  if (!isset($_COOKIE["student"])) {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: ../student/login/");
    exit();
  } elseif (isset($_COOKIE["student"])) {
    $student = json_decode($_COOKIE["student"]);
    $id = $student->id;
    $matric_no = $student->matric_no;

    require_once "/xampp/htdocs/CSC12/dist/lib/dbConnect.php";
    $studentOps = new dbOps();

    $studentProfile = $studentOps->getStudentById($id, $matric_no);
    if($studentProfile['status'] == false) {
      $error_message = $studentProfile['error'];
    }

    if (isset($_POST["save"])) {
      $surname = $_POST["surname"];
      $firstname = $_POST["firstname"];
      $middlename = $_POST["middlename"];
      $dob = $_POST["d-o-b"];
      $nationality = $_POST["nationality"];
      $state = $_POST["state"];
      $lga = $_POST["lga"];
      $matric_no = $_POST["matric-no"];
      $level = $_POST["level"];
      unset($_POST["save"]);

      if(strlen($matric_no) < 12 || strlen($matric_no) > 14) {
        $error_message = "Invalid matric number";
      }else {
        $student = array();
      
        //creating the student data array
        $student['matric_no'] = $matric_no;
        $student['surname'] = $surname;
        $student['first_name'] = $firstname;
        $student['middle_name'] = $middlename;
        $student['dob'] = $dob;
        $student['nationality'] = $nationality;
        $student['state'] = $state;
        $student['lga'] = $lga;
        $student['level'] = $level;
          
        $res = $studentOps->updateStudent($student, $id);
        if($res['status']) {
          $message = ("changes saved");
          setcookie("student", json_encode(array('matric_no' => $res['result']["matric_no"], 'id' => $res['result']["id"])), time() + 60 * 60 * 24 * 7, "/"); // expire in 7 days
          header("location:/CSC12/dist/student/");
          exit();
        } else {
          $error_message = $res['error'];
        }
        
        // reset form values
        $surname = $firstname = $middlename = $dob = $nationality = $state = $lga = $matric_no = "";
        $level = 100;
      }
    }
  }

?>

<?php
  //including the student edit page from views folder
  require_once('/xampp/htdocs/CSC12/dist/views/pages/studentEditPage.php');

?>
