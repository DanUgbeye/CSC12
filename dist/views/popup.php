<?php

  function showPopup($message) {
    echo('
      <!-- POPUP DIV -->
        <div id="popup" class="font-bold rounded-md min-w-[50px] w-[fit-content] py-[5px] px-[10px] bg-gray-200 border border-gray-700 text-gray-700 text-center absolute pointer-events-none bg-transparent left-[50%] bottom-[2rem] -translate-x-1/2" role="alert" >
          '.$message.'
      </div>
    ');
  }
?>

