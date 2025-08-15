<?php
    session_start();
    date_default_timezone_set('Asia/Manila');
    if($_SESSION['id']=="") header("Location:../../../");

      include '../../connection/connection.php';
      include '../../connection/logs.php';
          recordLog("Updated Profile Details");
      $sql = "UPDATE ts_users set
      username = '".$_POST["username"]."',
      email = '".base64_encode($_POST["email"])."',
      mobile = '".base64_encode($_POST["mobile"])."',
      new_password = '".password_hash(sha1($_POST["password"]), PASSWORD_BCRYPT)."'
      where user_id = '".$_SESSION['id']."'";

      if (mysqli_query($conn, $sql)) {
         header('Location: ../core/profile.php');
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
      mysqli_close($conn);
?>
