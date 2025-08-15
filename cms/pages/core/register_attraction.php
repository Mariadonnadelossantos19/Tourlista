<?php
  $page = "register_attraction";
  include '../template/header.php';
  recordLog("Visited Register Attraction");
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Register Tourist Attraction   </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Register Tourist Attraction </li>
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
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Basic Information</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form action="../crud/save_ta.php" method="POST" enctype="multipart/form-data">
              <div class="row">
            <div class="col-4">
              <div class="form-group">
                  <label>Name of Tourist Attraction</label>
                  <input type="text" name="ta_name" class="form-control" placeholder="Enter name of tourist attraction" required>
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                  <label>Complete Address</label>
                  <input type="text" name="address" class="form-control" placeholder="Enter complete address" required>
              </div>
            </div>
            <div class="col-2">
              <div class="form-group">
                  <label>Type</label>
                  <select name="type" id="type" class="form-control" onchange="showCategory(this.value)" required>
                      <option value="">Select Type</option>
                      <?php
                        include '../../../connection/connection.php';
                        $sql = "SELECT * FROM ta_type";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo '<option class="form-control" value="'.$row["ta_type_id"].'">'.$row["ta_type_id"].' - '.$row["ta_type"].'</option>';
                            }
                        }
                      ?>
                  </select>
              </div>
            </div>

            <div class="col-2">
              <div class="form-group">
                  <label>Category</label>
                  <select name="classification" id="category" class="form-control" required>
                      <option value="">Select Category</option>

                  </select>
              </div>
            </div>

            <div class="col-12">
              <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <textarea name="description" class="form-control" required></textarea>
              </div>
            </div>

            <div class="col-3"> 
                    <div class="form-group">
                        <label for="exampleInputEmail1">Attraction Accredited?</label>
                        <select class="form-control" name="is_accredited" required>
                            <option value="yes">YES</option>
                            <option value="no">NO</option>
                        </select>
                    </div>
                    <!-- /.form-group -->
                    </div>

                    <div class="col-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Accreditation Number</label>
                        <input type="text" name="accreditation_number" class="form-control" placeholder="Enter accreditation number">
                    </div>
                    <!-- /.form-group -->
                    </div>

                    
                    <div class="col-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Validity From</label>
                        <input type="date" name="valid_from" class="form-control" placeholder="Accreditation Validity Period From">
                    </div>
                    <!-- /.form-group -->
                    </div>

                    
                    <div class="col-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Validity To</label>
                        <input type="date" name="valid_to" class="form-control" placeholder="Accreditation Validity Period To">
                    </div>
                    <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
          </div>
          </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
        <div class="col-6">
        <!-- /.card -->
        <div class="card card-primary card-outline">
            <div class="card-header">
            <h3 class="card-title">Employees and Contacts</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <div class="form-group">
                <label for="manager">Name of General Manager:</label>
                <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                </div>
                <input type="text" id="manager" name="manager" class="form-control" placeholder="Enter Name of Manager" required>
                </div>
                <!-- /.input group -->
            </div>

            <div class="form-group">
                <label for="no_regular_m">Number of Regular Employees:</label>
                <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-male"></i></span>
                </div>
                <input type="number" id="no_regular_m" name="no_regular_m" class="form-control" placeholder="Enter Number of Male Regular Employees" min="0" max="300" required>
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-female"></i></span>
                </div>
                <input type="number" name="no_regular_f" class="form-control" placeholder="Enter Number of Female Regular Employees" min="0" max="300" required>
                </div>
                <!-- /.input group -->
            </div>

            <div class="form-group">
                <label for="no_on_call_m">Number of On-Call Employees:</label>
                <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-male"></i></span>
                </div>
                <input type="number" id="no_on_call_m" name="no_on_call_m" class="form-control" placeholder="Enter Number of Male on-call employees" min="0" max="300" required>
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-female"></i></span>
                </div>
                <input type="number" name="no_on_call_f" class="form-control" placeholder="Enter Number of Female on-call employees" min="0" max="300" required>
                </div>
                <!-- /.input group -->
            </div>

            <div class="form-group">
                <label for="email">Email Address:</label>
                <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                </div>
                <input type="email" id="email" name="email" class="form-control" placeholder="Enter email address" required>
                </div>
                <!-- /.input group -->
            </div>

            <div class="form-group">
                <label for="contact">Contact Number:</label>
                <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                </div>
                <input type="text" id="contact" name="contact" class="form-control" placeholder="Enter contact number" required>
                </div>
                <!-- /.input group -->
            </div>

            <div class="form-group">
                <label for="website">Website:</label>
                <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-globe"></i></span>
                </div>
                <input type="text" id="website" name="website" class="form-control" placeholder="Enter website address" required>
                </div>
                <!-- /.input group -->
            </div>
            <!-- /.form group -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        </div>

          <!-- /.col -->

          <div class="col-6">
            <!-- /.card -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Image and Map Locations</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- Date dd/mm/yyyy -->
                <div class="form-group">
                    <label>Geolocation:</label>
                    <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-map-pin"></i></span>
                    </div>
                    <input type="text" name="geolocation" class="form-control" id="location" placeholder="Geolocation" readonly>
                    </div>
                    <!-- /.input group -->
                </div>

                <div class="form-group">
                    <label>Map:</label>
                    <div>
                    <iframe src="maps.php" width="100%" height="335px"></iframe>
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleInputFile">Attraction Photo:</label>
                    <input type="file" name="taphoto" id="taphoto" accept="image/*" class="form-control-file">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

        </div>
        <div class="row justify-content-center">
        <div class="card-header">
            <div class="form-group">
            <input type="submit" class="btn btn-success btn-lg" value="Register Attraction" />
            </div>
        </div>
        </div>

      </form>

      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include '../template/footer.php'; ?>

<script>

function showCategory(type){
  //alert(type);
    $.ajax({
      type: "GET",
      url: "../crud/load_category.php",
      cache: false,
      data: {type},
      success: function(data){
        $("#category").html(data);
      }
    });
  }

function getLocation(location){
  document.getElementById('location').value=location;
}

$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
})
</script>