<?php
  $page = "training_masterlist";
  include 'template/header.php';
  include '../../connection/connection.php';
?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Forum/Training/Seminar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Forum/Training/Seminar</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <form action="../backend/add_training.php" method="get">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Forum/Training/Seminar Profile</h3>
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
                <div class="col-md-9">
                  <div class="form-group">
                    <label>Title *</label>
                    <input class="form-control" name="training_title" type="text" placeholder="Enter Forum/Training/Seminar Title" style="width: 100%;" required>
                  </div>  
                  <!-- /.form-group -->
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Type *</label>
                    <select class="form-control select2" name="training_type" style="width: 100%;" data-placeholder="Select Training Type" required>
                    <option value="">Please select training type</option>
                  <?php
                      include '../../connection/connection.php';
                      $sql = "SELECT * FROM psi_fora_types";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                          while($row = $result->fetch_assoc()) {
                              echo '<option value="'.$row["fr_type_id"].'">'.$row["fr_type_name"].'</option>';
                          }
                      } 
                      $conn->close();
                    ?>
                    </select>
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Training Description</label>
                  <textarea class="form-control" name="training_desc" type="text" placeholder="Enter Training Description" style="width: 100%;"></textarea>
                </div>  
                <!-- /.form-group -->
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Cooperating Agencies</label>
                  <select class="select2" name="cooperator" multiple="multiple" data-placeholder="Select Cooperating Agency" style="width: 100%;">
                  <option value="">Please select cooperator</option>
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
                  <label>Service Provider</label>
                  <select class="select2" name="service_provider" data-placeholder="Select Service Provider" style="width: 100%;">
                  <option value="">Please select service provider</option>
                  <?php
                      include '../../connection/connection.php';
                      $sql = "SELECT * FROM psi_service_providers";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                          while($row = $result->fetch_assoc()) {
                              echo '<option value="'.$row["sp_id"].'">'.$row["sp_name"].'</option>';
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
                  <label>Sectors</label>
                  <select class="form-control select2" name="sectors" style="width: 100%;" data-placeholder="Select Sector" required>
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
              <!-- /.col -->
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Start Date *</label>
                  <input class="form-control" name="start_date" type="date" style="width: 100%;" required>
                </div>  
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label>End Date *</label>
                  <input class="form-control" name="end_date" type="date" style="width: 100%;" required>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Requesting Party</label>
                  <textarea class="form-control" name="requesting_party" type="text" placeholder="Enter Requesting Party" style="width: 100%;"></textarea>
                </div>  
                <!-- /.form-group -->
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Cost</label>
                  <input class="form-control" name="training_cost" type="number" step="0.01" placeholder="Enter Consultancy Cost" style="width: 100%;" required>
                </div>  
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-4">
                <div class="form-group">
                  <label>Overall CSF</label>
                  <input class="form-control" name="overall_csf" type="number" placeholder="Enter Overall CSF Rating" step="0.01" style="width: 100%;" required>
                </div>
                <!-- /.form-group -->
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Implementor</label>
                  <select class="form-control select2" name="implementor" style="width: 100%;" data-placeholder="Select Implementor"  required>
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
                  </select>
                </div>
                <!-- /.form-group -->
                </div>
              <!-- /.col -->
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Remarks</label>
                  <textarea class="form-control" name="remarks" type="text" placeholder="Enter Remarks" style="width: 100%;"></textarea>
                </div>  
                <!-- /.form-group -->
              </div>
            </div>
        </div>
        </div>

        <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title">Participant Demographics</h3>

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
                  <label>No. of Female Participants *</label>
                  <input class="form-control" name="female_participants" type="number" max="99999999" placeholder="Enter No. of Female Participants" style="width: 100%;" required>
                </div>  
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-4">
                <div class="form-group">
                  <label>No. of Male Participants *</label>
                  <input class="form-control" name="male_participants" type="number" max="99999999" placeholder="Enter No. of Male Participants" style="width: 100%;"></div>
                <!-- /.form-group -->
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>No. of PWD Participants *</label>
                  <input class="form-control" name="pwd_participants" type="number" max="99999999" placeholder="Enter No. of PWD Participants" style="width: 100%;">
                </div>
                <!-- /.form-group -->
                </div>
              <!-- /.col -->
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>No. of Senior Citizen Participants *</label>
                  <input class="form-control" name="sr_participants" type="number" max="99999999" placeholder="Enter No. of Senior Citizen Participants " style="width: 100%;" required>
                </div>  
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-4">
                <div class="form-group">
                  <label>Total No. of Participating Firms *</label>
                  <input class="form-control" name="firm_participants" type="number" max="99999999" placeholder="Enter Total No. of Participating Firms" style="width: 100%;"></div>
                <!-- /.form-group -->
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Total No. of Participating PO *</label>
                  <input class="form-control" name="po_participants" type="number" max="99999999" placeholder="Enter Total No. of Participating PO" style="width: 100%;">
                </div>
                <!-- /.form-group -->
                </div>
              <!-- /.col -->
            </div>

            </div>
            </div>
            <!-- /.row -->
            
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
                  <select class="form-control select2" name="province" data-placeholder="Select Province" style="width: 100%;" required>
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
        <div style="text-align: center">
            <button type="submit" class="btn btn-primary btn-lg">Submit Training</button>
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
 