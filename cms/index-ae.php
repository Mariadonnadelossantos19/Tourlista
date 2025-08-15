<?php
    session_start();
    error_reporting(E_ERROR | E_PARSE);
    if($_SESSION['id']=="") header("Location:../signin");
    include 'connection/connection.php';
    include 'connection/logs.php';

    $sql = "select username,email,mobile,region_m, u.region_c, p.province_c,c.citymun_c,access_level,photo from ts_users u
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
    $ae_id = 0;
    $sql1 = "select * from accommodation_establishment where user_id='".$_SESSION['id']."'";
    $result1 = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($result1) > 0) {
        while($row1 = mysqli_fetch_assoc($result1)) {
          $change = 1;
          $ae_id = $row1['ae_id'];
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
        <?php
            include 'connection/connection.php';

            $totalNotif = 0;
            $pendingUsers = 0;

            $sqlUsers = "SELECT COUNT(*) AS num FROM ts_users WHERE status = '0'";
            if($_SESSION['level']=='5'){
              $sqlUsers = "SELECT COUNT(*) AS num FROM ts_users WHERE region_c = '$region' and status = '0' and access_level < 5";
            }
            if($_SESSION['level']=='4'){
              $sqlUsers = "SELECT COUNT(*) AS num FROM ts_users WHERE region_c = '$region' and province_c = '$province' and status = '0' and access_level < 4";
            }
            if($_SESSION['level']=='3'){
              $sqlUsers = "SELECT COUNT(*) AS num FROM ts_users WHERE region_c = '$region' and province_c = '$province' and citymun_c = '$citymun' and status = '0' and access_level < 3";
            }
            $result = mysqli_query($conn, $sqlUsers);
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $pendingUsers = $row['num'];
            } else {
                echo "Error: " . mysqli_error($conn);
            }
          //  mysqli_close($conn);
        ?>

        <?php
            include 'connection/connection.php';

            $pendingAEs = 0;

            $sqlAEs = "SELECT COUNT(*) AS num FROM accommodation_establishment WHERE approve_status = '0'";
            if($_SESSION['level']=='5'){
              $sqlAEs = "SELECT COUNT(*) AS num FROM accommodation_establishment a left join ts_users u on a.user_id = u.user_id 
              WHERE region_c = '$region' and approve_status = '0'";
            }
            if($_SESSION['level']=='4'){
              $sqlAEs = "SELECT COUNT(*) AS num FROM accommodation_establishment a left join ts_users u on a.user_id = u.user_id 
               WHERE region_c = '$region' and province_c = '$province' and approve_status = '0'";
            }
            if($_SESSION['level']=='3'){
              $sqlAEs = "SELECT COUNT(*) AS num FROM accommodation_establishment a left join ts_users u on a.user_id = u.user_id
               WHERE region_c = '$region' and province_c = '$province' and citymun_c = '$citymun' and approve_status = '0'";
            }
            $result = mysqli_query($conn, $sqlAEs);
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $pendingAEs = $row['num'];
            } else {
                echo "Error: " . mysqli_error($conn);
            }
           // mysqli_close($conn);
        ?>

        <?php
            include 'connection/connection.php';

            $pendingTAs = 0;

            $sqlTAs = "SELECT COUNT(*) AS num FROM tourist_attraction WHERE approve_status = '0'";
            if($_SESSION['level']=='5'){
              $sqlTAs = "SELECT COUNT(*) AS num FROM tourist_attraction a left join ts_users u on a.user_id = u.user_id 
              WHERE region_c = '$region' and approve_status = '0'";
            }
            if($_SESSION['level']=='4'){
              $sqlTAs = "SELECT COUNT(*) AS num FROM tourist_attraction a left join ts_users u on a.user_id = u.user_id 
               WHERE region_c = '$region' and province_c = '$province' and approve_status = '0'";
            }
            if($_SESSION['level']=='3'){
              $sqlTAs = "SELECT COUNT(*) AS num FROM tourist_attraction a left join ts_users u on a.user_id = u.user_id
               WHERE region_c = '$region' and province_c = '$province' and citymun_c = '$citymun' and approve_status = '0'";
            }
            $result = mysqli_query($conn, $sqlTAs);
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $pendingTAs = $row['num'];
            } else {
                echo "Error: " . mysqli_error($conn);
            }
          //  mysqli_close($conn);
        ?>

        <?php
            include 'connection/connection.php';

            $mismatch = 0;

            $sqlMM = "SELECT COUNT(*) AS untallied_tasks FROM ae_daily_task a
                      LEFT JOIN accommodation_establishment b ON a.ae_id = b.ae_id
                      LEFT JOIN ts_users u ON b.user_id = u.user_id
                      WHERE (a.no_new_checkin != (a.no_male + a.no_female) OR a.no_new_checkin != (a.local_tourist + a.foreign_tourist + a.overseas_filipino))
                      AND b.approve_status = '1'";

            if($_SESSION['level']=='5'){
              $sqlMM = "SELECT COUNT(*) AS untallied_tasks FROM ae_daily_task a
                      LEFT JOIN accommodation_establishment b ON a.ae_id = b.ae_id
                      LEFT JOIN ts_users u ON b.user_id = u.user_id
                      WHERE (a.no_new_checkin != (a.no_male + a.no_female) OR a.no_new_checkin != (a.local_tourist + a.foreign_tourist + a.overseas_filipino))
                      AND u.region_c = '$region' AND b.approve_status = '1'";
            }
            if($_SESSION['level']=='4'){
              $sqlMM = "SELECT COUNT(*) AS untallied_tasks FROM ae_daily_task a
                      LEFT JOIN accommodation_establishment b ON a.ae_id = b.ae_id
                      LEFT JOIN ts_users u ON b.user_id = u.user_id
                      WHERE (a.no_new_checkin != (a.no_male + a.no_female) OR a.no_new_checkin != (a.local_tourist + a.foreign_tourist + a.overseas_filipino))
                      AND u.region_c = '$region' AND u.province_c = '$province' AND b.approve_status = '1'";
            }
            if($_SESSION['level']=='3'){
              $sqlMM = "SELECT COUNT(*) AS untallied_tasks FROM ae_daily_task a
                      LEFT JOIN accommodation_establishment b ON a.ae_id = b.ae_id
                      LEFT JOIN ts_users u ON b.user_id = u.user_id
                      WHERE (a.no_new_checkin != (a.no_male + a.no_female) OR a.no_new_checkin != (a.local_tourist + a.foreign_tourist + a.overseas_filipino))
                      AND u.region_c = '$region' AND u.province_c = '$province' AND u.citymun_c = '$citymun' AND b.approve_status = '1'";
            }
            $result = mysqli_query($conn, $sqlMM);
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $mismatch = $row['untallied_tasks'];
            } else {
                echo "Error: " . mysqli_error($conn);
            }
          //  mysqli_close($conn);
        ?>
        <?php
        $notification = ($pendingUsers + $pendingAEs + $pendingTAs + $mismatch);
        ?>

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown" <?php if($_SESSION['level']<3){ echo 'style="display:none"';} ?>>
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge"><?=$notification?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"><?=$notification?> Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="pages/core/manage_user.php" class="dropdown-item">
            <i class="fas fa-users mr-2"></i>Users for Approval
            <span class="float-right text-muted text-sm"><?=$pendingUsers?> user(s)</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="pages/core/manage_accommodation.php" class="dropdown-item">
            <i class="fas fa-building mr-2"></i>Pending AEs
            <span class="float-right text-muted text-sm"><?=$pendingAEs?> establishment(s)</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="pages/core/manage_attraction.php" class="dropdown-item">
            <i class="fas fa-binoculars mr-2"></i>Pending TAs
            <span class="float-right text-muted text-sm"><?=$pendingTAs?> attraction(s)</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="pages/core/manage_encoding.php" class="dropdown-item">
            <i class="fas fa-file mr-2"></i>Mismatch Data
            <span class="float-right text-muted text-sm"><?=$mismatch?> encoding</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>

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
            <a href="../cms" class="nav-link active">
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
            <a href="pages/core/ae_monthly_encoding.php" class="nav-link <?php if($page == "ae_monthly_encoding"){ echo "active"; } ?>">
              <i class="nav-icon fas fa-folder-open"></i>
              <p>
              AE Data Encoding
              </p>
            </a>
          </li>
          <li class="nav-item">
              <a href="pages/core/ta_monthly_encoding.php" class="nav-link <?php if($page == "ta_monthly_encoding"){ echo "active"; } ?>">
                <i class="nav-icon fas fa-folder-open"></i>
                <p>
                TA Data Encoding
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
          <li class="nav-item">
            <a href="pages/core/manage_encoding.php" class="nav-link <?php if($page == "manage_encoding"){ echo "active"; } ?>">
              <i class="nav-icon fas fa-laptop"></i>
              <p>
                Manage Encoding
              </p>
            </a>
          </li>
        <?php } if($_SESSION['level']>4){ ?>



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
            <h1 class="m-0">
                <?php
                    if($_SESSION['level']>4){
                        echo 'Regional Accommodation Establishment Dashboard | <a type="button" class="btn btn-primary btn-sm" href="index-ta.php">Click to View Tourist Attraction Dashboard</a>';
                    }
                    if($_SESSION['level']=='4'){
                        echo 'Provincial Accommodation Establishment Dashboard | <a type="button" class="btn btn-secondary btn-sm" href="index-ta.php">Click to View Tourist Attraction Dashboard</a>';
                    }
                    if($_SESSION['level']=='3'){
                        echo 'Local Accommodation Establishment Dashboard | <a type="button" class="btn btn-primary btn-sm" href="index-ta.php">Click to View Tourist Attraction Dashboard</a>';
                    }
                    if($_SESSION['level']=='2'){
                        echo 'Tourist Attraction Dashboard';
                    }
                    if($_SESSION['level']=='1'){
                        echo 'Accommodation Establishment Dashboard';
                    }
                ?>
            </h1> 
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

                    if($access_level == '3'){
                      $sql = "select count(*) as num from accommodation_establishment ae
                      left join ts_users u on ae.user_id = u.user_id
                      where approve_status = '1' and province_c = '".$province."' and citymun_c = '".$citymun."'";
                    }

                    if($access_level == '1'){
                        $sql = "select count(*) as num from accommodation_establishment ae
                        left join ts_users u on ae.user_id = u.user_id
                        where approve_status = '1' and province_c = '".$province."' and citymun_c = '".$citymun."' and ae_id = '".$ae_id."'";
                    }

                    $result = mysqli_query($conn, $sql);
                    
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            if($access_level == '1'){
                              if($row["num"]==1){
                                echo 'Approved';
                              }else{
                                echo 'For Review';
                              }
                            }
                            else{ echo $row["num"];}
                        }
                    }
                    

                ?>
                </h3> 

              <p>
                <?php
                  if($access_level == '1'){ echo 'Status of AE Approval';}else{ echo 'Accommodation Establishments';}
                ?>
              </p>
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
              <h3>
              <?php
                    include 'connection/connection.php';
                    $local_ae = 0;
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
                    if($access_level == '3'){
                      $sql = "select sum(local_tourist) as local_tourist from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id
                      left join ts_users c on b.user_id = c.user_id
                      where province_c = '".$province."' and citymun_c = '".$citymun."' and year = '".date("Y")."' and approve_status = '1'";
                    }
                    if($access_level == '1'){
                        $sql = "select sum(local_tourist) as local_tourist from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id
                      left join ts_users c on b.user_id = c.user_id
                      where province_c = '".$province."' and citymun_c = '".$citymun."' and year = '".date("Y")."' and a.ae_id = '".$ae_id."' and approve_status = '1'";
                    }
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $local_ae+=$row["local_tourist"];
                        }
                    }
                    echo number_format($local_ae);
                    

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
          <div class="small-box bg-yellow">
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
                    if($access_level == '3'){
                      $sql = "select sum(foreign_tourist) as foreign_tourist from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id
                      left join ts_users c on b.user_id = c.user_id
                      where province_c = '".$province."' and citymun_c = '".$citymun."' and year = '".date("Y")."' and approve_status = '1'";
                    }
                    if($access_level == '1'){
                        $sql = "select sum(foreign_tourist) as foreign_tourist from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id
                        left join ts_users c on b.user_id = c.user_id
                        where province_c = '".$province."' and citymun_c = '".$citymun."' and year = '".date("Y")."' and approve_status = '1' and a.ae_id = '".$ae_id."'";
                      }
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $foreign_ae+=$row["foreign_tourist"];
                        }
                    }
                    echo number_format($foreign_ae);
                    

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
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php
                    include 'connection/connection.php';
                    $overseas_ae = 0;
                    $sql = "select sum(overseas_filipino) as overseas_filipino from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id where year = '".date("Y")."' and approve_status = '1'";
                    if($access_level == '5'){
                      $sql = "select sum(overseas_filipino) as overseas_filipino from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id
                      left join ts_users c on b.user_id = c.user_id
                      where region_c = '".$region."' and year = '".date("Y")."' and approve_status = '1'";
                    }
                    if($access_level == '4'){
                      $sql = "select sum(overseas_filipino) as overseas_filipino from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id
                      left join ts_users c on b.user_id = c.user_id
                      where province_c = '".$province."' and year = '".date("Y")."' and approve_status = '1'";
                    }
                    if($access_level == '3'){
                      $sql = "select sum(overseas_filipino) as overseas_filipino from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id
                      left join ts_users c on b.user_id = c.user_id
                      where province_c = '".$province."' and citymun_c = '".$citymun."' and year = '".date("Y")."' and approve_status = '1'";
                    }
                    if($access_level == '1'){
                        $sql = "select sum(overseas_filipino) as overseas_filipino from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id
                        left join ts_users c on b.user_id = c.user_id
                        where province_c = '".$province."' and citymun_c = '".$citymun."' and year = '".date("Y")."' and approve_status = '1' and a.ae_id = '".$ae_id."'";
                      }
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $overseas_ae+=$row["overseas_filipino"];
                        }
                    }
                    echo number_format($overseas_ae);
                    

                ?></h3>

              <p>Overseas Filipino Visitors</p>
            </div>
            <div class="icon">
              <i class="fa fa-car"></i>
            </div>
            <a href="#" class="small-box-footer"><i class="fa fa-calendar"></i> As of <?php echo date("F d, Y") ?></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- Info boxes --><br />
      <h3>Sex Disaggregated Data</h3>
      <div class="row">
        <?php
                    include 'connection/connection.php';
                    $emp_female = 0;
                    $emp_male = 0;
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
                    
                    if($access_level == '3'){
                      $sql = "SELECT SUM(no_regular_male) AS reg_male, SUM(no_on_call_male) AS oncall_male, SUM(no_regular_female) AS reg_female,
                      SUM(no_on_call_female) AS oncall_female FROM accommodation_establishment ae left join ts_users u on ae.user_id = u.user_id WHERE approve_status = '1' and province_c = '".$province."' and citymun_c = '".$citymun."'";
                    }

                    if($access_level == '1'){
                        $sql = "SELECT SUM(no_regular_male) AS reg_male, SUM(no_on_call_male) AS oncall_male, SUM(no_regular_female) AS reg_female,
                        SUM(no_on_call_female) AS oncall_female FROM accommodation_establishment ae left join ts_users u on ae.user_id = u.user_id WHERE approve_status = '1' and province_c = '".$province."' and citymun_c = '".$citymun."' and ae_id = '".$ae_id."'";
                      }

                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $emp_female = number_format($row["reg_female"]+$row["oncall_female"]);
                            $emp_male = number_format($row["reg_male"]+$row["oncall_male"]);
                        }
                    }

        ?>
        <?php
                    include 'connection/connection.php';
                    $total_male = 0;
                    $total_female = 0;
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
                    if($access_level == '3'){
                      $sql = "select sum(no_male) as male, sum(no_female) as female from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id
                      left join ts_users c on b.user_id = c.user_id
                      where province_c = '".$province."' and citymun_c = '".$citymun."' and year = '".date('Y')."' and approve_status = '1'";
                    }
                    if($access_level == '1'){
                        $sql = "select sum(no_male) as male, sum(no_female) as female from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id
                        left join ts_users c on b.user_id = c.user_id
                        where province_c = '".$province."' and citymun_c = '".$citymun."' and year = '".date('Y')."' and approve_status = '1' and a.ae_id = '".$ae_id."'";
                      }
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $total_male+=$row["male"];
                            $total_female+=$row["female"];
                        }
                    }

        ?>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-pink"><i class="fa  fa-venus-mars"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total Female Employees</span>
              <span class="info-box-number">
              <?= $emp_female; ?>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-primary"><i class="fa fa-venus-mars"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Male Employees</span>
              <span class="info-box-number">
              <?= $emp_male; ?>
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
            <span class="info-box-icon bg-pink"><i class="fa fa-venus-mars"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Female Visitors</span>
              <span class="info-box-number">
              <?= $total_female; ?>
             </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-primary"><i class="fa fa-venus-mars"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Male Visitors</span>
              <span class="info-box-number">
              <?= $total_male; ?>
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
    credits: {
        enabled: false
    },
    plotOptions: {
        column: {
            borderRadius: '25%'
        }
    },
    series: [{
        name: 'Domestic Visitors',
        data: [          <?php
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
                if($access_level == '3'){
                  $sql = "select sum(local_tourist) as num from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id 
                  left join ts_users c on b.user_id = c.user_id
                  where approve_status='1' and province_c = '".$province."' and citymun_c = '".$citymun."' and year = '".date("Y")."' and month ='".$date[$x]."' group by month";

                }
                if($access_level == '1'){
                    $sql = "select sum(local_tourist) as num from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id 
                    left join ts_users c on b.user_id = c.user_id
                    where approve_status='1' and a.ae_id = '".$ae_id."' and province_c = '".$province."' and citymun_c = '".$citymun."' and year = '".date("Y")."' and month ='".$date[$x]."' group by month";
  
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

          ?>]
    }, {
        name: 'Foreign Visitors',
        data: [<?php
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
                if($access_level == '3'){
                  $sql = "select sum(foreign_tourist) as num from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id
                  left join ts_users c on b.user_id = c.user_id
                  where approve_status='1' and province_c = '".$province."' and citymun_c = '".$citymun."' and year = '".date("Y")."' and month ='".$date[$x]."' group by month";

                }
                if($access_level == '1'){
                    $sql = "select sum(foreign_tourist) as num from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id
                    left join ts_users c on b.user_id = c.user_id
                    where approve_status='1' and a.ae_id = '".$ae_id."' and province_c = '".$province."' and citymun_c = '".$citymun."' and year = '".date("Y")."' and month ='".$date[$x]."' group by month";
  
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

          ?>]
    }, {
        name: 'Overseas Filipino',
        data: [
            <?php
            include 'connection/connection.php';
            $date = array("1","2","3","4","5","6","7","8","9","10","11","12");
            $data = "";
            for($x = 0; $x<12; $x++){
                $sql = "select sum(overseas_filipino) as num from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id where approve_status='1' and year = '".date("Y")."' and month ='".$date[$x]."' group by month";
                if($access_level == '5'){
                  $sql = "select sum(overseas_filipino) as num from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id 
                  left join ts_users c on b.user_id = c.user_id
                  where approve_status='1' and region_c = '".$region."' and year = '".date("Y")."' and month ='".$date[$x]."' group by month";
                }
                if($access_level == '4'){
                  $sql = "select sum(overseas_filipino) as num from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id 
                  left join ts_users c on b.user_id = c.user_id
                  where approve_status='1' and province_c = '".$province."' and year = '".date("Y")."' and month ='".$date[$x]."' group by month";
                }
                if($access_level == '3'){
                  $sql = "select sum(overseas_filipino) as num from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id
                  left join ts_users c on b.user_id = c.user_id
                  where approve_status='1' and province_c = '".$province."' and citymun_c = '".$citymun."' and year = '".date("Y")."' and month ='".$date[$x]."' group by month";

                }
                if($access_level == '1'){
                    $sql = "select sum(overseas_filipino) as num from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id
                    left join ts_users c on b.user_id = c.user_id
                    where approve_status='1' and a.ae_id = '".$ae_id."' and province_c = '".$province."' and citymun_c = '".$citymun."' and year = '".date("Y")."' and month ='".$date[$x]."' group by month";
  
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
        ]
    }]
});

  </script>
</body>
</html>
