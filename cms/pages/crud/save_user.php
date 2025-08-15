<?php
    session_start();
    date_default_timezone_set('Asia/Manila');
    if($_SESSION['id']=="") header("Location:../../../");
     include '../../connection/connection.php';
     include '../../connection/logs.php';
          recordLog("Encoded new user");
      $sql = "INSERT INTO ts_users (access_level, status, region_c, province_c, citymun_c, username, password, email, mobile, date_time_encoded)
      VALUES ('1','1','".$_POST["region"]."','".$_POST["province"]."','".$_POST["citymun"]."','".$_POST["username"]."', '".sha1($_POST["password"])."','".$_POST["email"]."', '".$_POST["mobile"]."', '".date("Y-m-d | H:i:s")."')";
      if (mysqli_query($conn, $sql)) {
         header('Location: ../core/manageUser.php');
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
      mysqli_close($conn);
?>
