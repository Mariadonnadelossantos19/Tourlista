<?php
    session_start();
    if($_SESSION['id']=="") header("Location:../../");
?>
  <thead>
    <th>Province/HUC/ICC</th>
    <th>Municipality/City</th>
    <th>Year</th>
    <th>Tourist Attraction</th>
    <th>TM(M)</th>
    <th>TM(F)</th>
    <th>TM(SUM)</th>
    <th>OM(M)</th>
    <th>OM(F)</th>
    <th>OM(SUM)</th>
    <th>FCR(M)</th>
    <th>FCR(F)</th>
    <th>FCR(SUM)</th>
    <th>Total Male</th>
    <th>Total Female</th>
    <th>Grand Total</th>
  </thead>

  <tbody>
    <?php
      include '../../connection/connection.php';
      $year = $_GET["year"];
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

      $sql = "select ta_id, province_m, citymun_m, ta_name from tourist_attraction a left join ts_users t on a.user_id = t.user_id left join province p on t.province_c = p.province_c left join citymun c on t.citymun_c = c.citymun_c and c.province_c = p.province_c where a.approve_status = '1' and t.region_c = '".$region."' " .$addq."";

        $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
              while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                <td>".$row['province_m']."</td>
                <td>".$row['citymun_m']."</td>
                <td>".$year."</td>
                <td>".strtoupper($row['ta_name'])."</td>
                ";
                   $sql1 = "select sum(r_male) as r_male, sum(r_female) as r_female, sum(nr_male) as nr_male, 
                   sum(nr_female) as nr_female, sum(fo_male) as fo_male, sum(fo_female) as fo_female from ts_users u left join tourist_attraction a  on u.user_id = a.user_id left join ta_daily_task z on a.ta_id = z.ta_id where year = '".$year."' and approve_status = '1' and z.ta_id='".$row['ta_id']."' group by z.ta_id";

echo $sql1;
                    $result1 = mysqli_query($conn, $sql1);

                    if (mysqli_num_rows($result1) > 0) {
                        while($row1 = mysqli_fetch_assoc($result1)) {
                            echo "
                            <td>".number_format($row1['r_male'])."</td>
                            <td>".number_format($row1['r_female'])."</td>
                            <td>".number_format($row1['r_male']+$row1['r_female'])."</td>
                            <td>".number_format($row1['nr_male'])."</td>
                            <td>".number_format($row1['nr_female'])."</td>
                            <td>".number_format($row1['nr_male']+$row1['nr_female'])."</td>
                            <td>".number_format($row1['fo_male'])."</td>
                            <td>".number_format($row1['fo_female'])."</td>
                            <td>".number_format($row1['fo_male']+$row1['fo_female'])."</td>
                            <td>".number_format($row1['r_male']+$row1['nr_male']+$row1['fo_male'])."</td>
                            <td>".number_format($row1['r_female']+$row1['nr_female']+$row1['fo_female'])."</td>
                            <td><b>".number_format($row1['r_male']+$row1['r_female']+$row1['nr_male']+$row1['nr_female']+$row1['fo_male']+$row1['fo_female'])."</b></td>
                            ";
                        }
                        
                    }
                    else{
                      echo "
                            <td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td>
                            ";
                    }

                  echo '</tr>';

              }
            //  echo '<tr><td colspan="13" align="right"><b>GRAND TOTAL</b></td><td><b>'.number_format($gtotal).'</b></td></tr>';
          }

    ?>
  </tbody>