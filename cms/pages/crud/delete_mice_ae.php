<?php
session_start();
if($_SESSION['id']=="") header("Location:../../../");

    include '../../connection/connection.php';
    include '../../connection/logs.php';
    recordLog("Deleted MICE with ID=".$_GET['id']);
    $id=$_GET['id'];
    $sql = "DELETE FROM mice WHERE mice_id='".$id."'";
    if (mysqli_query($conn, $sql)) {
        header("Location: ../core/ae_mice.php");
    }
    mysqli_close($conn);
?>
