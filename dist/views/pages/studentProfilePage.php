
<?php include "/xampp/htdocs/CSC12/dist/templates/header.php" ?>

<!-- sidenav -->
<?php include "/xampp/htdocs/CSC12/dist/templates/sidenav.php" ?>

<!-- RIGHT COLUMN -->
<div class="col-start-2 col-span-1 p-[20px] bg-[#E5E5E5] ">

  <!-- ALERT DIV -->
  <div class="w-full pointer-events-none bg-[#e5e5e5b9] backdrop-blur-sm sticky top-[10px] mb-[20px] ">
    <div id="alert" class="hidden font-bold bg-[transparent] w-[100%] p-[5px] mr-auto border border-red-500 text-red-500 " role="alert">
      Alert
    </div>
  </div>

  <!-- EDIT STUDENT BUTTON -->
  <a href="/CSC12/dist/student/edit/" class="w-max text-white py-3 px-4 mt-[30px] ml-auto bg-[#2F80ED] hover:bg-[#033e8b] rounded-md flex items-center ">
    <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M4.333 16.548L16.57 4.31001C17.0534 3.84738 17.6988 3.59242 18.3679 3.59973C19.037 3.60704 19.6767 3.87605 20.1499 4.34914C20.6231 4.82223 20.8923 5.4618 20.8998 6.1309C20.9073 6.8 20.6525 7.44544 20.19 7.92901L7.951 20.167C7.6718 20.4462 7.31619 20.6366 6.929 20.714L3 21.5L3.786 17.57C3.86345 17.1828 4.05378 16.8272 4.333 16.548V16.548Z" stroke="#F2F2F2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      <path d="M14.5 7L17.5 10" stroke="#F2F2F2" stroke-width="2" />
    </svg>

    <span class="ml-3">Edit</span>
  </a>


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

</body>

</html>