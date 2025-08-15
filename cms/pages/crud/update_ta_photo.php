<<?php
   /* session_start();
    date_default_timezone_set('Asia/Manila');
    if($_SESSION['id']=="") header("Location:../../../");

    //FOR PHOTO

    $name=$_FILES["taphoto"]["name"];
    $id=$_SESSION['id'];
    $path = $_FILES['taphoto']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $ext = strtolower($ext);
    $save=md5($name.$id).".".$ext;

    if($ext != 'php'){
      echo "Upload: " . $save . "<br />";
      echo "Type: " . $ext . "<br />";
      echo "Size: " . ($_FILES["taphoto"]["size"] / 1024) . " Kb<br />";
      echo "Temp file: " . $_FILES["taphoto"]["tmp_name"] . "<br />";

      move_uploaded_file($_FILES["taphoto"]["tmp_name"],"../../uploads/" . $save);
    }else{
     // header("Location:../core/register_attraction.php");
    }

    //FOR DATA UPLOAD
    if($ext != 'php'){
     include '../../connection/connection.php';
     include '../../connection/logs.php';
          recordLog("Updated TA Photo");
      $sql = "UPDATE tourist_attraction set
      photo = '".$save."' where ta_id = '".$_POST["ta_id"]."'";

      if (mysqli_query($conn, $sql)) {
       //  header('Location: ../core/registered_attraction.php');
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
      mysqli_close($conn);
    }else{
     // header("Location:../core/register_attraction.php");
    } */
?>
<?php
session_start();
require_once("../../connection/connection.php");
include '../../connection/logs.php';
recordLog("Updated TA Photo");

$name=$_FILES["taphoto"]["name"];
$id=$_SESSION['id'];
$path = $_FILES['taphoto']['name'];
$ext = pathinfo($path, PATHINFO_EXTENSION);
$ext = strtolower($ext);
$save=md5($name.$id).".".$ext;

if($ext != 'php'){
  move_uploaded_file($_FILES["taphoto"]["tmp_name"],"../../uploads/" . $save);
  mysqli_query($conn,"UPDATE tourist_attraction set photo = '".$save."' where ta_id = '".$_POST["ta_id"]."'");
  mysqli_close($conn);
  header("Location:../core/registered_attraction.php");

}else{
  header("Location:../core/registered_attraction.php");
}
?>