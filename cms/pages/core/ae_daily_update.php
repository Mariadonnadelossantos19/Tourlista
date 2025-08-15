<?php
  $page = "ae_daily_task";
  include '../template/header.php';
  recordLog("Visited AE Task Update");

  $error = 0;
  $sqlz = "select * from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id where approve_status = '1' and a.user_id = '".$_SESSION['id']."'";
  $resultz = mysqli_query($conn, $sqlz);
  while($rowz = mysqli_fetch_assoc($resultz)) {
    if($rowz['no_new_checkin']!=($rowz['local_tourist']+$rowz['foreign_tourist']+$rowz['overseas_filipino']) || $rowz['no_new_checkin']!=($rowz['no_male']+$rowz['no_female'])){
      $error++;
    }
  }
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" <?php if($error>0){echo "onload='alerto()'";} ?>>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Daily Accommodation Monitoring <?= "[".$_GET["year"]."]"; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Daily Accommodation Monitoring <?= "[".$_GET["year"]."]"; ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <form id="task_form" action="../crud/save_ae_daily_update.php" method="POST">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                <?php
                include '../../../connection/connection.php';
                $sql = "select ae_id, ae_name, no_rooms, approve_status from accommodation_establishment where user_id='".$_SESSION['id']."'";
                $result = mysqli_query($conn, $sql);
                $no_rooms = 0;
                $disabled = "disabled";
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "Daily Task of ".$row["ae_name"]." <input type='hidden' name='ae_id' value='".$row["ae_id"]."' />";
                        $no_rooms = $row["no_rooms"];
                        if($row["approve_status"]=='1'){
                          $disabled = "";
                        }
                    }
                }
                ?>

                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Date</label>
                        <div class="input-group date">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                            <?php
                                $month = "";
                                if($_GET["month"]<10){
                                    $month = "0".$_GET['month'];
                                }else{
                                    $month = $_GET['month'];
                                }
                                $num_days=cal_days_in_month(CAL_GREGORIAN,$month,$_GET["year"]);
                            ?>
                            <input type="date" name="task_date"  min="<?= $_GET['year']."-".$month; ?>-01" max="<?= $_GET['year']."-".$month."-".$num_days; ?>"  class="form-control pull-right" placeholder="Select Date" title="Date visitors checked-in" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Number of Rooms Occupied</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-hotel"></i></span>
                            </div>
                            <input type="number" name="no_rooms_occupied" id="no_rooms_occupied" class="form-control" placeholder="Enter no. of rooms occupied" min="0" max="<?php echo $no_rooms; ?>" title="Number of rooms occupied by visitors" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Number of Visitors Staying Overnight</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-moon"></i></span>
                            </div>
                            <input type="number" name="no_stayed_overnight" id="no_stayed_overnight" class="form-control" placeholder="Enter no. of visitors staying overnight" min="0" max="1000" title="Number of visitors that will stay overnight" onkeyup="setMaxN()" onchange="setMaxN()" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Number of New Guest Checked-in</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-check-square"></i></span>
                            </div>
                            <input type="number" name="no_new_checkin" id="nnc" class="form-control" placeholder="Enter of new guest checked-in" min="0" max="1000" title="Number of guest checked-in" onkeyup="setMax()" onchange="setMax()" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Number of Male Visitors</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-male"></i></span>
                            </div>
                            <input type="number" name="no_male" id="nm" class="form-control" placeholder="Enter no. of Male Visitors" min="0" max="1000" title="Number of male tourist/visitors" onkeyup="getFM()" onchange="getFM()" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Number of Female Visitors</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-female"></i></span>
                            </div>
                            <input type="number" name="no_female" id="nf" class="form-control" placeholder="Enter no. of Female Visitors" min="0" max="1000" title="Number of female tourist/visitors" onkeyup="getM()" onchange="getM()" required>
                        </div>
                    </div>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Number of Philippine Residents</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-bicycle"></i></span>
                            </div>
                            <input type="number" name="local_tourist" id="lt" class="form-control" placeholder="Number of Philippine Residents" min="0" max="1000" title="Number of Philippine Residents" onkeyup="getFT()" onchange="getFT()" title="Number of Philippine Residents" onkeypress="checkContent()" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" onclick="showCityMun()">Add Details</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Philippine Residents Details</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-info"></i></span>
                            </div>
                            <input type="text" name="local_details" id="local_details" class="form-control" placeholder="Please click Add Details button to encode the originating province" readonly="true" onkeypress="return false;" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Number of Non-Philippine Residents</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-plane"></i></span>
                            </div>
                            <input type="number" name="foreign_tourist" id="ft" class="form-control" placeholder="Number of Non-Philippine Residents" min="0" max="1000" onkeyup="getLT()" onchange="getLT()" title="Number of Non-Philippine Residents" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" onclick="showCountries()">Add Details</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Non-Philippine Residents Details</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-info"></i></span>
                            </div>
                            <input type="text" name="foreign_details" id="foreign_details" class="form-control" placeholder="Please click Add Details button to encode the country of residents" readonly="true" onkeypress="return false;" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Number of Overseas Filipino</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-plane"></i></span>
                            </div>
                            <input type="number" name="overseas_filipino" id="of" class="form-control" placeholder="Number of Overseas Filipino" min="0" max="1000" title="Number of Overseas Filipino" nkeyup="getFT()" onchange="getFT()" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" onclick="showOverseas()">Add Details</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Overseas Filipino Details</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-info"></i></span>
                            </div>
                            <input type="text" name="overseas_details" id="overseas_details" class="form-control" placeholder="Please click Add Details button to encode the country of residents" readonly="true"  onkeypress="return false;" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Remarks</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-comment"></i></span>
                            </div>
                            <textarea name="remarks" id="remarks" class="form-control" placeholder="Add additional information / remarks"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="ae_task_id" id="ae_task_id" />
              </div>
              <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" id="submit_button" class="btn btn-success float-right" <?php echo $disabled; ?>>Save Task</button>

                <a href="ae_daily_task.php"><button style="display: none;" type="button" id="cancel_button" class="btn btn-default float-left">Cancel</button></a>
            </div>
            </form>
            </div>
            </div>
        </div>
      
        <div class="modal fade" tabindex="-1" role="dialog" id="modal-default" data-backdrop="static" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-top" role="document">
          <div class="modal-content shadow-lg rounded-lg">
            <div class="modal-header bg-primary text-white">
              <h5 class="modal-title">Non-Philippine Residents</h5>
              <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                      <thead class="bg-light">
                        <tr>
                          <th>Country</th>
                          <th>Number of Residents</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody id="countryTableBody">
                        <!-- Dynamic rows will be added here -->
                        <tr id="row-template" style="display: none;">
                          <td>
                            <select class="form-control country-dropdown" onchange="updateCountryOptions()" data-placeholder="Select a Country" style="width: 100%;">
                              <option value="">Select Country of Residents</option>
                              <?php
                              include '../../../connection/connection.php';
                              $sql = "SELECT country_id, country FROM country";
                              $result = mysqli_query($conn, $sql);
                              if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                  echo "<option value='" . $row["country"] . "'>" . $row["country"] . "</option>";
                                }
                              }
                              ?>
                            </select>
                          </td>
                          <td>
                            <input type="number" class="form-control resident-count" placeholder="Enter Number" min="1">
                          </td>
                          <td class="text-center">
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Remove</button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="text-right">
                    <button type="button" class="btn btn-success btn-sm" onclick="addRow()">Add Entry</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default float-left" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="saveData()">Save Data</button>
            </div>
          </div>
        </div>
      </div>


      <div class="modal fade" tabindex="-1" role="dialog" id="modal-default1" data-backdrop="static" aria-labelledby="modal-title" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-top" role="document">
          <div class="modal-content shadow-lg rounded-lg">
            <div class="modal-header bg-primary text-white">
              <h5 class="modal-title">Overseas Filipino</h5>
              <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                      <thead class="bg-light">
                        <tr>
                          <th>Country</th>
                          <th>Number of Residents</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody id="countryTableBody1">
                        <!-- Dynamic rows will be added here -->
                        <tr id="row-template1" style="display: none;">
                          <td>
                            <select class="form-control country-dropdown1" onchange="updateCountryOptions1()" data-placeholder="Select a Country" style="width: 100%;">
                              <option value="">Select Country of Residents</option>
                              <?php
                              include '../../../connection/connection.php';
                              $sql = "SELECT country_id, country FROM country";
                              $result = mysqli_query($conn, $sql);
                              if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                  echo "<option value='" . $row["country"] . "'>" . $row["country"] . "</option>";
                                }
                              }
                              ?>
                            </select>
                          </td>
                          <td>
                            <input type="number" class="form-control resident-count1" placeholder="Enter Number" min="1">
                          </td>
                          <td class="text-center">
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Remove</button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="text-right">
                    <button type="button" class="btn btn-success btn-sm" onclick="addRow1()">Add Entry</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default float-left" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="saveDataOF()">Save Data</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" tabindex="-1" role="dialog" id="modal-default2" data-backdrop="static" aria-labelledby="modal-title" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-top" role="document">
          <div class="modal-content shadow-lg rounded-lg">
            <div class="modal-header bg-primary text-white">
              <h5 class="modal-title">Philippine Residents</h5>
              <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                      <thead class="bg-light">
                        <tr>
                          <th>Province/City</th>
                          <th>Number of Residents</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody id="provinceTableBody">
                        <!-- Dynamic rows will be added here -->
                        <tr id="row-template2" style="display: none;">
                          <td>
                            <select class="form-control province-dropdown" onchange="updateProvinceOptions()" data-placeholder="Select Province" style="width: 100%;">
                              <option value="">Select Province/City of Residents</option>
                              <?php
                                  include '../../../connection/connection.php';
                                  $sql = "select province_m from province";
                                  $result = mysqli_query($conn, $sql);
                                  if (mysqli_num_rows($result) > 0) {
                                      while($row = mysqli_fetch_assoc($result)) {
                                          echo "<option value=".$row["province_m"].">".$row["province_m"]."</option>";
                                      }
                                  }
                                ?>
                            </select>
                          </td>
                          <td>
                            <input type="number" class="form-control resident-count2" placeholder="Enter Number" min="1">
                          </td>
                          <td class="text-center">
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Remove</button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="text-right">
                    <button type="button" class="btn btn-success btn-sm" onclick="addRow2()">Add Entry</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default float-left" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="saveDataCM()">Save Data</button>
            </div>
          </div>
        </div>

      </div>

        <!-- Modal -->
        <div class="modal" tabindex="-1" role="dialog" id="myModal" data-backdrop="static">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Task Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <div class="modal-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col" style="width: 250px;">DESCRIPTION</th>
                <th scope="col">DETAILS</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Date Checked-in</th>
                <td id="a">-</td>
              </tr>
              <tr>
                <td>Number of Rooms Occupied</th>
                <td id="b">-</td>
              </tr>
              <tr>
                <td>Number of Visitors Stayed Overnight</th>
                <td id="c">-</td>
              </tr>
              <tr>
                <td>Number of New Guest Checked-in</th>
                <td id="d">-</td>
              </tr>
              <tr>
                <td>Number of Male Visitors</th>
                <td id="e">-</td>
              </tr>
              <tr>
                <td>Number of Female Visitors</th>
                <td id="f">-</td>
              </tr>
              <tr>
                <td>Number of Domestic Visitors</th>
                <td id="g">-</td>
              </tr>
              <tr>
                <td>Number of Foreign Visitors</th>
                <td id="h">-</td>
              </tr>
              <tr>
                <td>Number of Overseas Filipino</th>
                <td id="h1">-</td>
              </tr>
              <tr>
                <td>Local Visitors Details</th>
                <td> <small id="h2">-</small></td>
              </tr>
              <tr>
                <td>Foreign Visitors Details</th>
                <td><small id="i">-</small></td>
              </tr>
              <tr>
                <td>Overseas Filipino Details</th>
                <td><small id="i1">-</small></td>
              </tr>
              <tr>
                <td>Remarks / Additional Info</th>
                <td><small id="j">-</small></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
      </div>

        <div class="row">
          <div class="col-8">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                <h3 class="box-title">
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
                  echo $month." 1 to ".$d.", ".$_GET['year'];
                  ?>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table class="table table-striped" style="text-align: left;">
                  <tr>
                    <th>Date</th>
                    <th>Rooms Occupied</th>
                    <th>Stayed Overnight</th>
                    <th>New C-I (M/F)</th>
                   <!-- <th colspan="2">Local vs Foreign</th> -->
                    <th style="text-align: center;">Occupancy Rate</th>
                    <th >Remarks</th>
                    <th style="text-align: center;">Action</th>
                  </tr>
                  <?php
                      include '../../../connection/connection.php';
                      $totalrooms = 0;

                      // Fetch the total number of rooms for the current user
                      $sql1 = "SELECT no_rooms FROM accommodation_establishment WHERE user_id = '".$_SESSION['id']."'";
                      $result1 = mysqli_query($conn, $sql1);
                      if (mysqli_num_rows($result1) > 0) {
                          while ($row1 = mysqli_fetch_assoc($result1)) {
                              $totalrooms = $row1["no_rooms"];
                          }
                      }

                      // Initialize counters and totals
                      $num = 0;
                      $totalOccupancy = 0;
                      $totalMale = 0;
                      $totalFemale = 0;
                      $totalLocal = 0;
                      $totalForeign = 0;
                      $totalOverseas = 0;

                      // Loop through days of the selected month
                      for ($x = 1; $x <= $d; $x++) {
                          // Fetch daily task data for the current user, month, and year
                          $sql = "SELECT ae_task_id, task_date, day, month, year, no_rooms_occupied, no_stayed_overnight, no_male, no_female, local_tourist, foreign_tourist, overseas_filipino, remarks 
                                  FROM ae_daily_task 
                                  WHERE user_id = '".$_SESSION['id']."' AND day = '".$x."' AND month = '".$_GET["month"]."' AND year = '".$_GET['year']."' 
                                  ORDER BY task_date ASC";
                          $result = mysqli_query($conn, $sql);

                          if (mysqli_num_rows($result) > 0) {
                              while ($row = mysqli_fetch_assoc($result)) {
                                  // Calculate the rate and occupancy with zero checks to prevent division errors
                                  $totalTourists = $row["local_tourist"] + $row["foreign_tourist"];
                                  $rate = $totalTourists > 0 ? ($row["local_tourist"] / $totalTourists) * 100 : 0;
                                  $occupancy = $totalrooms > 0 ? ($row["no_rooms_occupied"] / $totalrooms) * 100 : 0;

                                  // Increment counters
                                  $num++;
                                  $totalOccupancy += $row["no_rooms_occupied"];
                                  $totalMale += $row['no_male'];
                                  $totalFemale += $row['no_female'];
                                  $totalLocal += $row['local_tourist'];
                                  $totalForeign += $row['foreign_tourist'];
                                  $totalOverseas += $row['overseas_filipino'];

                                  // Determine color for rate and occupancy
                                  $ratecolor = "";
                                  $occupancycolor = "";

                                  if ($rate >= 0 && $rate < 26) {
                                      $ratecolor = "danger";
                                  } elseif ($rate > 25 && $rate < 51) {
                                      $ratecolor = "warning";
                                  } elseif ($rate > 50 && $rate < 76) {
                                      $ratecolor = "primary";
                                  } elseif ($rate > 75 && $rate < 101) {
                                      $ratecolor = "success";
                                  }

                                  if ($occupancy >= 0 && $occupancy < 26) {
                                      $occupancycolor = "red";
                                  } elseif ($occupancy > 25 && $occupancy < 51) {
                                      $occupancycolor = "orange";
                                  } elseif ($occupancy > 50 && $occupancy < 76) {
                                      $occupancycolor = "blue";
                                  } elseif ($occupancy > 75 && $occupancy < 101) {
                                      $occupancycolor = "green";
                                  }

                                  $date = date_create($row["task_date"]);

                                  // Output the table row
                                  echo '<tr>
                                      <td>'.$month." ".$x.'</td>
                                      <td style="text-align: center;">'.$row['no_rooms_occupied'].'</td>
                                      <td style="text-align: center;">'.$row['no_stayed_overnight'].'</td>
                                      <td style="text-align: center;">
                                          <span class="badge badge-primary">'.$row['no_male'].'</span>
                                          <span class="badge badge-danger">'.$row['no_female'].'</span>
                                      </td>
                                      <td style="text-align: center;"><span class="badge bg-'.$occupancycolor.'">'.number_format($occupancy).'%</span></td>
                                      <td>'.substr($row['remarks'], 0, 20).'...</td>
                                      <td>
                                          <a title="View Details" onclick="getDetails('.$row["ae_task_id"].')"><button class="btn btn-info btn-xs"><i class="fa fa-eye"></i></button></a>
                                          <a title="Edit" onclick="update('.$row["ae_task_id"].')"><button class="btn btn-success btn-xs"><i class="fa fa-edit"></i></button></a>';

                                  // Check for the next day's data
                                  $sql1 = "SELECT * FROM ae_daily_task WHERE user_id = '".$_SESSION['id']."' AND task_date LIKE '".date("Y-m")."%' AND day = '".($x+1)."'";
                                  $result1 = mysqli_query($conn, $sql1);
                                  if (mysqli_num_rows($result1) > 0) {
                                      echo '<button title="Unable to extend data" class="btn btn-primary btn-xs" disabled><i class="fa fa-retweet"></i></button>';
                                  } else {
                                      echo '<a title="Extend next day" onclick="extend('.$row["ae_task_id"].')"><button class="btn btn-warning btn-xs"><i class="fa fa-retweet"></i></button></a>';
                                  }

                                  echo '<button class="btn btn-danger btn-xs" onclick="deleteRecord('.$row["ae_task_id"].')"><i class="fa fa-trash"></i></button>
                                      </td>
                                  </tr>';
                              }
                          } else {
                              // Output message for no data
                              echo "<tr><td>".$month." ".$x."</td><td colspan='7'>No daily accommodation data encoded for this date</td></tr>";
                          }
                      }
                      ?>


                </table>
            </div>
              <!-- /.card-body -->
            </div>
          </div>
          <!-- /.col -->

          <div class="col-4">
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

                        // Get the number of days in the current month
                        $daysInMonth = date("t");

                        // Check if $daysInMonth is zero to avoid division by zero error
                        if ($daysInMonth != 0) {
                            // Calculate the encoding rate
                            $encodingrate = ($num / $daysInMonth) * 100;
                            $encoding = $num . " / " . $daysInMonth;
                            $encodingStyle = "";

                            // Ensure $encodingrate is treated as an integer for comparison
                            $encodingrate = (int) $encodingrate;

                            // Determine the encoding style based on the encoding rate
                            if ($encodingrate >= 0 && $encodingrate < 26) {
                                $encodingStyle = "red";
                            }
                            if ($encodingrate > 25 && $encodingrate < 51) {
                                $encodingStyle = "yellow";
                            }
                            if ($encodingrate > 50 && $encodingrate < 76) {
                                $encodingStyle = "blue";
                            }
                            if ($encodingrate > 75 && $encodingrate < 101) {
                                $encodingStyle = "green";
                            }
                        } else {
                            // Handle the case where the number of days in the month is zero
                            $encodingrate = 0;
                            $encoding = "0 / 0";
                            $encodingStyle = "unknown"; // or any default value you want
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
                        // Check if $num is zero to avoid division by zero error
                        if ($num != 0) {
                          $occupancyrate = (floatval($totalOccupancy) / (floatval($totalrooms) * floatval($num))) * 100;
                            $occupancyStyle = "";

                            // Ensure $occupancyrate is treated as an integer for comparison
                            $occupancyrates = (int) $occupancyrate;

                            if ($occupancyrates >= 0 && $occupancyrates < 26) {
                                $occupancyStyle = "red";
                            }
                            if ($occupancyrates > 25 && $occupancyrates < 51) {
                                $occupancyStyle = "yellow";
                            }
                            if ($occupancyrates > 50 && $occupancyrates < 76) {
                                $occupancyStyle = "blue";
                            }
                            if ($occupancyrates > 75 && $occupancyrates < 101) {
                                $occupancyStyle = "green";
                            }
                        } else {
                            // Handle the case where $num is zero
                            $occupancyrate = 0;
                            $occupancyStyle = "red"; // or any default value you want
                        }
                    ?>
                      <div class="progress progress-xs progress-striped active">
                        <div class="progress-bar progress-bar-<?php echo $occupancyStyle; ?>" style="width: <?php echo $occupancyrate.'%'; ?>"></div>
                      </div>
                    </td>
                    <td>
                        <span class="badge bg-<?php echo $occupancyStyle; ?>"><?php echo number_format($occupancyrate, 2).'%'; ?></span>
                    </td>
                  </tr>

                  <tr>
                    <td>Male Visitors</td>
                    <td>
                    <?php
                          // Check if the sum of $totalMale and $totalFemale is zero to avoid division by zero error
                          $totalPeople = $totalMale + $totalFemale;
                          
                          if ($totalPeople != 0) {
                              // Calculate the male rate
                              $malerate = ($totalMale / $totalPeople) * 100;
                              $maleStyle = "";

                              // Ensure $malerate is treated as an integer for comparison
                              $malerate = (int) $malerate;

                              // Determine the male style based on the male rate
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
                              // Handle the case where the total number of people is zero
                              $malerate = 0;
                              $maleStyle = "red"; // or any default value you want
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
                            // Check if the sum of $totalMale and $totalFemale is zero to avoid division by zero error
                            $totalPeople = $totalMale + $totalFemale;
                            
                            if ($totalPeople != 0) {
                                // Calculate the female rate
                                $femalerate = ($totalFemale / $totalPeople) * 100;
                                $femaleStyle = "";

                                // Ensure $femalerate is treated as an integer for comparison
                                $femalerate = (int) $femalerate;

                                // Determine the female style based on the female rate
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
                                // Handle the case where the total number of people is zero
                                $femalerate = 0;
                                $femaleStyle = "red"; // or any default value you want
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
                          // Calculate the total number of people
                          $totalPeople = $totalLocal + $totalForeign + $totalOverseas;

                          // Check if the total number of people is zero to avoid division by zero error
                          if ($totalPeople != 0) {
                              // Calculate the local rate
                              $localrate = ($totalLocal / $totalPeople) * 100;
                              $localStyle = "";

                              // Ensure $localrate is treated as an integer for comparison
                              $localrate = (int) $localrate;

                              // Determine the local style based on the local rate
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
                              // Handle the case where the total number of people is zero
                              $localrate = 0;
                              $localStyle = "red"; // or any default value you want
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
                            // Calculate the total number of people
                            $totalPeople = $totalLocal + $totalForeign + $totalOverseas;

                            // Check if the total number of people is zero to avoid division by zero error
                            if ($totalPeople != 0) {
                                // Calculate the foreign rate
                                $foreignrate = ($totalForeign / $totalPeople) * 100;
                                $foreignStyle = "";

                                // Ensure $foreignrate is treated as an integer for comparison
                                $foreignrate = (int) $foreignrate;

                                // Determine the foreign style based on the foreign rate
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
                                // Handle the case where the total number of people is zero
                                $foreignrate = 0;
                                $foreignStyle = "red"; // or any default value you want
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

                  <tr>
                    <td>Overseas Filipino Visitors</td>
                    <td>
                    <?php
                                // Calculate the total number of people
                                $totalPeople = $totalLocal + $totalForeign + $totalOverseas;

                                // Check if the total number of people is zero to avoid division by zero error
                                if ($totalPeople != 0) {
                                    // Calculate the overseas rate
                                    $overseasrate = ($totalOverseas / $totalPeople) * 100;
                                    $overseasStyle = "";

                                    // Ensure $overseasrate is treated as an integer for comparison
                                    $overseasrate = (int) $overseasrate;

                                    // Determine the overseas style based on the overseas rate
                                    if ($overseasrate >= 0 && $overseasrate < 26) {
                                        $overseasStyle = "red";
                                    } elseif ($overseasrate > 25 && $overseasrate < 51) {
                                        $overseasStyle = "yellow";
                                    } elseif ($overseasrate > 50 && $overseasrate < 76) {
                                        $overseasStyle = "blue";
                                    } elseif ($overseasrate > 75 && $overseasrate < 101) {
                                        $overseasStyle = "green";
                                    }
                                } else {
                                    // Handle the case where the total number of people is zero
                                    $overseasrate = 0;
                                    $overseasStyle = "red"; // or any default value you want
                                }
                            ?>
                      <div class="progress progress-xs progress-striped active">
                        <div class="progress-bar progress-bar-<?php echo $overseasStyle; ?>" style="width: <?php echo $overseasrate.'%'; ?>"></div>
                      </div>
                    </td>
                    <td>
                        <span class="badge bg-<?php echo $overseasStyle; ?>"><?php echo $totalOverseas; ?></span>
                    </td>
                  </tr>

                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>

        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include '../template/footer.php'; ?>

<script>
var countries = [];
var overseas = [];
var citymun = [];
var length = 0;
var lengthCM = 0;
var tempfile = "";
var tempfileCM = "";
var tempfileOF = "";

function alerto(){
    Swal.fire({
    icon: 'error',
    title: 'Encoding Error!',
    text: 'You have an incorrect data encoded, please click the link below to view the incorrect entries.',
    footer: '<a href="manage_encoding.php">View List of Incorrect Entries</a>'
  })
}
function deleteRecord(id){
  var r = confirm("You are about to delete this record. Click OK to continue.");
  if (r == true) {
    window.location.href = "../crud/delete_ae_task.php?m=<?=$_GET['month'];?>&y=<?=$_GET['year'];?>&id="+id;
  }
}
function setMaxN(){
  var totalN = $('#nnc').val()*1;
  $("#no_stayed_overnight").attr({
       "min" : totalN          // values (or variables) here
  });

}

function setMax(){
  var total = $('#nnc').val()*1;
  $("#nm").attr({
       "max" : total,        // substitute your own
       "min" : 0          // values (or variables) here
  });

  $("#nf").attr({
       "max" : total,        // substitute your own
       "min" : 0          // values (or variables) here
  });

  $("#lt").attr({
       "max" : total,        // substitute your own
       "min" : 0          // values (or variables) here
  });

  $("#ft").attr({
       "max" : total,        // substitute your own
       "min" : 0          // values (or variables) here
  });
} 

function getFM(){
  var male = $('#nm').val()*1;
  var total = $('#nnc').val()*1;
  var female = (total-male);
  $('#nf').val(female);
  $("#nf").attr({
       "max" : female,        // substitute your own
       "min" : 0          // values (or variables) here
  });
}

function getM(){
  var female = $('#fm').val()*1;
  var total = $('#nnc').val()*1;
  var male = (total-female);
  $('#nm').val(male);
  $("#nm").attr({
       "max" : male,        // substitute your own
       "min" : 0          // values (or variables) here
  });
}

function getFT(){
  var lt = $('#lt').val()*1;
  var total = $('#nnc').val()*1;
  var ft = (total-lt);
  $('#of').val("0");
  $('#ft').val(ft);
    $("#ft").attr({
       "max" : ft,        // substitute your own
       "min" : 0          // values (or variables) here
  });

  if(lt>0){
      $("#local_details").prop("readonly", false);
  }
  if(ft>0){
    $("#foreign_details").prop("readonly", false);
  }
  if(lt<=0){
      $("#local_details").prop("readonly", true);
  }
  if(ft<=0){
    $("#foreign_details").prop("readonly", true);
  }
}

function getLT(){
  var ft = $('#ft').val()*1;
  var lt = $('#lt').val()*1;
  var total = $('#nnc').val()*1;
  var ofw = (total-(lt+ft));
  $('#of').val(ofw);
      $("#of").attr({
       "max" : of,        // substitute your own
       "min" : 0          // values (or variables) here
  });

  if(lt>0){
      $("#local_details").prop("readonly", false);
  }
  if(ft>0){
    $("#foreign_details").prop("readonly", false);
  }
  if(ofw>0){
    $("#overseas_details").prop("readonly", false);
  }
  if(lt<=0){
      $("#local_details").prop("readonly", true);
  }
  if(ft<=0){
    $("#foreign_details").prop("readonly", true);
  }
  if(ofw<=0){
    $("#overseas_details").prop("readonly", true);
  }
  
}

function getDetails(id){
      $.ajax({
      type: "GET",
      url: "../crud/load_details.php",
      cache: false,
      data: {id},
      success: function(data){
        var result = $.parseJSON(data);
        $("#a").html(result.task_date);
        $("#b").html(result.no_rooms_occupied);
        $("#c").html(result.no_stayed_overnight);
        $("#d").html(result.no_new_checkin);
        $("#e").html(result.no_male);
        $("#f").html(result.no_female);
        $("#g").html(result.local_tourist);
        $("#h").html(result.foreign_tourist);
        $("#h1").html(result.overseas_filipino);
        $("#h2").html(result.local_details);
        $("#i").html(result.foreign_details);
        $("#i1").html(result.overseas_details);
        $("#j").html(result.remarks);
        
        $('#myModal').modal('show');
      }
    });
}

function update(id){
      $.ajax({
      type: "GET",
      url: "../crud/load_ae_task.php",
      cache: false,
      data: {id},
      success: function(data){
        var result = $.parseJSON(data);
        $('input[name="task_date"]').val(result.task_date);
        $("#no_rooms_occupied").val(result.no_rooms_occupied);
        $("#no_stayed_overnight").val(result.no_stayed_overnight);
        $("#nnc").val(result.no_new_checkin);
        $("#nm").val(result.no_male);
        $("#nf").val(result.no_female);
        $("#lt").val(result.local_tourist);
        $("#ft").val(result.foreign_tourist);
        $("#of").val(result.overseas_filipino);
        $("#foreign_details").val(result.foreign_details);
        $("#local_details").val(result.local_details);
        $("#overseas_details").val(result.overseas_details);
        $("#remarks").val(result.remarks);
        $("#ae_task_id").val(result.ae_task_id);
        $("#submit_button").html("Update Task");
        $("#task_form").attr('action','../crud/update_ae_task.php');
        $("#cancel_button").css("display", "block");
        alert("You are about to load the selected task data. Please check the daily task form for the encoded information.");
      }
    });
}

function extend(id){
      $.ajax({
      type: "GET",
      url: "../crud/load_ae_task_extend.php",
      cache: false,
      data: {id},
      success: function(data){
        var result = $.parseJSON(data);
        $('input[name="task_date"]').val(result.task_date);
        $("#no_rooms_occupied").val(result.no_rooms_occupied);
        $("#no_stayed_overnight").val(result.no_stayed_overnight);
        $("#nnc").val(0);
        $("#nm").val(0);
        $("#nf").val(0);
        $("#lt").val(0);
        $("#ft").val(0);
        $("#foreign_details").val("");
        $("#remarks").val(result.remarks);
        $("#ae_task_id").val(result.ae_task_id);
        $("#submit_button").html("Extend Data");
        $("#task_form").attr('action','../crud/save_ae_daily_update.php');
        $("#cancel_button").css("display", "block");
        alert("You are about to extend the selected task data. Please check the daily task form for the encoded information.");
      }
    });
}


//FUNCTIONS FOR THE NON-PHILIPPINE RESIDENTS

function showCountries() {
  const foreignDetailsInput = document.querySelector('#foreign_details');
  const countryTableBody = document.querySelector('#countryTableBody');

  // Clear existing rows except the template row
  countryTableBody.querySelectorAll('tr:not(#row-template)').forEach(row => row.remove());

  // Parse the existing data in #foreign_details
  if (foreignDetailsInput && foreignDetailsInput.value) {
    try {
      const jsonData = JSON.parse(foreignDetailsInput.value);

      Object.entries(jsonData).forEach(([country, residents]) => {
        addRowWithData(country, residents);
      });
    } catch (error) {
      console.error('Error parsing foreign_details JSON:', error);
    }
  }

  // Show the modal
  $('#modal-default').modal('show');
}

function addRowWithData(country, residents) {
  const template = document.querySelector('#row-template');
  const clone = template.cloneNode(true);
  clone.style.display = '';
  clone.removeAttribute('id');

  const countryDropdown = clone.querySelector('.country-dropdown');
  const residentCountInput = clone.querySelector('.resident-count');

  // Set country and residents data
  if (countryDropdown && residentCountInput) {
    countryDropdown.value = country;
    residentCountInput.value = residents;

    // Ensure the selected country remains enabled
    updateCountryOptions();
  }

  document.querySelector('#countryTableBody').appendChild(clone);
}

function saveData() {
  const rows = document.querySelectorAll('#countryTableBody tr:not(#row-template)');
  let jsonData = {};
  let totalResidents = 0;

  rows.forEach((row) => {
    const countryDropdown = row.querySelector('.country-dropdown');
    const residentCountInput = row.querySelector('.resident-count');

    if (countryDropdown && residentCountInput) { // Ensure elements exist
      const country = countryDropdown.value;
      const residents = parseInt(residentCountInput.value) || 0;

      if (country && residents > 0) {
        jsonData[country] = residents;
        totalResidents += residents;
      }
    }
  });

  // Convert jsonData object to JSON string
  const jsonString = JSON.stringify(jsonData);
  console.log(jsonData);

  // Get the value from #ft and compare
  const ftInput = document.querySelector('#ft');
  const inputVal = ftInput ? parseInt(ftInput.value) || 0 : 0;

  if (inputVal === totalResidents) {
    // Set the JSON string to the #foreign_details input if totals match
    const foreignDetailsInput = document.querySelector('#foreign_details');
    if (foreignDetailsInput) {
      foreignDetailsInput.value = jsonString;
    } else {
      console.error('Error: #foreign_details input element not found.');
    }

    // Close the modal
    $('#modal-default').modal('hide');
  } else {
    // Show a warning if the totals do not match
    alert('Warning: The total input value does not match the total Non-Philippine Residents.');
  }
}


function getSumOfValues(jsonObj) {
  let sum = 0;
  for (const key in jsonObj) {
  if (jsonObj.hasOwnProperty(key)) {
      sum += parseInt(jsonObj[key]); // Convert the value to an integer
  }
  }
  return sum;
}

function addRow() {
    const tableBody = document.getElementById('countryTableBody');
    const template = document.getElementById('row-template');
    const newRow = template.cloneNode(true);
    newRow.style.display = ''; // Make row visible
    newRow.removeAttribute('id'); // Remove template ID
    tableBody.appendChild(newRow);
  }

function removeRow(button) {
    const row = button.closest('tr');
    row.remove();
}

function updateCountryOptions() {
  const selectedCountries = Array.from(document.querySelectorAll('.country-dropdown'))
    .map(dropdown => dropdown.value)
    .filter(value => value !== ''); // Get all selected countries

  document.querySelectorAll('.country-dropdown').forEach(dropdown => {
    const currentSelection = dropdown.value; // Preserve current selection
    Array.from(dropdown.options).forEach(option => {
      option.disabled = selectedCountries.includes(option.value) && option.value !== currentSelection;
    });
  });
}

//FUNCTIONS FOR THE OVERSEAS FILIPINO

function showOverseas() {
  const overseasDetailsInput = document.querySelector('#overseas_details');
  const countryTableBody = document.querySelector('#countryTableBody1');

  // Clear existing rows except the template row
  countryTableBody.querySelectorAll('tr:not(#row-template1)').forEach(row => row.remove());

  // Parse the existing data in #foreign_details
  if (overseasDetailsInput && overseasDetailsInput.value) {
    try {
      const jsonData = JSON.parse(overseasDetailsInput.value);

      Object.entries(jsonData).forEach(([country, residents]) => {
        addRowWithData1(country, residents);
      });
    } catch (error) {
      console.error('Error parsing overseas_details JSON:', error);
    }
  }

  // Show the modal
  $('#modal-default1').modal('show');
}

function addRowWithData1(country, residents) {
  const template = document.querySelector('#row-template1');
  const clone = template.cloneNode(true);
  clone.style.display = '';
  clone.removeAttribute('id');

  const countryDropdown = clone.querySelector('.country-dropdown1');
  const residentCountInput = clone.querySelector('.resident-count1');

  // Set country and residents data
  if (countryDropdown && residentCountInput) {
    countryDropdown.value = country;
    residentCountInput.value = residents;

    // Ensure the selected country remains enabled
    updateCountryOptions1();
  }

  document.querySelector('#countryTableBody1').appendChild(clone);
}

function saveDataOF() {
  const rows = document.querySelectorAll('#countryTableBody1 tr:not(#row-template1)');
  let jsonData = {};
  let totalResidents = 0;

  rows.forEach((row) => {
    const countryDropdown = row.querySelector('.country-dropdown1');
    const residentCountInput = row.querySelector('.resident-count1');

    if (countryDropdown && residentCountInput) { // Ensure elements exist
      const country = countryDropdown.value;
      const residents = parseInt(residentCountInput.value) || 0;

      if (country && residents > 0) {
        jsonData[country] = residents;
        totalResidents += residents;
      }
    }
  });

  // Convert jsonData object to JSON string
  const jsonString = JSON.stringify(jsonData);
  console.log(jsonData);

  // Get the value from #ft and compare
  const ofInput = document.querySelector('#of');
  const inputVal = ofInput ? parseInt(ofInput.value) || 0 : 0;

  if (inputVal === totalResidents) {
    // Set the JSON string to the #overseas_details input if totals match
    const overseasDetailsInput = document.querySelector('#overseas_details');
    if (overseasDetailsInput) {
      overseasDetailsInput.value = jsonString;
    } else {
      console.error('Error: #overseas_details input element not found.');
    }

    // Close the modal
    $('#modal-default1').modal('hide');
  } else {
    // Show a warning if the totals do not match
    alert('Warning: The total input value does not match the total Overseas Filipino.');
  }
}

function addRow1() {
    const tableBody = document.getElementById('countryTableBody1');
    const template = document.getElementById('row-template1');
    const newRow = template.cloneNode(true);
    newRow.style.display = ''; // Make row visible
    newRow.removeAttribute('id'); // Remove template ID
    tableBody.appendChild(newRow);
  }

function updateCountryOptions1() {
  const selectedCountries = Array.from(document.querySelectorAll('.country-dropdown1'))
    .map(dropdown => dropdown.value)
    .filter(value => value !== ''); // Get all selected countries

  document.querySelectorAll('.country-dropdown1').forEach(dropdown => {
    const currentSelection = dropdown.value; // Preserve current selection
    Array.from(dropdown.options).forEach(option => {
      option.disabled = selectedCountries.includes(option.value) && option.value !== currentSelection;
    });
  });
}

//FUNCTIONS FOR THE PHILIPPINE RESIDENTS

function showCityMun() {
  const localDetailsInput = document.querySelector('#local_details');
  const provinceTableBody = document.querySelector('#provinceTableBody');

  // Clear existing rows except the template row
  provinceTableBody.querySelectorAll('tr:not(#row-template2)').forEach(row => row.remove());

  // Parse the existing data in #foreign_details
  if (localDetailsInput && localDetailsInput.value) {
    try {
      const jsonData = JSON.parse(localDetailsInput.value);

      Object.entries(jsonData).forEach(([province, residents]) => {
        addRowWithData2(province, residents);
      });
    } catch (error) {
      console.error('Error parsing local_details JSON:', error);
    }
  }

  // Show the modal
  $('#modal-default2').modal('show');
}

function addRowWithData2(province, residents) {
  const template = document.querySelector('#row-template2');
  const clone = template.cloneNode(true);
  clone.style.display = '';
  clone.removeAttribute('id');

  const provinceDropdown = clone.querySelector('.province-dropdown');
  const residentCountInput = clone.querySelector('.resident-count2');

  // Set country and residents data
  if (provinceDropdown && residentCountInput) {
    provinceDropdown.value = province;
    residentCountInput.value = residents;

    // Ensure the selected country remains enabled
    updateProvinceOptions();
  }

  document.querySelector('#provinceTableBody').appendChild(clone);
}

function saveDataCM() {
  const rows = document.querySelectorAll('#provinceTableBody tr:not(#row-template2)');
  let jsonData = {};
  let totalResidents = 0;

  rows.forEach((row) => {
    const provinceDropdown = row.querySelector('.province-dropdown');
    const residentCountInput = row.querySelector('.resident-count2');

    if (provinceDropdown && residentCountInput) { // Ensure elements exist
      const province = provinceDropdown.value;
      const residents = parseInt(residentCountInput.value) || 0;

      if (province && residents > 0) {
        jsonData[province] = residents;
        totalResidents += residents;
      }
    }
  });

  // Convert jsonData object to JSON string
  const jsonString = JSON.stringify(jsonData);
  console.log(jsonData);

  // Get the value from #ft and compare
  const ofInput = document.querySelector('#lt');
  const inputVal = ofInput ? parseInt(ofInput.value) || 0 : 0;

  if (inputVal === totalResidents) {
    // Set the JSON string to the #overseas_details input if totals match
    const localDetailsInput = document.querySelector('#local_details');
    if (localDetailsInput) {
      localDetailsInput.value = jsonString;
    } else {
      console.error('Error: #local_details input element not found.');
    }

    // Close the modal
    $('#modal-default2').modal('hide');
  } else {
    // Show a warning if the totals do not match
    alert('Warning: The total input value does not match the total Philippine Residents.');
  }
}

function addRow2() {
    const tableBody = document.getElementById('provinceTableBody');
    const template = document.getElementById('row-template2');
    const newRow = template.cloneNode(true);
    newRow.style.display = ''; // Make row visible
    newRow.removeAttribute('id'); // Remove template ID
    tableBody.appendChild(newRow);
  }

function updateProvinceOptions() {
  const selectedProvinces = Array.from(document.querySelectorAll('.province-dropdown'))
    .map(dropdown => dropdown.value)
    .filter(value => value !== ''); // Get all selected countries

  document.querySelectorAll('.province-dropdown').forEach(dropdown => {
    const currentSelection = dropdown.value; // Preserve current selection
    Array.from(dropdown.options).forEach(option => {
      option.disabled = selectedProvinces.includes(option.value) && option.value !== currentSelection;
    });
  });
}

$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
})

</script>