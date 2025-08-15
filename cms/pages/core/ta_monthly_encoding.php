<?php
  $page = "ta_monthly_encoding";
  include '../template/header.php';
  recordLog("Visited TA Monthly Encoding");
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>TA Data Encoding</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">TA Data Encoding</li>
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
                <h3>Filter Options</h3>
            </div>
            <div class="card-body">
              <form class="form-row" action="../crud/sync_ta_data.php" method="GET">
            <!-- Province Select -->
            <div class="form-group col-md-3">
                <label for="province">Province:</label>
                <select name="province" id="province" class="form-control" 
                    <?php if($access_level<5){ echo 'onmousedown="return false;"'; } ?> 
                    onchange="showCityMun(<?= $region ?>, this.value)" required>
                    <option value="">Select Province</option>
                    <?php
                        include '../../connection/connection.php';
                        $sql = "SELECT province_c, province_m FROM province WHERE region_c = '".$region."' ORDER BY province_m ASC";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="'.$row["province_c"].'"';
                                if ($row["province_c"] == $province) { echo " selected"; }
                                echo '>'.$row["province_m"].'</option>';
                            }
                        }
                    ?>
                </select>
            </div>

            <!-- City/Municipality Select -->
            <div class="form-group col-md-3">
                <label for="citymunData">City/Mun:</label>
                <select name="citymun" id="citymunData" class="form-control" 
                    <?php if($access_level<4){ echo 'onmousedown="return false;"'; } ?> 
                    onchange="showAttractions(this.value)" required>
                    <option value="">Select City/Municipality</option>
                    <?php
                        $sql = "SELECT citymun_c, citymun_m FROM citymun WHERE province_c = '".$province."' ORDER BY citymun_m ASC";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="'.$row["citymun_c"].'"';
                                if ($row["citymun_c"] == $citymun) { echo " selected"; }
                                echo '>'.$row["citymun_m"].'</option>';
                            }
                        }
                    ?>
                </select>
            </div>

            <!-- Attraction Select -->
            <div class="form-group col-md-4">
                <label for="attractionData">Attraction:</label>
                <select name="ta_user" id="attractionData" class="form-control" required>
                    <option value="">Select an Attraction</option>
                    <?php
                        $sql = "SELECT u.user_id,ta_id, ta_name FROM ts_users u
                                LEFT JOIN tourist_attraction a ON u.user_id = a.user_id
                                WHERE a.approve_status = '1' AND u.province_c = '".$province."' AND u.citymun_c = '".$citymun."'";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="'.$row["user_id"].'">'.$row["ta_name"].'</option>';
                            }
                        }
                    ?>
                </select>
            </div>

            <!-- Year Select -->
            <div class="form-group col-md-2">
                <label for="year">Year:</label>
                <select name="year" id="year" class="form-control">
                    <option value="2025" <?php if($_GET['year']=="2025"){ echo "selected"; } ?>>2025</option>
                    <option value="2024" <?php if($_GET['year']=="2024"){ echo "selected"; } ?>>2024</option>
                    <option value="2023" <?php if($_GET['year']=="2023"){ echo "selected"; } ?>>2023</option>
                    <option value="2022" <?php if($_GET['year']=="2022"){ echo "selected"; } ?>>2022</option>
                    <option value="2021" <?php if($_GET['year']=="2021"){ echo "selected"; } ?>>2021</option>
                    <option value="2020" <?php if($_GET['year']=="2020"){ echo "selected"; } ?>>2020</option>
                </select>
            </div>

            <!-- Reload Button -->
            <div class="form-group col-12 text-center mt-3">
                <button type="submit" class="btn btn-success">Sync Attraction Data</button>
            </div>
        </form>
        <hr />
                <h4 class="box-title">
                  <?php
                  error_reporting(E_ERROR | E_PARSE);
                  date_default_timezone_set('Asia/Manila');
                  include '../../../connection/connection.php';
                  $ta_name = "- No Selected Attraction Yet -";
                  $sql1 = "select ta_name from tourist_attraction where user_id = '".$_SESSION['ta_user']."'";
                  $result1 = mysqli_query($conn, $sql1);
                  if (mysqli_num_rows($result1) > 0) {
                      while($row1 = mysqli_fetch_assoc($result1)) {
                        $ta_name = $row1["ta_name"];
                      }
                  }
                  if($_GET["year"]==""){
                    echo "Synced Data from: ".$ta_name;
                    echo  "<br /><small>For Calendar Year - ".date("Y")."</small>";
                  }else{
                    echo "Synced Data from: ".$ta_name;
                    echo  "<br /><small>For Calendar Year - ".$_GET['year']."</small>";
                  }
                  
                  ?>
                  
                </h4>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table class="table table-bordered table-hover"  style="text-align: center;">
                  <tr>
                    <th rowspan='2' style="text-align: center;">Month</th>
                    <th colspan='2' style="text-align: center;">Within the LGU</th>
                    <th colspan='2' style="text-align: center;">From other LGU</th>
                    <th colspan='2' style="text-align: center;">Foreign Visitor</th>
                    <th colspan='3' style="text-align: center;">Total Visitor</th>
                    <th rowspan='2' style="text-align: center;">Action</th>
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
                  include '../../../connection/connection.php';
                  $totalrooms = 0;
                  $sql1 = "select no_rooms from accommodation_establishment where user_id = '".$_SESSION['ta_user']."'";
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

                  $sql = "Select month, year, count(*) as num, sum(r_male), sum(r_female), sum(nr_male), sum(nr_female), sum(fo_male),sum(fo_female) from ta_daily_task
                          where user_id = '".$_SESSION['ta_user']."' and month='".$x."' and year = '".date("Y")."' group by month order by month asc";
                  $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                          //    $ave_gn = number_format(($row["sum(no_stayed_overnight)"]/($row["sum(no_male)"]+$row["sum(no_female)"]))*100);
                            //  $ave_oc = number_format(($row["sum(no_rooms_occupied)"]/($totalrooms*$row['num']))*100);
                            //  $total_guest = $row["sum(no_male)"]+$row["sum(no_female)"];

                              $num2++;
                              $num+=$row['num'];
                            //  $totalOccupancy += $ave_oc;
                              $totalMale += $row['sum(r_male)']+$row['sum(nr_male)']+$row['sum(fo_male)'];
                              $totalFemale += $row['sum(r_female)']+$row['sum(nr_female)']+$row['sum(fo_female)'];
                            //  $totalLocal += $row['sum(local_tourist)'];
                            //  $totalForeign += $row['sum(foreign_tourist)'];

                            //  $gn_color = "";
                          //    $oc_color = "";

                      /*        if($ave_gn>=0 && $ave_gn<26){
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
                              } */

                              echo
                                    '<tr>
                                          <td style="text-align: left;">'.$month.'</td>
                                          <td style="text-align: center;"><span class="label label-primary">'.$row["sum(r_male)"].'</span></td>
                                          <td style="text-align: center;"><span class="label label-danger">'.$row["sum(r_female)"].'</span></td>
                                          <td style="text-align: center;"><span class="label label-primary">'.$row["sum(nr_male)"].'</span></td>
                                          <td style="text-align: center;"><span class="label label-danger">'.$row["sum(nr_female)"].'</span></td>
                                          <td style="text-align: center;"><span class="label label-primary">'.$row["sum(fo_male)"].'</span></td>
                                          <td style="text-align: center;"><span class="label label-danger">'.$row["sum(fo_female)"].'</span></td>
                                          <td style="text-align: center;"><span class="label label-primary">'.($row["sum(fo_male)"]+$row["sum(nr_male)"]+$row["sum(r_male)"]).'</span></td>
                                          <td style="text-align: center;"><span class="label label-danger">'.($row["sum(fo_female)"]+$row["sum(nr_female)"]+$row["sum(r_female)"]).'</span></td>
                                          <td style="text-align: center;"><span class="label label-success">'.(($row["sum(fo_female)"]+$row["sum(nr_female)"]+$row["sum(r_female)"])+($row["sum(fo_male)"]+$row["sum(nr_male)"]+$row["sum(r_male)"])).'</span></td>
                                          <td>
                                          <a href="ta_daily_encoding.php?month='.$row["month"].'" title="Update"> <button class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></button></a>
                                          </td>
                                    </tr>';
                                }
                              }
                            else{
                              echo "<tr style='text-align: left;'><td>".$month."</td><td colspan='9'>No data encoded for this month</td>
                              <td style='text-align: center;'>";
                              if($x<=date("m")){
                               echo "<a href='ta_daily_encoding.php?month=".$x."' title='Add Data'> <button class='btn btn-success btn-xs'><i class='fa fa-plus'></i></button> </a>";
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
                    <td>Male Visitors</td>
                    <td>
                      <?php
                            // Check if $totalMale + $totalFemale is zero before performing division
                            if (($totalMale + $totalFemale) > 0) {
                                $malerate = number_format(($totalMale / ($totalMale + $totalFemale)) * 100);
                                $maleStyle = "";
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
                                $malerate = 0; // Default value when denominator is zero
                                $maleStyle = "gray"; // Default style for undefined rate
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
                            // Check if $totalMale + $totalFemale is zero before performing division
                            if (($totalMale + $totalFemale) > 0) {
                                $femalerate = number_format(($totalFemale / ($totalMale + $totalFemale)) * 100);
                                $femaleStyle = "";
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
                                $femalerate = 0; // Default value when denominator is zero
                                $femaleStyle = "gray"; // Default style for undefined rate
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
                    <td>Average Daily Visitors</td>
                    <td>
                      <?php
                            // Check if $num is zero before performing division
                            if ($num > 0) {
                                $dailyrate = number_format(($totalMale + $totalFemale) / $num);
                            } else {
                                $dailyrate = 0; // Default value when denominator is zero
                            }
                      ?>
                      <div class="progress progress-xs progress-striped active">
                        <div class="progress-bar progress-bar-yellow" style="width: <?php echo '50%'; ?>"></div>
                      </div>
                    </td>
                    <td>
                        <span class="badge bg-yellow"><?php echo $dailyrate; ?></span>
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
  <script>
    function showCityMun(region_c, province_c){
        if(region_c < 10){
            region_c = '0'+region_c;
        }
        $.ajax({
          type: "GET",
          url: "../crud/loadCityMun.php",
          cache: false,
          data: {region_c, province_c},
          success: function(data){
            $("#citymunData").html(data);
          }
        });
    }

    function showAttractions(citymun_c){
        var province_c = document.getElementById("province").value;
        $.ajax({
          type: "GET",
          url: "../crud/loadTAs.php",
          cache: false,
          data: {province_c, citymun_c},
          success: function(data){
            $("#attractionData").html(data);
          }
        });
    }


</script>
<?php include '../template/footer.php'; ?>