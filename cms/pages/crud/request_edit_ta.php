<?php
      session_start();
      if($_SESSION['id']=="") header("Location:../../../");

          include '../../connection/connection.php';
          include '../../connection/logs.php';
          recordLog("Request to edit tourist attraction name with ID=".$_GET['id']);
          $id=$_GET['id'];

          $sql = "UPDATE tourist_attraction set request_edit='1' WHERE ta_id='".$id."'";
          mysqli_query($conn, $sql);
          header("Location: ../core/registered_attraction.php");
          mysqli_close($conn);
?>
