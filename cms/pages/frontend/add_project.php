<?php
  $page = "add_project";
  include 'template/header.php';
?> 
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Project</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Project</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <form action="../backend/add_project.php" method="get">
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
                  <input class="form-control" name="project_code" type="text" placeholder="Enter Project Code" style="width: 100%;" required>
                </div>  
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-4">
                <div class="form-group">
                  <label>Program Type *</label>
                  <select class="form-control select2" name="project_type" data-placeholder="Select Project Type" style="width: 100%;" required>
                  <option value="">Select Project Type</option>
                  <?php
                      include '../../connection/connection.php';
                      $sql = "SELECT * FROM psi_project_types";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                          while($row = $result->fetch_assoc()) {
                              echo '<option value="'.$row["prj_type_id"].'">'.$row["prj_type_name"].'</option>';
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
                  <input class="form-control" name="year_approved" type="number" min="2008" max="<?= date("Y"); ?>" placeholder="Enter Year Approved" style="width: 100%;" required>
                </div>
                <!-- /.form-group -->
                </div>
              <!-- /.col -->
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Project Title</label>
                  <input class="form-control" name="project_title" type="text" placeholder="Enter Project Title" style="width: 100%;" required>
                </div>  
                <!-- /.form-group -->
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Project Description</label>
                  <textarea class="form-control" name="project_desc" type="text" placeholder="Enter Project Description" style="width: 100%;"></textarea>
                </div>  
                <!-- /.form-group -->
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Project Duration From *</label>
                  <input class="form-control" name="duration_from" type="date" style="width: 100%;" required>
                </div>  
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label>Project Duration To *</label>
                  <input class="form-control" name="duration_to" type="date" style="width: 100%;" required>
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
                              echo '<option value="'.$row["coop_id"].'">'.$row["coop_name"].'</option>';
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
                              echo '<option value="'.$row["col_id"].'">'.$row["col_name"].'</option>';
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
                  <select class="form-control select2" name="implementor" style="width: 100%;" data-placeholder="Select Implementor" required>
                  <option value="">Select Implementor</option>
                  <?php
                      include '../../connection/connection.php';
                      $sql = "SELECT * FROM psi_implementors";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                          while($row = $result->fetch_assoc()) {
                              echo '<option value="'.$row["implementor_id"].'">'.$row["implementor_name"].'</option>';
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
                  <input class="form-control" name="date_released" type="date" style="width: 100%;" required>
                </div>  
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-4">
                <div class="form-group">
                  <label>Sector</label>
                  <select class="form-control select2" name="sector" style="width: 100%;" data-placeholder="Select Sector" required>
                  <option value="">Select Sector</option>
                  <?php
                      include '../../connection/connection.php';
                      $sql = "SELECT * FROM psi_sectors";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                          while($row = $result->fetch_assoc()) {
                              echo '<option value="'.$row["sector_id"].'">'.$row["sector_name"].'</option>';
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
                              echo '<option value="'.$row["prj_status_name"].'">'.$row["prj_status_name"].'</option>';
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
                  <input class="form-control" name="street" type="text" placeholder="Enter Street Address" style="width: 100%;">
                </div>  
                <!-- /.form-group -->
              
            </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Province</label>
                  <select class="form-control select2" name="province" id="province" data-placeholder="Select Province" style="width: 100%;" required>
                  <option value="">Select Province</option>
                  <?php
                      include '../../connection/connection.php';
                      $sql = "SELECT * FROM psi_implementors";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                          while($row = $result->fetch_assoc()) {
                              echo '<option value="'.$row["implementor_id"].'">'.$row["implementor_name"].'</option>';
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
                  <label>Municipality / City</label>
                  <select class="form-control select2" name="city_mun" id="city_mun" data-placeholder="Select City/Municipality" style="width: 100%;">
                    <option value="">Select City/Municipality</option>
                    <?php

                      include '../../connection/connection.php';
                      $sql = "SELECT * FROM citymun where region_c = 17 && province_c = $implementor_id";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                          while($row = $result->fetch_assoc()) {
                              echo '<option value="'.$row["citymun_c"].'">'.$row["citymun_m"].'</option>';
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
                  <input class="form-control" name="project_cost" type="number" max="99999999" step="0.01" placeholder="Enter Project Cost"  style="width: 100%;" required>
                </div>  
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-4">
                <div class="form-group">
                  <label>Beneficiaries’ Counterpart</label>
                  <input class="form-control" name="beneficiary_counterpart" type="number" max="99999999" step="0.01" placeholder="Enter Beneficiaries’ Counterpart" style="width: 100%;"></div>
                <!-- /.form-group -->
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Other Project Cost</label>
                  <input class="form-control" name="other_project_cost" type="number" max="99999999" placeholder="Enter Other Project Cost" style="width: 100%;">
                </div>
                <!-- /.form-group -->
                </div>
              <!-- /.col -->
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Beneficiaries’ Counterpart Description</label>
                  <textarea class="form-control" name="counterpart_desc" type="text" placeholder="Enter Beneficiaries’ Counterpart Description" style="width: 100%;"></textarea>
                </div>  
                <!-- /.form-group -->
              
            </div>
            </div>
            </div>
            <!-- /.row -->
            
        </div>
        <div style="text-align: center">
            <button type="submit" class="btn btn-primary btn-lg">Submit Project</button>
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
 