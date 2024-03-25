<?php
  $page = "training_masterlist";
  include 'template/header.php';
  include '../../connection/connection.php';

// SQL query
$sql = "SELECT * FROM trainings";

// Execute query
$result = $conn->query($sql);

// Check if any results were returned
if ($result->num_rows > 0) {
    // Fetch each row and assign column values to individual variables
    while($row = $result->fetch_assoc()) {
        $training_id = $row["training_id"];
        $training_title = $row["training_title"];
        $training_type = $row["training_type"];
        $requesting_party = $row["requesting_party"];
        $service_provider = $row["service_provider"];
        $sectors = $row["sectors"];
        $start_date = $row["start_date"];
        $end_date = $row["end_date"];
        $training_cost = $row["training_cost"];
        $overall_csf = $row["overall_csf"];
        $implementor = $row["implementor"];
        $remarks = $row["remarks"];
        $female_participants = $row["female_participants"];
        $male_participants = $row["male_participants"];
        $pwd_participants = $row["pwd_participants"];
        $sr_participants = $row["sr_participants"];
        $firm_participants = $row["firm_participants"];
        $po_participants = $row["po_participants"];
        $street = $row["street"];
        $province = $row["province"];
        $city_mun = $row["city_mun"];
        $barangay = $row["barangay"];
        $user_id = $row["user_id"];
        $date_encoded = $row["date_encoded"];
        $date_updated = $row["date_updated"];

        // Now you have individual variables for each column of the fetched row
        // You can process these variables as needed
    }
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Project Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Project Details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Projects Detail</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-md-12 col-lg-7 order-2 order-md-1">
              <div class="row">
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-yellow">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Project Type</span>
                      <span class="info-box-number text-center mb-0"><?= $project_type ?></span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-lime">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Project Cost</span>
                      <span class="info-box-number text-center mb-0"><?= "PhP ".number_format($project_cost,2) ?></span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-orange">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Project Duration</span>
                      <span class="info-box-number text-center mb-0"><?= date_format($duration_from, "F d, Y")." to ".date_format($duration_to, "F d, Y") ?></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <h4>Recent Activity</h4>
                    <div class="post">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                        <span class="username">
                          <a href="#">Allan G. Acosta</a>
                        </span>
                        <span class="description">March 21, 2024 at 7:42 AM</span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                        Uploaded project proposal
                      </p>

                      <p>
                        <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Project Proposal v2</a>
                      </p>
                    </div>

                    <div class="post clearfix">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg" alt="User Image">
                        <span class="username">
                          <a href="#">Sarah Ross</a>
                        </span>
                        <span class="description">March 1, 2024 at 8:422 AM</span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                        Change the uploaded Memorandum of Agreement
                      </p>
                      <p>
                        <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Memorandum of Agreement</a>
                      </p>
                    </div>

                    <div class="post">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                        <span class="username">
                          <a href="#">Jonathan Burke Jr.</a>
                        </span>
                        <span class="description">February 6, 2024 at 12:16 PM</span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                        Encoded the project profile
                      </p>

                    </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-12 col-lg-5 order-1 order-md-2">
              <h5 class="text-primary"><b style="color: black;">Project Title: </b><br /><?= $project_title." " ?><small><span class="badge badge-danger"><?= $project_code ?></span></small.</h5>
              <hr />
              <p class="text-muted"><b style="color: black;">Description: </b><br /><?= $project_desc ?></p>
              <br>
              <div class="text-muted">
                <p class="text-sm">Status
                  <b class="d-block">
                    <?php
                        if($status == "New"){
                            echo '<span class="badge badge-primary">New</span>';
                        }
                        if($status == "On-going"){
                          echo '<span class="badge badge-warning">On-going</span>';
                        }
                        if($status == "Graduated"){
                          echo '<span class="badge badge-success">Graduated</span>';
                        }
                        if($status == "Deferred"){
                          echo '<span class="badge badge-secondary">Deferred</span>';
                        }
                        if($status == "Termindated"){
                          echo '<span class="badge badge-danger">Terminated</span>';
                        }
                        if($status == "Withdrawn"){
                          echo '<span class="badge badge-info">Withdrawn</span>';
                        }
                    ?>
                  </b>
                </p>
                <p class="text-sm">Project Implementor
                  <b class="d-block">
                  <?php
                        if($implementor == "0"){
                            echo 'Regional Office';
                        }
                        if($implementor == "51"){
                          echo 'PSTO-Occidental Mindoro';
                        }
                        if($implementor == "52"){
                          echo 'PSTO-Oriental Mindoro';
                        }
                        if($implementor == "40"){
                          echo 'PSTO-Marinduque';
                        }
                        if($implementor == "59"){
                          echo 'PSTO-Romblon';
                        }
                        if($implementor == "53"){
                          echo 'PSTO-Palawan';
                        }
                    ?>
                  </b>
                </p>
              </div>

              <h5 class="mt-5 text-muted">Project Documentation</h5>

              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>File</th>
                    <th>Download</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Project Proposal</td>
                    <td><a href="#"><span class="badge badge-success">Download</span></a></td>
                  </tr>
                  <tr>
                    <td>Memorandum of Agreement</td>
                    <td><a href="#"><span class="badge badge-success">Download</span></a></td>
                  </tr>
                  <tr>
                    <td>PIS Form</td>
                    <td><a href="#"><span class="badge badge-success">Download</span></a></td>
                  </tr>
                  <tr>
                    <td>Progress Report</td>
                    <td><small>No Uploaded File</small.</td>
                  </tr>
                </tbody>
              </table>

              <div class="text-center mt-5 mb-3">
                <a href="#" class="btn btn-sm btn-primary">Upload Project File</a>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php
  include 'template/footer.php';
?>
 