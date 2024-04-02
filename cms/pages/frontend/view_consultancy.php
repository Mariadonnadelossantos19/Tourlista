<?php
$page = "consultancy_masterlist";
include 'template/header.php';

include '../../connection/connection.php';

// SQL query to select all records from the projects table

if($_SESSION['id']=="") header("Location:../../../");

$sql = "SELECT * FROM consultancies c
left join psi_consultancy_types ct on c.consultancy_type = ct.con_type_id
left join projects p on c.project_id = p.project_id
left join psi_cooperators coop on c.cooperator_id = coop.coop_id
left join psi_service_providers sp on c.service_provider_id = sp.sp_id
left join psi_implementors im on c.implementor_id = im.implementor_id
WHERE consultancy_id='".$_GET['id']."'";

// Execute the query
$result = $conn->query($sql);

// Check if any records are returned
if ($result->num_rows > 0) {
    // Fetch each row and store its data into separate variables
    while ($row = $result->fetch_assoc()) {
        $consultancy_id = $row['consultancy_id'];
        $project_title = $row['project_title'];
        $cooperator_id = $row['cooperator_id'];
        $service_provider_id = $row['service_provider_id'];
        $consultancy_type = $row['con_type_name'];
        $consultancy_start_time = $row['consultancy_start'];
        $consultancy_end_time = $row['consultancy_end'];
        $implementor_name = $row['implementor_name'];
        $no_participants = $row['no_participants'];
        $no_firms = $row['no_firms'];
        $no_po = $row['no_po'];
        $consultancy_cost = $row['consultancy_cost'];
        $remarks = $row['remarks'];
        $street = $row['street'];
        $province = $row['province'];
        $city_mun = $row['city_mun'];
        $barangay =$row['barangay'];
        $project_code = $row['project_code'];
        $project_desc = $row['project_desc'];
        $coop_name = $row['coop_name'];
        $sp_name = $row['sp_name'];

    }
} else {
    echo "0 results";
}
$duration_from = date_create($consultancy_start_time);
$duration_to = date_create($consultancy_end_time);
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
            <h1>Consultancy Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Consultancy Details</li>
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
          <h3 class="card-title">Consultancy Detail</h3>

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
                        <span class="info-box-text text-center text-muted">Consultancy Type</span>
                        <span class="info-box-number text-center mb-0"><?= $consultancy_type ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-4">
                    <div class="info-box bg-lime">
                      <div class="info-box-content">
                        <span class="info-box-text text-center text-muted">Consultancy Cost</span>
                        <span class="info-box-number text-center mb-0"><?= "PhP ".number_format($consultancy_cost,2) ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-4">
                    <div class="info-box bg-orange">
                      <div class="info-box-content">
                        <span class="info-box-text text-center text-muted">Consultancy Duration</span>
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
              <h5 class="text-primary"><b style="color: black;">Program Title: </b><br /><?= $project_title." " ?><small><span class="badge badge-danger"><?= $project_code ?></span></small.</h5>
              <hr />
              <p class="text-muted"><b style="color: black;">Description: </b><br /><?= $project_desc ?></p>
              <div class="row">
              <p class="text-muted"><b style="color: black;">Cooperator</b><br /><?=$coop_name?><br /><br /><b style="color: black;">Implementor</b><br /><?=$implementor_name?></p>
              <span style="display:inline-block; border-left:1px solid #ccc; margin:0 10px; height:125px;"></span>
              <p class="text-muted"><b style="color: black;">Service Provider</b><br /><?=$sp_name?></p>
                </div>
              <br>
              
              <div class="text-muted">
                <p class="text-sm">
                  <b class="d-block">
                  <div id="con_participants_pie"></div>
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
 