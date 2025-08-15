<?php
    session_start();
    date_default_timezone_set('Asia/Manila');
    if($_SESSION['id']=="") header("Location:../../../");


    

    //FOR DATA UPLOAD
/*ta_name, complete_address, type, classification, description, manager, no_regular_male, no_regular_female,
no_on_call_male, no_on_call_female, email, contact_number, website, geo_location, photo, user_id

VALUES ('".$_POST["ta_name"]."', '".$_POST["address"]."','".$_POST["type"]."','".$_POST["classification"]."',
'".$_POST["description"]."','".$_POST["manager"]."','".$_POST["no_regular_m"]."','".$_POST["no_regular_f"]."',
  '".$_POST["no_on_call_m"]."','".$_POST["no_on_call_f"]."','".$_POST["email"]."','".$_POST["contact"]."',
  '".$_POST["website"]."','".$_POST["geolocation"]."','".$newfilename."','".$_SESSION["id"]."')"; */

      include '../../connection/connection.php';
      include '../../connection/logs.php';
          recordLog("Updated TA Details");
      $sql = "UPDATE tourist_attraction set
      ta_name = '".addslashes($_POST["ta_name"])."',
      request_edit = '0',
      complete_address = '".addslashes($_POST["address"])."',
      type = '".$_POST["type"]."',
      classification = '".$_POST["classification"]."',
      description = '".addslashes($_POST["description"])."',
      is_accredited = '".$_POST["is_accredited"]."', 
      accreditation_number = '".addslashes($_POST["accreditation_number"])."', 
      valid_from = '".$_POST["valid_from"]."', 
      valid_to = '".$_POST["valid_to"]."',
      manager = '".addslashes($_POST["manager"])."', 
      no_regular_male = '".$_POST["no_regular_m"]."',
      no_regular_female = '".$_POST["no_regular_f"]."',
      no_on_call_male = '".$_POST["no_on_call_m"]."',
      no_on_call_female = '".$_POST["no_on_call_f"]."',
      website = '".addslashes($_POST["website"])."',
      contact_number = '".$_POST["contact"]."',
      email = '".$_POST["email"]."',
      geo_location = '".addslashes($_POST["geolocation"])."'
      where user_id = '".$_SESSION["id"]."'";

      if (mysqli_query($conn, $sql)) {
         header('Location: ../core/registered_attraction.php');
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
      mysqli_close($conn);
?>
