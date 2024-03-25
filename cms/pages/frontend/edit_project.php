<?php
$page = "project_masterlist";
include 'template/header.php';
include '../../connection/connection.php';

// SQL query to select all records from the projects table
$sql = "SELECT * FROM projects";

// Execute the query
$result = $conn->query($sql);

// Check if any records are returned
if ($result->num_rows > 0) {
    // Fetch each row and store its data into separate variables
    while ($row = $result->fetch_assoc()) {
        $project_id = $row['project_id'];
        $project_code = $row['project_code'];
        $project_type = $row['project_type'];
        $year_approved = $row['year_approved'];
        $project_title = $row['project_title'];
        $project_desc = $row['project_desc'];
        $duration_from = $row['duration_from'];
        $duration_to = $row['duration_to'];
        $beneficiaries = $row['beneficiaries'];
        $collaborating_agencies = $row['collaborating_agencies'];
        $implementor = $row['implementor'];
        $date_released = $row['date_released'];
        $sector = $row['sector'];
        $status = $row['status'];
        $street = $row['street'];
        $province = $row['province'];
        $city_mun = $row['city_mun'];
        $barangay = $row['barangay'];
        $project_cost = $row['project_cost'];
        $beneficiary_counterpart = $row['beneficiary_counterpart'];
        $other_project_cost = $row['other_project_cost'];
        $counterpart_desc = $row['counterpart_desc'];
        $user_id = $row['user_id'];
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
            <h1>Edit Project</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Project</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <form action="../backend/update_project.php" method="get">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Project Profile</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            <!--  <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button> -->
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Project Code</label>
                  <input class="form-control" name="project_code" type="text" placeholder="Enter Project Code" style="width: 100%;" value="<?= $project_code ?>" required>
                </div>  
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-4">
                <div class="form-group">
                  <label>Project Type *</label>
                  <select class="form-control select2" name="project_type" data-placeholder="Select Project Type" style="width: 100%;" required>
                  <option value="">Select Project Type</option>
                  <?php
                      include '../../connection/connection.php';
                      $sql = "SELECT * FROM psi_project_types";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                          while($row = $result->fetch_assoc()) {
                              echo '<option value="'.$row["prj_type_id"].'"'; if($project_type==$row['prj_type_id']){ echo 'selected'; } echo '>'.$row["prj_type_name"].'</option>';
                          }
                      } 
                      $conn->close();
                    ?>
                  </select>
                </div>
                <!-- /.form-group -->
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Year Approved *</label>
                  <input class="form-control" name="year_approved" type="number" min="2008" max="<?= date("Y"); ?>" value="<?= $year_approved ?>" style="width: 100%;" required>
                </div>
                <!-- /.form-group -->
                </div>
              <!-- /.col -->
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Project Title</label>
                  <input class="form-control" name="project_title" type="text" placeholder="Enter Project Title" value="<?= $project_title ?>" style="width: 100%;" required>
                </div>  
                <!-- /.form-group -->
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Project Description</label>
                  <textarea class="form-control" name="project_desc" type="text" placeholder="Enter Project Description" style="width: 100%;"><?= $project_desc ?></textarea>
                </div>  
                <!-- /.form-group -->
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Project Duration From *</label>
                  <input class="form-control" name="duration_from" type="date" value="<?= $duration_from ?>" style="width: 100%;" required>
                </div>  
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label>Project Duration To *</label>
                  <input class="form-control" name="duration_to" type="date" value="<?= $duration_to ?>" style="width: 100%;" required>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Beneficiaries</label>
                  <select class="select2" name="beneficiaries" multiple="multiple" data-placeholder="Select Beneficiaries" style="width: 100%;">
                  <?php
                      include '../../connection/connection.php';
                      $sql = "SELECT * FROM psi_cooperators";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                          while($row = $result->fetch_assoc()) {
                              echo '<option value="'.$row["coop_id"].'"'; if($beneficiaries==$row['coop_id']){ echo 'selected'; } echo '>'.$row["coop_name"].'</option>';
                          }
                      } 
                      $conn->close();
                    ?>
                  </select>
                </div>  
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-4">
                <div class="form-group">
                  <label>Collaborating Agencies</label>
                  <select class="select2" name="collaborating_agencies" multiple="multiple" data-placeholder="Select Collaborating Agencies" style="width: 100%;">
                  <?php
                      include '../../connection/connection.php';
                      $sql = "SELECT * FROM psi_collaborators";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                          while($row = $result->fetch_assoc()) {
                              echo '<option value="'.$row["col_id"].'"'; if($collaborating_agencies==$row['col_id']){ echo 'selected'; }  echo '>'.$row["col_name"].'</option>';
                          }
                      } 
                      $conn->close();
                    ?>
                  </select>
                </div>
                <!-- /.form-group -->
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Implementor</label>
                  <select class="form-control select2" name="implementor" data-placeholder="Select Implementor" style="width: 100%;" required>
                  <option value="">Select Implementor</option>
                  <?php
                      include '../../connection/connection.php';
                      $sql = "SELECT * FROM psi_implementors";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                          while($row = $result->fetch_assoc()) {
                              echo '<option value="'.$row["implementor_id"].'"'; if($implementor==$row['implementor_id']){ echo 'selected'; } echo '>'.$row["implementor_name"].'</option>';
                          }
                      } 
                      $conn->close();
                    ?>
                  </select></div>
                <!-- /.form-group -->
                </div>
              <!-- /.col -->
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Date Funds Released</label>
                  <input class="form-control" name="date_released" type="date" value="<?= $date_released ?>" style="width: 100%;" required>
                </div>  
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-4">
                <div class="form-group">
                  <label>Sector</label>
                  <select class="form-control select2" name="sector" data-placeholder="Select Sector" style="width: 100%;" required>
                  <?php
                      include '../../connection/connection.php';
                      $sql = "SELECT * FROM psi_sectors";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                          while($row = $result->fetch_assoc()) {
                              echo '<option value="'.$row["sector_id"].'"'; if($sector==$row['sector_id']){ echo 'selected'; } echo '>'.$row["sector_name"].'</option>';
                          }
                      } 
                      $conn->close();
                    ?>
                  </select>
                </div>
                <!-- /.form-group -->
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Project Status</label>
                  <select class="form-control select2" name="status" style="width: 100%;" data-placeholder="Select Project Status" required>
                  <option value="">Select Project Status</option>
                  <?php
                      include '../../connection/connection.php';
                      $sql = "SELECT * FROM psi_project_status";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                          while($row = $result->fetch_assoc()) {
                              echo '<option value="'.$row["prj_status_id"].'"'; if($status==$row['prj_status_id']){ echo 'selected'; } echo '>'.$row["prj_status_name"].'</option>';
                          }
                      } 
                      $conn->close();
                    ?>
                  </select>
                </div>
                <!-- /.form-group -->
                </div>
              <!-- /.col -->
            </div>
        </div>
        </div>
        <!-- /.row -->
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Project Location</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            <!--  <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button> -->
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
          <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Street Address</label>
                  <input class="form-control" name="street" type="text" placeholder="Enter Street Address" value="<?= $street ?>" style="width: 100%;">
                </div>  
                <!-- /.form-group -->
              
            </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Province</label>
                  <select class="form-control select2" name="province" data-placeholder="Select Province" data-placeholder="Select Province"  style="width: 100%;" required>
                  <option value="">Select Province</option>
                  <option value="51">Occidental Mindoro</option>
                    <option value="52">Oriental Mindoro</option>
                    <option value="40">Marinduque</option>
                    <option value="59">Romblon</option>
                    <option value="53">Palawan</option>
                    <option value="315">City of Puerto Princesa</option>
                    <option value="100">Region-wide</option>
                  </select>
                </div>  
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-4">
                <div class="form-group">
                  <label>Municipality / City</label>
                  <select class="form-control select2" name="city_mun" data-placeholder="Select City/Municipality" style="width: 100%;">
                  <option value="">Select City/Municipality</option>
                  </select>
                </div>
                <!-- /.form-group -->
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Barangay</label>
                  <select class="form-control select2" name="barangay" data-placeholder="Select Barangay" style="width: 100%;">
                  <option value="">Select Barangay</option>
                  </select>
                </div>
                <!-- /.form-group -->
                </div>
              <!-- /.col -->
            </div>
            </div>
            <!-- /.row -->
        </div>

        <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title">Project Cost</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            <!--  <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button> -->
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Project Cost</label>
                  <input class="form-control" name="project_cost" type="number" max="99999999" step="0.01" placeholder="Enter Project Cost" value="<?= $project_cost ?>" style="width: 100%;" required>
                </div>  
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-4">
                <div class="form-group">
                  <label>Beneficiaries’ Counterpart</label>
                  <input class="form-control" name="beneficiary_counterpart" type="number" max="99999999" step="0.01" placeholder="Enter Beneficiaries’ Counterpart" value="<?= $beneficiary_counterpart ?>" style="width: 100%;"></div>
                <!-- /.form-group -->
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Other Project Cost</label>
                  <input class="form-control" name="other_project_cost" type="number" max="99999999" step="0.01" placeholder="Enter Other Project Cost" value="<?= $other_project_cost ?>" style="width: 100%;">
                </div>
                <!-- /.form-group -->
                </div>
              <!-- /.col -->
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Beneficiaries Counterpart Description</label>
                  <textarea class="form-control" name="counterpart_desc" type="text" placeholder="Enter Beneficiaries Counterpart Description" style="width: 100%;"><?= $counterpart_desc ?></textarea>
                </div>  
                <!-- /.form-group -->
              
            </div>
            </div>
            </div>
            <!-- /.row -->
            <input type="hidden" name="project_id" value="<?= $project_id ?>" />
        </div>
        <div style="text-align: center">
            <button type="submit" class="btn btn-primary btn-lg">Update Project</button>
        </div><br /><br /><br />
        </form>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php
  include 'template/footer.php';
?>
 