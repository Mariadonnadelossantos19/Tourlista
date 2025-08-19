<?php
  $page = "manage_accommodation";
  include '../template/header.php';
  recordLog("Visited Manage Accommodation");
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Accommodation Establishment </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage Accommodation Establishment</li>
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
                <h3 class="card-title">List of Accommodation Establishments</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                        <th>Establishment</th>
                        <th>Province</th>
                        <th>City/Municipality</th>
                        <th>Type</th>
                        <th>Updating Request</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                  <?php
                  $num=1;
                  include '../../../connection/connection.php';
                  $ae_approved = 0;
                  $ae_denied = 0;
                  $ae_pending = 0;
                  $ae_total = 0;
                  $sql = "";

                  if($_SESSION['level'] == '3'){
                        $sql = "
                        select distinct * from accommodation_establishment a
                        left join ts_users t on (t.user_id = a.user_id)
                        left join region r on (r.region_c = t. region_c)
                        left join province p on (p.province_c = t.province_c) and (p.region_c = r.region_c)
                        left join citymun c on (c.citymun_c = t.citymun_c) and (c.province_c = p.province_c) and (c.region_c = r.region_c)
                        where t.access_level < ".$_SESSION['level']." and
                        t.region_c = '".$region."' and t.province_c = '".$province."' and t.citymun_c = '".$citymun."' order by ae_id desc";
                  }
                  if($_SESSION['level'] == '4'){
                        $sql = "
                        select distinct * from accommodation_establishment a
                        left join ts_users t on (t.user_id = a.user_id)
                        left join region r on (r.region_c = t. region_c)
                        left join province p on (p.province_c = t.province_c) and (p.region_c = r.region_c)
                        left join citymun c on (c.citymun_c = t.citymun_c) and (c.province_c = p.province_c) and (c.region_c = r.region_c)
                        where t.access_level < ".$_SESSION['level']." and
                        t.region_c = '".$region."' and t.province_c = '".$province."' order by ae_id desc";
                  }
                  if($_SESSION['level'] == '5'){
                        $sql = "
                        select distinct * from accommodation_establishment a
                        left join ts_users t on (t.user_id = a.user_id)
                        left join region r on (r.region_c = t. region_c)
                        left join province p on (p.province_c = t.province_c) and (p.region_c = r.region_c)
                        left join citymun c on (c.citymun_c = t.citymun_c) and (c.province_c = p.province_c) and (c.region_c = r.region_c)
                        where t.access_level < ".$_SESSION['level']." and
                        t.region_c = '".$region."' order by ae_id desc";
                  }

                  if (!empty($sql)) {
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)) {
                  echo '
                  <tr>
                        <td>'.strtoupper($row['ae_name']).'</td>
                        <td>'.$row['province_m'].'</td>
                        <td>'.$row['citymun_m'].'</td>
                        <td style="color: red;">'.strtoupper($row['type']).'</td>
                        <td>'; 
                            if($row['request_edit']==0){
                              echo '<span class="badge badge-info">not requested</span>';
                            }

                            if($row['request_edit']==1){
                              echo '<a href="../crud/approve_edit.php?id='.$row["ae_id"].'" class="badge badge-success">requested - click to grant</a>';
                            }

                            if($row['request_edit']==2){
                              echo '<span class="badge badge-success">granted</span>';
                            }
                        
                        echo '</td><td>';

                        if($row['approve_status']==0){
                          echo '<span class="badge badge-warning">pending</span>';
                          $ae_pending++;
                          $ae_total++;
                        }
                        if($row['approve_status']==1){
                          echo '<span class="badge badge-success">approved</span>';
                          $ae_approved++;
                          $ae_total++;
                        }
                        if($row['approve_status']==2){
                          echo '<span class="badge badge-danger">denied</span>';
                          $ae_denied++;
                          $ae_total++;
                        }

                        echo  '</td>
                              <td>
                              <a title="show details"><button class="btn btn-info btn-sm" onclick="getDetails('.$row["ae_id"].')"><i class="fa fa-book"></i></button></a></a>';
                              if($row['approve_status']==0){
                                echo '
                                      <a href="../crud/approve_ae.php?id='.$row["ae_id"].'" title="approved"><button class="btn btn-success btn-sm"><i class="fa fa-thumbs-up"></i></button></a>
                                      <a href="../crud/disapprove_ae.php?id='.$row["ae_id"].'" title="denied"><button class="btn btn-warning btn-sm"><i class="fa fa-thumbs-down"></i></button></a>
                                      ';
                              }
                              if($row['approve_status']==1){
                                echo '
                                      <a href="../crud/disapprove_ae.php?id='.$row["ae_id"].'" title="denied"><button class="btn btn-warning btn-sm"><i class="fa fa-thumbs-down"></i></button></a>
                                      ';
                              }
                              if($row['approve_status']==2){
                                echo '
                                      <a href="../crud/approve_ae.php?id='.$row["ae_id"].'" title="approved"><button class="btn btn-success btn-sm"><i class="fa fa-thumbs-up"></i></button></a>';
                                
                                      if($_SESSION['level']>4){
                                echo '
                                      <a href="../crud/delete_ae.php?id='.$row["ae_id"].'" title="delete"><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>
                                      ';
                              }
                              }


                              echo '</td>
                        </tr>';
                  $num++;
                }
                  }
                  ?>

                  </tbody>
                  <tfoot>
                  <tr>
                     <th>Establishment</th>
                     <th>Province</th>
                    <th>City/Municipality</th>
                    <th>Type</th>
                    <th>Updating Request</th>
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
        <!--MODAL -->
        <form action="../crud/update_ae_byuser.php" method="post">
        <div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Establishment Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <div class="modal-body">
          <table class="table table-striped">
          
            <thead>
              <tr>
                <th scope="col" style="width: 250px;">DESCRIPTION</th>
                <th scope="col">DETAILS</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Accommodation Establishment</th>
                <td id="a">-</td>
              </tr>
              <tr>
                <td>Complete Address</th>
                <td id="b">-</td>
              </tr>
              <tr>
                <td>Contact Number</th>
                <td id="c">-</td>
              </tr>
              <tr>
                <td>Email</th>
                <td id="d">-</td>
              </tr>
              <tr>
                <td>Type</th>
                <td id="e">-</td>
              </tr>
              <tr>
                <td>Manager</th>
                <td id="f">-</td>
              </tr>
              <tr>
                <td>Is Accredited?</th>
                <td id="q">-</td>
              </tr>
              <tr>
                <td>Accreditation Number</th>
                <td id="r">-</td>
              </tr>
              <tr>
                <td>Accreditation Valid From</th>
                <td id="s">-</td>
              </tr>
              <tr>
                <td>Accreditation Valid Until</th>
                <td id="t">-</td>
              </tr>
              <tr>
                <td>No. of Rooms</th>
                <td id="g">-</td>
              </tr>
              <tr>
                <td>Room Capacity</th>
                <td id="h">-</td>
              </tr>
              <tr>
                <td>Room Types</th>
                <td id="i">-</td>
              </tr>
              <tr>
                <td>Function Rooms</th>
                <td id="j">-</td>
              </tr>
              <tr>
                <td>Function Room Capacity</th>
                <td id="k">-</td>
              </tr>
              <tr>
                <td>Regular (Male)</th>
                <td id="l">-</td>
              </tr>
              <tr>
                <td>Regular (Female)</th>
                <td id="m">-</td>
              </tr>
              <tr>
                <td>On-Call (Male)</th>
                <td id="n">-</td>
              </tr>
              <tr>
                <td>On-Call (Female)</th>
                <td id="o">-</td>
              </tr>
              <tr>
                <td>Geolocation</th>
                <td id="p">-</td>
              </tr>
            </tbody>
          </table>
        </div>
        <input type='hidden' id='ae_id' name='id' />
        <div class="modal-footer">
          <button id="editButton" type="button" class="btn btn-primary" onclick="getDetails2(1)">Edit Details</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
  function getDetails(id){
      $.ajax({
      type: "GET",
      url: "../crud/load_ae_details.php",
      cache: false,
      data: {id},
      success: function(data){
        var result = $.parseJSON(data);
        $("#a").html(result.ae_name);
        $("#b").html(result.complete_address);
        $("#c").html(result.contact_number);
        $("#d").html(result.email);
        $("#e").html(result.type);
        $("#f").html(result.manager);
        $("#g").html(result.no_rooms);
        $("#h").html(result.room_capacity);
        $("#i").html(result.room_type);
        $("#j").html(result.no_function_room);
        $("#k").html(result.function_room_capacity);
        $("#l").html(result.no_regular_male);
        $("#m").html(result.no_regular_female);
        $("#n").html(result.no_on_call_male);
        $("#o").html(result.no_on_call_female);
        $("#p").html(result.geolocation);
        $("#q").html(result.is_accredited);
        $("#r").html(result.accreditation_number);
        $("#s").html(result.valid_from);
        $("#t").html(result.valid_to);
        $('#editButton').removeClass('btn-success').addClass('btn-primary');
        $('#editButton').attr('type', 'button');
        $('#editButton').text('Edit Details');
        $('#editButton').attr('onclick', 'getDetails2('+result.id+')');
        $('#myModal').modal('show');
      }
    }); 
  }

  function getDetails2(id){
      $.ajax({
      type: "GET",
      url: "../crud/load_ae_details.php",
      cache: false,
      data: {id},
      success: function(data){
        var result = $.parseJSON(data);
        $("#a").html("<input type='text' class='form-control' placeholder='Establishment Name' name='establishment_name' value='"+result.ae_name+"' />");
        $("#b").html("<input name='complete_address' type='text' class='form-control' value='"+result.complete_address+"' />");
        $("#c").html("<input name='contact_number' type='text' class='form-control' value='"+result.contact_number+"' />");
        $("#d").html("<input name='email' type='email' class='form-control' value='"+result.email+"' />");
        $("#e").html("<input name='type' type='text' class='form-control' value='"+result.type+"' />");
        $("#f").html("<input name='manager' type='text' class='form-control' value='"+result.manager+"' />");
        $("#g").html("<input name='no_rooms' type='number' class='form-control' value='"+result.no_rooms+"' />");
        $("#h").html("<input name='room_capacity' type='number' class='form-control' value='"+result.room_capacity+"' />");
        $("#i").html("<input name='room_type' type='text' class='form-control' value='"+result.room_type+"' />");
        $("#j").html("<input name='no_function_room' type='number' class='form-control' value='"+result.no_function_room+"' />");
        $("#k").html("<input name='function_room_capacity' type='number' class='form-control' value='"+result.function_room_capacity+"' />");
        $("#l").html("<input name='no_regular_m' type='number' class='form-control' value='"+result.no_regular_male+"' />");
        $("#m").html("<input name='no_regular_f' type='number' class='form-control' value='"+result.no_regular_female+"' />");
        $("#n").html("<input name='no_on_call_m' type='number' class='form-control' value='"+result.no_on_call_male+"' />");
        $("#o").html("<input name='no_on_call_f' type='number' class='form-control' value='"+result.no_on_call_female+"' />");
        $("#p").html("<input name='geolocation' type='text' class='form-control' value='"+result.geolocation+"' />");
        $("#q").html("<input name='is_accredited' type='text' class='form-control' value='"+result.is_accredited+"' />");
        $("#r").html("<input name='accreditation_number' type='text' class='form-control' value='"+result.accreditation_number+"' />");
        $("#s").html("<input name='valid_from' type='date' class='form-control' value='"+result.valid_from+"' />");
        $("#t").html("<input name='valid_to' type='date' class='form-control' value='"+result.valid_to+"' />");
        $("#ae_id").val(result.id);
        $('#editButton').removeClass('btn-primary').addClass('btn-success');
        $('#editButton').attr('type', 'submit');
        $('#editButton').text('Update Record');
        $('#myModal').modal('show');
      }
    }); 
  }
</script>