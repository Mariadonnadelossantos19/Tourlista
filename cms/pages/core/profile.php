<?php
  $page = "dashboard";
  include '../template/header.php';
  recordLog("Visited Profile");
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Users Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Upload File</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              <div class="card-body">
                <form method="post" action="../crud/upload_profile.php" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-12"> <p>Find File:</p> <input name="file" type="file" value="select image" accept="image/*" required />
                    </div>
                  </div>
                  <input type="hidden" name="id" id="id" />
            </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button class="btn btn-success btn-round">Upload File</button>
            </div>
            </form>

          </div>
        </div>
      </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="../../uploads/<?php echo $photo; ?>"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php echo $usernames; ?></h3>
                <p class="text-muted text-center">
                <?php
                    if($access_level == "1"){ echo "AE User Account"; }
                    else if($access_level == "2"){ echo "TA User Account"; }
                    else if($access_level == "3"){ echo "City/Mun User Account"; }
                    else if($access_level == "4"){ echo "Provincial User Account"; }
                    else if($access_level == "5"){ echo "Regional User Account"; }
                ?>

                </p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Region</b> <a class="float-right"><?php echo $r; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Province</b> <a class="float-right"><?php echo $province_m; if($province == ""){ echo "N/A"; } ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>City/Mun</b> <a class="float-right"><?php echo $citymun_m; if($citymun == ""){ echo "N/A"; } ?></a>
                  </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal"><b>Upload Profile Image</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card card-primary card-outline">
              <div class="card-header p-2"> <h3>Profile Details</h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="card-content">
                    <form class="form-horizontal" action="../crud/update_profile.php" method="post">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" name="username" <?php echo "value='".$usernames."'"; ?> placeholder="Enter username" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Enter Email Address" <?php echo "value='".$email."'"; ?> required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Mobile Number</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" name="mobile" placeholder="Enter Mobile Number" <?php echo "value='".$mobile."'"; ?> required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="inputSkills" name="password" placeholder="Enter Password" required>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-success">Update</button>
                        </div>
                      </div>
                    </form>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include '../template/footer.php'; ?>