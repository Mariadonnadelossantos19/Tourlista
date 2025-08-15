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
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $access_level = $row["access_level"];
            $province = $row["province_c"];
        }
    }
?>
  <thead>
    <th colspan="14" style="color: red;">TA PROVINCIAL SUMMARY REPORT FOR CY <?php echo $_GET['year']; ?></th>
  </thead>
  <thead>
    <th rowspan="1"><a href='#' onclick="generateReport2(1,<?php echo $_GET['year']; ?>)"><b><?php if($access_level > 4) { echo "<u>RETURN TO PROVINCE LIST</u>"; } ?></b></a></th>
    <th colspan="12">MONTHS</th>
    <th rowspan="2">TOTAL</th>

  </thead>
  <thead>
    <td><b>CITY / MUNICIPALITY</b></td>
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

      $sql = "select citymun_c, citymun_m from citymun where province_c = '".$province."'";

        $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
              while($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td><a href='#' onclick='generateReport2(5,".$year.",".$province.",".$row['citymun_c'].")'>".$row['citymun_m']."</a></td>";

                   $sql1 = "select province_c, citymun_c, month, sum(r_male) as rm, sum(r_female) as rf, sum(nr_male) as nrm, sum(nr_female) as nrf, sum(fo_male) as fm, sum(fo_female) as ff from ts_users u left join tourist_attraction a on u.user_id = a.user_id left join ta_daily_task z on a.ta_id = z.ta_id where year = '".$year."' and approve_status = '1' and u.province_c = '".$province."' and citymun_c = '".$row['citymun_c']."' group by citymun_c, z.month";

                    $result1 = mysqli_query($conn, $sql1);

                    if (mysqli_num_rows($result1) > 0) {
                        $data = array("0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0");
                        $total = 0;
                        while($row1 = mysqli_fetch_assoc($result1)) {
                          $data[$row1['month']-1]=($row1['rm']+$row1['rf']+$row1['nrm']+$row1['nrf']+$row1['fm']+$row1['ff']);
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