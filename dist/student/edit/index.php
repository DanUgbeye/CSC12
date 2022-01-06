<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="/CSC12/dist/style.css">
    <title>CSC 12</title>
  </head>

  <body class="min-h-[100vh] relative bg-[#E5E5E5] grid grid-cols-[150px_auto] sm:grid-cols-[200px_auto]">

    <!-- LEFT COLUMN -->
    <div class="col-start-1 col-span-1 relative bg-[#F2F2F2] ">

      <nav class="p-[20px] fixed top-0 left-0 h-[100vh] sm:max-w-[200px] sm:w-[200px] ">

        <div class="w-full flex items-center justify-center">
          <img src="/CSC12/dist/res/images/logo.svg" alt="">
        </div>

        <ul class="list-none mt-[45px] mr-[40px] text-[#333333] ">
          <li class="block mb-[20px] ">
            <a href="/CSC12/dist/student/" class="block p-[5px] h-full hover:bg-gray-300 hover:rounded font-[700] text-[#EF5DA8] ">
              Profile
            </a>
          </li>
        </ul>

        <div class="absolute bottom-0 left-0 p-[10px] w-full ">
          <h4 id="dis-mat-no" class="text-[#5D5FEF] text-center" ></h4>
        </div>
      </nav>
    </div>
    
    <!-- RIGHT COLUMN -->
    <div class="col-start-2 col-span-1 p-[20px] bg-[#E5E5E5] relative ">

      <!-- ALERT DIV -->
      <div class="w-full pointer-events-none bg-[#e5e5e5b9] backdrop-blur-sm sticky top-[10px] mb-[20px] ">
        <div id="alert" class="hidden font-bold bg-[transparent] w-[100%] p-[5px] mr-auto border border-red-500 text-red-500 " role="alert" >
          Alert
        </div>
      </div>

      <!-- SAVE BUTTON -->
      <div class="flex ">
        <button type="submit" id="save-std" class=" text-white px-[10px] py-[5px] bg-[#2F80ED] rounded-md flex mt-[30px] ml-auto cursor-pointer hover:bg-[#4091FE] gap-[5px] " >
          <span>
            <img id="save-std" src="/CSC12/dist/res/images/save.svg" alt="">
          </span>
          <p id="save-std" class="hidden sm:block">Save</p>
        </button>
      </div>

      <form action="" class=" ">

        <!-- Personal Info form group -->
        <div class=" mb-[20px] ">

          <h3 class="w-full border-b-[2px] border-[#BDBDBD] font-bold mb-[20px] ">Personal Information</h3>

          <div class="md:grid md:grid-cols-6 md:grid-rows-3 md:gap-x-[47px] md:gap-y-[10px] font-[500]  ">
            
            <!-- Surname input field -->
            <div class="md:col-start-1 md:col-span-3 md:row-start-1 md:row-span-1  mb-[20px] md:mb-0 ">
              <label for="surname" class="block">Surname</label>
              <input class="w-full outline-0 rounded p-[10px] border border-[#BDBDBD]" type="text" name="surname" id="surname" placeholder="surname">
            </div>

            <!-- Firstname input field -->
            <div class="md:col-start-4 md:col-span-3 md:row-start-1 md:row-span-1  mb-[20px] md:mb-0 ">
              <label for="firstname" class="block">Firstname</label>
              <input class="w-full outline-0 rounded p-[10px] border border-[#BDBDBD] " type="text" name="firstname" id="firstname" placeholder="firstname">
            </div>

            <!-- Middlename input field -->
            <div class="md:col-start-1 md:col-span-3 md:row-start-2 md:row-span-1  mb-[20px] md:mb-0 ">
              <label for="middlename" class="block">Middlename</label>
              <input class="w-full outline-0 rounded p-[10px] border border-[#BDBDBD] " type="text" name="middlename" id="middlename" placeholder="middlename">
            </div>

            <!-- date of birth input field -->
            <div class="md:col-start-4 md:col-span-3 md:row-start-2 md:row-span-1  mb-[20px] md:mb-0 ">
              <label for="d-o-b" class="block">Date of Birth</label>
              <input class="w-full outline-0 rounded p-[10px] bg-[white] placeholder:text-[#BDBDBD] border border-[#BDBDBD] " placeholder="dd-mm-yyyy" max="01/01/2022" type="date" name="d-o-b" id="d-o-b" >
            </div>

            <!-- Nationality input field -->
            <div class="md:col-start-1 md:col-span-2 md:row-start-3 md:row-span-1  mb-[20px] md:mb-0 ">
              <label for="nationality" class="block">Nationality</label>
              <input class="w-full outline-0 rounded p-[10px] placeholder:text-[#BDBDBD] border border-[#BDBDBD] " type="text" name="nationality" id="nationality" placeholder="nationality">
            </div>

            <!-- State input field -->
            <div class="md:col-start-3 md:col-span-2 md:row-start-3 md:row-span-1  mb-[20px] md:mb-0 ">
              <label for="state" class="block">State</label>
              <input class="w-full outline-0 rounded p-[10px] placeholder:text-[#BDBDBD] border border-[#BDBDBD] " type="text" name="state" id="state" placeholder="state">
            </div>

            <!-- LGA input field -->
            <div class="md:col-start-5 md:col-span-2 md:row-start-3 md:row-span-1  mb-[20px] md:mb-0 ">
              <label for="lga" class="block">LGA</label>
              <input class="w-full outline-0 rounded p-[10px] placeholder:text-[#BDBDBD] border border-[#BDBDBD] " type="text" name="lga" id="lga" placeholder="LGA">
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
              <select class="w-full outline-0 rounded p-[10px] bg-[white] border border-[#BDBDBD] " type="" name="level" id="level" >
                <option value="100">100</option>
                <option value="200">200</option>
                <option value="300">300</option>
                <option value="400">400</option>              
              </select>
            </div>

          </div>
        </div>
           
      </form>
      
      <!-- POPUP DIV -->
      <div class="fixed pointer-events-none bg-transparent right-[50%] rounded-md w-[150px]  left-[50%] bottom-[20%] top-[90vh] ">
        <div id="popup" class="gap-[5px] hidden font-bold rounded-md min-w-[50px] w-[fit-content] py-[5px] px-[10px] bg-gray-200 border border-gray-700 text-gray-700 text-center " role="alert" >
          Popup
        </div>
      </div>
      
    </div>


    <script src=/CSC12/dist/scripts/ui.js"></script>
    <!-- <script src="/CSC12/dist/scripts/login.js"></script>
    <script src="/CSC12/dist/scripts/student.js"></script>
    <script src="/CSC12/dist/app.js"></script> -->
    
  </body>
</html>
