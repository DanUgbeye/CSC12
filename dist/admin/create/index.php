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

  if(($res['status'])) {
    $message = ("Student created");
  } else {
    $error_message = $res['error'];
  }
  
  // reset form values
  $surname = $firstname = $middlename = $dob = $nationality = $state = $lga = $matric_no = "";
  $level = 100;
}
?>

<?php include "../../templates/header.php" ?>
<?php include "../../templates/sidenav.php" ?>

<!-- RIGHT COLUMN -->
<div class="max-h-screen overflow-y-auto col-start-2 col-span-1 p-[20px] bg-[#E5E5E5] ">

  <?php
    //this displays the error
    if(!empty($error_message)) {
      require_once "/xampp/htdocs/CSC12/dist/views/alert.php";
      showAlert($error_message);
    }
  ?>

  <form action="<?php echo (htmlspecialchars($_SERVER["PHP_SELF"])) ?>" class="w-full" method="post">

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

      </div>
    </div>

    <!-- School Info form group -->
    <div class=" mb-[20px] mt-[40px] ">

      <h3 class=" w-full border-b-[2px] border-[#BDBDBD] font-bold mb-[20px] ">School Information</h3>

      <div class="md:grid md:grid-cols-6 md:grid-rows-1 md:gap-x-[47px] md:gap-y-[10px] font-[500]  ">

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
      </div>

    <?php //echo ("<p class='text-red-500'>$creation_error</p>") ?>

    <!-- CREATE STUDENT BUTTON -->
    <button id="create-std" type="submit" name="submit" class="text-white px-[10px] min-w-[150px] py-[10px] bg-[#2F80ED] rounded-md flex gap-[5px] mt-[30px] ml-auto hover:bg-[#4091FE] ">
      <span>
        <!-- create icon -->
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path opacity="0.3" d="M9 10C10.1046 10 11 9.10457 11 8C11 6.89543 10.1046 6 9 6C7.89543 6 7 6.89543 7 8C7 9.10457 7.89543 10 9 10Z" fill="white"/>
          <path opacity="0.3" d="M9 16C6.3 16 3.2 17.29 3 18H15C14.78 17.28 11.69 16 9 16Z" fill="white"/>
          <path d="M9 14C6.33 14 1 15.34 1 18V20H17V18C17 15.34 11.67 14 9 14ZM3 18C3.2 17.29 6.3 16 9 16C11.69 16 14.78 17.28 15 18H3Z" fill="white"/>
          <path d="M20 10V7H18V10H15V12H18V15H20V12H23V10H20Z" fill="white"/>
          <path d="M9 12C11.21 12 13 10.21 13 8C13 5.79 11.21 4 9 4C6.79 4 5 5.79 5 8C5 10.21 6.79 12 9 12ZM9 6C10.1 6 11 6.9 11 8C11 9.1 10.1 10 9 10C7.9 10 7 9.1 7 8C7 6.9 7.9 6 9 6Z" fill="white"/>
        </svg>
      </span>
      <label for="create-std" class=" sm:flex" >
        Create
      </label>
    </button>

  </form>



  <?php
    // this displays the created successful message
      if ($message) {
        include_once '/xampp/htdocs/CSC12/dist/views/popup.php';
        showPopup($message);
      }
    ?>

</div>
</body>

</html>