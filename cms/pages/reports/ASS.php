<?php
    session_start();
    error_reporting(E_ERROR | E_PARSE);
    if($_SESSION['id']=="") header("Location:../s../");
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
                <table class="table table-striped" style="text-align: left;">
                  <tr>
                    <th>Date</th>
                    <th>Rooms Occupied</th>
                    <th>Stayed Overnight</th>
                    <th>New Checkin</th>
                    <th style="text-align: center;">Occupancy Rate</th>
                  </tr>
                  <?php
                  include '../../connection/connection.php';
                  $totalrooms = 0;
                  $sql1 = "select no_rooms from accommodation_establishment where ae_id = '".$_GET['id']."'";
                  $result1 = mysqli_query($conn, $sql1);
                  if (mysqli_num_rows($result1) > 0) {
                      while($row1 = mysqli_fetch_assoc($result1)) {
                      $totalrooms = $row1["no_rooms"];
                      }
                  }
                  $num = 0;
                  $totalOccupancy = 0;
                  $totalRO = 0;
                  $totalSO = 0;
                  $totalCI = 0;

                  for($x=1; $x<=$d; $x++){

                  $sql = "select ae_task_id, task_date, day, month, year, no_rooms_occupied, no_stayed_overnight, no_new_checkin, local_tourist, foreign_tourist, remarks from ae_daily_task where ae_id = '".$_GET['id']."'
                  and day = '".$x."' and month = '".$_GET["month"]."' and year = '".$_GET["year"]."' order by task_date asc";
                  $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                              $rate = ($row["local_tourist"]/($row["local_tourist"]+$row["foreign_tourist"]))*100;
                              $occupancy = ($row["no_rooms_occupied"]/$totalrooms)*100;

                              $num++;
                              $totalOccupancy += $occupancy;
                              $totalRO += $row['no_new_checkin'];
                              $totalSO += $row['no_new_checkin'];
                              $totalCI += $row['no_new_checkin'];

                              //for local vs tourist
                              $ratecolor = "";
                              $occupancycolor = "";

                              if($rate>=0 && $rate<26){ // 0 - 25
                                $ratecolor = "danger";
                              }
                              if($rate>25 && $rate<51){ // 26 - 50
                                $ratecolor = "warning";
                              }
                              if($rate>50 && $rate<76){ // 51 - 75
                                $ratecolor = "primary";
                              }
                              if($rate>75 && $rate<101){ // 76 - 100
                                $ratecolor = "success";
                              }

                              if($occupancy>=0 && $occupancy<26){
                                $occupancycolor = "red";
                              }
                              if($occupancy>25 && $occupancy<51){
                                $occupancycolor = "orange";
                              }
                              if($occupancy>50 && $occupancy<76){
                                $occupancycolor = "blue";
                              }
                              if($occupancy>75 && $occupancy<101){
                                $occupancycolor = "green";
                              }
                              $date=date_create($row["task_date"]);
                                    echo
                                    '<tr>
                                          <td>'.$month." ".$x.'</td>
                                          <td style="text-align: center;">'.$row['no_rooms_occupied'].'</td>
                                          <td style="text-align: center;">'.$row['no_stayed_overnight'].'</td>
                                          <td style="text-align: center;">'.$row['no_new_checkin'].'</td>

                                          <td style="text-align: center;"><span class="badge bg-'.$occupancycolor.'">'.number_format($occupancy).'%</span></td>

                                    </tr>';
                                }
                              }
                            else{
                              echo "<tr><td>".$month." ".$x."</td><td colspan='5'>No daily accommodation data encoded for this date</td></tr>";
                            }

                          }
                          echo "<tr><td colspan='3'><b>TOTAL GUEST FOR THE MONTH</b></td><td style='text-align: center; color: red;'><b>".number_format($totalCI)."</b></td><td></td></tr>";
                  ?>

                </table>