<?php
  $page = "manage_user";
  include '../template/header.php';
  recordLog("Visited Manage User");
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage User Accounts </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage User Accounts </li>
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
                <h3 class="card-title">List of User Accounts</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Username</th>
                    <th>Province</th>
                    <th>City / Mun</th>
                    <th>Date Registered</th>
                    <th>Email Address</th>
                    <th>Verification</th>
                    <th>Access Level</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                $num=1;
                include '../../connection/connection.php';
                $approved = 0;
                $denied = 0;
                $pending = 0;
                $total = 0;
                $sql = "";
                if($_SESSION['level'] == '3'){
                      $sql = "
                      select distinct * from ts_users t
                      left join region r on (r.region_c = t. region_c)
                      left join province p on (p.province_c = t.province_c) and (p.region_c = r.region_c)
                      left join citymun c on (c.citymun_c = t.citymun_c) and (c.province_c = p.province_c) and (c.region_c = r.region_c)
                      where access_level < ".$_SESSION['level']." and
                      t.region_c = '".$region."' and t.province_c = '".$province."' and t.citymun_c = '".$citymun."' order by user_id asc";
                }
                if($_SESSION['level'] == '4'){
                      $sql = "
                      select distinct * from ts_users t
                      left join region r on (r.region_c = t. region_c)
                      left join province p on (p.province_c = t.province_c) and (p.region_c = r.region_c)
                      left join citymun c on (c.citymun_c = t.citymun_c) and (c.province_c = p.province_c) and (c.region_c = r.region_c)
                      where access_level < ".$_SESSION['level']." and
                      t.region_c = '".$region."' and t.province_c = '".$province."'  order by user_id asc";
                }
                if($_SESSION['level'] == '5'){
                      $sql = "
                      select distinct * from ts_users t
                      left join region r on (r.region_c = t. region_c)
                      left join province p on (p.province_c = t.province_c) and (p.region_c = r.region_c)
                      left join citymun c on (c.citymun_c = t.citymun_c) and (c.province_c = p.province_c) and (c.region_c = r.region_c)
                      where access_level < ".$_SESSION['level']." and
                      t.region_c = '".$region."' order by user_id asc";
                }

                if($_SESSION['level'] == '6'){
                  $sql = "
                  select distinct * from ts_users t
                  left join region r on (r.region_c = t. region_c)
                  left join province p on (p.province_c = t.province_c) and (p.region_c = r.region_c)
                  left join citymun c on (c.citymun_c = t.citymun_c) and (c.province_c = p.province_c) and (c.region_c = r.region_c)
                  where access_level < ".$_SESSION['level']." order by user_id asc";
            }

                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result)) {
                  
                echo '
                <tr>
                      <td>'.strtoupper($row['username']).'</td>
                      <td>'.$row['province_m'];
                      if($row['access_level']=='5'){
                        echo $row['region_m'];
                      }
                      echo '</td>
                      <td>'.$row['citymun_m'].'</td>
                      <td>'.$row['date_time_encoded'].'</td>
                      <td>'.base64_decode($row['email']).'</td>
                      <td>'; 
                      if($row['verified']==1){
                        echo '<span class="badge badge-info">verified</span>';
                      }
                      if($row['verified']==0){
                        echo '<span class="badge badge-secondary">not-verified</span>';
                      }
                      
                      echo '</td>
                      
                      <td style="color: blue;">';
                      if($row['access_level']=='1'){
                        echo 'AE User';
                      }
                      if($row['access_level']=='2'){
                        echo 'TA User';
                      }
                      if($row['access_level']=='3'){
                        echo 'City/Municipality User';
                      }
                      if($row['access_level']=='4'){
                        echo 'Provincial User';
                      }
                      if($row['access_level']=='5'){
                        echo 'Regional User';
                      }
                echo '</td><td>';
                      if($row['status']==0){
                        if($row['attempts']>2){
                          echo '<span class="badge badge-info">locked</span>';
                        }else{
                          echo '<span class="badge badge-warning">pending</span>';
                        }
                        
                        $pending++;
                        $total++;
                      }
                      if($row['status']==1){
                        echo '<span class="badge badge-success">approved</span>';
                        $approved++;
                        $total++;
                      }
                      if($row['status']==2){
                        echo '<span class="badge badge-danger">denied</span>';
                        $denied++;
                        $total++;
                      }

                echo  '</td>
                      <td>';
                      if($row['status']==0){
                        echo '
                              <a href="../crud/approve_user.php?id='.$row["user_id"].'" title="approved"><button class="btn btn-success btn-sm"><i class="fa fa-thumbs-up" onclick="sendSMS('.$row["mobile"].')"></i></button></a>
                              <a href="../crud/disapprove_user.php?id='.$row["user_id"].'" title="denied"><button class="btn btn-warning btn-sm"><i class="fa fa-thumbs-down"></i></button></a>
                              ';
                      }
                      if($row['status']==1){
                        echo '
                              <a href="../crud/disapprove_user.php?id='.$row["user_id"].'" title="denied"><button class="btn btn-warning btn-sm"><i class="fa fa-thumbs-down"></i></button></a>
                              

                              <a href="../crud/reset_user.php?id='.$row["user_id"].'" title="reset password to 12345678"><button class="btn btn-info btn-sm"><i class="fa fa-unlock"></i></button></a>
                              ';
                      }
                      if($row['status']==2){
                        echo '
                              <a href="../crud/approve_user.php?id='.$row["user_id"].'" title="approved"><button class="btn btn-success btn-sm" onclick="sendSMS('.$row["mobile"].')"><i class="fa fa-thumbs-up"></i></button></a>';
                        if($_SESSION['level']>4){
                          echo ' <a href="../crud/delete_user.php?id='.$row["user_id"].'" title="delete"><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>';
                        }

                             
                      }


                      echo '</td>
                </tr>';
                $num++;
              }
                ?>

                  </tbody>
                  <tfoot>
                  <tr>
                  <th>Username</th>
                    <th>Province</th>
                    <th>City / Mun</th>
                    <th>Date Registered</th>
                    <th>Email Address</th>
                    <th>Verification</th>
                    <th>Access Level</th>
                    <th>Status</th>
                    <th>Action</th>
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