<?php
$username = "";

$surname = $firstname = $middlename = $dob = $nationality = $state = $lga = $matric_no = "";
$level = 100;

if (!isset($_COOKIE["admin"])) {
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: /CSC12/dist/admin/login/index.php");
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

  // create a new pin based on current time
  $pin = substr(MD5(time()), 0, 12);

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
  echo ("user created sucessfully");

  // reset form values
  $surname = $firstname = $middlename = $dob = $nationality = $state = $lga = $matric_no = "";
  $level = 100;
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

<body class="min-h-[100vh] bg-[#E5E5E5] grid grid-cols-[150px_auto] sm:grid-cols-[200px_auto]">

  <!-- LEFT COLUMN -->
  <div class="col-start-1 col-span-1 relative bg-[#F2F2F2] ">

    <nav class="p-[20px] fixed top-0 left-0 h-[100vh] sm:max-w-[200px] sm:w-[200px] ">

      <div class="w-full flex items-center justify-center">
        <img src="/CSC12/dist/res/images/logo.svg" alt="">
      </div>

      <ul class="list-none mt-[45px] mr-[40px] text-[#333333] ">
        <li class="block mb-[20px] ">
          <a href="/CSC12/dist/admin/" class="block p-[5px] h-full hover:bg-gray-300 hover:rounded ">Overview</a>
        </li>
        <li class="block mb-[20px] ">
          <a href="/CSC12/dist/admin/create/" class="block p-[5px] h-full hover:bg-gray-300 rounded  bg-gray-200 font-[700] text-[#5D5FEF] ">Create</a>
        </li>
        <li class="block mb-[20px] ">
          <a href="/CSC12/dist/admin/update/" class="block p-[5px] h-full hover:bg-gray-300 hover:rounded ">Update</a>
        </li>
        <li>
          <button name="logout" onclick="document.cookie = 'admin=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/'; window.location.replace(`/CSC12/dist/admin/login/index.php`)">logout</button>
        </li>
      </ul>

      <div class="absolute bottom-0 left-0 p-[10px] w-full ">
        <!-- link to update page -->
        <a href="" class="text-[#5D5FEF] text-center">
          <?php echo ($username) ?></a>
      </div>
    </nav>
  </div>

  <!-- RIGHT COLUMN -->
  <div class="col-start-2 col-span-1 p-[20px] bg-[#E5E5E5] relative">

    <!-- ALERT DIV -->
    <div class="w-full pointer-events-none bg-[#e5e5e5b9] backdrop-blur-sm sticky top-[10px] mb-[20px] ">
      <div id="alert" class="hidden font-bold bg-[transparent] w-[100%] p-[5px] mr-auto border border-red-500 text-red-500 " role="alert">
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
      </div>

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


  <script src="/CSC12/dist/scripts/ui.js"></script>
  <!-- <script src="/CSC12/dist/scripts/login.js"></script>
    <script src="/CSC12/dist/scripts/student.js"></script>
    <script src="/CSC12/dist/app.js"></script> -->

</body>

</html>