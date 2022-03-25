<?php

if (!isset($_COOKIE["admin"])) {
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: /CSC12/dist/admin/login/index.php");
  exit();
}
?>

<?php
  //including the admin overview page from views folder
  require_once('/xampp/htdocs/CSC12/dist/views/pages/adminOverviewPage.php');

?>
