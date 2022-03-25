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
  if (!$studentProfile['status']) {
    $error_message = $studentProfile['error'];
  }
}
?>

<?php
  //including the student profile page from views folder
  require_once('/xampp/htdocs/CSC12/dist/views/pages/studentProfilePage.php');

?>
