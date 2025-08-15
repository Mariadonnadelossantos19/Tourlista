<?php
  $page = "manage_encoding";
  include '../template/header.php';
  recordLog("Visited Manage Encoding");
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage AE Encoding  </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage AE Encoding </li>
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
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List of AE Data with Mismatched Entries - Please Review and Correct</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                        <th>Establishment</th>
                        <th>Type</th>
                        <th>Year</th>
                        <th>Task Date</th>
                        <th>No New Checkin</th>
                        <th>Staying Overnight</th>
                        <th>Local Tourist</th>
                        <th>Foreign Tourist</th>
                        <th>Overseas Filipino</th>
                        <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                  <?php
                    $num = 1;
                    include '../../connection/connection.php';
                    $ae_approved = $ae_denied = $ae_pending = $ae_total = 0;

                    // Base query
                    $sql = "SELECT * FROM ae_daily_task a LEFT JOIN accommodation_establishment b ON a.ae_id = b.ae_id 
                    LEFT JOIN ts_users u ON b.user_id = u.user_id
                    WHERE region_c = '$region' and approve_status = '1'";

                    //Query per level
                    if($_SESSION['level']=='4'){
                        $sql = "SELECT * FROM ae_daily_task a LEFT JOIN accommodation_establishment b ON a.ae_id = b.ae_id
                        LEFT JOIN ts_users u ON b.user_id = u.user_id
                        WHERE region_c = '$region' and province_c = '$province' and approve_status = '1'";
                    }

                    if($_SESSION['level']=='3'){
                      $sql = "SELECT * FROM ae_daily_task a LEFT JOIN accommodation_establishment b ON a.ae_id = b.ae_id
                      LEFT JOIN ts_users u ON b.user_id = u.user_id
                      WHERE region_c = '$region' and province_c = '$province' and citymun_c = '$citymun' and approve_status = '1'";
                  }

                    // Execute query
                    $result = mysqli_query($conn, $sql);
                    if (!$result) {
                        die("Query Error: " . mysqli_error($conn));
                    }

                    // Output table rows
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $newCheckinMismatch = $row['no_new_checkin'] != ($row['local_tourist'] + $row['foreign_tourist'] + $row['overseas_filipino']);
                            $genderMismatch = $row['no_new_checkin'] != ($row['no_male'] + $row['no_female']);
                            
                            if ($newCheckinMismatch || $genderMismatch) {
                              
                                echo '
                                <tr>
                                    <td>' . strtoupper($row['ae_name']) . '</td>
                                    <td style="color: red;">' . strtoupper($row['type']) . '</td>
                                    <td>' . $row['year'] . '</td>
                                    <td>' . $row['task_date'] . '</td>
                                    <td>' . $row['no_new_checkin'] . '</td>
                                    <td>' . $row['no_stayed_overnight'] . '</td>
                                    <td>' . $row['local_tourist'] . '</td>
                                    <td>' . $row['foreign_tourist'] . '</td>
                                    <td>' . $row['overseas_filipino'] . '</td>
                                    <td><a title="View Details" onclick="getDetails(' . $row["ae_task_id"] . ')">
                                            <button class="btn btn-info btn-xs"><i class="fa fa-edit"></i></button>
                                        </a></td>
                                </tr>';
                            }
                        }
                    } else {
                        echo "<tr><td colspan='10'>No records found</td></tr>";
                    }
                    ?>


                  </tbody>
                  <tfoot>
                  <tr>
                        <th>Establishment</th>
                        <th>Type</th>
                        <th>Year</th>
                        <th>Task Date</th>
                        <th>No New Checkin</th>
                        <th>Staying Overnight</th>
                        <th>Local Tourist</th>
                        <th>Foreign Tourist</th>
                        <th>Overseas Filipino</th>
                        <th>Action</th>
                </tr>
                  </tfoot>
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

      <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form id="task_form" action="../crud/update_ae_encoding.php" method="POST">
        <!-- Modal Header -->
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="myModalLabel">Task Details</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body">
          <div class="table-responsive">
          <div id="visitors" class="alert alert-danger alert-dismissible fade show" style="display:none;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Visitors Count Mismatch!</strong> Please check if the no. of new checkin is equal to the total of visitors.
          </div>

          <div id="gender" class="alert alert-danger alert-dismissible fade show" style="display:none;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Gender Count Mismatch!</strong> Please check and update the number of male and female.
          </div>

            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th scope="col" style="width: 40%;">Description</th>
                  <th scope="col">Details</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Date Checked-in</td>
                  <td id="a">-</td>
                </tr>
                <tr>
                  <td>Number of Rooms Occupied</td>
                  <td id="b">-</td>
                </tr>
                <tr>
                  <td>Number of Visitors Stayed Overnight</td>
                  <td id="c">-</td>
                </tr>
                <tr>
                  <td>Number of New Guests Checked-in</td>
                  <td><input type="number" min="0" name="no_checkin" id="d" class="form-control" placeholder="Enter number" /></td>
                </tr>
                <tr>
                  <td>Number of Male Visitors</td>
                  <td><input type="number" min="0" name="male" id="e" class="form-control" placeholder="Enter number" /></td>
                </tr>
                <tr>
                  <td>Number of Female Visitors</td>
                  <td><input type="number" min="0" name="female" id="f" class="form-control" placeholder="Enter number" /></td>
                </tr>
                <tr>
                  <td>Number of Local Visitors</td>
                  <td><input type="number" min="0" name="local" id="g" class="form-control" placeholder="Enter number" /></td>
                </tr>
                <tr>
                  <td>Number of Foreign Visitors</td>
                  <td><input type="number" min="0" name="foreign" id="h" class="form-control" placeholder="Enter number" /></td>
                </tr>
                <tr>
                  <td>Number of Overseas Filipino</td>
                  <td><input type="number" min="0" name="overseas" id="i" class="form-control" placeholder="Enter number" /></td>
                </tr>
                <input type="hidden" name="task_id" id="task_id" />
              </tbody>
            </table>
          </div>
        </div>
        <!-- Modal Footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>


  </div>
  <!-- /.content-wrapper -->
  <script>
    function getDetails(id) {
            $.ajax({
                type: "GET",
                url: "../crud/load_details.php",
                cache: false,
                data: { id },
                success: function(data) {
                    var result = $.parseJSON(data);

                    $("#a").html(result.task_date);
                    $("#b").html(result.no_rooms_occupied);
                    $("#c").html(result.no_stayed_overnight);
                    $("#d").val(result.no_new_checkin);
                    $("#e").val(result.no_male);
                    $("#f").val(result.no_female);
                    $("#g").val(result.local_tourist);
                    $("#h").val(result.foreign_tourist);
                    $("#i").val(result.overseas_filipino);
                    $("#task_id").val(id);

                    // Gender mismatch logic
                    if (parseInt(result.no_new_checkin) !== (parseInt(result.no_male) + parseInt(result.no_female))) {
                        $("#gender").css("display", "block");
                    } else {
                        $("#gender").css("display", "none");
                    }

                    // Visitors mismatch logic
                    if (parseInt(result.no_new_checkin) !== (parseInt(result.local_tourist) + parseInt(result.foreign_tourist) + parseInt(result.overseas_filipino))) {
                        $("#visitors").css("display", "block");
                    } else {
                        $("#visitors").css("display", "none");
                    }

                    $('#myModal').modal('show');
                }
            });
        }
    </script>
<?php include '../template/footer.php'; ?>