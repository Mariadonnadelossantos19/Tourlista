<?php
    session_start();
    date_default_timezone_set('Asia/Manila');
    if($_SESSION['id']=="") header("Location:../../../");

    $date=date_create($_POST["task_date"]);

     include '../../connection/connection.php';
     include '../../connection/logs.php';
     recordLog("Updated AE Task with ID=".$_POST["ae_task_id"]);
      $sql = "UPDATE ae_daily_task set
      task_date = '".date_format($date,"Y-m-d")."',
      day = '".date_format($date,"d")."',
      month = '".date_format($date,"m")."',
      year = '".date_format($date,"Y")."',
      no_rooms_occupied = '".$_POST["no_rooms_occupied"]."',
      no_stayed_overnight = '".$_POST["no_stayed_overnight"]."',
      no_new_checkin = '".$_POST["no_new_checkin"]."',
      no_male = '".$_POST["no_male"]."',
      no_female = '".$_POST["no_female"]."',
      local_tourist = '".$_POST["local_tourist"]."',
      foreign_tourist = '".$_POST["foreign_tourist"]."',
      overseas_filipino = '".$_POST["overseas_filipino"]."',
      local_details = '".$_POST["local_details"]."',
      foreign_details = '".$_POST["foreign_details"]."',
      overseas_details = '".$_POST["overseas_details"]."',
      remarks = '".addslashes($_POST["remarks"])."',
      date_time_encoded = '".date("Y-m-d | H:i:s")."'
      where ae_task_id = '".$_POST["ae_task_id"]."'";

      if (mysqli_query($conn, $sql)) {
                if($_SESSION['level']>2){
                    header('Location: ../core/ae_daily_encoding.php?month='.number_format(date_format($date,"m")).'&year='.date_format($date,"Y"));
                }else{
                    header('Location: ../core/ae_daily_update.php?month='.number_format(date_format($date,"m")).'&year='.date_format($date,"Y"));
                }
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
      mysqli_close($conn);
?>
