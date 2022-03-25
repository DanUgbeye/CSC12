<?php
require_once "/xampp/htdocs/CSC12/dist/lib/dbConnect.php";
session_start();

if (!isset($_COOKIE["admin"])) {
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: /CSC12/dist/admin/login/");
  exit();
} else {
  $username = $matric_no = "";
  $adminOps = new adminDb();
  $data = array();
  $editing_state = false;
  $student_data = false;
  $admin = json_decode($_COOKIE["admin"]);
  $error_message = "";
  $username = $admin->email;
}

if (isset($_POST["edit"])) {
  $editing_state = true;
  $matric_no = $_SESSION["matric_no"];
  $result = $adminOps->getStudentByMatricNo($matric_no);
  if ($result['status']) {
    $data = $result['result'];
    $student_data = true;
  }
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

  $res = $adminOps->updateStudent($student, $_SESSION['id']);
  $editing_state = false;
  $matric_no = $_SESSION["matric_no"];
  if ($res['status'] == true) {
    $data = $res['result'];
    $student_data = true;
  }else {
    $result = $adminOps->getStudentByMatricNo($matric_no);
    $data = $result['result'];
    $editing_state = true;
    $error_message = $res['error'];
    $student_data = true;
  }
}

if (isset($_POST["delete"])) {
  $matric_no = $_SESSION["matric_no"];
  $result = $adminOps->deleteStudent($matric_no, "matric_no");
  if ($result['status']) {
    $data = array();
  }
}

if (isset($_POST["search"])) {
  $matric_no = $_SESSION['matric_no'] = $_POST["matric_no"];
  $result = $adminOps->getStudentByMatricNo($matric_no);
  if ($result['status'] == true) {
    $data = $result['result'];
    $_SESSION["id"] = $data["id"];
    $student_data = true;
  }else {
    // echo $result['error'];
    $error_message = $result['error'];
  }
}

?>

<?php
  //including the admin update page from views folder
  require_once('/xampp/htdocs/CSC12/dist/views/pages/adminUpdatePage.php');

?>