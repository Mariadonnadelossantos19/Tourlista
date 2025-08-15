<?php
    session_start(); 
    if($_SESSION['id']=="") header("Location:../signin");
    include '../../connection/connection.php';
    include '../../connection/logs.php';
    recordLog("Visited Summary and Statistics");
    $sql = "select * from ts_users where user_id='".$_SESSION['id']."'";
    $result = mysqli_query($conn, $sql);
    $access_level = "";
    $province = "";
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $access_level = $row["access_level"];
            $province = $row["province_c"];
        }
    }
?>
  <thead>
    <th colspan="14" style="color: red;">AE CITY/MUNICIPAL SUMMARY REPORT FOR CY <?php echo $_GET['year']; ?></th>
  </thead>
  <thead>
    <th rowspan="1"><a href='#' onclick="generateReport2(2,<?php echo $_GET['year'].",".($_GET['province']*1); ?>)"><b><?php if($access_level > 3) { echo "<u>RETURN TO CITY/MUNICIPALITY LIST</u>"; } ?></b></a></th>
    <th colspan="12">MONTHS</th>
    <th rowspan="2">TOTAL</th>

  </thead>
  <thead>
    <td><b>ACCOMMODATION ESTABLISHMENT</b></td>
    <td>Jan</td>
    <td>Feb</td>
    <td>Mar</td>
    <td>Apr</td>
    <td>May</td>
    <td>Jun</td>
    <td>Jul</td>
    <td>Aug</td>
    <td>Sep</td>
    <td>Oct</td>
    <td>Nov</td>
    <td>Dec</td>
    <td></td>
  </thead>
  <tbody>
    <?php
      include '../../connection/connection.php';
      $year = $_GET["year"];
      $province = $_GET["province"];
      $citymun = $_GET["citymun"];
      $gtotal = 0;

      $sql = "SELECT ae_id, ae_name FROM accommodation_establishment a LEFT JOIN ts_users t ON a.user_id = t.user_id WHERE a.approve_status = '1' AND province_c = '".$province."' AND citymun_c = '".$citymun."' ORDER BY ae_name ASC";

        $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
              while($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>".strtoupper($row['ae_name'])."</td>";

                $sql1 = "SELECT province_c, citymun_c, a.ae_id,a.ae_name, month, sum(no_new_checkin) as tot FROM ts_users u LEFT JOIN accommodation_establishment a ON u.user_id = a.user_id LEFT JOIN ae_daily_task z ON a.ae_id = z.ae_id WHERE year = '".$year."' AND approve_status = '1' AND u.province_c = '".$province."' AND u.citymun_c = '".$citymun."' AND a.ae_id = '".$row['ae_id']."' GROUP BY z.ae_id, z.month";

                    $result1 = mysqli_query($conn, $sql1);

                    if (mysqli_num_rows($result1) > 0) {
                        $data = array("0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0");
                        $total = 0;
                        while($row1 = mysqli_fetch_assoc($result1)) {
                          $data[$row1['month']-1]=$row1['tot'];
                        }
                        for($y=0; $y<12; $y++){
                            echo "<td>";
                              if($data[$y]>0){
                                  echo "<a href='#' onclick='loadData(6,".$row['ae_id'].",".($y+1).",".$year.")'>".number_format($data[$y])."</a>";
                              }
                              else{
                                echo number_format($data[$y]);
                              }
                            

                            echo "</td>";
                            $total+=$data[$y];
                            $gtotal+=$data[$y];
                        }
                        echo "<td>".number_format($total)."</td>";
                    }
                    else{
                      for($x=0; $x<13; $x++){
                          echo '<td>0</td>';
                      }
                    }

                  echo '</tr>';

              }
              echo '<tr><td colspan="13" align="right"><b>GRAND TOTAL</b></td><td><b>'.number_format($gtotal).'</b></td></tr>';
          }

    ?>
  </tbody>