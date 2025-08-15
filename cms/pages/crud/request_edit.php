<?php
      session_start();
      if($_SESSION['id']=="") header("Location:../../../");

          include '../../connection/connection.php';
          include '../../connection/logs.php';
          recordLog("Request to edit accommodation establishment name with ID=".$_GET['id']);
          $id=$_GET['id'];

          $sql = "UPDATE accommodation_establishment set request_edit='1' WHERE ae_id='".$id."'";
          mysqli_query($conn, $sql);
          header("Location: ../core/registered_establishment.php");
          mysqli_close($conn);
?>
