<?php
session_start();
if($_SESSION['id']=="") header("Location:../../../");

    include '../../connection/connection.php';
    include '../../connection/logs.php';
    recordLog("Deleted user with ID=".$_GET['id']);
    $id=$_GET['id'];
    $sql = "DELETE FROM ts_users WHERE user_id='".$id."'";
    if (mysqli_query($conn, $sql)) {
        header("Location: ../core/manage_user.php");
    }
    mysqli_close($conn);
?>
