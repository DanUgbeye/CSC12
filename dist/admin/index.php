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

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="/CSC12/dist/style.css">
  <title>CSC 12</title>
</head>

<body class="min-h-[100vh] h-[100vh] bg-[#E5E5E5] grid grid-cols-[150px_auto] sm:grid-cols-[200px_auto]">

  <!-- LEFT COLUMN -->
  <div class="col-start-1 col-span-1 relative bg-[#F2F2F2] h-full ">

    <nav class="p-[20px] fixed top-0 left-0 h-[100vh] sm:max-w-[200px] sm:w-[200px] z-0">

      <div class="w-full flex items-center justify-center">
        <img src="/CSC12/dist/res/images/logo.svg" alt="">
      </div>

      <ul class="list-none mt-[45px] mr-[40px] text-[#333333] ">
        <li class="block mb-[20px] ">
          <a href="/CSC12/dist/admin/" class="block p-[5px] h-full hover:bg-gray-300 rounded  bg-gray-200 font-[700] text-[#5D5FEF]  ">Overview</a>
        </li>
        <li class="block mb-[20px] ">
          <a href="/CSC12/dist/admin/create/" class="block p-[5px] h-full hover:bg-gray-300 hover:rounded  ">Create</a>
        </li>
        <li class="block mb-[20px] ">
          <a href="/CSC12/dist/admin/update/" class="block p-[5px] h-full hover:bg-gray-300 hover:rounded ">Update</a>
        </li>
        <li  class="block mb-[20px] ">
          <button  class="text-[#5D5FEF] block p-[5px] text-left w-full hover:bg-gray-300 hover:rounded " name="logout" onclick="document.cookie = 'admin=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/'; window.location.replace(`/CSC12/dist/admin/login/index.php`)">
            Logout
          </button>
        </li>
      </ul>

      <div class="absolute bottom-0 left-0 p-[10px] w-full ">
        <!-- link to update page -->
        <a href="" class="text-[#5D5FEF] text-center">
          <?php echo ($username) ?>
        </a>
      </div>

    </nav>
  </div>

  <!-- RIGHT COLUMN -->
  <div class="col-start-2 col-span-1 p-[20px] bg-[#E5E5E5] ">

    <!-- ALERT DIV -->
    <div class="w-full pointer-events-none bg-[#e5e5e5b9] backdrop-blur-sm sticky top-[10px] mb-[20px] ">
      <div id="alert" class="hidden font-bold bg-[transparent] w-[100%] p-[5px] mr-auto border border-red-500 text-red-500 " role="alert">
        Alert
      </div>
    </div>

    <div class="py-[20px] w-full grid grid-cols-2 gap-[16px] lg:grid-cols-4 ">

      <?php

      //this gets the number of students per level
        require_once "/xampp/htdocs/CSC12/dist/lib/dbConnect.php";
        $adminOps = new adminDb();
        $student_stats = array();

        for($level = 100; $level <= 400; $level += 100) {

          if($level == 100) {
            $student_stats[$level] = $adminOps->getNoOfStudents($level);
          } elseif($level == 200) {
            $student_stats[$level] = $adminOps->getNoOfStudents($level);
          } elseif($level == 300) {
            $student_stats[$level] = $adminOps->getNoOfStudents($level);
          } elseif($level == 400) {
            $student_stats[$level] = $adminOps->getNoOfStudents($level);
          }

        }
      ?>

      <div class=" lg:col-start-1 lg:col-span-1 flex flex-col sm:flex-row lg:flex-col items-center justify-center bg-pink-200 text-pink-500 px-[25px] lg:py-[12.5px]  rounded-lg ">
        <h3 class="font-[700] text-[24px] text-center sm:text-left lg:text-center w-full">Year 1</h3>
        <span id="no-yr-1" class="font-[700] text-[36px] mx-auto "><?php echo($student_stats[100]['result']) ?></span>
      </div>

      <div class=" lg:col-start-2 lg:col-span-1 flex flex-col sm:flex-row lg:flex-col items-center justify-center bg-purple-300 text-purple-500 px-[25px] lg:py-[12.5px]  rounded-lg ">
        <h3 class="font-[700] text-[24px] text-center sm:text-left lg:text-center w-full">Year 2</h3>
        <span id="no-yr-2" class="font-[700] text-[36px] mx-auto "><?php echo($student_stats[200]['result']) ?></span>
      </div>

      <div class=" lg:col-start-3 lg:col-span-1 flex flex-col sm:flex-row lg:flex-col items-center justify-center bg-blue-300 text-blue-500 px-[25px] lg:py-[12.5px] rounded-lg ">
        <h3 class="font-[700] text-[24px] text-center sm:text-left lg:text-center w-full">Year 3</h3>
        <span id="no-yr-3" class="font-[700] text-[36px] mx-auto "><?php echo($student_stats[300]['result']) ?></span>
      </div>

      <div class=" lg:col-start-4 lg:col-span-1 flex flex-col sm:flex-row lg:flex-col items-center justify-center bg-green-300 text-green-500 px-[25px] lg:py-[12.5px]  rounded-lg ">
        <h3 class="font-[700] text-[24px] text-center sm:text-left lg:text-center w-full">Year 4</h3>
        <span id="no-yr-4" class="font-[700] text-[36px] mx-auto "><?php echo($student_stats[400]['result']) ?></span>
      </div>

    </div>

    <div class="p-[10px] ">

    <?php

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $level = $_POST["level"];
        echo $level;
      }else {
        $level = 100;
        echo $level;
      }

    ?>

    <form id="form-level" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" onsubmit="(e)=>e.preventDefault()">
      <!-- REMEMBER TO CHANGE THE ONCHANGE EVENT -->
      <!-- NA HERE THE PROBLEM DEY -->
      <select name="level" id="level" value="<?php echo $level; ?>" onchange="document.querySelector('#form-level').submit()" class=" ml-auto flex w-[100px] outline-0 rounded p-[10px] bg-[transparent] border border-[#BDBDBD] ">
        <option  value="100">Yr 1</option>
        <option  value="200">Yr 2</option>
        <option  value="300">Yr 3</option>
        <option  value="400">Yr 4</option>
      </select>

    </form>


      <div class=" h-[fit-content] p-0 mt-[20px] border border-[#BDBDBD] overflow-hiddden rounded-lg ">

          <?php

            $students_data = $adminOps->getAllStudents($level);

            echo('
            
              <table id="table" class="relative w-full">

                <thead class="w-full bg-gray-300  text-left font-[500]  ">
                  <td class="p-[10px] rounded-tl-lg ">Matric No</td>
                  <td class="p-[10px] rounded-tr-lg md:rounded-[0]">Name</td>
                  <td class="md:rounded-tr-lg lg:rounded-[0] w-0 invisible absolute md:relative overflow-hidden pointer-events-none md:pointer-events-auto md:visible md:w-[fit-content] ">Nationality</td>
                  <td class="w-0 invisible absolute lg:relative overflow-hidden pointer-events-none lg:pointer-events-auto lg:visible lg:w-[fit-content] ">State of Origin</td>
                  <td class="rounded-tr-lg w-0 invisible absolute lg:relative overflow-hidden pointer-events-none lg:pointer-events-auto lg:visible lg:w-[fit-content] ">Date of Birth</td>
                </thead>
          
                <tbody>
            
            ');

            //if there are students in the selected level, display them
            if($students_data['status']) {

              $no_of_students = count($students_data['result']);
              for($x = 0; $x < $no_of_students; $x++) {
                echo('
                
                  <tr class="p-[27px] text-left border-t border-[#BDBDBD] ">
                    <td class="p-[10px] ">
                      '.$students_data['result'][$x]['matric_no'].'
                    </td>
                    <td class="p-[10px] rounded-tr-lg md:rounded-[0]">
                      '.$students_data['result'][$x]['surname'].' '.$students_data['result'][$x]['first_name'].'
                    </td>
                    <td class="md:rounded-tr-lg lg:rounded-[0] w-0 invisible absolute md:relative overflow-hidden pointer-events-none md:pointer-events-auto md:visible md:w-[fit-content] " >
                    ' .$students_data['result'][$x]['nationality'].'
                    </td>
                    <td class="w-0 invisible absolute lg:relative overflow-hidden pointer-events-none lg:pointer-events-auto lg:visible lg:w-[fit-content] " >
                      '.$students_data['result'][$x]['state'].'
                    </td>
                    <td class="w-0 invisible absolute lg:relative overflow-hidden pointer-events-none lg:pointer-events-auto lg:visible lg:w-[fit-content] " >
                      '.$students_data['result'][$x]['dob'].'
                    </td>
                  </tr>

                ');
              }

            } 
            
            echo('
            
                </tbody>
              </table>
            
            ');
            
            //if there are no students in that level this is displayed
            if(!$students_data['status'] && $students_data['error'] == 'no students in this level') {
                
              echo('
                <div>
                 <p class="p-[10px] text-[24px] text-gray-400 ">No students in this level</p>
                </div>
              ');

            }

          ?>

      </div>

    </div>

  </div>
  <?php
    echo('
      <script>
        document.querySelector("#level").value = '.$level.'
      </script>
    ');
  ?>

  <script src="/CSC12/dist/scripts/ui.js"></script>
  <!-- <script src="/CSC12/dist/scripts/login.js"></script>
    <script src="/CSC12/dist/scripts/student.js"></script>
    <script src="/CSC12/dist/app.js"></script> -->

</body>

</html>