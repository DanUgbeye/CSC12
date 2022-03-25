<?php
$username = "";
$creation_error = "";
$surname = $firstname = $middlename = $dob = $nationality = $state = $lga = $matric_no = "";
$level = 100;
$error_message = $message = '';

if (!isset($_COOKIE["admin"])) {
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: /CSC12/dist/admin/login/");
  exit();
} else {
  $admin = json_decode($_COOKIE["admin"]);
  $username = $admin->email;
}

if (isset($_POST["submit"])) {
  $surname = $_POST["surname"];
  $firstname = $_POST["firstname"];
  $middlename = $_POST["middlename"];
  $dob = $_POST["dob"];
  $nationality = $_POST["nationality"];
  $state = $_POST["state"];
  $lga = $_POST["lga"];
  $matric_no = $_POST["matric-no"];
  $level = $_POST["level"];

  if(strlen($matric_no) < 12 || strlen($matric_no) > 14) {
    $error_message = "Invalid matric number";
  }else {
    // create a connection to the db
    $conn = mysqli_connect("localhost", "deedee", "123456", "csc12");
  
    if (!$conn) {
      echo ("connection error" . mysqli_connect_error());
    }
  
  
    // query for checking if a user with the pin already exists in the db
    do {
      // create a new pin based on current time
      $pin = substr(MD5(time()), 0, 12);
  
      // query for checking if a user with the matric number already exists in the db
      $sql = "SELECT `pin` FROM `students` WHERE `pin`='" . $pin . "'";
      $result = mysqli_query($conn, $sql);
      $existing_student = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } while (count($existing_student) > 0);
  
    // free system resources
    mysqli_free_result($result);
  
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
    $student['pin'] = $pin;
  
    require_once "/xampp/htdocs/CSC12/dist/lib/dbConnect.php";
    $adminOps = new adminDb();
  
    $res = $adminOps->createStudent($student);
  
    if (($res['status'])) {
      $message = ("Student created");
    } else {
      $error_message = $res['error'];
    }
  
    // reset form values
    $surname = $firstname = $middlename = $dob = $nationality = $state = $lga = $matric_no = "";
    $level = 100;

  }
}
?>

<?php
  //including the admin create page from views folder
  require_once('/xampp/htdocs/CSC12/dist/views/pages/adminCreatePage.php');

?>