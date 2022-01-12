<?php

if (!isset($_COOKIE["admin"])) {
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: /CSC12/dist/admin/login/index.php");
  exit();
}
?>

<?php include "../templates/header.php" ?>
<?php include "../templates/sidenav.php" ?>

<!-- RIGHT COLUMN -->
<div class="col-start-2 col-span-1 p-[20px] bg-[#E5E5E5] ">

  <div class="py-[20px] w-full grid grid-cols-2 gap-[16px] lg:grid-cols-4 ">

    <?php

    require_once "/xampp/htdocs/CSC12/dist/lib/dbConnect.php";
    $adminOps = new adminDb();
    $student_stats = array();

    //this gets the number of students per level
    for ($level = 100; $level <= 400; $level += 100) {

      if ($level == 100) {
        $student_stats[$level] = $adminOps->getNoOfStudents($level);
      } elseif ($level == 200) {
        $student_stats[$level] = $adminOps->getNoOfStudents($level);
      } elseif ($level == 300) {
        $student_stats[$level] = $adminOps->getNoOfStudents($level);
      } elseif ($level == 400) {
        $student_stats[$level] = $adminOps->getNoOfStudents($level);
      }
    }
    ?>

    <div class=" lg:col-start-1 lg:col-span-1 flex flex-col sm:flex-row lg:flex-col items-center justify-center bg-pink-200 text-pink-500 px-[25px] lg:py-[12.5px]  rounded-lg ">
      <h3 class="font-[700] text-[24px] text-center sm:text-left lg:text-center w-full">Year 1</h3>
      <span id="no-yr-1" class="font-[700] text-[36px] mx-auto "><?php echo ($student_stats[100]['result']) ?></span>
    </div>

    <div class=" lg:col-start-2 lg:col-span-1 flex flex-col sm:flex-row lg:flex-col items-center justify-center bg-purple-300 text-purple-500 px-[25px] lg:py-[12.5px]  rounded-lg ">
      <h3 class="font-[700] text-[24px] text-center sm:text-left lg:text-center w-full">Year 2</h3>
      <span id="no-yr-2" class="font-[700] text-[36px] mx-auto "><?php echo ($student_stats[200]['result']) ?></span>
    </div>

    <div class=" lg:col-start-3 lg:col-span-1 flex flex-col sm:flex-row lg:flex-col items-center justify-center bg-blue-300 text-blue-500 px-[25px] lg:py-[12.5px] rounded-lg ">
      <h3 class="font-[700] text-[24px] text-center sm:text-left lg:text-center w-full">Year 3</h3>
      <span id="no-yr-3" class="font-[700] text-[36px] mx-auto "><?php echo ($student_stats[300]['result']) ?></span>
    </div>

    <div class=" lg:col-start-4 lg:col-span-1 flex flex-col sm:flex-row lg:flex-col items-center justify-center bg-green-300 text-green-500 px-[25px] lg:py-[12.5px]  rounded-lg ">
      <h3 class="font-[700] text-[24px] text-center sm:text-left lg:text-center w-full">Year 4</h3>
      <span id="no-yr-4" class="font-[700] text-[36px] mx-auto "><?php echo ($student_stats[400]['result']) ?></span>
    </div>

  </div>

  <div class="p-[10px] ">

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $level = $_POST["level"];
    } else {
      $level = 100;
    }

    ?>

    <form id="form-level" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" onsubmit="(e)=>e.preventDefault()">

      <select name="level" id="level" value="<?php echo $level; ?>" onchange="document.querySelector('#form-level').submit()" class=" ml-auto flex w-[100px] outline-0 rounded p-[10px] bg-[transparent] border border-[#BDBDBD] ">
        <option value="100">Yr 1</option>
        <option value="200">Yr 2</option>
        <option value="300">Yr 3</option>
        <option value="400">Yr 4</option>
      </select>

    </form>


    <div class=" h-[fit-content] p-0 mt-[20px] border border-[#BDBDBD] overflow-hiddden rounded-lg ">

    <?php

      $students_data = $adminOps->getAllStudents($level);
      // if($students_data['status']) echo($students_data['result'][0]['surname']);

      echo('

        <table id="table" class="relative w-full">

          <thead class="w-full bg-gray-300  text-left font-[500]  ">
            <td class="p-[10px] rounded-tl-lg ">Matric No</td>
            <td class="p-[10px] rounded-tr-lg md:rounded-[0]">Name</td>
            <td class="md:rounded-tr-lg lg:rounded-[0] w-0 invisible absolute lg:relative overflow-hidden pointer-events-none lg:pointer-events-auto lg:visible lg:w-[fit-content] ">Nationality</td>
            <td class="w-0 invisible absolute lg:relative overflow-hidden pointer-events-none lg:pointer-events-auto lg:visible lg:w-[fit-content] ">State of Origin</td>
            <td class="w-0 invisible absolute lg:relative overflow-hidden pointer-events-none lg:pointer-events-auto lg:visible lg:w-[fit-content] ">Date of Birth</td>
            <td class="rounded-tr-lg w-0 invisible absolute md:relative overflow-hidden pointer-events-none md:pointer-events-auto md:visible md:w-[fit-content] ">Pin</td>
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
              <td class="w-0 invisible absolute lg:relative overflow-hidden pointer-events-none lg:pointer-events-auto lg:visible md:w-[fit-content] " >
              ' .$students_data['result'][$x]['nationality'].'
              </td>
              <td class="w-0 invisible absolute lg:relative overflow-hidden pointer-events-none lg:pointer-events-auto lg:visible md:w-[fit-content] " >
                '.$students_data['result'][$x]['state'].'
              </td>
              <td class="w-0 invisible absolute lg:relative overflow-hidden pointer-events-none lg:pointer-events-auto lg:visible md:w-[fit-content] " >
                '.$students_data['result'][$x]['dob'].'
              </td>
              <td class="md:rounded-tr-lg lg:rounded-[0] w-0 invisible absolute md:relative overflow-hidden pointer-events-none md:pointer-events-auto md:visible md:w-[fit-content] " >
                '.$students_data['result'][$x]['pin'].'
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
          <p class="p-[10px] text-[24px] text-center text-gray-400 ">No students in this level</p>
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

</body>

</html>