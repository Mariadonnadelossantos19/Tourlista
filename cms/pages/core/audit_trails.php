<?php
  $page = "audit_trails";
  include '../template/header.php';
  recordLog("Visited Audit Trails");
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Audit Trails   </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Audit Trails  </li>
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

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Activities of TourLISTA Users</h3>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div>
                <form>
                  <div class="form-row">
                    <div class="col-3">
                      <input type="date" name="date" class="form-control" placeholder="Select Date">
                    </div>
                    <div class="col">
                    <button type="submit" class="btn btn-primary mb-2">Filter Logs</button>
                    </div>
                  </div>
                </form>
                </div><hr />
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                        <th>#</th>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Action</th>
                        <th>Action Date</th>
                        <th>Action Time</th>
                      </tr>
                  </thead>
                  <tbody>
                  <?php
                        $num=1;
                        include '../../connection/connection.php';
                        $ae_approved = 0;
                        $ae_denied = 0;
                        $ae_pending = 0;
                        $ae_total = 0;
                        $sql = "select * from transactions t left join ts_users s on t.user_id = s.user_id where action_date = '".date("Y-m-d")."'";
                        if($_GET["date"]!=""){
                          $sql = "select * from transactions t left join ts_users s on t.user_id = s.user_id where action_date = '".$_GET["date"]."'";
                        }

                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($result)) {
                            $user_id = $row['user_id'];
                            $username = $row['username'];
                            if($user_id=="" || $username==""){
                                $user_id = "No Session";
                                $username = "Guest";

                            }
                        echo '
                        <tr>
                                <td>'.$num.'</td>
                                <td>'.$user_id.'</td>
                                <td>'.$username.'</td>
                                <td>'.$row['action'].'</td>
                                <td>'.$row['action_date'].'</td>
                                <td>'.$row['action_time'].'</td>
                                </tr>';
                        $num++;
                        }
                  ?>

                  </tbody>
                  <tfoot>
                  <tr>
                        <th>#</th>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Action</th>
                        <th>Action Date</th>
                        <th>Action Time</th>
                </tr>
                  </tfoot>
                </table>
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