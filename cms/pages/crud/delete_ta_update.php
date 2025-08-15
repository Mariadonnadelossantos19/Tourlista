<?php
session_start();
if($_SESSION['id']=="") header("Location:../../../");

    include '../../connection/connection.php';
    include '../../connection/logs.php';
    recordLog("Deleted TA task with ID=".$_GET['id']);
    $id=$_GET['id'];
    $sql = "DELETE FROM ta_daily_task WHERE ta_task_id='".$id."'";
    if (mysqli_query($conn, $sql)) {
        if($_SESSION['level']>2){
            header("Location: ../core/ta_daily_encoding.php?month=".$_GET["month"]);
        }else{
            header("Location: ../core/ta_daily_update.php?month=".$_GET["month"]);
        }
    }
    mysqli_close($conn);
?> 
