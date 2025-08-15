<?php
    session_start();
    if($_SESSION['id']=="") header("Location:../../");
    include '../../connection/connection.php';
    include '../../connection/logs.php';
    recordLog("Visited Summary and Statistics");
    $sql = "select * from ts_users where user_id='".$_SESSION['id']."'";
    $result = mysqli_query($conn, $sql);
    $access_level = "";
    $province = "";
    $region = "";
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $access_level = $row["access_level"];
            $province = $row["province_c"];
            $region = $row["region_c"];
        }
    }
?>
  <thead>
    <th colspan="14" style="color: red;">AE REGIONAL SUMMARY REPORT FOR CY <?php echo $_GET['year']; ?></th>
  </thead>
  <thead>
    <th rowspan="1">Province</th>
    <th colspan="12">Months</th>
    <th rowspan="2">Total</th>

  </thead>
  <thead>
    <td></td>
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
      $gtotal = 0;

      $sql = "select province_c, province_m from province where region_c = '".$region."'";

        $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
              while($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td><a href='#' onclick='generateReport2(2,".$year.",".($row['province_c']*1).",0)'>".$row['province_m']."</a></td>";

                   $sql1 = "select p.province_c,province_m, sum(no_new_checkin) as tot, d.month from province p left join ts_users t on p.province_c = t.province_c left join accommodation_establishment a on t.user_id = a.user_id left join ae_daily_task d on a.ae_id = d.ae_id where a.approve_status = '1' and d.year = '".$year."' and p.province_c = '".$row['province_c']."' group by d.month,province_m";
                   //echo "tr><td>".$sql1."</td></tr>";

                    $result1 = mysqli_query($conn, $sql1);

                    if (mysqli_num_rows($result1) > 0) {
                        $data = array("0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0");
                        $total = 0;
                        while($row1 = mysqli_fetch_assoc($result1)) {
                          $data[$row1['month']-1]=$row1['tot'];
                        }
                        for($y=0; $y<12; $y++){
                            echo "<td>".number_format($data[$y])."</td>";
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