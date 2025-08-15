<?php
  session_start();
  include '../../connection/logs.php';
  recordLog("Signed out");
  session_destroy();
  header("Location:../../../signin");
?>
