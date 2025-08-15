<?php
    session_start();
    date_default_timezone_set('Asia/Manila');
    if($_SESSION['id']=="") header("Location:../../../");
     $date=date_create($_POST["task_date"]);
     include '../../connection/connection.php';
     include '../../connection/logs.php';
     recordLog("Encoded AE Task");

     //view if existing
     $sql = "SELECT task_date FROM ae_daily_task WHERE ae_id = '".$_POST["ae_id"]."' and task_date = '".date_format($date,"Y-m-d")."'";
     $result = mysqli_query($conn, $sql);
     if (mysqli_num_rows($result) > 0) {
            $sql = "UPDATE ae_daily_task SET 
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
            where 
            ae_id = '".$_POST["ae_id"]."' AND
            task_date = '".date_format($date,"Y-m-d")."'";
            if (mysqli_query($conn, $sql)) {
              header('Location: ../core/ae_daily_task.php');
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

     }
     else{
            $sql = "INSERT INTO ae_daily_task (task_date, day, month, year, no_rooms_occupied, no_stayed_overnight, no_new_checkin, no_male, no_female, local_tourist, foreign_tourist, overseas_filipino, local_details, foreign_details, overseas_details, remarks, date_time_encoded, ae_id, user_id)
            VALUES ('".date_format($date,"Y-m-d")."', '".date_format($date,"d")."','".date_format($date,"m")."','".date_format($date,"Y")."','".$_POST["no_rooms_occupied"]."', '".$_POST["no_stayed_overnight"]."', '".$_POST["no_new_checkin"]."','".$_POST["no_male"]."', '".$_POST["no_female"]."', '".$_POST["local_tourist"]."',
              '".$_POST["foreign_tourist"]."','".$_POST["overseas_filipino"]."','".$_POST["local_details"]."','".$_POST["foreign_details"]."','".$_POST["overseas_details"]."','".addslashes($_POST["remarks"])."','".date("Y-m-d | H:i:s")."','".$_POST["ae_id"]."', '".$_SESSION["id"]."')";
            if (mysqli_query($conn, $sql)) {
              header('Location: ../core/ae_daily_task.php');
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
     }
      mysqli_close($conn);
?>
