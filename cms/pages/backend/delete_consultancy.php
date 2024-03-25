<?php
session_start();
if($_SESSION['id']=="") header("Location:../../../");
include '../../connection/connection.php';
$sql = "DELETE FROM consultancies WHERE consultancy_id='".$_GET['id']."'";
if (mysqli_query($conn, $sql)) {
    header("Location: ../frontend/consultancy_masterlist.php");
}
mysqli_close($conn);
?>