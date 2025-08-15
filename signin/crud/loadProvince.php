<?php
  include '../../cms/connection/connection.php';
  $sql = "Select province_c, province_m from province where region_c = '".$_GET["region_c"]."'";
  $result = mysqli_query($conn, $sql);
  echo  "<option value=''>Select Province</option>";
  if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {
          echo '<option class="form-control" value="'.$row["province_c"].'">'.$row["province_m"].'</option>';
      }
  }
?>
