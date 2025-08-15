<?php
      session_start();
      if($_SESSION['id']=="") header("Location:../../../");

          include '../../connection/connection.php';
          include '../../connection/logs.php';
          recordLog("Reset user with ID=".$_GET['id']);
          $id=$_GET['id'];
          $sql = "UPDATE ts_users set new_password='".password_hash('7c222fb2927d828af22f592134e8932480637c0d', PASSWORD_BCRYPT)."' WHERE user_id='".$id."'";
          if (mysqli_query($conn, $sql)) {
            $sqlx = "UPDATE ts_users set attempts = '0' where user_id = '".$id."'";
            mysqli_query($conn, $sqlx);
              header("Location: ../core/manage_user.php");
          }
          mysqli_close($conn);
?>
