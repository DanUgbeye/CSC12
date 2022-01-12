<?php
$username = "";
if (!isset($_COOKIE["admin"])) {
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: /CSC12/dist/admin/login/");
  exit();
} else {
  $admin = json_decode($_COOKIE["admin"]);
  $username = $admin->email;
}
?>

<?php include "../../templates/header.php" ?>
<?php include "../../templates/sidenav.php" ?>

<!-- RIGHT COLUMN -->
<div class="max-h-screen overflow-y-auto col-start-2 col-span-1 p-[20px] bg-[#E5E5E5] ">

  <!-- ALERT DIV -->
  <div class="w-full z-[1000] pointer-events-none bg-[#e5e5e5b9] backdrop-blur-sm sticky top-[10px] mb-[20px] ">
    <div id="alert" class="hidden font-bold bg-[#e5e5e5b9] w-[100%] p-[5px] mr-auto border border-red-500 text-red-500 " role="alert">
      Alert
    </div>
  </div>

  <!-- Search input field -->
  <div class="mb-[20px] flex items-center relative">
    <input class="w-full outline-0 rounded p-[10px] pr-[35px] placeholder:text-[transparent] sm:placeholder:text-gray-300 border border-[#BDBDBD]" type="text" name="search" id="search" placeholder="Type in a matric number to begin">

    <!-- REMEMBER ONCLICK HERE TOO -->
    <button id="search-std" onclick=" " class="absolute right-[10px] p-[10px] pr-0  ">
      <img src="/CSC12/dist/res/images/search.svg" alt="search">
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
          <input disabled class="w-full outline-0 rounded p-[10px] border border-[#BDBDBD]" type="text" name="surname" id="surname" placeholder="surname">
        </div>

        <!-- Firstname input field -->
        <div class="md:col-start-4 md:col-span-3 md:row-start-1 md:row-span-1  mb-[20px] md:mb-0 ">
          <label for="firstname" class="block">Firstname</label>
          <input disabled class="w-full outline-0 rounded p-[10px] border border-[#BDBDBD] " type="text" name="firstname" id="firstname" placeholder="firstname">
        </div>

        <!-- Middlename input field -->
        <div class="md:col-start-1 md:col-span-3 md:row-start-2 md:row-span-1  mb-[20px] md:mb-0 ">
          <label for="middlename" class="block">Middlename</label>
          <input disabled class="w-full outline-0 rounded p-[10px] border border-[#BDBDBD] " type="text" name="middlename" id="middlename" placeholder="middlename">
        </div>

        <!-- date of birth input field -->
        <div class="md:col-start-4 md:col-span-3 md:row-start-2 md:row-span-1  mb-[20px] md:mb-0 ">
          <label for="d-o-b" class="block">Date of Birth</label>
          <input disabled placeholder="YYYY-MM-DD" class="w-full outline-0 rounded p-[10px] bg-[transparent] placeholder:text-[#BDBDBD] border border-[#BDBDBD] " type="date" name="d-o-b" id="d-o-b">
        </div>

        <!-- Nationality input field -->
        <div class="md:col-start-1 md:col-span-2 md:row-start-3 md:row-span-1  mb-[20px] md:mb-0 ">
          <label for="nationality" class="block">Nationality</label>
          <input disabled class="w-full outline-0 rounded p-[10px] placeholder:text-[#BDBDBD] border border-[#BDBDBD] " type="text" name="nationality" id="nationality" placeholder="nationality">
        </div>

        <!-- State input field -->
        <div class="md:col-start-3 md:col-span-2 md:row-start-3 md:row-span-1  mb-[20px] md:mb-0 ">
          <label for="state" class="block">State</label>
          <input disabled class="w-full outline-0 rounded p-[10px] placeholder:text-[#BDBDBD] border border-[#BDBDBD] " type="text" name="state" id="state" placeholder="state">
        </div>

        <!-- LGA input field -->
        <div class="md:col-start-5 md:col-span-2 md:row-start-3 md:row-span-1  mb-[20px] md:mb-0 ">
          <label for="lga" class="block">LGA</label>
          <input disabled class="w-full outline-0 rounded p-[10px] placeholder:text-[#BDBDBD] border border-[#BDBDBD] " type="text" name="lga" id="lga" placeholder="LGA">
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
          <input disabled class="w-full outline-0 rounded p-[10px] border border-[#BDBDBD]" type="text" name="matric-no" id="matric-no" placeholder="Eg. 17/184145016TR">
        </div>

        <!-- Level input field -->
        <div class="md:col-start-4 md:col-span-3 md:row-start-1 md:row-span-1  mb-[20px] md:mb-0 ">
          <label for="level" class="block">Level</label>
          <select disabled class="w-full outline-0 rounded p-[10px] bg-[transparent] border border-[#BDBDBD] " type="" name="level" id="level">
            <option value="100">100</option>
            <option value="200">200</option>
            <option value="300">300</option>
            <option value="400">400</option>
          </select>
        </div>

      </div>
    </div>


    <div class="flex w-max ml-auto">
      <!-- EDIT STUDENT BUTTON -->
      <button class="text-white py-3 px-4 rounded-md flex mt-[30px] ml-[20px] cursor-pointer bg-[#2F80ED] hover:bg-[#033e8b]">
        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M4.333 16.548L16.57 4.31001C17.0534 3.84738 17.6988 3.59242 18.3679 3.59973C19.037 3.60704 19.6767 3.87605 20.1499 4.34914C20.6231 4.82223 20.8923 5.4618 20.8998 6.1309C20.9073 6.8 20.6525 7.44544 20.19 7.92901L7.951 20.167C7.6718 20.4462 7.31619 20.6366 6.929 20.714L3 21.5L3.786 17.57C3.86345 17.1828 4.05378 16.8272 4.333 16.548V16.548Z" stroke="#F2F2F2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M14.5 7L17.5 10" stroke="#F2F2F2" stroke-width="2" />
        </svg>

        <span class="ml-3">
          Edit
        </span>
      </button>

      <!-- SAVE BUTTON -->
      <button class="text-white py-3 px-4 rounded-md flex mt-[30px] ml-[20px] cursor-pointer bg-[#1db336] hover:bg-[#038013]">
        <svg width=" 24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M19 21.5H5C4.46957 21.5 3.96086 21.2893 3.58579 20.9142C3.21071 20.5391 3 20.0304 3 19.5V5.5C3 4.96957 3.21071 4.46086 3.58579 4.08579C3.96086 3.71071 4.46957 3.5 5 3.5H16L21 8.5V19.5C21 20.0304 20.7893 20.5391 20.4142 20.9142C20.0391 21.2893 19.5304 21.5 19 21.5Z" stroke="#F2F2F2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M17 21.5V13.5H7V21.5" stroke="#F2F2F2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M7 3.5V8.5H15" stroke="#F2F2F2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <span class="ml-3">
          Save
        </span>
      </button>

      <!-- DELETE STUDENT BUTTON -->
      <button class="text-white py-3 px-4 bg-[#fc4747] rounded-md flex mt-[30px] ml-[20px] cursor-pointer hover:bg-[#d42020]">
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M6 19C6 20.1 6.9 21 8 21H16C17.1 21 18 20.1 18 19V7H6V19ZM8 9H16V19H8V9ZM15.5 4L14.5 3H9.5L8.5 4H5V6H19V4H15.5Z" fill="white" />
        </svg>
        <span class="ml-3">
          Delete
        </span>
      </button>
    </div>

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