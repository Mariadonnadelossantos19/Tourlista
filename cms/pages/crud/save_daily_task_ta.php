<?php
    session_start();
    date_default_timezone_set('Asia/Manila');
    if($_SESSION['id']=="") header("Location:../../../");
     $date=date_create($_POST["task_date"]);
     include '../../connection/connection.php';
     include '../../connection/logs.php';
     recordLog("Encoded TA Task");

     //view if existing
     $sql = "SELECT task_date FROM ta_daily_task WHERE ta_id = '".$_POST["ta_id"]."' and task_date = '".date_format($date,"Y-m-d")."'";
     $result = mysqli_query($conn, $sql);
     if (mysqli_num_rows($result) > 0) {
          $sql = "UPDATE ta_daily_task SET
          task_date = '".date_format($date,"Y-m-d")."',
          day = '".date_format($date,"d")."',
          month = '".date_format($date,"m")."',
          year = '".date_format($date,"Y")."',
          r_male = '".$_POST["r_male"]."',
          r_female = '".$_POST["r_female"]."',
          nr_male = '".$_POST["nr_male"]."',
          nr_female = '".$_POST["nr_female"]."',
          nr_details = '".$_POST["nr_details"]."',
          fo_male = '".$_POST["fo_male"]."',
          fo_female = '".$_POST["fo_female"]."',
          fo_details = '".$_POST["fo_details"]."',
          date_time_encoded = '".date("Y-m-d | H:i:s")."'
          where 
          ta_id = '".$_POST["ta_id"]."' and
          task_date = '".date_format($date,"Y-m-d")."'";
          if (mysqli_query($conn, $sql)) {
            header('Location: ../core/ta_daily_task.php');
          } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          }

     }
     else{
      $sql = "INSERT INTO ta_daily_task (task_date, day, month, year, r_male, r_female, nr_male, nr_female, nr_details, fo_male, fo_female, fo_details, date_time_encoded, ta_id, user_id)
      VALUES ('".date_format($date,"Y-m-d")."', '".date_format($date,"d")."','".date_format($date,"m")."','".date_format($date,"Y")."','".$_POST["r_male"]."', '".$_POST["r_female"]."', '".$_POST["nr_male"]."', '".$_POST["nr_female"]."', '".$_POST["nr_details"]."',
        '".$_POST["fo_male"]."','".$_POST["fo_female"]."','".$_POST["fo_details"]."','".date("Y-m-d | H:i:s")."','".$_POST["ta_id"]."', '".$_SESSION["id"]."')";
      if (mysqli_query($conn, $sql)) {
         header('Location: ../core/ta_daily_task.php');
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }


     }
      mysqli_close($conn);
?>
