<?php
  $page = "training_masterlist";
  include 'template/header.php';
  include '../../connection/connection.php';

  if($_SESSION['id']=="") header("Location:../../../");
// SQL query
$sql = "SELECT * FROM trainings p
left join psi_fora_types t on p.training_type = t.fr_type_id
left join psi_sectors s on p.sectors = s.sector_id
WHERE training_id='".$_GET['id']."'";

// Execute query
$result = $conn->query($sql);

// Check if any results were returned
if ($result->num_rows > 0) {
    // Fetch each row and assign column values to individual variables
    while($row = $result->fetch_assoc()) {
        $training_id = $row["training_id"];
        $training_title = $row["training_title"];
        $training_type = $row["fr_type_name"];
        $training_desc = $row["training_desc"];
        $requesting_party = $row["requesting_party"];
        $service_provider = $row["service_provider"];
        $sectors = $row["sector_name"];
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
        
        $totalcount = $female_participants + $male_participants + $pwd_participants + $sr_participants + $firm_participants + $po_participants;

        // Now you have individual variables for each column of the fetched row
        // You can process these variables as needed
    }
} else {
    echo "0 results";
}
$start_date = date_create($start_date);
$end_date = date_create($end_date);
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
            <h1><?=$training_type?> Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?=$training_type?> Details</li>
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
          <h3 class="card-title"><?=$training_type?> Detail</h3>

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
                      <span class="info-box-text text-center text-muted">Type</span>
                      <span class="info-box-number text-center mb-0"><?= $training_type ?></span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-lime">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Project Cost</span>
                      <span class="info-box-number text-center mb-0"><?= "PhP ".number_format($training_cost,2) ?></span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-orange">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Project Duration</span>
                      <span class="info-box-number text-center mb-0"><?= date_format($start_date, "F d, Y")." to ".date_format($end_date, "F d, Y") ?></span>
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
                          <a style="color:blue;">Allan G. Acosta</a>
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
              <h5 class="text-primary"><b style="color: black;">Training Title: </b><br /><?= $training_title." " ?><small><span class="badge badge-danger"><?= $sectors ?></span></small.</h5>
              <hr />
              <p class="text-muted"><b style="color: black;">Description: </b><br /><?= $training_desc ?></p>
              <br>
              <div class="text-muted">
                  <b class="d-block">
                  <div id="container"></div>
                  </b>
               
                <p class="text-sm">Project Implementor
                  <b class="d-block">
                  <?php
                        if($implementor == "100"){
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
  include 'template/charts.php';
  include 'template/footer.php';
?>
 
 