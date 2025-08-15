<?php
  $page = "sync_data_ta";
  include '../template/header.php';
  recordLog("Visited Sync Offline Data");
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sync Offline Data </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sync Offline Data </li>
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
          <?php

            if($_GET["status"]=='1'){
                echo 
                '<div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> You have successfully sync your offline daily monitoring database.
                </div>
                ';
            }
            if($_GET["status"]=='0'){
                echo 
                '<div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Failed!</strong> Sorry an error has been occured, please validate your file.
                </div>
                ';
            }
            if($_GET["status"]=='2'){
                echo 
                '<div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Failed!</strong> Please check if your file format is correct.
                </div>
                ';
            }

            ?>
            <!-- /.card -->
            <form id="task_form" action="../crud/importDataTA.php" method="post" enctype="multipart/form-data">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Upload CSV File</h3>
              </div>
              <!-- /.card-header -->
              <?php
                  include '../../../connection/connection.php';
                  $sql = "select * from tourist_attraction where user_id='".$_SESSION['id']."' and approve_status = '1'";
                  $result = mysqli_query($conn, $sql);
                  $disabled = "disabled";
                  if (mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_assoc($result)) {
                          $disabled = "";
                      }
                  }
              ?>

              <div class="card-body">
              <input type="file" name="file" accept=".csv" class="form-control pull-right" title="Upload Offline CSV File" required>
              </div>
              <div class="card-footer">
                <button type="submit" id="submit_button" class="btn btn-success float-right" <?php echo $disabled; ?>>Sync Offline Data</button>

              </div>
            </form>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>

        <div class="row">
          <div class="col-12">
            <!-- /.card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">CSV Template for Daily Tourist Attraction Visitors Monitoring</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="form-group">
                  <p>Your data is very important to us, so we make this tourLISTA feature for you to be able to sync your offline data. By downloading this Excel File you can encode your daily accommodation data in an excel spreadsheet, save your excel file into <b>.csv</b> file format before uploading in the sync form found above.</p> <br />
                  <a href="../reports/TA_MONITORING_TEMPLATE.xlsx" download><button type="button" class="btn btn-info">Download Now!</button></a>
              </div>
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
  </div>
  <!-- /.content-wrapper -->
<?php include '../template/footer.php'; ?>