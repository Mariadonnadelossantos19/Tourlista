<?php
          include '../cms/connection/connection.php';
          $sql = "UPDATE ts_users set verified='1' WHERE email='".base64_encode(strtolower($_GET['email']))."'";
          if (mysqli_query($conn, $sql)) {
              header("Location: index.php?status=5");
          }
          mysqli_close($conn);
?>