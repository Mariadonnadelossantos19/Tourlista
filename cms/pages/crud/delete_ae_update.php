<?php
session_start();
if($_SESSION['id']=="") header("Location:../../../");

    include '../../connection/connection.php';
    include '../../connection/logs.php';
    recordLog("Deleted AE task with ID=".$_GET['id']);
    $id=$_GET['id'];
    $sql = "DELETE FROM ae_daily_task WHERE ae_task_id='".$id."'";
    if (mysqli_query($conn, $sql)) {
        header("Location: ../core/ae_daily_update.php?month=".$_GET["month"]);
    }
    mysqli_close($conn);
?>
