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
<<<<<<< HEAD
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

    // create a connection to the db
    $conn = mysqli_connect("localhost", "deedee", "123456", "csc12");

    if (!$conn) {
      echo ("connection error" . mysqli_connect_error());
    }

=======
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

  // create a connection to the db
  $conn = mysqli_connect("localhost", "deedee", "123456", "csc12");

  if (!$conn) {
    echo ("connection error" . mysqli_connect_error());
  }

  
  // query for checking if a user with the pin already exists in the db
  do {
>>>>>>> ac6ecc2583784322c0753bb26ac6a18aeae0c151
    // create a new pin based on current time
    $pin = substr(MD5(time()), 0, 12);

    // query for checking if a user with the matric number already exists in the db
    $sql = "SELECT `matric_no` FROM `students` WHERE `matric_no`='" . $matric_no . "'";
    $result = mysqli_query($conn, $sql);
    $existing_student = mysqli_fetch_all($result, MYSQLI_ASSOC);
<<<<<<< HEAD

    if (count($existing_student) > 0) {
      $creation_error =  ("a user with this matric number already exists");
    } else {
      // query for checking if a user with the pin already exists in the db
      $sql = "SELECT `pin` FROM `students` WHERE `pin`='" . $pin . "'";
      $result = mysqli_query($conn, $sql);
      $existing_student = mysqli_fetch_all($result, MYSQLI_ASSOC);

      // while pin isn't unique always generate new pins until a unique pin is gotten
      while (count($existing_student) === 1) {
        $pin = substr(MD5(time()), 0, 12);
        $sql = "SELECT `pin` FROM `students` WHERE `pin`='" . $pin . "'";
        $result = mysqli_query($conn, $sql);
        $existing_student =
          mysqli_fetch_all($result, MYSQLI_ASSOC);
      }
      // free system resources
      mysqli_free_result($result);

      // query for saving user data
      $sql = "INSERT INTO `students`(`pin`, `matric_no`, `surname`, `first_name`, `middle_name`, `dob`, `nationality`, `state`, `lga`, `level`) VALUES(" . "'" . $pin . "','" . $matric_no . "'," . "'" . $surname . "'," . "'" . $firstname . "'," . "'" . $middlename . "'," . "'" . $dob . "'," . "'" . $nationality . "'," . "'" . $state . "'," . "'" . $lga . "'," . "'" . $level . "')";

      $result = mysqli_query($conn, $sql);
      $creation_error = ("user created sucessfully");

      // reset form values
      $surname = $firstname = $middlename = $dob = $nationality = $state = $lga = $matric_no = "";
      $level = 100;
    }
  }
=======
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

  if(($res['status'])) {
    $message = ("Student created");
  } else {
    $error_message = $res['error'];
  }
  // // query for saving user data
  // $sql = "INSERT INTO `students`(`pin`, `matric_no`, `surname`, `first_name`, `middle_name`, `dob`, `nationality`,
  //  `state`, `lga`, `level`) 
  //  VALUES(" . "'" . $pin . "','" . $matric_no . "'," . "'" . $surname . "'," . "'" . $firstname . "'," . "'" 
  //  . $middlename . "'," . "'" . $dob . "'," . "'" . $nationality . "'," . "'" . $state . "'," . "'" . $lga . "'," . "'" 
  //  . $level . "')";

  // $result = mysqli_query($conn, $sql);

  // reset form values
  $surname = $firstname = $middlename = $dob = $nationality = $state = $lga = $matric_no = "";
  $level = 100;
>>>>>>> ac6ecc2583784322c0753bb26ac6a18aeae0c151
}
?>

<?php include "../../templates/header.php" ?>
<?php include "../../templates/sidenav.php" ?>

<!-- RIGHT COLUMN -->
<div class="max-h-screen overflow-y-auto col-start-2 col-span-1 p-[20px] bg-[#E5E5E5] ">

  <!-- ALERT DIV -->
  <div class=" w-full pointer-events-none bg-[#e5e5e5b9] backdrop-blur-sm sticky top-[10px] mb-[20px] ">
    <div id=" alert" class="hidden font-bold bg-[transparent] w-[100%] p-[5px] mr-auto border border-red-500 text-red-500 " role="alert">
      Alert
    </div>
  </div>

  <form action="<?php echo (htmlspecialchars($_SERVER["PHP_SELF"])) ?>" class="c" method="post">

    <!-- Personal Info form group -->
    <div class=" mb-[20px] ">

      <h3 class="w-full border-b-[2px] border-[#BDBDBD] font-bold mb-[20px] ">Personal Information</h3>

      <div class="md:grid md:grid-cols-6 md:grid-rows-3 md:gap-x-[47px] md:gap-y-[10px] font-[500]  ">

        <!-- Surname input field -->
        <div class="md:col-start-1 md:col-span-3 md:row-start-1 md:row-span-1  mb-[20px] md:mb-0 ">
          <label for="surname" class="block">Surname</label>
          <input class="w-full outline-0 rounded p-[10px] border border-[#BDBDBD]" type="text" name="surname" id="surname" value="<?php echo ($surname) ?>" required placeholder="surname">
        </div>

        <!-- Firstname input field -->
        <div class="md:col-start-4 md:col-span-3 md:row-start-1 md:row-span-1  mb-[20px] md:mb-0 ">
          <label for="firstname" class="block">Firstname</label>
          <input class="w-full outline-0 rounded p-[10px] border border-[#BDBDBD] " type="text" name="firstname" id="firstname" placeholder="firstname" value="<?php echo ($firstname) ?>" required>
        </div>

<<<<<<< HEAD
        <!-- Middlename input field -->
        <div class="md:col-start-1 md:col-span-3 md:row-start-2 md:row-span-1  mb-[20px] md:mb-0 ">
          <label for="middlename" class="block">Middlename</label>
          <input class="w-full outline-0 rounded p-[10px] border border-[#BDBDBD] " type="text" name="middlename" id="middlename" placeholder="middlename" value="<?php echo ($middlename) ?>" required>
        </div>

        <!-- date of birth input field -->
        <div class="md:col-start-4 md:col-span-3 md:row-start-2 md:row-span-1  mb-[20px] md:mb-0 ">
          <label for="d-o-b" class="block">Date of Birth</label>
          <input class="w-full outline-0 rounded p-[10px] bg-[white] placeholder:text-[#BDBDBD] border border-[#BDBDBD] " type="date" name="dob" id="d-o-b" value="<?php echo ($dob) ?>" required>
        </div>
=======
    <?php
      //this displays the error
      if(!empty($error_message)) {
        require_once "/xampp/htdocs/CSC12/dist/views/alert.php";
        showAlert($error_message);
      }
    ?>

    <form action="<?php echo (htmlspecialchars($_SERVER["PHP_SELF"])) ?>" class="" method="post">

      <!-- Personal Info form group -->
      <div class=" mb-[20px] ">

        <h3 class="w-full border-b-[2px] border-[#BDBDBD] font-bold mb-[20px] ">Personal Information</h3>

        <div class="md:grid md:grid-cols-6 md:grid-rows-3 md:gap-x-[47px] md:gap-y-[10px] font-[500]  ">

          <!-- Surname input field -->
          <div class="md:col-start-1 md:col-span-3 md:row-start-1 md:row-span-1  mb-[20px] md:mb-0 ">
            <label for="surname" class="block">Surname</label>
            <input required class="w-full outline-0 rounded p-[10px] border border-[#BDBDBD]" type="text" name="surname" id="surname" value="<?php echo ($surname) ?>" required placeholder="surname">
          </div>

          <!-- Firstname input field -->
          <div class="md:col-start-4 md:col-span-3 md:row-start-1 md:row-span-1  mb-[20px] md:mb-0 ">
            <label for="firstname" class="block">Firstname</label>
            <input required class="w-full outline-0 rounded p-[10px] border border-[#BDBDBD] " type="text" name="firstname" id="firstname" placeholder="firstname" value="<?php echo ($firstname) ?>" required>
          </div>

          <!-- Middlename input field -->
          <div class="md:col-start-1 md:col-span-3 md:row-start-2 md:row-span-1  mb-[20px] md:mb-0 ">
            <label for="middlename" class="block">Middlename</label>
            <input required class="w-full outline-0 rounded p-[10px] border border-[#BDBDBD] " type="text" name="middlename" id="middlename" placeholder="middlename" value="<?php echo ($middlename) ?>" required>
          </div>

          <!-- date of birth input field -->
          <div class="md:col-start-4 md:col-span-3 md:row-start-2 md:row-span-1  mb-[20px] md:mb-0 ">
            <label for="d-o-b" class="block">Date of Birth</label>
            <input required class="w-full outline-0 rounded p-[10px] bg-[white] placeholder:text-[#BDBDBD] border border-[#BDBDBD] " type="date" name="dob" id="d-o-b" value="<?php echo ($dob) ?>" required>
          </div>

          <!-- Nationality input field -->
          <div class="md:col-start-1 md:col-span-2 md:row-start-3 md:row-span-1  mb-[20px] md:mb-0 ">
            <label for="nationality" class="block">Nationality</label>
            <input required class="w-full outline-0 rounded p-[10px] placeholder:text-[#BDBDBD] border border-[#BDBDBD] " type="text" name="nationality" id="nationality" placeholder="nationality" value="<?php echo ($nationality) ?>" required>
          </div>

          <!-- State input field -->
          <div class="md:col-start-3 md:col-span-2 md:row-start-3 md:row-span-1  mb-[20px] md:mb-0 ">
            <label for="state" class="block">State</label>
            <input required class="w-full outline-0 rounded p-[10px] placeholder:text-[#BDBDBD] border border-[#BDBDBD] " type="text" name="state" id="state" placeholder="state" value="<?php echo ($state) ?>" required>
          </div>

          <!-- LGA input field -->
          <div class="md:col-start-5 md:col-span-2 md:row-start-3 md:row-span-1  mb-[20px] md:mb-0 ">
            <label for="lga" class="block">LGA</label>
            <input required class="w-full outline-0 rounded p-[10px] placeholder:text-[#BDBDBD] border border-[#BDBDBD] " type="text" name="lga" id="lga" placeholder="LGA" value="<?php echo ($lga) ?>" required>
          </div>
>>>>>>> ac6ecc2583784322c0753bb26ac6a18aeae0c151

        <!-- Nationality input field -->
        <div class="md:col-start-1 md:col-span-2 md:row-start-3 md:row-span-1  mb-[20px] md:mb-0 ">
          <label for="nationality" class="block">Nationality</label>
          <input class="w-full outline-0 rounded p-[10px] placeholder:text-[#BDBDBD] border border-[#BDBDBD] " type="text" name="nationality" id="nationality" placeholder="nationality" value="<?php echo ($nationality) ?>" required>
        </div>

        <!-- State input field -->
        <div class="md:col-start-3 md:col-span-2 md:row-start-3 md:row-span-1  mb-[20px] md:mb-0 ">
          <label for="state" class="block">State</label>
          <input class="w-full outline-0 rounded p-[10px] placeholder:text-[#BDBDBD] border border-[#BDBDBD] " type="text" name="state" id="state" placeholder="state" value="<?php echo ($state) ?>" required>
        </div>

        <!-- LGA input field -->
        <div class="md:col-start-5 md:col-span-2 md:row-start-3 md:row-span-1  mb-[20px] md:mb-0 ">
          <label for="lga" class="block">LGA</label>
          <input class="w-full outline-0 rounded p-[10px] placeholder:text-[#BDBDBD] border border-[#BDBDBD] " type="text" name="lga" id="lga" placeholder="LGA" value="<?php echo ($lga) ?>" required>
        </div>

      </div>
    </div>

    <!-- School Info form group -->
    <div class=" mb-[20px] mt-[40px] ">

<<<<<<< HEAD
      <h3 class=" w-full border-b-[2px] border-[#BDBDBD] font-bold mb-[20px] ">School Information</h3>

      <div class="md:grid md:grid-cols-6 md:grid-rows-1 md:gap-x-[47px] md:gap-y-[10px] font-[500]  ">
=======
          <!-- Matric No input field -->
          <div class="md:col-start-1 md:col-span-3 md:row-start-1 md:row-span-1  mb-[20px] md:mb-0 ">
            <label for="matric-no" class="block">Matric No</label>
            <input required class="w-full outline-0 rounded p-[10px] border border-[#BDBDBD]" type="text" name="matric-no" id="matric-no" placeholder="Eg. 17/184145016TR" value="<?php echo ($matric_no) ?>" required>
          </div>

          <!-- Level input field -->
          <div class="md:col-start-4 md:col-span-3 md:row-start-1 md:row-span-1  mb-[20px] md:mb-0 ">
            <label for="level" class="block">Level</label>
            <select required class="w-full outline-0 rounded p-[10px] bg-[white] border border-[#BDBDBD] " type="" name="level" id="level" value="<?php echo ($level) ?>" required>
              <option value="100">100</option>
              <option value="200">200</option>
              <option value="300">300</option>
              <option value="400">400</option>
            </select>
          </div>
>>>>>>> ac6ecc2583784322c0753bb26ac6a18aeae0c151

        <!-- Matric No input field -->
        <div class="md:col-start-1 md:col-span-3 md:row-start-1 md:row-span-1  mb-[20px] md:mb-0 ">
          <label for="matric-no" class="block">Matric No</label>
          <input class="w-full outline-0 rounded p-[10px] border border-[#BDBDBD]" type="text" name="matric-no" id="matric-no" placeholder="Eg. 17/184145016TR" value="<?php echo ($matric_no) ?>" required>
        </div>

        <!-- Level input field -->
        <div class="md:col-start-4 md:col-span-3 md:row-start-1 md:row-span-1  mb-[20px] md:mb-0 ">
          <label for="level" class="block">Level</label>
          <select class="w-full outline-0 rounded p-[10px] bg-[white] border border-[#BDBDBD] " type="" name="level" id="level" value="<?php echo ($level) ?>" required>
            <option value="100">100</option>
            <option value="200">200</option>
            <option value="300">300</option>
            <option value="400">400</option>
          </select>
        </div>

<<<<<<< HEAD
      </div>
    </div>
=======
    <?php
    // this displays the login successful message
      if ($message) {
        include_once '/xampp/htdocs/CSC12/dist/views/popup.php';
        showPopup($message);
      }
    ?>
>>>>>>> ac6ecc2583784322c0753bb26ac6a18aeae0c151

    <?php echo ("<p class='text-red-500'>$creation_error</p>") ?>
    <!-- CREATE STUDENT BUTTON -->
    <button id="create-std" type="submit" name="submit" class="text-white px-[20px] py-[10px] bg-[#2F80ED] rounded-md flex gap-[10px] mt-[30px] ml-auto cursor-pointer hover:bg-[#4091FE] ">
      <span>
        <img src="/CSC12/dist/res/images/create.svg" alt="">
      </span>
      Create Student
    </button>
  </form>



  <!-- POPUP DIV -->
  <div class="fixed pointer-events-none bg-transparent right-[50%] rounded-md w-[150px]  left-[50%] bottom-[20%] top-[90vh] ">
    <div id="popup" class="gap-[5px] hidden font-bold rounded-md min-w-[50px] w-[fit-content] py-[5px] px-[10px] bg-gray-200 border border-gray-700 text-gray-700 text-center " role="alert">
      Popup
    </div>
  </div>

</div>
</body>

</html>