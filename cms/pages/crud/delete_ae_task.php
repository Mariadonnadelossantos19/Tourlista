<?php
session_start();
if($_SESSION['id']=="") header("Location:../../../");

    include '../../connection/connection.php';
    include '../../connection/logs.php';
    recordLog("Deleted AE task with ID=".$_GET['id']);
    $id=$_GET['id'];
    $sql = "DELETE FROM ae_daily_task WHERE ae_task_id='".$id."'";
    if (mysqli_query($conn, $sql)) {
        if($_GET['mo']!==""){
            if($_SESSION['level']>2){
                header("Location: ../core/ae_daily_encoding.php?month=".$_GET['m']."&year=".$_GET['y']);
            }else{
                header("Location: ../core/ae_daily_update.php?month=".$_GET['m']."&year=".$_GET['y']);
            }
        }else{
            header("Location: ../core/ae_daily_task.php");
        }
    }
    mysqli_close($conn);
?>
