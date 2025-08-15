<?php
session_start();
if($_SESSION['id']=="") header("Location:../../../");

    include '../../connection/connection.php';
    include '../../connection/logs.php';
    recordLog("Deleted tourist attraction with ID=".$_GET['id']);
    $id=$_GET['id'];
    $sql = "DELETE FROM tourist_attraction WHERE ta_id='".$id."'";
    if (mysqli_query($conn, $sql)) {
        header("Location: ../core/manage_attraction.php");
    }
    mysqli_close($conn);
?>
