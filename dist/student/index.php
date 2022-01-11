<?php
  $matric_no = "";
  if (!isset($_COOKIE["student"])) {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: /CSC12/dist/student/login/");
    exit();
  } else {
    $student = json_decode($_COOKIE["student"]);
    $matric_no = $student->matric_no;
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

        <!-- Brand icon -->
        <div class="w-full flex items-center justify-center">
          <a href="/CSC12/dist/"  >
            <img src="/CSC12/dist/res/images/logo.svg" alt="">
          </a>
        </div>

        <ul class="list-none mt-[45px] mr-[40px] text-[#333333] ">
          <li class="block mb-[20px] ">
            <a href="/CSC12/dist/student/" class="block p-[5px] h-full hover:bg-gray-300 hover:rounded font-[700] text-[#EF5DA8] ">
              Profile
            </a>
          </li>
          <li  class="block mb-[20px] ">
            <button  class="text-[#5D5FEF] block p-[5px] text-left w-full hover:bg-gray-300 hover:rounded " name="logout" onclick="document.cookie = 'student=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/'; window.location.replace(`/CSC12/dist/student/login/`)">
              Logout
            </button>
          </li>
        </ul>

        <div class="absolute bottom-0 left-0 p-[10px] w-full ">
          <!-- link to update page -->
          <a href="" class="text-[#5D5FEF] text-center">
            <?php echo ($matric_no); ?>
          </a>
        </div>
      </nav>
    </div>
    
    <!-- RIGHT COLUMN -->
    <div class="col-start-2 col-span-1 p-[20px] bg-[#E5E5E5] ">
      
      <!-- ALERT DIV -->
      <div class="w-full pointer-events-none bg-[#e5e5e5b9] backdrop-blur-sm sticky top-[10px] mb-[20px] ">
        <div id="alert" class="hidden font-bold bg-[transparent] w-[100%] p-[5px] mr-auto border border-red-500 text-red-500 " role="alert" >
          Alert
        </div>
      </div>

      <!-- EDIT STUDENT BUTTON -->
      <div class="flex ">
        <button class="text-white bg-[#2F80ED] rounded-md  mt-[30px] ml-auto cursor-pointer hover:bg-[#4091FE]  " >
          <a href="/CSC12/dist/student/edit/" class="px-[10px] py-[5px] flex gap-[5px]">
            <span>
              <img src="/CSC12/dist/res/images/pencil.svg" alt="">
            </span>
            <p class="hidden sm:block">Edit</p> 
          </a>
        </button>
      </div>


      <form action="" class="c">

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
              <input disabled class="w-full outline-0 rounded p-[10px] bg-[transparent] placeholder:text-[#BDBDBD] border border-[#BDBDBD] " type="date" name="d-o-b" id="d-o-b" >
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
              <select disabled class="w-full outline-0 rounded p-[10px] bg-[transparent] border border-[#BDBDBD] " type="" name="level" id="level" >
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

    <script src="/CSC12/dist/scripts/ui.js"></script>
    <!-- <script src="/CSC12/dist/scripts/login.js"></script>
    <script src="/CSC12/dist/scripts/student.js"></script>
    <script src="/CSC12/dist/app.js"></script> -->
    
  </body>
</html>
