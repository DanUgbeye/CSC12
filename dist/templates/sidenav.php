<?php
$username = "username";
$type = "";

if (isset($_COOKIE["admin"])) {
  $type = "admin";
  $admin = json_decode($_COOKIE["admin"]);
  $username = $admin->email;
} elseif (isset($_COOKIE["student"])) {
  $type = "student";
  $admin = json_decode($_COOKIE["student"]);
  $username = $admin->matric_no;
}
?>
<nav class="p-[20px] h-[100vh] w-full bg-gray-100 flex flex-col justify-between">

  <div>
    <!-- logo -->
    <a href="../index.php" class="w-full flex items-center justify-center">
      <svg width="77" height="41" viewBox="0 0 77 41" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M1.792 17.552C1.792 15.888 2.152 14.408 2.872 13.112C3.592 11.8 4.592 10.784 5.872 10.064C7.168 9.328 8.632 8.96 10.264 8.96C12.264 8.96 13.976 9.488 15.4 10.544C16.824 11.6 17.776 13.04 18.256 14.864H13.744C13.408 14.16 12.928 13.624 12.304 13.256C11.696 12.888 11 12.704 10.216 12.704C8.952 12.704 7.928 13.144 7.144 14.024C6.36 14.904 5.968 16.08 5.968 17.552C5.968 19.024 6.36 20.2 7.144 21.08C7.928 21.96 8.952 22.4 10.216 22.4C11 22.4 11.696 22.216 12.304 21.848C12.928 21.48 13.408 20.944 13.744 20.24H18.256C17.776 22.064 16.824 23.504 15.4 24.56C13.976 25.6 12.264 26.12 10.264 26.12C8.632 26.12 7.168 25.76 5.872 25.04C4.592 24.304 3.592 23.288 2.872 21.992C2.152 20.696 1.792 19.216 1.792 17.552ZM26.8653 26.168C25.6333 26.168 24.5293 25.968 23.5533 25.568C22.5773 25.168 21.7933 24.576 21.2013 23.792C20.6253 23.008 20.3213 22.064 20.2893 20.96H24.6573C24.7213 21.584 24.9373 22.064 25.3053 22.4C25.6733 22.72 26.1533 22.88 26.7453 22.88C27.3533 22.88 27.8333 22.744 28.1853 22.472C28.5373 22.184 28.7133 21.792 28.7133 21.296C28.7133 20.88 28.5693 20.536 28.2813 20.264C28.0093 19.992 27.6653 19.768 27.2493 19.592C26.8493 19.416 26.2733 19.216 25.5213 18.992C24.4333 18.656 23.5453 18.32 22.8573 17.984C22.1693 17.648 21.5773 17.152 21.0813 16.496C20.5853 15.84 20.3373 14.984 20.3373 13.928C20.3373 12.36 20.9053 11.136 22.0413 10.256C23.1773 9.36 24.6573 8.912 26.4813 8.912C28.3373 8.912 29.8333 9.36 30.9693 10.256C32.1053 11.136 32.7133 12.368 32.7933 13.952H28.3533C28.3213 13.408 28.1213 12.984 27.7533 12.68C27.3853 12.36 26.9133 12.2 26.3372 12.2C25.8413 12.2 25.4413 12.336 25.1373 12.608C24.8333 12.864 24.6813 13.24 24.6813 13.736C24.6813 14.28 24.9373 14.704 25.4492 15.008C25.9613 15.312 26.7613 15.64 27.8493 15.992C28.9373 16.36 29.8173 16.712 30.4893 17.048C31.1773 17.384 31.7693 17.872 32.2653 18.512C32.7613 19.152 33.0093 19.976 33.0093 20.984C33.0093 21.944 32.7613 22.816 32.2653 23.6C31.7853 24.384 31.0813 25.008 30.1533 25.472C29.2253 25.936 28.1293 26.168 26.8653 26.168ZM34.8389 17.552C34.8389 15.888 35.1989 14.408 35.9189 13.112C36.6389 11.8 37.6389 10.784 38.9189 10.064C40.2149 9.328 41.6789 8.96 43.3109 8.96C45.3109 8.96 47.0229 9.488 48.4469 10.544C49.8709 11.6 50.8229 13.04 51.3029 14.864H46.7909C46.4549 14.16 45.9749 13.624 45.3509 13.256C44.7429 12.888 44.0469 12.704 43.2629 12.704C41.9989 12.704 40.9749 13.144 40.1909 14.024C39.4069 14.904 39.0149 16.08 39.0149 17.552C39.0149 19.024 39.4069 20.2 40.1909 21.08C40.9749 21.96 41.9989 22.4 43.2629 22.4C44.0469 22.4 44.7429 22.216 45.3509 21.848C45.9749 21.48 46.4549 20.944 46.7909 20.24H51.3029C50.8229 22.064 49.8709 23.504 48.4469 24.56C47.0229 25.6 45.3109 26.12 43.3109 26.12C41.6789 26.12 40.2149 25.76 38.9189 25.04C37.6389 24.304 36.6389 23.288 35.9189 21.992C35.1989 20.696 34.8389 19.216 34.8389 17.552Z" fill="#5D5FEF" />
        <path d="M52.9761 12.296V8.48H59.6241V26H55.3521V12.296H52.9761ZM62.2876 22.712C62.8316 22.28 63.0796 22.08 63.0316 22.112C64.5996 20.816 65.8316 19.752 66.7276 18.92C67.6396 18.088 68.4076 17.216 69.0316 16.304C69.6556 15.392 69.9676 14.504 69.9676 13.64C69.9676 12.984 69.8156 12.472 69.5116 12.104C69.2076 11.736 68.7516 11.552 68.1436 11.552C67.5356 11.552 67.0556 11.784 66.7036 12.248C66.3676 12.696 66.1996 13.336 66.1996 14.168H62.2396C62.2716 12.808 62.5596 11.672 63.1036 10.76C63.6636 9.848 64.3916 9.176 65.2876 8.744C66.1996 8.312 67.2076 8.096 68.3116 8.096C70.2156 8.096 71.6476 8.584 72.6076 9.56C73.5836 10.536 74.0716 11.808 74.0716 13.376C74.0716 15.088 73.4876 16.68 72.3196 18.152C71.1516 19.608 69.6636 21.032 67.8556 22.424H74.3356V25.76H62.2876V22.712Z" fill="#EF5DA8" />
        <line x1="2.5" y1="38.5" x2="74.5" y2="38.5" stroke="url(#paint0_linear_42_2)" stroke-width="5" stroke-linecap="round" />
        <defs>
          <linearGradient id="paint0_linear_42_2" x1="77" y1="41" x2="0" y2="41" gradientUnits="userSpaceOnUse">
            <stop stop-color="#A5A6F6" />
            <stop offset="1" stop-color="#5D5FEF" />
          </linearGradient>
        </defs>
      </svg>
    </a>

    <ul class="list-none mt-10 text-[#333333] grid grid-flow-row gap-4">
      <?php
      if ($type === "admin") {
        echo ("
            <li>
              <a href='/CSC12/dist/admin/index.php' class='block p-[5px] h-full  text-gray-700 rounded font-medium tracking-wider active:text-[#5D5FEF] hover:bg-gray-200'>Overview</a>
            </li>
            <li>
              <a href='/CSC12/dist/admin/create/index.php' class='block p-[5px] h-full text-gray-700 font-medium tracking-wider rounded active:text-[#5d5fef] hover:bg-gray-200'>Create</a>
            </li>
            <li>
              <a href='/CSC12/dist/admin/update/index.php' class='block p-[5px] h-full text-gray-700 font-medium tracking-wider rounded hover:bg-gray-200 '>Update</a>
            </li>
            <li>
              <button class='flex items-center p-[5px] w-full text-left text-gray-700 font-medium tracking-wider rounded hover:bg-gray-200 ' name='logout' onclick='document.cookie = `admin=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/`; window.location.replace(`/CSC12/dist/admin/login/index.php`)'>
                <svg xmlns='http://www.w3.org/2000/svg' class='h-6 w-6' fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                  <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1' />
                </svg>
                <span class='ml-4'>
                  logout
                </span>
              </button>
            </li>
          ");
      } elseif ($type === "student") {
        echo ("
            <li>
              <a href='/CSC12/dist/student/' class='block p-[5px] h-full text-gray-700 font-medium tracking-wider rounded hover:bg-gray-200 '>Profile</a>
            </li>
            <li>
              <button class='flex items-center p-[5px] w-full text-left text-gray-700 font-medium tracking-wider rounded hover:bg-gray-200 ' name='logout' onclick='document.cookie = `student=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/`; window.location.replace(`/CSC12/dist/student/login/index.php`)'>
                <svg xmlns='http://www.w3.org/2000/svg' class='h-6 w-6' fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                  <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1' />
                </svg>
                <span class='ml-4'>
                  logout
                </span>
              </button>
            </li>
          ");
      }
      ?>
    </ul>
  </div>

  <div class="flex items-center justify-center">
    <a href="../admin/index.php" class="text-gray-600 tracking-widest text-center hover:font-semibold">
      <?php echo ($username) ?></a>
  </div>
</nav>