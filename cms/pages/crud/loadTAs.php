<?php
  include '../../connection/connection.php';
  $sql = "select u.user_id, ta_id, ta_name from ts_users u
  left join tourist_attraction a on u.user_id = a.user_id
  left join province p on u.province_c = p.province_c
  left join citymun c on p.province_c = c.province_c and u.citymun_c = c.citymun_c
  where a.approve_status = '1' and u.province_c = '".$_GET["province_c"]."' and u.citymun_c = '".$_GET["citymun_c"]."'";
    $result = mysqli_query($conn, $sql);
    echo '<option class="form-control" value="">Select an Attraction</option>';
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo '<option class="form-control" value="'.$row["user_id"].'">'.$row["ta_name"].'</option>';
            }
        }
?>
