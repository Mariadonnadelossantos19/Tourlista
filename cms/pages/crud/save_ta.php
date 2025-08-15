<?php
    session_start();
    date_default_timezone_set('Asia/Manila');
    if($_SESSION['id']=="") header("Location:../../../");


    //FOR PHOTO UPLOAD

$name=$_FILES["taphoto"]["name"];
$id=$_SESSION['id'];
$path = $_FILES['taphoto']['name'];
$ext = pathinfo($path, PATHINFO_EXTENSION);

$save=md5($name.$id).".".$ext;
  echo "Upload: " . $save . "<br />";
  echo "Type: " . $ext . "<br />";
  echo "Size: " . ($_FILES["taphoto"]["size"] / 1024) . " Kb<br />";
  echo "Temp file: " . $_FILES["taphoto"]["tmp_name"] . "<br />";

  move_uploaded_file($_FILES["taphoto"]["tmp_name"],"../../uploads/" . $save);

  if($ext==""){
      $save="attraction.png";
  }

    //FOR DATA UPLOAD

     include '../../connection/connection.php';
     include '../../connection/logs.php';
          recordLog("Encoded Tourist Attraction");
      $sql = "INSERT INTO tourist_attraction (ta_name, complete_address, type, classification, description, is_accredited, accreditation_number, valid_from, valid_to, manager, no_regular_male, no_regular_female, no_on_call_male, no_on_call_female, email, contact_number, website, geo_location, photo, user_id)
      VALUES ('".addslashes ($_POST["ta_name"])."', '".addslashes ($_POST["address"])."','".$_POST["type"]."','".$_POST["classification"]."', '".addslashes ($_POST["description"])."',
      '".$_POST["is_accredited"]."', '".addslashes($_POST["accreditation_number"])."','".$_POST["valid_from"]."', '".$_POST["valid_to"]."','".addslashes ($_POST["manager"])."','".$_POST["no_regular_m"]."','".$_POST["no_regular_f"]."',
        '".$_POST["no_on_call_m"]."','".$_POST["no_on_call_f"]."','".$_POST["email"]."','".addslashes ($_POST["contact"])."','".addslashes ($_POST["website"])."','".$_POST["geolocation"]."','".$save."','".$_SESSION["id"]."')";
      if (mysqli_query($conn, $sql)) {
         header('Location: ../core/registered_attraction.php');
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
      mysqli_close($conn);
?>
