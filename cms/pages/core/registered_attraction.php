<?php
  $page = "registered_attraction";
  include '../template/header.php';
  recordLog("Visited Registered Attraction");
?>
<?php
    include '../../../connection/connection.php';
    $sql1 = "select * from tourist_attraction where user_id = '".$_SESSION['id']."'";
    $result1 = mysqli_query($conn, $sql1);
    $ta_id = "";
    $ta_name = "";
    $complete_address = "";
    $type = "";
    $classification = "";
    $description = "";
    $manager = "";
    $no_regular_male = "";
    $no_regular_female = "";
    $no_on_call_male = "";
    $no_on_call_female = "";
    $email = "";
    $contact_number = "";
    $geo_location = "";
    $photos = "";
    $edit_request = "";
    $is_accredited = "";
    $accreditation_number = "";
    $valid_from = "";
    $valid_to = "";
    if (mysqli_num_rows($result1) > 0) {
        while($row1 = mysqli_fetch_assoc($result1)) {
          $ta_id = $row1["ta_id"];
          $ta_name = $row1["ta_name"];
          $complete_address = $row1["complete_address"];
          $type = $row1["type"];
          $classification = $row1["classification"];
          $description = $row1["description"];
          $manager = $row1["manager"];
          $no_regular_male = $row1["no_regular_male"];
          $no_regular_female = $row1["no_regular_female"];
          $no_on_call_male = $row1["no_on_call_male"];
          $no_on_call_female = $row1["no_on_call_female"];
          $email = $row1["email"];
          $contact_number = $row1["contact_number"];
          $website = $row1["website"];
          $geo_location = $row1["geo_location"];
          $photos = $row1["photo"];
          $edit_request = $row1["request_edit"];
          $is_accredited = $row1["is_accredited"];
          $accreditation_number = $row1["accreditation_number"];
          $valid_from = $row1["valid_from"];
          $valid_to = $row1["valid_to"];

        }
    }
?> 
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Tourist Attraction </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Update Tourist Attraction</li>
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
                <h3 class="card-title">Basic Information
                <?php 
                  if($edit_request==0){
                    echo '<a href="../crud/request_edit_ta.php?id='.$ta_id.'" class="badge badge-primary">Request to edit Attraction Name</a>';
                  }
                  if($edit_request==1){
                    echo '<span class="badge badge-warning">Request submitted to LGU Administrator</span>';
                  }
                  if($edit_request==2){
                    echo '<span class="badge badge-success">Request Granted</span>';
                  }
                  ?>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form action="../crud/update_ta.php" method="POST">
              <div class="row">
            <div class="col-4">
              <div class="form-group">
                  <label>Name of Tourist Attraction</label>
                  <input type="text" name="ta_name" class="form-control" placeholder="Enter name of tourist attraction" value="<?php echo $ta_name; ?>"  required <?php if($edit_request<2){ echo 'readonly'; } ?>>
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                  <label>Complete Address</label>
                  <input type="text" name="address" class="form-control" placeholder="Enter complete address" value="<?php echo $complete_address; ?>"  required>
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
                        $selected = "";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                              if($row["ta_type_id"]==$type){ $selected = "selected"; }
                              else { $selected = ""; }

                              echo '<option class="form-control" value="'.$row["ta_type_id"].'" '.$selected.'>'.$row["ta_type_id"].' - '.$row["ta_type"].'</option>';
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
                      <?php
                        include '../../../connection/connection.php';
                        $sql = "SELECT * FROM ta_category where ta_type_id = '".$type."'";
                        $selected = "";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                              if($row["ta_category_code"]==$classification){ $selected = "selected"; }
                              else { $selected = ""; }
                              
                              echo '<option class="form-control" value="'.$row["ta_category_code"].'" '.$selected.'>'.$row["ta_category_code"].' - '.$row["category"].'</option>';
                            }
                        }
                      ?>

                  </select>
              </div>
            </div>

            <div class="col-12">
              <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <textarea name="description" class="form-control" required><?php echo $description; ?></textarea>
              </div>
            </div>
            <div class="col-3"> 
                    <div class="form-group">
                        <label for="exampleInputEmail1">Establishment Accredited?</label>
                        <select class="form-control" name="is_accredited" required>
                            <option value="yes" <?php if($is_accredited=="yes"){ echo "Selected";} ?>>YES</option>
                            <option value="no" <?php if($is_accredited=="no"){ echo "Selected";} ?>>NO</option>
                        </select>
                    </div>
                    <!-- /.form-group -->
                    </div>

                    <div class="col-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Accreditation Number</label>
                        <input type="text" name="accreditation_number" class="form-control" placeholder="Enter accreditation number" value="<?php echo $accreditation_number; ?>">
                    </div>
                    <!-- /.form-group -->
                    </div>

                    
                    <div class="col-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Validity From</label>
                        <input type="date" name="valid_from" class="form-control" placeholder="Accreditation Validity Period From" value="<?php echo $valid_from; ?>">
                    </div>
                    <!-- /.form-group -->
                    </div>

                    
                    <div class="col-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Validity To</label>
                        <input type="date" name="valid_to" class="form-control" placeholder="Accreditation Validity Period To" value="<?php echo $valid_to; ?>">
                    </div>
                    <!-- /.form-group -->
                    </div>
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
                <input type="text" id="manager" name="manager" class="form-control" placeholder="Enter Name of Manager" value="<?php echo $manager; ?>" required>
                </div>
                <!-- /.input group -->
            </div>

            <div class="form-group">
                <label for="no_regular_m">Number of Regular Employees:</label>
                <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-male"></i></span>
                </div>
                <input type="number" id="no_regular_m" name="no_regular_m" class="form-control" placeholder="Enter Number of Male Regular Employees" value="<?php echo $no_regular_male; ?>" min="0" max="300" required>
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-female"></i></span>
                </div>
                <input type="number" name="no_regular_f" class="form-control" placeholder="Enter Number of Female Regular Employees" value="<?php echo $no_regular_female; ?>" min="0" max="300" required>
                </div>
                <!-- /.input group -->
            </div>

            <div class="form-group">
                <label for="no_on_call_m">Number of On-Call Employees:</label>
                <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-male"></i></span>
                </div>
                <input type="number" id="no_on_call_m" name="no_on_call_m" class="form-control" placeholder="Enter Number of Male on-call employees" value="<?php echo $no_on_call_male; ?>" min="0" max="300" required>
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-female"></i></span>
                </div>
                <input type="number" name="no_on_call_f" class="form-control" placeholder="Enter Number of Female on-call employees" value="<?php echo $no_on_call_female; ?>" min="0" max="300" required>
                </div>
                <!-- /.input group -->
            </div>

            <div class="form-group">
                <label for="email">Email Address:</label>
                <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                </div>
                <input type="email" id="email" name="email" class="form-control" placeholder="Enter email address" value="<?php echo $email; ?>" required>
                </div>
                <!-- /.input group -->
            </div>

            <div class="form-group">
                <label for="contact">Contact Number:</label>
                <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                </div>
                <input type="text" id="contact" name="contact" class="form-control" placeholder="Enter contact number" value="<?php echo $contact_number; ?>" required>
                </div>
                <!-- /.input group -->
            </div>

            <div class="form-group">
                <label for="website">Website:</label>
                <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-globe"></i></span>
                </div>
                <input type="text" id="website" name="website" class="form-control" placeholder="Enter website address" value="<?php echo $website; ?>" required>
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
                    <input type="text" name="geolocation" class="form-control" id="location" value="<?php echo $geo_location; ?>" placeholder="Geolocation" readonly />
                  <div class="input-group-addon">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal2">Change Geolocation</button>
                  </div>
                    </div>
                    <!-- /.input group -->
                </div>

                <div class="form-group">
                <label>Image:</label>
                <div>
                  <img src="../../uploads/<?php echo $photos; ?>" class="img-thumbnail" alt="Attraction Photo" width="304" height="236">
                  </div>
                </div>

                <div class="form-group">
                  <input type="button" class="btn btn-primary btn-xs" value="Update Attraction Image" data-toggle="modal" data-target="#myModal" />
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
            <input type="submit" class="btn btn-success btn-lg" id="submitnow" value="Update Information" />
            </div>
        </div>
        </div>

      </form>

      </div>
      <!-- /.container-fluid -->

                  <!-- Modal -->
            <div class="modal" tabindex="-1" role="dialog" id="myModal" data-backdrop="static">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Attraction Photo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <form action="../crud/update_ta_photo.php" method="POST" enctype="multipart/form-data">
                   <input type="hidden" name="ta_id" value="<?php echo $ta_id; ?>" /> 
                   <input type="file" name="taphoto" id="taphoto" accept="image/*" required > <br /> <br />
                   <input type="submit" class="btn btn-success" value="Upload Photo" />
                  </form>
                </div>
            </div>
          </div>
        </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="myModal2" data-backdrop="static">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Geolocation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                <label>Get your geotag by pointing your establishment / attraction location in the map below:</label>

                  <div>
                    <iframe src="maps.php" width="100%" height="335px"> </iframe>
                  </div>

                  <div class="form-group">
                    <input type="button" class="btn btn-success btn-xm" id="getgeo" value="Update Geolocation Now!" />
                  </div>



                </div>
                </div>
            </div>
          </div>

        </div>
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

$(document).ready(function(){
  $("#getgeo").click(function(){
    $("#submitnow").trigger("click");
  });
});
</script>