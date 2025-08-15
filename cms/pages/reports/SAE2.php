<?php
    session_start();
    if($_SESSION['id']=="") header("Location:../../");
?>
  <thead>
    <th>No.</th>
    <th>Type of Accommodation</th>
    <th>Number of Establishment</th>
    <th>Number of Rooms</th>
    <th>Number of Employees</th>
    <th>Note</th>
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
          $addq = "and t.province_c = '".$province."' and t.citymun_c = '".$citymun."'";
      }
      if($_SESSION['level']=='4'){
          $addq = "and t.province_c = '".$province."' ";
      }

      $sql = "select type_classification as typ, count(ae_id) as est, sum(no_rooms) as rooms, sum(no_regular_male) as c, sum(no_regular_female) as d, sum(no_on_call_male) as e, sum(no_on_call_female) as f from ae_type e left join accommodation_establishment a on e.type_classification = a.type left join ts_users t on a.user_id = t.user_id where approve_status = '1' and t.region_c = '".$region."' " .$addq." group by a.type order by e.sort asc";

        $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
              while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                <td>".$num."</td>
                <td>".$row['typ']."</td>
                <td>".$row['est']."</td>
                <td>".$row['rooms']."</td>
                <td>".($row['c']+$row['d']+$row['e']+$row['f'])."</td>
                <td></td>
                ";


                  echo '</tr>';
                  $num++;

              }

            //  echo '<tr><td colspan="13" align="right"><b>GRAND TOTAL</b></td><td><b>'.number_format($gtotal).'</b></td></tr>';
          }

    ?>
  </tbody>