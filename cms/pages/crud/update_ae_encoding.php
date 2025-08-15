<?php
    session_start();
    date_default_timezone_set('Asia/Manila');
    if($_SESSION['id']=="") header("Location:../../../");

     include '../../connection/connection.php';
     include '../../connection/logs.php';
          recordLog("Updated AE Task with ID=".$_POST["task_id"]);
      $sql = "UPDATE ae_daily_task set
      no_new_checkin = '".$_POST["no_checkin"]."',
      no_male = '".$_POST["male"]."',
      no_female = '".$_POST["female"]."',
      local_tourist = '".$_POST["local"]."',
      foreign_tourist = '".$_POST["foreign"]."',
      overseas_filipino = '".$_POST["overseas"]."'
      where ae_task_id = '".$_POST["task_id"]."'";

      if (mysqli_query($conn, $sql)) {
         header('Location: ../core/manage_encoding.php');
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
      mysqli_close($conn);
?>
