<?php
  include '../../connection/connection.php';
  $sql = "Select * from ta_category where ta_type_id = '".$_GET["type"]."'";
  $result = mysqli_query($conn, $sql);
  echo  "<option value=''>Select Category</option>";
  if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {
          echo '<option class="form-control" value="'.$row["ta_category_code"].'">'.$row["ta_category_code"].' - '.$row["category"].'</option>';
      }
  }
?>
