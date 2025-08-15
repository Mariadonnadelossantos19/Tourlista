<?php
    session_start();
    error_reporting(E_ERROR | E_PARSE);
    if($_SESSION['id']=="") header("Location:../../");
?>

<?php
                  $month = "";
                  date_default_timezone_set('Asia/Manila');
                  $d=cal_days_in_month(CAL_GREGORIAN,$_GET["month"],$_GET["year"]);
                  $x = $_GET["month"];
                  if($x=='1'){
                    $month = "January";
                  }
                  if($x=='2'){
                    $month = "February";
                  }
                  if($x=='3'){
                    $month = "March";
                  }
                  if($x=='4'){
                    $month = "April";
                  }
                  if($x=='5'){
                    $month = "May";
                  }
                  if($x=='6'){
                    $month = "June";
                  }
                  if($x=='7'){
                    $month = "July";
                  }
                  if($x=='8'){
                    $month = "August";
                  }
                  if($x=='9'){
                    $month = "September";
                  }
                  if($x=='10'){
                    $month = "October";
                  }
                  if($x=='11'){
                    $month = "November";
                  }
                  if($x=='12'){
                    $month = "December";
                  }
                  ?>
                </h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body no-padding">
                <table class="table table-bordered table-hover" style="text-align: left;">
                  <tr>
                    <th rowspan='2' style="text-align: center;">Date</th>
                    <th colspan='2' style="text-align: center;">Within the LGU</th>
                    <th colspan='2' style="text-align: center;">From other LGU</th>
                    <th colspan='2' style="text-align: center;">Foreign Visitor</th>
                    <th colspan='3' style="text-align: center;">Total Visitor</th>
                  </tr>
                  <tr>
                    <th style="background:#AED6F1; text-align: center;">Male</th>
                    <th style="background:#FADBD8; text-align: center;">Female</th>
                    <th style="background:#AED6F1; text-align: center;">Male</th>
                    <th style="background:#FADBD8; text-align: center;">Female</th>
                    <th style="background:#AED6F1; text-align: center;">Male</th>
                    <th style="background:#FADBD8; text-align: center;">Female</th>
                    <th style="background:#AED6F1; text-align: center;">Male</th>
                    <th style="background:#FADBD8; text-align: center;">Female</th>
                    <th style="background:#D2B4DE; text-align: center;">Total</th>
                  </tr>
                  <?php
                  include '../../connection/connection.php';
                  $num = 0;
                  $total = 0;
                  $totalR= 0;
                  $totalNR= 0;
                  $totalFO = 0;
                  $totalMale = 0;
                  $totalFemale = 0;
                  $totalVisit = 0;
                  $grandtotal = 0;

                  for($x=1; $x<=$d; $x++){

                  $sql = "select * from ta_daily_task where ta_id = '".$_GET['id']."' and year = '".$_GET["year"]."' and month = '".$_GET['month']."' and day = '".$x."' order by task_date asc";
                  $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                              $num++;
                              $totalR = $row['r_male']+$row['r_female'];
                              $totalNR = $row['nr_male']+$row['nr_female'];
                              $totalFO = $row['fo_male']+$row['fo_female'];
                              $totalF = $row['r_female']+$row['nr_female']+$row['fo_female'];
                              $totalM = $row['r_male']+$row['nr_male']+$row['fo_male'];
                              $totalMale +=$totalM;
                              $totalFemale +=$totalF;
                              $totalVisit +=$totalM+$totalF;
                              $total =$totalM+$totalF;
                              $grandtotal += $total;

                              $date=date_create($row["task_date"]);
                                    echo
                                    '<tr style="text-align: center;">
                                          <td style="text-align: left;">'.$month." ".$x.'</td>
                                          <td>'.$row['r_male'].'</td>
                                          <td>'.$row['r_female'].'</td>
                                          <td>'.$row['nr_male'].'</td>
                                          <td>'.$row['nr_female'].'</td>
                                          <td>'.$row['fo_male'].'</td>
                                          <td>'.$row['fo_female'].'</td>
                                          <td>'.$totalM.'</td>
                                          <td>'.$totalF.'</td>
                                          <td><b>'.$total.'</b></td>
                                    </tr>';
                                }
                              }
                            else{
                              echo "<tr><td>".$month." ".$x."</td><td colspan='10'>No tourist attraction data encoded for this date</td></tr>";
                            }

                          }
                          echo "<tr><td colspan='7'><b>TOTAL VISITORS FOR THE MONTH</b></td><td colspan = '3' style='text-align: center; color: red;'><b>".number_format($grandtotal)."</b></td></tr>";





                                //  echo "<tr><td>".date("F")." ".$x."</td><td>No Data</td></tr>";
                  ?>

                </table>