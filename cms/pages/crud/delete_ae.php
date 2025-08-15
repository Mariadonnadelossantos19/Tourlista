<?php
session_start();
if($_SESSION['id']=="") header("Location:../../../");

    include '../../connection/connection.php';
    include '../../connection/logs.php';
    recordLog("Deleted accommodation establishment with ID=".$_GET['id']);
    $id=$_GET['id'];
    $sql = "DELETE FROM accommodation_establishment WHERE ae_id='".$id."'";
    if (mysqli_query($conn, $sql)) {
        header("Location: ../core/manage_accommodation.php");
    }
    mysqli_close($conn);
?>
