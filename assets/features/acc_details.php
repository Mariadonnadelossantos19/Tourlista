<?php
include '../../cms/connection/connection.php';
$sql = "Select * from accommodation_establishment where ae_name = '".$_GET['x']."'";
//For the accommodation establishments
$result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {
      echo "<img src='../cms/uploads/".$row['photo']."' class='img-thumbnail' style='width: 200px;'><br /><br /><b>Establishment: </b>".$row['ae_name']." <br /> <b>Address: </b>".$row['complete_address']." <br /> <b>Telephone: </b>".$row['contact_number'].
      " <br /> <b>Email: </b>".$row['email'];
      }
    }
  ?>
