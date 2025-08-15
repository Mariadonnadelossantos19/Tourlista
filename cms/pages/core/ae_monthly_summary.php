<?php
  $page = "ae_monthly_summary";
  include '../template/header.php';
  recordLog("Visited AE Monthly Summary");
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Monthly Accommodation Monitoring </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Monthly Accommodation Monitoring </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-8">
            <!-- /.card -->
            <div class="card">
              <div class="card-header">
                <form class="form-inline">
                    <div class="form-group mx-sm-3 mb-2">
                    <label class="form-group">RELOAD PREVIOUS YEARS DATA: </label>&nbsp;&nbsp;
                      <select name="year" class="form-control">
                      <option value="2024">2024</option>
                        <option value="2023" <?php if($_GET['year']=="2023"){ echo  "selected"; } ?> >2023</option>
                        <option value="2022" <?php if($_GET['year']=="2022"){ echo  "selected"; } ?>>2022</option>
                        <option value="2021" <?php if($_GET['year']=="2021"){ echo  "selected"; } ?>>2021</option>
                        <option value="2020" <?php if($_GET['year']=="2020"){ echo  "selected"; } ?>>2020</option>
                      </select>
                    </div>&nbsp;&nbsp;
                    <button type="submit" class="btn btn-success btn-sm">Reload Data</button>
                  </form>
                  <hr />
                <h3 class="box-title">
                  <?php
                  error_reporting(E_ERROR | E_PARSE);
                  date_default_timezone_set('Asia/Manila');
                  if($_GET["year"]==""){
                    echo  "Calendar Year - ".date("Y");
                  }else{
                    echo  "Calendar Year - ".$_GET['year'];
                  }
                  
                  ?>
                  
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table class="table table-striped" style="text-align: center;">
                  <tr >
                    <th>Month</th>
                    <th>Avg Length of Stay</th>
                    <th>Avg Occupancy Rate</th>
                    <th>Total Guest (M/F)</th>
                    <th>Domestic Visitors</th>
                    <th>Foreign Visitors</th>
                    <th>Action</th>
                  </tr>
                  <?php
                  include '../../../connection/connection.php';
                  $totalrooms = 0;
                  $sql1 = "select no_rooms from accommodation_establishment where user_id = '".$_SESSION['id']."'";
                  $result1 = mysqli_query($conn, $sql1);
                  if (mysqli_num_rows($result1) > 0) {
                      while($row1 = mysqli_fetch_assoc($result1)) {
                      $totalrooms = $row1["no_rooms"];
                      }
                  }
                  $num = 0;
                  $num2 = 0;
                  $totalOccupancy = 0;
                  $totalMale = 0;
                  $totalFemale = 0;
                  $totalLocal = 0;
                  $totalForeign = 0;
                  $month = "";
                  for($x=1; $x<=12; $x++){
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

                  $sql = "select month, year, count(*) as num, sum(no_rooms_occupied), sum(no_stayed_overnight), sum(no_male), sum(no_female), sum(local_tourist), sum(foreign_tourist)
                  from ae_daily_task where user_id = '".$_SESSION['id']."' and month='".$x."' and year = '".date("Y")."' group by month order by month asc";

                  if($_GET["year"]!=""){
                    $sql = "select month, year, count(*) as num, sum(no_rooms_occupied), sum(no_stayed_overnight), sum(no_male), sum(no_female), sum(local_tourist), sum(foreign_tourist)
                  from ae_daily_task where user_id = '".$_SESSION['id']."' and month='".$x."' and year = '".$_GET['year']."' group by month order by month asc";
                  }
                  $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                              $ave_gn = floatval(($row["sum(no_stayed_overnight)"]/($row["sum(no_male)"]+$row["sum(no_female)"])));
                              $ave_oc = floatval($row["sum(no_rooms_occupied)"] / (($totalrooms*$row['num']))*100);
                              $total_guest = $row["sum(no_male)"]+$row["sum(no_female)"];

                              $num2++;
                              $num+=$row['num'];
                              $totalOccupancy += $ave_oc;
                              $totalMale += $row['sum(no_male)'];
                              $totalFemale += $row['sum(no_female)'];
                              $totalLocal += $row['sum(local_tourist)'];
                              $totalForeign += $row['sum(foreign_tourist)'];

                              $gn_color = "";
                              $oc_color = "";

                              if($ave_gn>=0 && $ave_gn<26){
                                $gn_color = "red";
                              }
                              if($ave_gn>25 && $ave_gn<51){
                                $gn_color = "orange";
                              }
                              if($ave_gn>50 && $ave_gn<76){
                                $gn_color = "blue";
                              }
                              if($ave_gn>75 && $ave_gn<101){
                                $gn_color = "green";
                              }

                              if($ave_oc>=0 && $ave_oc<26){
                                $oc_color = "red";
                              }
                              if($ave_oc>25 && $ave_oc<51){
                                $oc_color = "orange";
                              }
                              if($ave_oc>50 && $ave_oc<76){
                                $oc_color = "blue";
                              }
                              if($ave_oc>75 && $ave_oc<101){
                                $oc_color = "green";
                              }
                              $year = "";
                              if($_GET["year"]!=""){
                                  $year = $_GET['year'];
                              }else{
                                $year = date('Y');
                              }


                              echo
                                    '<tr>
                                          <td style="text-align: left;">'.$month.'</td>
                                          <td><span class="badge bg-'.$gn_color.'">'.number_format($ave_gn,2).' </span></td>
                                          <td><span class="badge bg-'.$oc_color.'">'.number_format($ave_oc,2).' %</span></td>
                                          <td style="text-align: left;"><span class="badge badge-primary">'.$row["sum(no_male)"].'</span> <span class="badge badge-danger">'.$row["sum(no_female)"].'</span> = <b>'.$total_guest.'</b></td>
                                          <td><span class="badge bg-gray">'.$row["sum(local_tourist)"].'</span></td>
                                          <td><span class="badge bg-gray">'.$row["sum(foreign_tourist)"].'</span></td>
                                          <td>
                                          <a href="ae_daily_update.php?month='.$row["month"].'&year='.$year.'" title="Update"> <button class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></button></a>
                                          </td>
                                    </tr>';
                                }
                              }
                            else{
                              echo "<tr style='text-align: left;'><td>".$month."</td><td colspan='5'>No data encoded for this month</td>
                              <td style='text-align: center;'>";
                              if($x<=date("m") || ($_GET["year"]!="" && $_GET["year"]< date("Y"))){
                                $year = "";
                                if($_GET["year"]!=""){
                                    $year = $_GET['year'];
                                }else{
                                  $year = date('Y');
                                }
                                  echo "<a href='ae_daily_update.php?month=".$x.'&year='.$year."' title='Add Data'> <button class='btn btn-success btn-xs'><i class='fa fa-plus'></i></button></a>";
                              }

                              echo "</td>
                              </tr>";
                            }

                          }

                  ?>

                </table>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-4">
            <!-- /.card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Status Summary</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table class="table table-striped">
                  <tr>
                    <th width="30%">Particulars</th>
                    <th width="50%">Progress</th>
                    <th>Rate / Total</th>
                  </tr>
                  <tr>
                    <td>Encoding Status</td>
                    <td>
                      <?php
                            error_reporting(E_ERROR | E_PARSE);
                            $encodingrate = number_format(($num/365)*100);
                            $encoding = $num." / ".date("t");
                            $encodingStyle = "";
                            if($encodingrate>=0 && $encodingrate<26){
                              $encodingStyle = "red";
                            }
                            if($encodingrate>25 && $encodingrate<51){
                              $encodingStyle = "yellow";
                            }
                            if($encodingrate>50 && $encodingrate<76){
                              $encodingStyle = "blue";
                            }
                            if($encodingrate>75 && $encodingrate<101){
                              $encodingStyle = "green";
                            }
                      ?>
                      <div class="progress progress-xs progress-striped active">
                        <div class="progress-bar progress-bar-<?php echo $encodingStyle; ?>" style="width: <?php echo $encodingrate.'%'; ?>"></div>
                      </div>
                    </td>
                    <td>
                        <span class="badge bg-<?php echo $encodingStyle; ?>"><?php echo $encodingrate.'%'; ?></span>
                    </td>
                  </tr>

                  <tr>
                    <td>Occupancy Rate</td>
                    <td>
                    <?php
                        // Initialize $occupancyRate and $occupancyStyle
                        $occupancyrate = 0;
                        $occupancyStyle = "";

                        // Prevent division by zero
                        if ($num2 > 0) {
                            $occupancyrate = number_format(($totalOccupancy / $num2), 2);

                            // Determine style based on occupancy rate
                            if ($occupancyrate >= 0 && $occupancyrate < 26) {
                                $occupancyStyle = "red";
                            } elseif ($occupancyrate > 25 && $occupancyrate < 51) {
                                $occupancyStyle = "yellow";
                            } elseif ($occupancyrate > 50 && $occupancyrate < 76) {
                                $occupancyStyle = "blue";
                            } elseif ($occupancyrate > 75 && $occupancyrate < 101) {
                                $occupancyStyle = "green";
                            }
                        } else {
                            // Handle the case when $num2 is zero or invalid
                            $occupancyrate = "N/A";
                            $occupancyStyle = "gray"; // Optional: a neutral style for invalid data
                        }
                    ?>
                      <div class="progress progress-xs progress-striped active">
                        <div class="progress-bar progress-bar-<?php echo $occupancyStyle; ?>" style="width: <?php echo $occupancyrate.'%'; ?>"></div>
                      </div>
                    </td>
                    <td>
                        <span class="badge bg-<?php echo $occupancyStyle; ?>"><?php echo $occupancyrate.'%'; ?></span>
                    </td>
                  </tr>

                  <tr>
                    <td>Male Visitors</td>
                    <td>
                    <?php
                        // Initialize $maleRate and $maleStyle
                        $malerate = 0;
                        $maleStyle = "";

                        // Prevent division by zero
                        if (($totalMale + $totalFemale) > 0) {
                            $malerate = number_format(($totalMale / ($totalMale + $totalFemale)) * 100, 2);

                            // Determine style based on male rate
                            if ($malerate >= 0 && $malerate < 26) {
                                $maleStyle = "red";
                            } elseif ($malerate > 25 && $malerate < 51) {
                                $maleStyle = "yellow";
                            } elseif ($malerate > 50 && $malerate < 76) {
                                $maleStyle = "blue";
                            } elseif ($malerate > 75 && $malerate < 101) {
                                $maleStyle = "green";
                            }
                        } else {
                            // Handle the case when the total is zero or invalid
                            $malerate = "N/A";
                            $maleStyle = "gray"; // Optional: a neutral style for invalid data
                        }
                    ?>
                      <div class="progress progress-xs progress-striped active">
                        <div class="progress-bar progress-bar-<?php echo $maleStyle; ?>" style="width: <?php echo $malerate.'%'; ?>"></div>
                      </div>
                    </td>
                    <td>
                        <span class="badge bg-<?php echo $maleStyle; ?>"><?php echo $totalMale; ?></span>
                    </td>
                  </tr>

                  <tr>
                    <td>Female Visitors</td>
                    <td>
                    <?php
                            // Female Rate
                            $femalerate = 0;
                            $femaleStyle = "";

                            if (($totalMale + $totalFemale) > 0) {
                                $femalerate = number_format(($totalFemale / ($totalMale + $totalFemale)) * 100, 2);

                                if ($femalerate >= 0 && $femalerate < 26) {
                                    $femaleStyle = "red";
                                } elseif ($femalerate > 25 && $femalerate < 51) {
                                    $femaleStyle = "yellow";
                                } elseif ($femalerate > 50 && $femalerate < 76) {
                                    $femaleStyle = "blue";
                                } elseif ($femalerate > 75 && $femalerate < 101) {
                                    $femaleStyle = "green";
                                }
                            } else {
                                $femalerate = "N/A";
                                $femaleStyle = "gray";
                            }
                      ?>
                      <div class="progress progress-xs progress-striped active">
                        <div class="progress-bar progress-bar-<?php echo $femaleStyle; ?>" style="width: <?php echo $femalerate.'%'; ?>"></div>
                      </div>
                    </td>
                    <td>
                        <span class="badge bg-<?php echo $femaleStyle; ?>"><?php echo $totalFemale; ?></span>
                    </td>
                  </tr>

                  <tr>
                    <td>Domestic Visitors</td>
                    <td>
                    <?php
                            // Local Rate
                            $localrate = 0;
                            $localStyle = "";

                            if (($totalLocal + $totalForeign) > 0) {
                                $localrate = number_format(($totalLocal / ($totalLocal + $totalForeign)) * 100, 2);

                                if ($localrate >= 0 && $localrate < 26) {
                                    $localStyle = "red";
                                } elseif ($localrate > 25 && $localrate < 51) {
                                    $localStyle = "yellow";
                                } elseif ($localrate > 50 && $localrate < 76) {
                                    $localStyle = "blue";
                                } elseif ($localrate > 75 && $localrate < 101) {
                                    $localStyle = "green";
                                }
                            } else {
                                $localrate = "N/A";
                                $localStyle = "gray";
                            }
                      ?>
                      <div class="progress progress-xs progress-striped active">
                        <div class="progress-bar progress-bar-<?php echo $localStyle; ?>" style="width: <?php echo $localrate.'%'; ?>"></div>
                      </div>
                    </td>
                    <td>
                        <span class="badge bg-<?php echo $localStyle; ?>"><?php echo $totalLocal; ?></span>
                    </td>
                  </tr>

                  <tr>
                    <td>Foreign Visitors</td>
                    <td>
                    <?php
                        // Foreign Rate
                        $foreignrate = 0;
                        $foreignStyle = "";

                        if (($totalLocal + $totalForeign) > 0) {
                            $foreignrate = number_format(($totalForeign / ($totalLocal + $totalForeign)) * 100, 2);

                            if ($foreignrate >= 0 && $foreignrate < 26) {
                                $foreignStyle = "red";
                            } elseif ($foreignrate > 25 && $foreignrate < 51) {
                                $foreignStyle = "yellow";
                            } elseif ($foreignrate > 50 && $foreignrate < 76) {
                                $foreignStyle = "blue";
                            } elseif ($foreignrate > 75 && $foreignrate < 101) {
                                $foreignStyle = "green";
                            }
                        } else {
                            $foreignrate = "N/A";
                            $foreignStyle = "gray";
                        }
                      ?>
                      <div class="progress progress-xs progress-striped active">
                        <div class="progress-bar progress-bar-<?php echo $foreignStyle; ?>" style="width: <?php echo $foreignrate.'%'; ?>"></div>
                      </div>
                    </td>
                    <td>
                        <span class="badge bg-<?php echo $foreignStyle; ?>"><?php echo $totalForeign; ?></span>
                    </td>
                  </tr>

                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include '../template/footer.php'; ?>