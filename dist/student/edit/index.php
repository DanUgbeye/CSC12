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
    if(!$studentProfile['status']) {
      $error_message = $studentProfile['error'];
    }

    if (isset($_POST["submit"])) {
      $surname = $_POST["surname"];
      $firstname = $_POST["firstname"];
      $middlename = $_POST["middlename"];
      $dob = $_POST["d-o-b"];
      $nationality = $_POST["nationality"];
      $state = $_POST["state"];
      $lga = $_POST["lga"];
      $matric_no = $_POST["matric-no"];
      $level = $_POST["level"];
      unset($_POST["submit"]);

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
?>

<?php include "/xampp/htdocs/CSC12/dist/templates/header.php" ?>

  <!-- sidenav -->
  <?php include "/xampp/htdocs/CSC12/dist/templates/sidenav.php" ?>

  <!-- RIGHT COLUMN -->
  <div class="col-start-2 col-span-1 p-[20px] bg-[#E5E5E5] ">

    <?php
      //this displays the error
      if(!empty($error_message)) {
        require_once "/xampp/htdocs/CSC12/dist/views/alert.php";
        showAlert($error_message);
      }
    ?>

  
    <form action="<?php echo (htmlspecialchars($_SERVER["PHP_SELF"])) ?>" class="w-full" method="post">

      <!-- SAVE BUTTON -->
      <div class="flex ">
        <button type="submit" name="submit" id="save-std" class=" text-white px-[10px] py-[5px] bg-[#2F80ED] rounded-md flex mt-[30px] ml-auto cursor-pointer hover:bg-[#4091FE] gap-[5px] " >
          <span>
            <img id="save-std" src="/CSC12/dist/res/images/save.svg" alt="">
          </span>
          <p id="save-std" class="hidden sm:block">Save</p>
        </button>
      </div>

      <!-- Personal Info form group -->
      <div class=" mb-[20px] ">

        <h3 class="w-full border-b-[2px] border-[#BDBDBD] font-bold mb-[20px] ">Personal Information</h3>


        <div class="md:grid md:grid-cols-6 md:grid-rows-3 md:gap-x-[47px] md:gap-y-[10px] font-[500]  ">

          <!-- Surname input field -->
          <div class="md:col-start-1 md:col-span-3 md:row-start-1 md:row-span-1  mb-[20px] md:mb-0 ">
            <label for="surname" class="block">Surname</label>
            <input   class="w-full outline-0 rounded p-[10px] border border-[#BDBDBD]" type="text" name="surname" id="surname" placeholder="surname" value="<?php echo $studentProfile['result']['surname']; ?>">
          </div>

          <!-- Firstname input field -->
          <div class="md:col-start-4 md:col-span-3 md:row-start-1 md:row-span-1  mb-[20px] md:mb-0 ">
            <label for="firstname" class="block">Firstname</label>
            <input   class="w-full outline-0 rounded p-[10px] border border-[#BDBDBD] " type="text" name="firstname" id="firstname" placeholder="firstname" value="<?php echo $studentProfile['result']['first_name']; ?>">
          </div>

          <!-- Middlename input field -->
          <div class="md:col-start-1 md:col-span-3 md:row-start-2 md:row-span-1  mb-[20px] md:mb-0 ">
            <label for="middlename" class="block">Middlename</label>
            <input   class="w-full outline-0 rounded p-[10px] border border-[#BDBDBD] " type="text" name="middlename" id="middlename" placeholder="middlename" value="<?php echo $studentProfile['result']['middle_name']; ?>">
          </div>

          <!-- date of birth input field -->
          <div class="md:col-start-4 md:col-span-3 md:row-start-2 md:row-span-1  mb-[20px] md:mb-0 ">
            <label for="d-o-b" class="block">Date of Birth</label>
            <input   class="w-full outline-0 rounded p-[10px] bg-[transparent] placeholder:text-[#BDBDBD] border border-[#BDBDBD] " type="date" name="d-o-b" id="d-o-b" value="<?php echo $studentProfile['result']['dob']; ?>">
          </div>

          <!-- Nationality input field -->
          <div class="md:col-start-1 md:col-span-2 md:row-start-3 md:row-span-1  mb-[20px] md:mb-0 ">
            <label for="nationality" class="block">Nationality</label>
            <input   class="w-full outline-0 rounded p-[10px] placeholder:text-[#BDBDBD] border border-[#BDBDBD] " type="text" name="nationality" id="nationality" placeholder="nationality" value="<?php echo $studentProfile['result']['nationality']; ?>">
          </div>

          <!-- State input field -->
          <div class="md:col-start-3 md:col-span-2 md:row-start-3 md:row-span-1  mb-[20px] md:mb-0 ">
            <label for="state" class="block">State</label>
            <input   class="w-full outline-0 rounded p-[10px] placeholder:text-[#BDBDBD] border border-[#BDBDBD] " type="text" name="state" id="state" placeholder="state" value="<?php echo $studentProfile['result']['state']; ?>">
          </div>

          <!-- LGA input field -->
          <div class="md:col-start-5 md:col-span-2 md:row-start-3 md:row-span-1  mb-[20px] md:mb-0 ">
            <label for="lga" class="block">LGA</label>
            <input   class="w-full outline-0 rounded p-[10px] placeholder:text-[#BDBDBD] border border-[#BDBDBD] " type="text" name="lga" id="lga" placeholder="LGA" value="<?php echo $studentProfile['result']['lga']; ?>">
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
            <input   class="w-full outline-0 rounded p-[10px] border border-[#BDBDBD]" type="text" name="matric-no" id="matric-no" placeholder="Eg. 17/184145016TR" value="<?php echo $studentProfile['result']['matric_no']; ?>">
          </div>

          <!-- Level input field -->
          <div class="md:col-start-4 md:col-span-3 md:row-start-1 md:row-span-1  mb-[20px] md:mb-0 ">
            <label for="level" class="block">Level</label>
            <select   class="w-full outline-0 rounded p-[10px] bg-[transparent] border border-[#BDBDBD] " type="" name="level" id="level" value="<?php echo $studentProfile['result']['level']; ?>">
              <option value="100">100</option>
              <option value="200">200</option>
              <option value="300">300</option>
              <option value="400">400</option>
            </select>
          </div>

        </div>
      </div>

    </form>
  </div>

  <?php
    if(!empty($studentProfile['result']['level'])) {
      echo ('
        <script>
          document.querySelector("#level").value = ' . $studentProfile['result']['level'] . ';
          document.querySelector("#level").classList.remove("bg-[transparent]");
          document.querySelector("#level").classList.add("bg-[white]");
          document.querySelector("#d-o-b").classList.remove("bg-[transparent]");
          document.querySelector("#d-o-b").classList.add("bg-[white]");
        </script>
      ');
    }
?>
  <script src="../scripts/ui.js"></script>

</body>

</html>