<?php
    session_start();
    date_default_timezone_set('Asia/Manila');
    if($_SESSION['id']=="") header("Location:../../../");


    //FOR DATA UPLOAD

     include '../../connection/connection.php';
     include '../../connection/logs.php';
      recordLog("Updated TA details");

      $sql = "UPDATE tourist_attraction set
      ta_name = '".addslashes($_POST["attraction_name"])."',
      complete_address = '".addslashes($_POST["complete_address"])."',
      type = '".$_POST["type"]."',
      classification = '".$_POST["classification"]."',
      description = '".$_POST["description"]."',
      is_accredited = '".$_POST["is_accredited"]."',
      accreditation_number = '".addslashes($_POST["accreditation_number"])."',
      valid_from = '".$_POST["valid_from"]."',
      valid_to = '".$_POST["valid_to"]."',
      manager = '".$_POST["manager"]."',
      contact_number = '".addslashes($_POST["contact_number"])."',
      email = '".$_POST["email"]."',
      manager = '".addslashes($_POST["manager"])."',
      no_regular_male = '".$_POST["no_regular_m"]."',
      no_regular_female = '".$_POST["no_regular_f"]."',
      no_on_call_male = '".$_POST["no_on_call_m"]."',
      no_on_call_female = '".$_POST["no_on_call_f"]."',
      website = '".$_POST["website"]."',
      geo_location = '".$_POST["geolocation"]."'
      where ta_id = '".$_POST["id"]."'";

      echo $sql;
      if (mysqli_query($conn, $sql)) {
         header('Location: ../core/manage_attraction.php');
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
      mysqli_close($conn);
?>
