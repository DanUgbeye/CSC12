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
    
  }
?>

<?php include "../templates/header.php" ?>

  <!-- sidenav -->
  <?php include "../templates/sidenav.php" ?>

  <!-- RIGHT COLUMN -->
  <div class="col-start-2 col-span-1 p-[20px] bg-[#E5E5E5] ">

    <!-- ALERT DIV -->
    <div class="w-full pointer-events-none bg-[#e5e5e5b9] backdrop-blur-sm sticky top-[10px] mb-[20px] ">
      <div id="alert" class="hidden font-bold bg-[transparent] w-[100%] p-[5px] mr-auto border border-red-500 text-red-500 " role="alert">
        Alert
      </div>
    </div>

    <!-- EDIT STUDENT BUTTON -->
    <div class="flex ">
      <button class="text-white bg-[#2F80ED] rounded-md  mt-[30px] ml-auto cursor-pointer hover:bg-[#4091FE]  ">
        <a href="/CSC12/dist/student/edit/" class="px-[10px] py-[5px] flex gap-[5px]">
          <span>
            <img src="/CSC12/dist/res/images/pencil.svg" alt="edit">
          </span>
          <p class="hidden sm:block">Edit</p>
        </a>
      </button>
    </div>


    <form action="" class="">

      <!-- Personal Info form group -->
      <div class=" mb-[20px] ">

        <h3 class="w-full border-b-[2px] border-[#BDBDBD] font-bold mb-[20px] ">Personal Information</h3>


        <div class="md:grid md:grid-cols-6 md:grid-rows-3 md:gap-x-[47px] md:gap-y-[10px] font-[500]  ">

          <!-- Surname input field -->
          <div class="md:col-start-1 md:col-span-3 md:row-start-1 md:row-span-1  mb-[20px] md:mb-0 ">
            <label for="surname" class="block">Surname</label>
            <input disabled class="w-full outline-0 rounded p-[10px] border border-[#BDBDBD]" type="text" name="surname" id="surname" placeholder="surname" value="<?php echo $studentProfile['result']['surname']; ?>">
          </div>

          <!-- Firstname input field -->
          <div class="md:col-start-4 md:col-span-3 md:row-start-1 md:row-span-1  mb-[20px] md:mb-0 ">
            <label for="firstname" class="block">Firstname</label>
            <input disabled class="w-full outline-0 rounded p-[10px] border border-[#BDBDBD] " type="text" name="firstname" id="firstname" placeholder="firstname" value="<?php echo $studentProfile['result']['first_name']; ?>">
          </div>

          <!-- Middlename input field -->
          <div class="md:col-start-1 md:col-span-3 md:row-start-2 md:row-span-1  mb-[20px] md:mb-0 ">
            <label for="middlename" class="block">Middlename</label>
            <input disabled class="w-full outline-0 rounded p-[10px] border border-[#BDBDBD] " type="text" name="middlename" id="middlename" placeholder="middlename" value="<?php echo $studentProfile['result']['middle_name']; ?>">
          </div>

          <!-- date of birth input field -->
          <div class="md:col-start-4 md:col-span-3 md:row-start-2 md:row-span-1  mb-[20px] md:mb-0 ">
            <label for="d-o-b" class="block">Date of Birth</label>
            <input disabled class="w-full outline-0 rounded p-[10px] bg-[transparent] placeholder:text-[#BDBDBD] border border-[#BDBDBD] " type="date" name="d-o-b" id="d-o-b" value="<?php echo $studentProfile['result']['dob']; ?>">
          </div>

          <!-- Nationality input field -->
          <div class="md:col-start-1 md:col-span-2 md:row-start-3 md:row-span-1  mb-[20px] md:mb-0 ">
            <label for="nationality" class="block">Nationality</label>
            <input disabled class="w-full outline-0 rounded p-[10px] placeholder:text-[#BDBDBD] border border-[#BDBDBD] " type="text" name="nationality" id="nationality" placeholder="nationality" value="<?php echo $studentProfile['result']['nationality']; ?>">
          </div>

          <!-- State input field -->
          <div class="md:col-start-3 md:col-span-2 md:row-start-3 md:row-span-1  mb-[20px] md:mb-0 ">
            <label for="state" class="block">State</label>
            <input disabled class="w-full outline-0 rounded p-[10px] placeholder:text-[#BDBDBD] border border-[#BDBDBD] " type="text" name="state" id="state" placeholder="state" value="<?php echo $studentProfile['result']['state']; ?>">
          </div>

          <!-- LGA input field -->
          <div class="md:col-start-5 md:col-span-2 md:row-start-3 md:row-span-1  mb-[20px] md:mb-0 ">
            <label for="lga" class="block">LGA</label>
            <input disabled class="w-full outline-0 rounded p-[10px] placeholder:text-[#BDBDBD] border border-[#BDBDBD] " type="text" name="lga" id="lga" placeholder="LGA" value="<?php echo $studentProfile['result']['lga']; ?>">
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
            <input disabled class="w-full outline-0 rounded p-[10px] border border-[#BDBDBD]" type="text" name="matric-no" id="matric-no" placeholder="Eg. 17/184145016TR" value="<?php echo $studentProfile['result']['matric_no']; ?>">
          </div>

          <!-- Level input field -->
          <div class="md:col-start-4 md:col-span-3 md:row-start-1 md:row-span-1  mb-[20px] md:mb-0 ">
            <label for="level" class="block">Level</label>
            <select disabled class="w-full outline-0 rounded p-[10px] bg-[transparent] border border-[#BDBDBD] " type="" name="level" id="level" value="<?php echo $studentProfile['result']['level']; ?>">
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
echo ('
      <script>
        document.querySelector("#level").value = ' . $studentProfile['result']['level'] . ';
        document.querySelector("#d-o-b").classList.remove("bg-[white]");
        document.querySelector("#d-o-b").classList.add("bg-[transparent]");
        document.querySelector("#level").classList.remove("bg-[white]");
        document.querySelector("#level").classList.add("bg-[transparent]");
      </script>
    ');
?>
  <script src="../scripts/ui.js"></script>

</body>

</html>