<?php
session_start();
if($_SESSION['id']=="") header("Location:../../../");
include '../../connection/connection.php';
$sql = "DELETE FROM trainings WHERE training_id='".$_GET['id']."'";
if (mysqli_query($conn, $sql)) {
    header("Location: ../frontend/training_masterlist.php");
}
mysqli_close($conn);
?>