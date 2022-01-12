<?php

  function showPopup($message) {
    echo('
      <!-- POPUP DIV -->
        <div id="popup" class="flex gap-[10px] font-bold rounded-md min-w-[70px] w-[fit-content] py-[5px] px-[10px] border border-gray-700 text-gray-700 text-center absolute pointer-events-none bg-[#E5E5E5] left-[50%] bottom-[2rem] -translate-x-1/2" role="alert" >
          '.$message.'
          <span>
          <img src="/CSC12/dist/res/images/done.svg" />
        </span>
      </div>
    ');
  }
?>

