<?php
    session_start();
    date_default_timezone_set('Asia/Manila');
    if($_SESSION['id']=="") header("Location:../../../");

    $date=date_create($_POST["mice_date"]);

     include '../../connection/connection.php';
     include '../../connection/logs.php';
      recordLog("Updated MICE with ID=".$_POST["mice_id"]);
      $sql = "UPDATE mice set
      mice_date = '".date_format($date,"Y-m-d")."',
      day = '".date_format($date,"d")."',
      month = '".date_format($date,"m")."',
      year = '".date_format($date,"Y")."',
      event_name = '".addslashes($_POST["event_name"])."',
      no_of_days = '".$_POST["no_days"]."',
      no_of_hours = '".$_POST["no_hours"]."',
      classification = '".$_POST["classification"]."',
      type = '".$_POST["type"]."',
      no_male = '".$_POST["no_male"]."',
      no_female = '".$_POST["no_female"]."',
      local_tourist = '".$_POST["local_visitor"]."',
      foreign_tourist = '".$_POST["foreign_visitor"]."',
      foreign_details = '".$_POST["foreign_details"]."',
      with_exhibition = '".$_POST["with_exhibition"]."',
      num_exhibitors = '".$_POST["num_exhibitors"]."',
      organizer = '".addslashes($_POST["organizer"])."',
      contact_person = '".addslashes($_POST["contact_person"])."',
      address = '".addslashes($_POST["address"])."',
      contact_number = '".addslashes($_POST["contact_details"])."',
      remarks = '".addslashes($_POST["remarks"])."',
      date_time_encoded = '".date("Y-m-d | H:i:s")."'
      where mice_id = '".$_POST["mice_id"]."'";

      if (mysqli_query($conn, $sql)) {
         if($_SESSION['level']=='1'){
            header('Location: ../core/ae_mice.php');
         }
         if($_SESSION['level']=='2'){
            header('Location: ../core/ta_mice.php');
         }
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
      mysqli_close($conn);
?>
