<?php
session_start();
if($_SESSION['id']=="") header("Location:../../../");

    include '../../connection/connection.php';
    include '../../connection/logs.php';
    recordLog("Deleted TA task with ID=".$_GET['id']);
    $id=$_GET['id'];
    $sql = "DELETE FROM ta_daily_task WHERE ta_task_id='".$id."'";
    if (mysqli_query($conn, $sql)) {
        header("Location: ../core/ta_daily_task.php");
    }
    mysqli_close($conn);
?>
