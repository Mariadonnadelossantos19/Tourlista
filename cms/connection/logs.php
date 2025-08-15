<?php
    function recordLog($action){
      include 'connection.php';
        date_default_timezone_set('Asia/Manila');
        $query = "Insert into transactions (user_id,action,action_date,action_time) values ('".$_SESSION['id']."','".$action."','".date("Y-m-d")."','".date("H:i:s")."')";
        mysqli_query($conn, $query);
    }
?>