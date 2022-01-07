<?php
  function showAlert($message) {
     
    if($message) {
      echo('
        <div class="w-full max-w-[500px] pointer-events-none bg-[#e5e5e5b9] backdrop-blur-sm sticky top-[10px] mb-[20px] ">
          <div id="alert" class=" font-bold bg-[transparent] w-[100%] p-[5px] mr-auto border border-red-500 text-red-500 " role="alert">'
              .$message.
          '</div>
        </div>
      ');
    }

  }
?>