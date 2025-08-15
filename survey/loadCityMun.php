<?php
  include '../connection/connection.php';
  $sql = "Select citymun_c, citymun_m from citymun where province_c = '".$_GET["province_c"]."'";
  $result = mysqli_query($conn, $sql);
  echo  "<option value=''>Select City / Municipality</option>";
  if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {
          echo '<option class="form-control" value="'.$row["citymun_c"].'">'.$row["citymun_m"].'</option>';
      }
  }
?>
