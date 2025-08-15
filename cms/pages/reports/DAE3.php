<?php
    session_start();
    if($_SESSION['id']=="") header("Location:../../");
?>
  <thead>
    <th>Province/HUC/ICC</th>
    <th>Municipality/City</th>
    <th>Year</th>
    <th>Month</th>
    <th>Accommodation Establishment</th>
    <th>Type-Class</th>
    <th>Total Rooms</th>
    <th>Total Phil. Resident (Domestic) Guest Checked-In</th>
    <th>Total Phil. Resident (Domestic) Guest Night</th>
    <th>Total No. of Rooms Occupied</th>
    <th>Total Foreign Visitor Arrival</th>
    <th>Total Guest Nights of Foreign Visitor</th>
    <th>Total Guest Nights (Domestic+Foreign)</th>
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

      if($_SESSION['level']=='3'){
          $addq = "and p.province_c = '".$province."' and c.citymun_c = '".$citymun."'";
      }
      if($_SESSION['level']=='4'){
          $addq = "and p.province_c = '".$province."'";
      }

      $sql = "select ae_id, province_m, citymun_m, ae_name, type, no_rooms from accommodation_establishment a left join ts_users t on a.user_id = t.user_id left join province p on t.province_c = p.province_c left join citymun c on t.citymun_c = c.citymun_c and c.province_c = p.province_c where a.approve_status = '1' and t.region_c = '".$region."' " .$addq."";

        $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
              while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                <td>".$row['province_m']."</td>
                <td>".$row['citymun_m']."</td>
                <td>".$year."</td>
                <td>".$month."</td>
                <td>".strtoupper($row['ae_name'])."</td>
                <td>".strtoupper($row['type'])."</td>
                <td>".$row['no_rooms']."</td>
                ";

                   $sql1 = "select sum(local_tourist) as domestic, sum(no_rooms_occupied) as total_room, sum(foreign_tourist) as foreigns, sum(no_stayed_overnight) as overnight from ts_users u left join accommodation_establishment a  on u.user_id = a.user_id left join ae_daily_task z on a.ae_id = z.ae_id where year = '".$year."' and month = '".$month."' and approve_status = '1' and z.ae_id='".$row['ae_id']."' group by z.ae_id";


                    $result1 = mysqli_query($conn, $sql1);

                    if (mysqli_num_rows($result1) > 0) {
                        while($row1 = mysqli_fetch_assoc($result1)) {
                          $dom_stay = ($row1['overnight']-$row1['foreigns']);
                          $for_stay = ($row1['overnight']-$dom_stay);
                            echo "
                            <td>".$row1['domestic']."</td>
                            <td>-</td>
                            <td>".$row1['total_room']."</td>
                            <td>".$row1['foreigns']."</td>
                            <td>-</td>
                            
                            <td>".$row1['overnight']."</td>
                            ";
                        }
                        
                    }
                    else{
                      echo "
                            <td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td>
                            ";
                    }

                  echo '</tr>';

              }
            //  echo '<tr><td colspan="13" align="right"><b>GRAND TOTAL</b></td><td><b>'.number_format($gtotal).'</b></td></tr>';
          }

    ?>
  </tbody>