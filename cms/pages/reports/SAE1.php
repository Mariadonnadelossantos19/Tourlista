<?php
    session_start();
    if($_SESSION['id']=="") header("Location:../../");
?>
  <thead>
    <th>No.</th>
    <th>Name of Establishment</th>
    <th>Type</th>
    <th>No. of Rooms</th>
    <th>Number of Employees</th>
    <th>Number of Male</th>
    <th>Number of Female</th>
    <th>Number of Regular</th>
    <th>Number of On-Call</th>
    <th>Year</th>
    <th>Province/HUC/ICC  </th>
    <th>Municipality/City</th>
  </thead>
  <tbody>
    <?php
      include '../../connection/connection.php';
      $year = $_GET["year"];
      $month = $_GET["month"];
      $region = $_GET["region"];
      $province = $_GET["province"];
      $citymun = $_GET["citymun"];
      $addq = "";
      $num = 1;

      if($_SESSION['level']=='3'){
          $addq = "and p.province_c = '".$province."' and c.citymun_c = '".$citymun."'";
      }
      if($_SESSION['level']=='4'){
          $addq = "and p.province_c = '".$province."'";
      }

      $sql = "select ae_name, type, no_rooms, province_m, citymun_m, no_regular_male, no_regular_female, no_on_call_male, no_on_call_female from accommodation_establishment a  left join ts_users t on a.user_id = t.user_id left join province p on t.province_c = p.province_c left join citymun c on t.citymun_c = c.citymun_c and c.province_c = p.province_c where a.approve_status = '1' and t.region_c = '".$region."'" .$addq."";

        $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
              while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                <td>".$num."</td>
                <td>".strtoupper($row['ae_name'])."</td>
                <td>".strtoupper($row['type'])."</td>
                <td>".$row['no_rooms']."</td>
                <td>".($row['no_regular_male']+$row['no_regular_female']+$row['no_on_call_male']+$row['no_on_call_female'])."</td>
                <td>".($row['no_regular_male']+$row['no_on_call_male'])."</td>
                <td>".($row['no_regular_female']+$row['no_on_call_female'])."</td>
                <td>".($row['no_regular_male']+$row['no_regular_female'])."</td>
                <td>".($row['no_on_call_male']+$row['no_on_call_female'])."</td>
                <td>".$year."</td>
                <td>".$row['province_m']."</td>
                <td>".$row['citymun_m']."</td>
                ";


                  echo '</tr>';
                  $num++;

              }
            //  echo '<tr><td colspan="13" align="right"><b>GRAND TOTAL</b></td><td><b>'.number_format($gtotal).'</b></td></tr>';
          }

    ?>
  </tbody>