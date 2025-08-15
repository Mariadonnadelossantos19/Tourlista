<?php
  $page = "ta_daily_task";
  include '../template/header.php';
  recordLog("Visited TA Daily Task");

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
            <h1>Daily Tourist Attraction Monitoring </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Daily Tourist Attraction Monitoring</li>
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
            <form action="../crud/save_daily_task_ta.php" method="POST">
                
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                <?php
                    include '../../../connection/connection.php';
                    $sql = "select ta_id, ta_name, approve_status from tourist_attraction where user_id='".$_SESSION['id']."'";
                    $result = mysqli_query($conn, $sql);
                    $no_rooms = 0;
                    $disabled = "disabled";
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "Daily Task of ".$row["ta_name"]." <input type='hidden' name='ta_id' value='".$row["ta_id"]."' />";
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
                <div class="col-md-3">
                    <div class="form-group">
                    <label for="task_date">Date</label>
                    <div class="input-group date">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                        <input type="date" id="task_date" name="task_date" min="<?= date('Y-m-01'); ?>" max="<?= date('Y-m-t'); ?>" class="form-control pull-right" placeholder="Select Date" title="Date visitors checked-in" required>
                    </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                    <label for="r_male">Visitors from this Municipality (MALE)</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-male"></i></span>
                        </div>
                        <input type="number" id="r_male" name="r_male" class="form-control" placeholder="Enter no. of male visitors from this municipality" min="0" max="10000" onkeyup="calc()" required>
                    </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                    <label for="r_female">Visitors from this Municipality (FEMALE)</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-female"></i></span>
                        </div>
                        <input type="number" id="r_female" name="r_female" class="form-control" placeholder="Enter no. of female visitors from this municipality" min="0" max="10000" onkeyup="calc()" required>
                    </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                    <label>Total Visitors from the Municipality</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-users"></i></span>
                        </div>
                        <input type="number" id="r_total" class="form-control" placeholder="Total visitor from the municipality" readonly>
                    </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                    <label for="nr_male">Visitors from other Municipality (MALE)</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-male"></i></span>
                        </div>
                        <input type="number" id="nr_male" name="nr_male" class="form-control" placeholder="Enter no. of male visitors from other municipality" min="0" max="10000" required>
                    </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                    <label for="nr_female">Visitors from other Municipality (FEMALE)</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-female"></i></span>
                        </div>
                        <input type="number" id="nr_female" name="nr_female" class="form-control" placeholder="Enter no. of female visitors from other municipality" min="0" max="10000" required>
                    </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="cm_details">Other Municipality Details</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary" type="button" onclick="showCityMun()">Add Details</button>
                        </div>
                        <input type="text" id="cm_details" name="nr_details" class="form-control" placeholder="Details of visitors from other municipality" readonly>
                    </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                    <label for="fo_male">Foreign Visitors (MALE)</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-male"></i></span>
                        </div>
                        <input type="number" id="fo_male" name="fo_male" class="form-control" placeholder="Enter no. of Male Foreign Visitors" min="0" max="10000" required>
                    </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                    <label for="fo_female">Foreign Visitors (FEMALE)</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-female"></i></span>
                        </div>
                        <input type="number" id="fo_female" name="fo_female" class="form-control" placeholder="Enter no. of Female Foreign Visitors" min="0" max="10000" required>
                    </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="foreign_details">Foreign Visitors Details</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary" type="button" onclick="showCountries()">Add Details</button>
                        </div>
                        <input type="text" id="foreign_details" name="fo_details" class="form-control" placeholder="Details of visitors from other country" readonly>
                    </div>
                    </div>
                </div>
                </div>

              </div>
              <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-success float-right" <?php echo $disabled; ?>>Save Task</button>
            </div>
            </form>
            </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="modal-default" data-backdrop="static" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-top" role="document">
          <div class="modal-content shadow-lg rounded-lg">
            <div class="modal-header bg-primary text-white">
              <h5 class="modal-title">Foreign Visitors</h5>
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
                                $sql = "select citymun_c, citymun_m, province_m from province p left join citymun c on p.province_c = c.province_c";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value=".$row["citymun_m"].">".$row["citymun_m"].", ".$row["province_m"]."</option>";
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

      <div class="row">
          <div class="col-8">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                <h3 class="box-title">
                  <?php
                    date_default_timezone_set('Asia/Manila');
                    echo date("F")." 1 to ".date("t").", ".date("Y");
                  ?>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table class="table table-bordered table-hover" style="text-align: left;">
                  <tr>
                    <th rowspan='2' style="text-align: center;">Date</th>
                    <th colspan='2' style="text-align: center;">Within the LGU</th>
                    <th colspan='2' style="text-align: center;">From other LGU</th>
                    <th colspan='2' style="text-align: center;">Foreign Visitors</th>
                    <th colspan='3' style="text-align: center;">Total Visitors</th>
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
                  $num = 0;
                  $total = 0;
                  $totalR= 0;
                  $totalNR= 0;
                  $totalFO = 0;
                  $totalMale = 0;
                  $totalFemale = 0;
                  $totalVisit = 0;

                  for($x=1; $x<=date("t"); $x++){

                  $sql = "select * from ta_daily_task where user_id = '".$_SESSION['id']."' and task_date like '".date("Y-m")."%' and day = '".$x."' order by task_date asc";
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

                              $date=date_create($row["task_date"]);
                                    echo
                                    '<tr style="text-align: center;">
                                          <td style="text-align: left;">'.date("F")." ".$x.'</td>
                                          <td>'.$row['r_male'].'</td>
                                          <td>'.$row['r_female'].'</td>
                                          <td>'.$row['nr_male'].'</td>
                                          <td>'.$row['nr_female'].'</td>
                                          <td>'.$row['fo_male'].'</td>
                                          <td>'.$row['fo_female'].'</td>
                                          <td>'.$totalM.'</td>
                                          <td>'.$totalF.'</td>
                                          <td><b>'.$total.'</b></td>
                                          <td>
                                          <a href="../crud/delete_ta_task.php?id='.$row["ta_task_id"].'" title="Delete"> <button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button> </a>
                                          </td>
                                    </tr>';
                                }
                              }
                            else{
                              echo "<tr><td>".date("F")." ".$x."</td><td colspan='10'>No tourist attraction data encoded for this date</td></tr>";
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
                    <td>Average Daily Visitors</td>
                    <td>
                    <?php
                        // Check if $num is not zero to avoid DivisionByZeroError
                        if ($num != 0) {
                            // Calculate visit average
                            $visitAverage = number_format($totalVisit / $num);
                        } else {
                            // Handle the case where $num is zero
                            $visitAverage = 0; // Default value or any alternative handling
                        }

                        // Initialize visit rate and style
                        $visitrate = $visitAverage; // Assuming you want to set a fixed visit rate of 50
                        $visitStyle = "";

                        // Determine the visit style based on the visit rate
                        if ($visitrate >= 0 && $visitrate < 26) {
                            $visitStyle = "red";
                        } elseif ($visitrate >= 26 && $visitrate < 51) {
                            $visitStyle = "yellow";
                        } elseif ($visitrate >= 51 && $visitrate < 76) {
                            $visitStyle = "blue";
                        } elseif ($visitrate >= 76 && $visitrate <= 100) {
                            $visitStyle = "green";
                        }
                        ?>

                      <div class="progress progress-xs progress-striped active">
                        <div class="progress-bar progress-bar-<?php echo $visitStyle; ?>" style="width: <?php echo $visitrate.'%'; ?>"></div>
                      </div>
                    </td>
                    <td>
                        <span class="badge bg-<?php echo $visitStyle; ?>"><?php echo $visitAverage; ?></span>
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

function calc(){
  var male = $('#r_male').val()*1;
  var female = $('#r_female').val()*1;
  total = (male+female);
  $('#r_total').val(total);
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
  const maleValue = parseInt(document.querySelector('#fo_male').value) || 0;
  const femaleValue = parseInt(document.querySelector('#fo_female').value) || 0;

  const ftInput = maleValue + femaleValue; // Sum of male and female values
  const inputVal = ftInput; // Directly use the calculated sum


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

//FUNCTIONS FOR THE PHILIPPINE RESIDENTS

function showCityMun() {
  const localDetailsInput = document.querySelector('#cm_details');
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
const maleValue = parseInt(document.querySelector('#nr_male').value) || 0;
const femaleValue = parseInt(document.querySelector('#nr_female').value) || 0;

const ftInput = maleValue + femaleValue; // Sum of male and female values
const inputVal = ftInput; // Directly use the calculated sum


  if (inputVal === totalResidents) {
    // Set the JSON string to the #overseas_details input if totals match
    const localDetailsInput = document.querySelector('#cm_details');
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