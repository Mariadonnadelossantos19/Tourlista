<?php
    session_start();
    date_default_timezone_set('Asia/Manila');
    if($_SESSION['id']=="") header("Location:../../../");


    //FOR DATA UPLOAD

     include '../../connection/connection.php';
     include '../../connection/logs.php';
      recordLog("Updated AE details");

      $sql = "UPDATE accommodation_establishment set
      ae_name = '".addslashes($_POST["establishment_name"])."',
      complete_address = '".addslashes($_POST["complete_address"])."',
      contact_number = '".addslashes($_POST["contact_number"])."',
      email = '".$_POST["email"]."',
      type = '".$_POST["type"]."',
      manager = '".addslashes($_POST["manager"])."',
      is_accredited = '".$_POST["is_accredited"]."',
      accreditation_number = '".addslashes($_POST["accreditation_number"])."',
      valid_from = '".$_POST["valid_from"]."',
      valid_to = '".$_POST["valid_to"]."',
      no_rooms = '".$_POST["no_rooms"]."',
      room_capacity = '".$_POST["room_capacity"]."',
      room_type = '".$_POST["room_type"]."',
      no_function_room = '".$_POST["no_function_room"]."',
      function_room_capacity = '".$_POST["function_room_capacity"]."',
      no_regular_male = '".$_POST["no_regular_m"]."',
      no_regular_female = '".$_POST["no_regular_f"]."',
      no_on_call_male = '".$_POST["no_on_call_m"]."',
      no_on_call_female = '".$_POST["no_on_call_f"]."',
      geolocation = '".$_POST["geolocation"]."'
      where ae_id = '".$_POST["id"]."'";

      echo $sql;
      if (mysqli_query($conn, $sql)) {
         header('Location: ../core/manage_accommodation.php');
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
      mysqli_close($conn);
?> 
