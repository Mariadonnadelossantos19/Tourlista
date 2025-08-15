<?php
    session_start();
    error_reporting(E_ERROR | E_PARSE);
    if($_SESSION['id']=="") header("Location:../signin");
    include 'connection/connection.php';
    include 'connection/logs.php';

    $sql = "select username,email,mobile,region_m, u.region_c, province_m,citymun_m,access_level,photo from ts_users u
    left join region r on u.region_c = r.region_c
    left join province p on r.region_c = p.region_c and p.province_c = u.province_c
    left join citymun c on r.region_c = c.region_c and p.province_c = c.province_c and c.citymun_c = u.citymun_c
    where user_id='".$_SESSION['id']."'";
    $result = mysqli_query($conn, $sql);

    $usernames = "";
    $photo = "";
    $access_level = "";
    $region = "";
    $r= "";
    $province = "";
    $citymun = "";
    $email = "";
    $mobile = "";
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $usernames = $row["username"];
            $photo = $row["photo"];
            $access_level = $row["access_level"];
            $region = $row["region_c"];
            $r = $row["region_m"];
            $province = $row["province_c"];
            $citymun = $row["citymun_c"];
            $email = base64_decode($row["email"]);
            $mobile = base64_decode($row["mobile"]);
        }
    }

    $change = 0;
    $sql1 = "select * from accommodation_establishment where user_id='".$_SESSION['id']."'";
    $result1 = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($result1) > 0) {
        while($row1 = mysqli_fetch_assoc($result1)) {
          $change = 1;
        }
    }

    $change1 = 0;
    $sql2 = "select * from tourist_attraction where user_id='".$_SESSION['id']."'";
    $result2 = mysqli_query($conn, $sql2);
    if (mysqli_num_rows($result2) > 0) {
        while($row2 = mysqli_fetch_assoc($result2)) {
          $change1 = 1;
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TourLISTA - Tourism Live-Inventory and Statistics of Tourist Arrivals</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href=".plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="icon" href="../assets/images/tl.png">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user">&nbsp;&nbsp;| <?= $usernames; ?>&nbsp;&nbsp;</i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username"><?= $usernames; ?></h3>
                <h5 class="widget-user-desc">Administrator</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="uploads/<?php echo $photo; ?>" alt="User Avatar">
              </div>
              <div class="card-footer">
              <div class="row">
                  <div class="col">
                      <div class="float-left">
                          <a href="pages/core/profile.php" class="btn btn-primary">Profile</a>
                      </div>
                  </div>
                  <div class="col">
                      <div class="float-right">
                          <a href="pages/core/signout.php" class="btn btn-danger">Sign out</a>
                      </div>
                  </div>
              </div>
            </div>
            <!-- /.widget-user -->
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="../assets/images/tl.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Tour<b>LISTA</b> v1.50</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="uploads/<?php echo $photo; ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= $usernames; ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="../../" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

        <?php if($_SESSION['level']=='1') { ?>

          <?php

          if($change == 0){
          echo '
          <li class="nav-item">
            <a href="pages/core/register_establishment.php" class="nav-link'; if($page == "register_establishment"){ echo " active".'">'; }else{ echo '">'; }  echo '
              <i class="nav-icon fas fa-edit"></i>
              <p>
              Register Establishment
              </p>
            </a>
          </li>';
          }else{
          echo '
          <li class="nav-item">
            <a href="pages/core/registered_establishment.php" class="nav-link'; if($page == "registered_establishment"){ echo " active".'">'; }else{ echo '">'; } echo '
              <i class="nav-icon fas fa-edit"></i>
              <p>
              Update Establishment
              </p>
            </a>
          </li>';

        } ?>

          <li class="nav-item">
            <a href="pages/core/ae_daily_task.php" class="nav-link <?php if($page == "ae_daily_task"){ echo "active"; } ?>">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
              Daily Task
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="pages/core/ae_monthly_summary.php" class="nav-link <?php if($page == "ae_monthly_summary"){ echo "active"; } ?>">
              <i class="nav-icon fas fa-folder-open"></i>
              <p>
              Monthly Summary
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="pages/core/ae_mice.php" class="nav-link <?php if($page == "ae_mice"){ echo "active"; } ?>">
              <i class="nav-icon fas fa-calendar-check"></i>
              <p>
              MICE
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="pages/core/sync_data.php" class="nav-link <?php if($page == "sync_data"){ echo "active"; } ?>">
              <i class="nav-icon fas fa-cloud-upload-alt"></i>
              <p>
              Sync Offline Data
              </p>
            </a>
          </li>
        
        <?php } if($_SESSION['level']=='2') { ?>

          <?php

            if($change1 == 0){
            echo '
            <li class="nav-item">
              <a href="pages/core/register_attraction.php" class="nav-link'; if($page == "register_attraction"){ echo " active".'">'; }else{ echo '">'; }  echo '
                <i class="nav-icon fas fa-edit"></i>
                <p>
                Register Attraction
                </p>
              </a>
            </li>';
            }else{
            echo '
            <li class="nav-item">
              <a href="pages/core/registered_attraction.php" class="nav-link'; if($page == "registered_attraction"){ echo " active".'">'; }else{ echo '">'; } echo '
                <i class="nav-icon fas fa-edit"></i>
                <p>
                Update Attraction
                </p>
              </a>
            </li>';

            } ?>

            <li class="nav-item">
              <a href="pages/core/ta_daily_task.php" class="nav-link <?php if($page == "ta_daily_task"){ echo "active"; } ?>">
                <i class="nav-icon fas fa-tasks"></i>
                <p>
                Daily Task
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="pages/core/ta_monthly_summary.php" class="nav-link <?php if($page == "ta_monthly_summary"){ echo "active"; } ?>">
                <i class="nav-icon fas fa-folder-open"></i>
                <p>
                Monthly Summary
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="pages/core/ta_mice.php" class="nav-link <?php if($page == "ta_mice"){ echo "active"; } ?>">
                <i class="nav-icon fas fa-calendar-check"></i>
                <p>
                MICE
                </p>
              </a>
            </li>
                    
      
        <?php } if($_SESSION['level']>2){ ?>

          <li class="nav-item">
            <a href="pages/core/manage_user.php" class="nav-link <?php if($page == "manage_user"){ echo "active"; } ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Manage Users
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/core/manage_accommodation.php" class="nav-link <?php if($page == "manage_accommodation"){ echo "active"; } ?>">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Manage AEs
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/core/manage_attraction.php" class="nav-link <?php if($page == "manage_attraction"){ echo "active"; } ?>">
              <i class="nav-icon fas fa-binoculars"></i>
              <p>
                Manage TAs
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/core/statistics.php" class="nav-link <?php if($page == "statistics"){ echo "active"; } ?>">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                Summary & Statistics
              </p>
            </a>
          </li>
        <?php } if($_SESSION['level']>4){ ?>


          <li class="nav-item">
            <a href="pages/core/manage_encoding.php" class="nav-link <?php if($page == "manage_encoding"){ echo "active"; } ?>">
              <i class="nav-icon fas fa-laptop"></i>
              <p>
                Manage Encoding
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/core/audit_trails.php" class="nav-link <?php if($page == "audit_trails"){ echo "active"; } ?>">
              <i class="nav-icon fas fa-history"></i>
              <p>
                Audit Trails
              </p>
            </a>
          </li>
        
        <?php } ?>

          <li class="nav-item">
            <a href="pages/core/generate_report.php" class="nav-link <?php if($page == "generate_report"){ echo "active"; } ?>">
            <i class="nav-icon fas fa-file-excel"></i>
              <p>
                Generate Report
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner">
              <h3>
                <?php
                    include 'connection/connection.php';
                    $sql = "select count(*) as num from accommodation_establishment where approve_status = '1'";
                    if($access_level == '5'){
                      $sql = "select count(*) as num from accommodation_establishment ae
                      left join ts_users u on ae.user_id = u.user_id
                      where approve_status = '1' and region_c = '".$region."'";
                    }

                    if($access_level == '4'){
                      $sql = "select count(*) as num from accommodation_establishment ae
                      left join ts_users u on ae.user_id = u.user_id
                      where approve_status = '1' and province_c = '".$province."'";
                    }

                    if($access_level < 4){
                      $sql = "select count(*) as num from accommodation_establishment ae
                      left join ts_users u on ae.user_id = u.user_id
                      where approve_status = '1' and province_c = '".$province."' and citymun_c = '".$citymun."'";
                    }

                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo $row["num"];
                        }
                    }

                ?>
                </h3>

              <p>Accommodation Establishments</p>
            </div>
            <div class="icon">
              <i class="fa fa-bed"></i>
            </div>
            <a href="#" class="small-box-footer"><i class="fa fa-calendar"></i> As of <?php echo date("F d, Y") ?> </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php
                    include 'connection/connection.php';
                    $sql = "select count(*) as num from tourist_attraction where approve_status = '1'";
                    if($access_level == '5'){
                      $sql = "select count(*) as num from tourist_attraction ta
                      left join ts_users u on ta.user_id = u.user_id
                      where approve_status = '1' and region_c = '".$region."'";
                    }
                    if($access_level == '4'){
                      $sql = "select count(*) as num from tourist_attraction ta
                      left join ts_users u on ta.user_id = u.user_id
                      where approve_status = '1' and province_c = '".$province."'";
                    }
                    if($access_level < 4){
                      $sql = "select count(*) as num from tourist_attraction ta
                      left join ts_users u on ta.user_id = u.user_id
                      where approve_status = '1' and province_c = '".$province."' and citymun_c = '".$citymun."'";
                    }
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo $row["num"];
                        }
                    }

                ?></h3>

              <p>Tourist Attractions</p>
            </div>
            <div class="icon">
              <i class="fa fa-camera"></i>
            </div>
            <a href="#" class="small-box-footer"><i class="fa fa-calendar"></i> As of <?php echo date("F d, Y") ?></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>
              <?php
                    include 'connection/connection.php';
                    $local_ae = 0;
                    $local_ta = 0;
                    $total = 0;
                    $sql = "select sum(local_tourist) as local_tourist from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id where year = '".date("Y")."' and approve_status = '1'";
                    if($access_level == '5'){
                      $sql = "select sum(local_tourist) as local_tourist from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id
                      left join ts_users c on b.user_id = c.user_id
                      where region_c = '".$region."' and year = '".date("Y")."' and approve_status = '1'";
                    }
                    if($access_level == '4'){
                      $sql = "select sum(local_tourist) as local_tourist from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id
                      left join ts_users c on b.user_id = c.user_id
                      where province_c = '".$province."' and year = '".date("Y")."' and approve_status = '1'";
                    }
                    if($access_level < 4){
                      $sql = "select sum(local_tourist) as local_tourist from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id
                      left join ts_users c on b.user_id = c.user_id
                      where province_c = '".$province."' and citymun_c = '".$citymun."' and year = '".date("Y")."' and approve_status = '1'";
                    }
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $local_ae+=$row["local_tourist"];
                        }
                    }

                    $sql1 = "select sum(r_male) as r_male,sum(r_female) as r_female,sum(nr_male) as nr_male,sum(nr_female) as nr_female from ta_daily_task a left join tourist_attraction b on a.ta_id = b.ta_id where year = '".date("Y")."' and approve_status = '1'";
                    if($access_level == '5'){
                      $sql1 = "select sum(r_male) as r_male,sum(r_female) as r_female,sum(nr_male) as nr_male,sum(nr_female) as nr_female from ta_daily_task a left join tourist_attraction b on a.ta_id = b.ta_id 
                      left join ts_users c on b.user_id = c.user_id
                      where region_c = '".$region."' and year = '".date("Y")."' and approve_status = '1'";
                    }
                    if($access_level == '4'){
                      $sql1 = "select sum(r_male) as r_male,sum(r_female) as r_female,sum(nr_male) as nr_male,sum(nr_female) as nr_female from ta_daily_task a left join tourist_attraction b on a.ta_id = b.ta_id 
                      left join ts_users c on b.user_id = c.user_id
                      where province_c = '".$province."' and year = '".date("Y")."' and approve_status = '1'";
                    }
                    if($access_level < 4){
                      $sql1 = "select sum(r_male) as r_male,sum(r_female) as r_female,sum(nr_male) as nr_male,sum(nr_female) as nr_female from ta_daily_task a left join tourist_attraction b on a.ta_id = b.ta_id 
                      left join ts_users c on b.user_id = c.user_id
                      where province_c = '".$province."' and citymun_c = '".$citymun."' and year = '".date("Y")."' and approve_status = '1'";
                    }
                    $result1 = mysqli_query($conn, $sql1);
                    if (mysqli_num_rows($result1) > 0) {
                        while($row1 = mysqli_fetch_assoc($result1)) {
                            $local_ta+=$row1["r_male"];
                            $local_ta+=$row1["r_female"];
                            $local_ta+=$row1["nr_male"];
                            $local_ta+=$row1["nr_female"];
                        }
                    }

                    $total = ($local_ae+$local_ta);
                    echo number_format($total)." <small style='font-size: 50%; color: white;'>(AE: ".number_format($local_ae)." | TA: ".number_format($local_ta).")</small>";
                    

                ?>
              </h3>

              <p>Domestic Visitors</p>
            </div>
            <div class="icon">
              <i class="fa fa-bicycle"></i>
            </div>
            <a href="#" class="small-box-footer"><i class="fa fa-calendar"></i> As of <?php echo date("F d, Y") ?></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php
                    include 'connection/connection.php';
                    $foreign_ae = 0;
                    $foreign_ta = 0;
                    $total = 0;
                    $sql = "select sum(foreign_tourist) as foreign_tourist from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id where year = '".date("Y")."' and approve_status = '1'";
                    if($access_level == '5'){
                      $sql = "select sum(foreign_tourist) as foreign_tourist from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id
                      left join ts_users c on b.user_id = c.user_id
                      where region_c = '".$region."' and year = '".date("Y")."' and approve_status = '1'";
                    }
                    if($access_level == '4'){
                      $sql = "select sum(foreign_tourist) as foreign_tourist from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id
                      left join ts_users c on b.user_id = c.user_id
                      where province_c = '".$province."' and year = '".date("Y")."' and approve_status = '1'";
                    }
                    if($access_level < 4){
                      $sql = "select sum(foreign_tourist) as foreign_tourist from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id
                      left join ts_users c on b.user_id = c.user_id
                      where province_c = '".$province."' and citymun_c = '".$citymun."' and year = '".date("Y")."' and approve_status = '1'";
                    }
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $foreign_ae+=$row["foreign_tourist"];
                        }
                    }

                    $sql1 = "select sum(fo_male) as fo_male,sum(fo_female) as fo_female from ta_daily_task a left join tourist_attraction b on a.ta_id = b.ta_id where year = '".date("Y")."' and approve_status = '1'";
                    if($access_level == '5'){
                      $sql1 = "select sum(fo_male) as fo_male,sum(fo_female) as fo_female from ta_daily_task a left join tourist_attraction b on a.ta_id = b.ta_id 
                      left join ts_users c on b.user_id = c.user_id
                      where region_c = '".$region."' and year = '".date("Y")."' and approve_status = '1'";
                    }
                    if($access_level == '4'){
                      $sql1 = "select sum(fo_male) as fo_male,sum(fo_female) as fo_female from ta_daily_task a left join tourist_attraction b on a.ta_id = b.ta_id 
                      left join ts_users c on b.user_id = c.user_id
                      where province_c = '".$province."' and year = '".date("Y")."' and approve_status = '1'";
                    }
                    if($access_level < 4){
                      $sql1 = "select sum(fo_male) as fo_male,sum(fo_female) as fo_female from ta_daily_task a left join tourist_attraction b on a.ta_id = b.ta_id 
                      left join ts_users c on b.user_id = c.user_id
                      where province_c = '".$province."' and citymun_c = '".$citymun."' and year = '".date("Y")."' and approve_status = '1'";
                    }
                    $result1 = mysqli_query($conn, $sql1);
                    if (mysqli_num_rows($result1) > 0) {
                        while($row1 = mysqli_fetch_assoc($result1)) {
                            $foreign_ta+=$row1["fo_male"];
                            $foreign_ta+=$row1["fo_female"];
                        }
                    }

                    $total = ($foreign_ae+$foreign_ta);
                    echo number_format($total)." <small style='font-size: 50%; color: white;'>(AE: ".number_format($foreign_ae)." | TA: ".number_format($foreign_ta).")</small>";
                    

                ?></h3>

              <p>Foreign Visitors</p>
            </div>
            <div class="icon">
              <i class="fa fa-plane"></i>
            </div>
            <a href="#" class="small-box-footer"><i class="fa fa-calendar"></i> As of <?php echo date("F d, Y") ?></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- Info boxes --><br />
      <h3>Sex Disaggregated Data</h3>
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-primary"><i class="fa  fa-venus-mars"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Employees from AE</span>
              <span class="info-box-number">
                <?php
                    include 'connection/connection.php';
                    $sql = "SELECT SUM(no_regular_male) AS reg_male, SUM(no_on_call_male) AS oncall_male, SUM(no_regular_female) AS reg_female,
                    SUM(no_on_call_female) AS oncall_female FROM accommodation_establishment WHERE approve_status = '1'";
                    if($access_level == '5'){
                                          $sql = "SELECT SUM(no_regular_male) AS reg_male, SUM(no_on_call_male) AS oncall_male, SUM(no_regular_female) AS reg_female,
                                          SUM(no_on_call_female) AS oncall_female FROM accommodation_establishment ae left join ts_users u on ae.user_id = u.user_id WHERE approve_status = '1' and region_c = '".$region."'";
                    }
                    if($access_level == '4'){
                      $sql = "SELECT SUM(no_regular_male) AS reg_male, SUM(no_on_call_male) AS oncall_male, SUM(no_regular_female) AS reg_female,
                      SUM(no_on_call_female) AS oncall_female FROM accommodation_establishment ae left join ts_users u on ae.user_id = u.user_id WHERE approve_status = '1' and province_c = '".$province."'";
                    }
                    if($access_level < 4){
                      $sql = "SELECT SUM(no_regular_male) AS reg_male, SUM(no_on_call_male) AS oncall_male, SUM(no_regular_female) AS reg_female,
                      SUM(no_on_call_female) AS oncall_female FROM accommodation_establishment ae left join ts_users u on ae.user_id = u.user_id WHERE approve_status = '1' and province_c = '".$province."' and citymun_c = '".$citymun."'";
                    }

                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "FEMALE: ".number_format($row["reg_female"]+$row["oncall_female"])."<br />MALE: ".number_format($row["reg_male"]+$row["oncall_male"]);
                        }
                    }

                ?>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-venus-mars"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Employees from TA</span>
              <span class="info-box-number">
              <?php
                    include 'connection/connection.php';
                    $sql = "SELECT SUM(no_regular_male) AS reg_male, SUM(no_on_call_male) AS oncall_male, SUM(no_regular_female) AS reg_female,
                    SUM(no_on_call_female) AS oncall_female FROM tourist_attraction WHERE approve_status = '1'";
                    if($access_level == '5'){
                      $sql = "SELECT SUM(no_regular_male) AS reg_male, SUM(no_on_call_male) AS oncall_male, SUM(no_regular_female) AS reg_female,
                      SUM(no_on_call_female) AS oncall_female FROM tourist_attraction ta left join ts_users u on ta.user_id = u.user_id WHERE approve_status = '1' and region_c = '".$region."'";
                    }                    
                    if($access_level == '4'){
                      $sql = "SELECT SUM(no_regular_male) AS reg_male, SUM(no_on_call_male) AS oncall_male, SUM(no_regular_female) AS reg_female,
                      SUM(no_on_call_female) AS oncall_female FROM tourist_attraction ta left join ts_users u on ta.user_id = u.user_id WHERE approve_status = '1' and province_c = '".$province."'";
                    }
                    if($access_level < 4){
                      $sql = "SELECT SUM(no_regular_male) AS reg_male, SUM(no_on_call_male) AS oncall_male, SUM(no_regular_female) AS reg_female,
                      SUM(no_on_call_female) AS oncall_female FROM tourist_attraction ta left join ts_users u on ta.user_id = u.user_id WHERE approve_status = '1' and province_c = '".$province."' and citymun_c = '".$citymun."'";
                    }

                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "FEMALE: ".number_format($row["reg_female"]+$row["oncall_female"])."<br />MALE: ".number_format($row["reg_male"]+$row["oncall_male"]);
                        }
                    }

                ?>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-venus-mars"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">AE Visitors</span>
              <span class="info-box-number">

                <?php
                    include 'connection/connection.php';
                    $total_male = 0;
                    $total_female = 0;
                    $total = 0;
                    $sql = "select sum(no_male) as male, sum(no_female) as female from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id where year = '".date("Y")."' and approve_status = '1'";
                    if($access_level == '5'){
                      $sql = "select sum(no_male) as male, sum(no_female) as female from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id
                      left join ts_users c on b.user_id = c.user_id
                      where region_c = '".$region."' and year = '".date('Y')."' and approve_status = '1'";
                    }
                    if($access_level == '4'){
                      $sql = "select sum(no_male) as male, sum(no_female) as female from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id
                      left join ts_users c on b.user_id = c.user_id
                      where province_c = '".$province."' and year = '".date('Y')."' and approve_status = '1'";
                    }
                    if($access_level < 4){
                      $sql = "select sum(no_male) as male, sum(no_female) as female from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id
                      left join ts_users c on b.user_id = c.user_id
                      where province_c = '".$province."' and citymun_c = '".$citymun."' and year = '".date('Y')."' and approve_status = '1'";
                    }
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $total_male+=$row["male"];
                            $total_female+=$row["female"];
                        }
                    }

                    $sql1 = "select sum(r_male) as r_male,sum(r_female) as r_female,sum(nr_male) as nr_male,sum(nr_female) as nr_female from ta_daily_task a left join tourist_attraction b on a.ta_id = b.ta_id where year = '".date("Y")."' and approve_status = '1'";
                    if($access_level == '5'){
                      $sql1 = "select sum(r_male) as r_male,sum(r_female) as r_female,sum(nr_male) as nr_male,sum(nr_female) as nr_female from ta_daily_task a left join tourist_attraction b on a.ta_id = b.ta_id 
                      left join ts_users c on b.user_id = c.user_id
                      where region_c = '".$region."' and year = '".date("Y")."' and approve_status = '1'";
                    }
                    if($access_level == '4'){
                      $sql1 = "select sum(r_male) as r_male,sum(r_female) as r_female,sum(nr_male) as nr_male,sum(nr_female) as nr_female from ta_daily_task a left join tourist_attraction b on a.ta_id = b.ta_id 
                      left join ts_users c on b.user_id = c.user_id
                      where province_c = '".$province."' and year = '".date("Y")."' and approve_status = '1'";
                    }
                    if($access_level < 4){
                      $sql1 = "select sum(r_male) as r_male,sum(r_female) as r_female,sum(nr_male) as nr_male,sum(nr_female) as nr_female from ta_daily_task a left join tourist_attraction b on a.ta_id = b.ta_id 
                      left join ts_users c on b.user_id = c.user_id
                      where province_c = '".$province."' and citymun_c = '".$citymun."' and year = '".date("Y")."' and approve_status = '1'";
                    }

                    $total = ($total_male+$total_female);
                    echo "FEMALE: ".number_format($total_female)."<br />MALE: ".number_format($total_male);

                    

                ?>
                  
                </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-venus-mars"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">TA Visitors</span>
              <span class="info-box-number">
              <?php
                    include 'connection/connection.php';
                    $total_male = 0;
                    $total_female = 0;
                    $total = 0;

                    $sql1 = "select sum(r_male) as r_male,sum(r_female) as r_female,sum(nr_male) as nr_male,sum(nr_female) as nr_female, sum(fo_male) as fo_male, sum(fo_female) as fo_female from ta_daily_task a left join tourist_attraction b on a.ta_id = b.ta_id where year = '".date("Y")."' and approve_status = '1'";
                    if($access_level == '5'){
                      $sql1 = "select sum(r_male) as r_male,sum(r_female) as r_female,sum(nr_male) as nr_male,sum(nr_female) as nr_female, sum(fo_male) as fo_male, sum(fo_female) as fo_female from ta_daily_task a left join tourist_attraction b on a.ta_id = b.ta_id 
                      left join ts_users c on b.user_id = c.user_id
                      where region_c = '".$region."' and year = '".date("Y")."' and approve_status = '1'";
                    }
                    if($access_level == '4'){
                      $sql1 = "select sum(r_male) as r_male,sum(r_female) as r_female,sum(nr_male) as nr_male,sum(nr_female) as nr_female, sum(fo_male) as fo_male, sum(fo_female) as fo_female from ta_daily_task a left join tourist_attraction b on a.ta_id = b.ta_id 
                      left join ts_users c on b.user_id = c.user_id
                      where province_c = '".$province."' and year = '".date("Y")."' and approve_status = '1'";
                    }
                    if($access_level < 4){
                      $sql1 = "select sum(r_male) as r_male,sum(r_female) as r_female,sum(nr_male) as nr_male,sum(nr_female) as nr_female, sum(fo_male) as fo_male, sum(fo_female) as fo_female from ta_daily_task a left join tourist_attraction b on a.ta_id = b.ta_id 
                      left join ts_users c on b.user_id = c.user_id
                      where province_c = '".$province."' and citymun_c = '".$citymun."' and year = '".date("Y")."' and approve_status = '1'";
                    }
                    $result1 = mysqli_query($conn, $sql1);
                    if (mysqli_num_rows($result1) > 0) {
                        while($row1 = mysqli_fetch_assoc($result1)) {
                            $total_male+=$row1["r_male"];
                            $total_female+=$row1["r_female"];
                            $total_male+=$row1["nr_male"];
                            $total_female+=$row1["nr_female"];
                            $total_male+=$row1["fo_male"];
                            $total_female+=$row1["fo_female"];
                        }
                    }

                    $total = ($total_male+$total_female);
                    echo "FEMALE: ".number_format($total_female)."<br />MALE: ".number_format($total_male);

                    

                ?>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div><hr />
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Monthly Recap Report</h3>
            </div>
            <!-- /.box-header -->
          <div class="row">
            <div class="col-md-12">
              <div class="card card-chart">
                <div class="card-header card-header-success">
                  <div class="ct-chart" id="container"></div>
                </div>
              </div>
            </div>
          </div>
            <!-- ./box-body -->
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.5.0
    </div>
    <strong>Copyright &copy; <?= date("Y"); ?><a href="https://tourlista.ph/"> TourLISTA.ph</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();

    });

    Highcharts.chart('container', {

    chart: {
        type: 'column'
    },

  title: {
    text: 'Monthly Tourist Arrivals Trend'
  },
  subtitle: {
    text: 'TourLISTA Database'
  },

    xAxis: {
      categories: [
      'Jan',
      'Feb',
      'Mar',
      'Apr',
      'May',
      'Jun',
      'Jul',
      'Aug',
      'Sep',
      'Oct',
      'Nov',
      'Dec'
    ],
    },

  yAxis: {
    min: 0,
    title: {
      text: 'Tourist Count'
    }
  },

    tooltip: {
        formatter: function () {
            return '<b>' + this.x + '</b><br/>' +
                this.series.name + ': ' + this.y + '<br/>' +
                'Total: ' + this.point.stackTotal;
        }
    },

    plotOptions: {
        column: {
            stacking: 'normal'
        }
    },

    series: [{
        name: 'Local Tourist (AE)',
        data: 
        [
          <?php
            include 'connection/connection.php';
            $date = array("1","2","3","4","5","6","7","8","9","10","11","12");
            $data = "";
            for($x = 0; $x<12; $x++){
                $sql = "select sum(local_tourist) as num from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id where approve_status='1' and year = '".date("Y")."' and month ='".$date[$x]."' group by month";
                if($access_level == '5'){
                  $sql = "select sum(local_tourist) as num from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id 
                  left join ts_users c on b.user_id = c.user_id
                  where approve_status='1' and region_c = '".$region."' and year = '".date("Y")."' and month ='".$date[$x]."' group by month";
                }
                if($access_level == '4'){
                  $sql = "select sum(local_tourist) as num from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id 
                  left join ts_users c on b.user_id = c.user_id
                  where approve_status='1' and province_c = '".$province."' and year = '".date("Y")."' and month ='".$date[$x]."' group by month";
                }
                if($access_level < 4){
                  $sql = "select sum(local_tourist) as num from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id 
                  left join ts_users c on b.user_id = c.user_id
                  where approve_status='1' and province_c = '".$province."' and citymun_c = '".$citymun."' and year = '".date("Y")."' and month ='".$date[$x]."' group by month";

                }
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                  while($row = mysqli_fetch_assoc($result)) {
                      $data.=$row["num"].",";
                  }
                }
                else{
                    $data.="0".",";
                }

            }
            $data = substr($data, 0, -1);
            echo $data;

          ?>

        ],
        stack: 'local'
    }, {
        name: 'Local Tourist (TA)',
        data: [
        <?php
            include 'connection/connection.php';
            $date = array("1","2","3","4","5","6","7","8","9","10","11","12");
            $data = "";
            for($x = 0; $x<12; $x++){
                $sql = "select sum(r_male) as num1, sum(r_female) as num2, sum(nr_male) as num3, sum(nr_female) as num4 from ta_daily_task a left join tourist_attraction b on a.ta_id = b.ta_id where approve_status='1' and year = '".date("Y")."' and month ='".$date[$x]."' group by month";
                if($access_level == '5'){
                  $sql = "select sum(r_male) as num1, sum(r_female) as num2, sum(nr_male) as num3, sum(nr_female) as num4 from ta_daily_task a left join tourist_attraction b on a.ta_id = b.ta_id 
                  left join ts_users c on b.user_id = c.user_id
                  where approve_status='1' and region_c = '".$region."' and year = '".date("Y")."' and month ='".$date[$x]."' group by month";
                }
                if($access_level == '4'){
                  $sql = "select sum(r_male) as num1, sum(r_female) as num2, sum(nr_male) as num3, sum(nr_female) as num4 from ta_daily_task a left join tourist_attraction b on a.ta_id = b.ta_id 
                  left join ts_users c on b.user_id = c.user_id
                  where approve_status='1' and province_c = '".$province."' and year = '".date("Y")."' and month ='".$date[$x]."' group by month";
                }
                if($access_level < 4){
                  $sql = "select sum(r_male) as num1, sum(r_female) as num2, sum(nr_male) as num3, sum(nr_female) as num4 from ta_daily_task a left join tourist_attraction b on a.ta_id = b.ta_id
                  left join ts_users c on b.user_id = c.user_id
                  where approve_status='1' and province_c = '".$province."' and citymun_c = '".$citymun."' and year = '".date("Y")."' and month ='".$date[$x]."' group by month";

                }
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                  while($row = mysqli_fetch_assoc($result)) {
                      $data.=($row["num1"]+$row["num2"]+$row["num3"]+$row["num4"]).",";
                  }
                }
                else{
                    $data.="0".",";
                }
            }
            $data = substr($data, 0, -1);
            echo $data;

          ?>],
        stack: 'local'
    }, {
        name: 'Foreign Tourist (AE)',
        data: [
        <?php
            include 'connection/connection.php';
            $date = array("1","2","3","4","5","6","7","8","9","10","11","12");
            $data = "";
            for($x = 0; $x<12; $x++){
                $sql = "select sum(foreign_tourist) as num from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id where approve_status='1' and year = '".date("Y")."' and month ='".$date[$x]."' group by month";
                if($access_level == '5'){
                  $sql = "select sum(foreign_tourist) as num from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id 
                  left join ts_users c on b.user_id = c.user_id
                  where approve_status='1' and region_c = '".$region."' and year = '".date("Y")."' and month ='".$date[$x]."' group by month";
                }
                if($access_level == '4'){
                  $sql = "select sum(foreign_tourist) as num from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id 
                  left join ts_users c on b.user_id = c.user_id
                  where approve_status='1' and province_c = '".$province."' and year = '".date("Y")."' and month ='".$date[$x]."' group by month";
                }
                if($access_level < 4){
                  $sql = "select sum(foreign_tourist) as num from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id
                  left join ts_users c on b.user_id = c.user_id
                  where approve_status='1' and province_c = '".$province."' and citymun_c = '".$citymun."' and year = '".date("Y")."' and month ='".$date[$x]."' group by month";

                }
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                  while($row = mysqli_fetch_assoc($result)) {
                      $data.=$row["num"].",";
                  }
                }
                else{
                    $data.="0".",";
                }

            }
            $data = substr($data, 0, -1);
            echo $data;

          ?>
          ],
        stack: 'foreign'
    }, {
        name: 'Foreign Tourist (TA)',
        data: [
        <?php
            include 'connection/connection.php';
            $date = array("1","2","3","4","5","6","7","8","9","10","11","12");
            $data = "";
            for($x = 0; $x<12; $x++){
                $sql = "select sum(fo_male) as num1, sum(fo_female) as num2 from ta_daily_task a left join tourist_attraction b on a.ta_id = b.ta_id where approve_status='1' and year = '".date("Y")."' and month ='".$date[$x]."' group by month";
                if($access_level == '5'){
                  $sql = "select sum(fo_male) as num1, sum(fo_female) as num2 from ta_daily_task a left join tourist_attraction b on a.ta_id = b.ta_id
                  left join ts_users c on b.user_id = c.user_id
                  where approve_status='1' and region_c = '".$region."' and year = '".date("Y")."' and month ='".$date[$x]."' group by month";
                }
                if($access_level == '4'){
                  $sql = "select sum(fo_male) as num1, sum(fo_female) as num2 from ta_daily_task a left join tourist_attraction b on a.ta_id = b.ta_id
                  left join ts_users c on b.user_id = c.user_id
                  where approve_status='1' and province_c = '".$province."' and year = '".date("Y")."' and month ='".$date[$x]."' group by month";
                }
                if($access_level < 4){
                  $sql = "select sum(fo_male) as num1, sum(fo_female) as num2 from ta_daily_task a left join tourist_attraction b on a.ta_id = b.ta_id
                  left join ts_users c on b.user_id = c.user_id
                  where approve_status='1' and province_c = '".$province."' and citymun_c = '".$citymun."' and year = '".date("Y")."' and month ='".$date[$x]."' group by month";

                }
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                  while($row = mysqli_fetch_assoc($result)) {
                      $data.=($row["num1"]+$row["num2"]).",";
                  }
                }
                else{
                    $data.="0".",";
                }
            }
            $data = substr($data, 0, -1);
            echo $data;

          ?>
          ],
        stack: 'foreign'
    }]
});

  </script>
</body>
</html>
