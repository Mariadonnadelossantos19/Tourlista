<?php
  $page = "ae_mice";
  include '../template/header.php';
  recordLog("Visited AE MICE");

  $error = 0;
  $sqlz = "select * from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id where approve_status = '1' and a.user_id = '".$_SESSION['id']."'";
  $resultz = mysqli_query($conn, $sqlz);
  while($rowz = mysqli_fetch_assoc($resultz)) {
    if($rowz['no_new_checkin']!=($rowz['local_tourist']+$rowz['foreign_tourist']+$rowz['overseas_filipino']) || $rowz['no_new_checkin']!=($rowz['no_male']+$rowz['no_female'])){
      $error++;
    }
  }
?>
<?php
            include '../../../connection/connection.php';
            $sql = "select ae_id, ae_name, no_rooms from accommodation_establishment where user_id='".$_SESSION['id']."'";
            $result = mysqli_query($conn, $sql);
            $no_rooms = 0;
            $disabled = "disabled";
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                  //  echo "Activity / Event at ".$row["ae_name"]." <input type='hidden' name='ae_id' value='".$row["ae_id"]."' />";
                    $no_rooms = $row["no_rooms"];
                    $disabled = "";
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
            <h1>Meetings, Incentives, Conventions, Exhibits/Events (MICE)</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Meetings, Incentives, Conventions, Exhibits/Events (MICE) </li>
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
            <form id="task_form" action="../crud/save_mice_ae.php" method="POST">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                <?php
                    include '../../../connection/connection.php';
                    $sql = "select ae_id, ae_name, no_rooms from accommodation_establishment where user_id='".$_SESSION['id']."'";
                    $result = mysqli_query($conn, $sql);
                    $no_rooms = 0;
                    $disabled = "disabled";
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "Activity / Event at ".$row["ae_name"]." <input type='hidden' name='ae_id' value='".$row["ae_id"]."' />";
                            $no_rooms = $row["no_rooms"];
                            $disabled = "";
                        }
                    }
                    ?>

                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <input type="hidden" id="mice_id" name="mice_id" />
                <div class="row">
                    <div class="col-2">
                        <div class="form-group">
                            <label>Date of Event</label>
                            <div class="input-group date">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                                <input type="date" name="mice_date" class="form-control" id="mice_date" placeholder="Select Date" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Title of Event</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar-check"></i></span>
                                </div>
                                <input type="text" name="event_name" id="event_name" class="form-control" placeholder="Please do not enter Wedding and Birthdays and Personal Gatherings" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label>Number of Days</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                                <input type="number" name="no_days" id="no_days" class="form-control" placeholder="Number of Days" min="0" max="10000" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label>Number of Hours</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-clock"></i></span>
                                </div>
                                <input type="number" name="no_hours" id="no_hours" class="form-control" placeholder="Duration of the event" min="0" max="10000" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Classification</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-folder-open"></i></span>
                                </div>
                                <select name="classification" id="classification" class="form-control" required>
                                    <option value="">Select Event Classification</option>
                                    <option value="International" title="Two or more continents">International</option>
                                    <option value="Regional Asia-Pacific" title="Two or more countries from the same continents">Regional Asia-Pacific</option>
                                    <option value="National Offshore" title="One country excluding the Philippines">National Offshore</option>
                                    <option value="Regional Philippines" title="Within the region of the Philippines">Regional Philippine</option>
                                    <option value="National" title="Two or more regions in the Philippines">National</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Type</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-tag"></i></span>
                                </div>
                                <select name="type" id="type" class="form-control" required>
                                    <option value="">Select Event Type</option>
                                    <option value="Association Meeting">Association Meeting</option>
                                    <option value="Corporate Meeting">Corporate Meeting</option>
                                    <option value="Incentive Travel">Incentive Travel</option>
                                    <option value="Convention/Conferences">Convention/Conferences</option>
                                    <option value="Trade Fair/Exhibition">Trade Fair/Exhibition</option>
                                    <option value="Seminar/Workshop/Symposium">Seminar/Workshop/Symposium</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>No. of Male Visitors</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-male"></i></span>
                                </div>
                                <input type="number" name="no_male" id="nm" class="form-control" placeholder="Enter no. of Male Visitor" min="0" max="10000" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>No. of Female Visitors</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-female"></i></span>
                                </div>
                                <input type="number" name="no_female" id="nf" class="form-control" placeholder="Enter no. of Female Visitors" min="0" max="10000" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Number of Local Visitor</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-bicycle"></i></span>
                                </div>
                                <input type="number" name="local_visitor" id="lv" class="form-control" placeholder="Enter no. of Local Visitors" min="0" max="10000" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Number of Foreign Visitor</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-plane"></i></span>
                                </div>
                                <input type="number" name="foreign_visitor" id="fv" class="form-control" placeholder="Enter no. of Foreign Visitors" min="0" max="10000" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" onclick="showCountries()">Add Details</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Foreign Tourist Details</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-info"></i></span>
                                </div>
                                <input type="text" name="foreign_details" id="foreign_details" class="form-control" placeholder="No Foreign Tourist per Country" value="{}" readonly required>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>With Exhibitions?</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-industry"></i></span>
                                </div>
                                <select class="form-control" name="with_exhibition" id="with_exhibition">
                            <option value="yes">YES</option>
                            <option value="no">NO</option>
                        </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Number of Exhibitors</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-address-card"></i></span>
                                </div>
                                <input type="number" name="num_exhibitors" id="num_exhibitors" class="form-control" placeholder="Enter no. of Exhibitors" value="0">
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Organizer</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-address-book"></i></span>
                                </div>
                                <input type="text" name="organizer" id="organizer" class="form-control" placeholder="Enter name of organizer">
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Contact Person</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" name="contact_person" id="contact_person" class="form-control" placeholder="Enter name of contact person">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Address</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
                                </div>
                                <input type="text" name="address" id="address" class="form-control" placeholder="Enter address of organizer">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Contact Details</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                </div>
                                <input type="text" name="contact_details" id="contact_details" class="form-control" placeholder="Enter contact details">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
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
            </div>

              <!-- /.card-body -->

            <div class="card-footer">
            <button type="submit" id="submit_button" class="btn btn-success float-right" <?php echo $disabled; ?>>Save Event</button>

            <a href="ae_mice.php"><button style="display: none;" type="button" id="cancel_button" class="btn btn-default float-left">Cancel</button></a>
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

        <!-- /.modal-dialog -->
      </div>

      <div class="modal" tabindex="-1" role="dialog" id="myModal" data-backdrop="static">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">MICE Details</h5>
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
                <td>Date of Event</th>
                <td id="a">-</td>
              </tr>
              <tr>
                <td>Title of Event</th>
                <td id="b">-</td>
              </tr>
              <tr>
                <td>Number of Days</th>
                <td id="c">-</td>
              </tr>
              <tr>
                <td>Number of Hours</th>
                <td id="d">-</td>
              </tr>
              <tr>
                <td>Classification</th>
                <td id="e">-</td>
              </tr>
              <tr>
                <td>Type</th>
                <td id="f">-</td>
              </tr>
              <tr>
                <td>No. of Male Visitor</th>
                <td id="g">-</td>
              </tr>
              <tr>
                <td>No. of Female Visitor</th>
                <td id="h">-</td>
              </tr>
              <tr>
                <td>Number of Local Visitor</th>
                <td id="i">-</td>
              </tr>
              <tr>
                <td>Number of Foreign Visitor</th>
                <td id="j">-</td>
              </tr>
              <tr>
                <td>Foreign Tourist Details</th>
                <td><small id="k">-</small></td>
              </tr>
              <tr>
                <td>With Exhibition?</th>
                <td><small id="q">-</small></td>
              </tr>
              <tr>
                <td>Number of Exhibitors</th>
                <td><small id="r">-</small></td>
              </tr>
              <tr>
                <td>Organizer</th>
                <td id="l">-</td>
              </tr>
              <tr>
                <td>Contact Person</th>
                <td id="m">-</td>
              </tr>
              <tr>
                <td>Address</th>
                <td id="n">-</td>
              </tr>
              <tr>
                <td>Contact Details</th>
                <td id="o">-</td>
              </tr>
              <tr>
                <td>Remarks / Additional Info</th>
                <td><small id="p">-</small></td>
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
                  Meetings, Incentives, Conventions, Exhibits/Events (MICE)
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table class="table table-striped" style="text-align: left;">
                  <tr >
                    <th>Date of Event</th>
                    <th>Event Name</th>
                    <th>Duration</th>
                    <th>Male / Female</th>
                    <th>Organizer</th>
                    <th>Action</th>
                  </tr>
                  <?php
                  include '../../../connection/connection.php';
                  $totalrooms = 0;
                  $num = 0;
                  $totalOccupancy = 0;
                  $totalMale = 0;
                  $totalFemale = 0;
                  $totalLocal = 0;
                  $totalForeign = 0;

                  $sql = "Select * from mice where user_id = '".$_SESSION['id']."' order by mice_date asc";
                  $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                              $num++;
                              $totalMale += $row['no_male'];
                              $totalFemale += $row['no_female'];
                              $totalLocal += $row['local_tourist'];
                              $totalForeign += $row['foreign_tourist'];

                              $date=date_create($row["mice_date"]);
                                    echo
                                    '<tr>
                                          <td>'.$row['mice_date'].'</td>
                                          <td>'.$row['event_name'].'</td>
                                          <td>'.$row['no_of_days'].' day(s) / '.$row['no_of_hours'].' hour(s)</td>
                                          <td>
                                            <span class="label label-primary">'.$row['no_male'].'</span>
                                            <span class="label label-danger">'.$row['no_female'].'</span>
                                          </td>
                                          <td>'.$row['organizer'].'</td>
                                          <td>
                                           <a title="View Remarks" onclick="getDetails('.$row["mice_id"].')"><button class="btn btn-info btn-xs"><i class="fa fa-eye"></i></button> </a>

                                          <a title="Edit" onclick="update('.$row["mice_id"].')"><button class="btn btn-success btn-xs"><i class="fa fa-edit"></i></button> </a>

                                          <a href="../crud/delete_mice_ae.php?id='.$row["mice_id"].'" title="Delete"> <button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button></a>
                                          </td>
                                    </tr>';
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
                    <td>Male Visitors</td>
                    <td>
                    <?php
                          // Calculate the total number of people
                          $totalPeople = $totalMale + $totalFemale;

                          // Check if the total number of people is zero to avoid division by zero error
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
                          // Calculate the total number of people
                          $totalPeople = $totalMale + $totalFemale;

                          // Check if the total number of people is zero to avoid division by zero error
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
                    <td>Local Toursit</td>
                    <td>
                    <?php
                        // Calculate the total number of people
                        $totalPeople = $totalLocal + $totalForeign;

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
                    <td>Foreign Tourist</td>
                    <td>
                    <?php
                      // Calculate the total number of people
                      $totalPeople = $totalLocal + $totalForeign;

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
var length = 0;
var tempfile = "";

function setMax(){
  var nm = $('#nm').val()*1;
  var nf = $('#nf').val()*1;
  var total = (nm+nf);
  $("#lv").attr({
       "max" : total,        // substitute your own
       "min" : 0          // values (or variables) here
  });
  $("#fv").attr({
       "max" : total,        // substitute your own
       "min" : 0          // values (or variables) here
  });
}

function setFV(){
  var nm = $('#nm').val()*1;
  var nf = $('#nf').val()*1;
  var lv = $('#lv').val()*1;
  var total = (nm+nf);
  $("#fv").val(total-lv);
}

function setLV(){
  var nm = $('#nm').val()*1;
  var nf = $('#nf').val()*1;
  var fv = $('#fv').val()*1;
  var total = (nm+nf);
  $("#lv").val(total-fv);
}

function getDetails(id){
      $.ajax({
      type: "GET",
      url: "../crud/load_mice_details.php",
      cache: false,
      data: {id},
      success: function(data){
        var result = $.parseJSON(data);
        $("#a").html(result.mice_date);
        $("#b").html(result.event_name);
        $("#c").html(result.no_of_days);
        $("#d").html(result.no_of_hours);
        $("#e").html(result.classification);
        $("#f").html(result.type);
        $("#g").html(result.no_male);
        $("#h").html(result.no_female);
        $("#i").html(result.local_tourist);
        $("#j").html(result.foreign_tourist);
        $("#k").html(result.foreign_details);
        $("#l").html(result.organizer);
        $("#m").html(result.contact_person);
        $("#n").html(result.address);
        $("#o").html(result.contact_details);
        $("#p").html(result.remarks);
        $("#q").html(result.with_exhibition);
        $("#r").html(result.num_exhibitors);
        
        $('#myModal').modal('show');
      }
    });
}

function update(id){
      $.ajax({
      type: "GET",
      url: "../crud/load_mice_details.php",
      cache: false,
      data: {id},
      success: function(data){
        var result = $.parseJSON(data);
        $("#mice_id").val(id);
        $('input[name="mice_date"]').val(result.mice_date);
        $("#event_name").val(result.event_name);
        $("#no_days").val(result.no_of_days);
        $("#no_hours").val(result.no_of_hours);
        $("#classification").val(result.classification);
        $("#type").val(result.type);
        $("#nm").val(result.no_male);
        $("#nf").val(result.no_female);
        $("#lv").val(result.local_tourist);
        $("#fv").val(result.foreign_tourist);
        $("#foreign_details").val(result.foreign_details);
        $("#with_exhibition").val(result.with_exhibition);
        $("#num_exhibitors").val(result.num_exhibitors);
        $("#organizer").val(result.organizer);
        $("#contact_person").val(result.contact_person);
        $("#address").val(result.address);
        $("#contact_details").val(result.contact_details);
        $("#remarks").val(result.remarks);
        $("#submit_button").html("Update MICE");
        $("#task_form").attr('action','../crud/update_mice.php');
        $("#cancel_button").css("display", "block");
        alert("You are about to load the MICE data. Please check the MICE form for the encoded information.");
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
  const ftInput = document.querySelector('#fv');
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

  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })

  $(document).ready(function() {
  $('#with_exhibition').change(function() {
    const selectedValue = $(this).val();
    if (selectedValue === 'no') {
      $('#num_exhibitors').prop('readonly', true).removeAttr('required').val('0'); // Disable, remove 'required', and clear
    }else if (selectedValue === 'yes') {
      $('#num_exhibitors').prop('readonly', false).attr('required', 'required'); // Enable and set 'required'
    }
  });

  // Trigger change event on page load to set the initial state
  $('#with_exhibition').trigger('change');
});

</script>