<?php
  $page = "generate_report";
  include '../template/header.php';
  recordLog("Visited Generate Report");
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Generate Report   </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Generate Report  </li>
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
                <h3 class="card-title">Select Report to be Generated</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                  <label for="exampleInputEmail1">Select Report Type</label>
                  <select class="form-control" id="type" name="type" required onchange="onChange()">

                    <?php
                          if($_SESSION['level']=='1'){ 
                              echo
                              '<option value="DAE1A">Monthly Recording Format for Accommodation Establishment (DAE-1A)</option>
                              <option value="CUS">Convention Utilization Survey (CUS)</option>
                              ';
                          }
                          if($_SESSION['level']=='2'){
                              echo
                              '<option value="VAR1">Tourism Attraction Visitor Record (VAR-1)</option>
                              <option value="CUS">Convention Utilization Survey (CUS)</option>
                              ';
                          }
                          if($_SESSION['level']>2){
                              echo
                              '<option value="DAE3">Municipal/City/Province Monthly Record (DAE-3)</option>
                              <option value="TAVR">Tourist Attraction Visitors Record (TAVR)</option>
                              <option value="SAE1">Accommodation Establishment Inventory Data Sheet for LGUs (SAE-1)</option>
                              <option value="SAE2">Report on the Number of Rooms and Employees in AE by Type (SAE-2)</option>
                              <option value="FRMA">Report on the Regional Distribution of Travelers (Form A)</option>
                              <option value="FRMB">Report on the Regional/Provincial Distribution of Travelers (Local Tourist)</option>';

                              if($_SESSION['level']=='4'){echo '<option value="FRMA3">Report on the Regional Distribution of Travelers (Form A) per CITY/MUN</option>'; }

                              echo '
                              <option value="AE_MICE">MICE Summary for Accommodation Establishments</option>
                              <option value="TA_MICE">MICE Summary for Tourist Attractions</option>
                              <option value="SUM_AE">Annual Regional/Provincial/CityMun Summary Report of AE Visitors</option>
                              <option value="SUM_TA">Annual Regional/Provincial/CityMun Summary Report of TA Visitors</option>
                              <option value="SUM_AEM">Monthly Regional/Provincial/CityMun Summary Report of AE Visitors</option>
                              <option value="SUM_TAM">Monthly Regional/Provincial/CityMun Summary Report of TA Visitors</option>
                              ';
                          }
                              /*
                              <option value="DAE4">LGU Monthly Reporting Format by Type of Accommodation Establishment (DAE-4)</option>
                              <option value="R6">Annual Report on Supply and Demand Data from AE</option>
                              <option value="VAR2">Attraction Monthly Report (VAR-2)</option>
                              */

                    ?>
                    
                    
              
                    
                  </select>
              </div>
              <!-- /.form-group -->
            </div>
            <div class="col-md-2">
              <div class="form-group">
                  <label for="exampleInputEmail1">Reporting Year</label>
                  <select class="form-control" id="year" name="year" required>
                    <option value="2025">2025</option>
                    <option value="2024">2024</option>
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
                    <option value="2021">2021</option>
                    <option value="2020">2020</option>
                  </select>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-2" id="mon">
              <div class="form-group">
                  <label for="exampleInputEmail1">Reporting Month</label>
                  <select class="form-control" id="month" name="month" required>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                  </select>
              </div>
              <!-- /.form-group -->
            </div>

            <div class="col-md-1" id="sdate" style="display: none;">
              <div class="form-group">
                  <label for="exampleInputEmail1">Start Date</label>
                  <select class="form-control" id="start_date" name="start_date" required>
                    <?php
                      for($i=1; $i<32; $i++){
                          echo "<option value='".$i."'>".$i."</option>";
                    }
                    ?>
                  </select>
              </div>
              <!-- /.form-group -->
            </div>

            <div class="col-md-1" id="edate" style="display: none;">
              <div class="form-group">
                  <label for="exampleInputEmail1">End Date</label>
                  <select class="form-control" id="end_date" name="end_date" required>
                    <?php
                      for($i=1; $i<32; $i++){
                          echo "<option value='".$i."'>".$i."</option>";
                    }
                    ?>
                  </select>
              </div>
              <!-- /.form-group -->
            </div>

            <div class="col-md-2" id="p" <?php if($_SESSION['level']>4 || $_SESSION['level']<3 ){ echo 'style="display: none;"'; } ?>>
              <div class="form-group">
                  <label for="exampleInputEmail1">Province</label>
                  <select class="form-control" id="province" name="province" onchange="loadCM(this.value)" required <?php if($_SESSION['level']<5){ echo 'disabled'; } ?>>
                  <?php 
                          include '../../connection/connection.php';
                          $sql = "select * from province where region_c ='".$region."'";
                          $result = mysqli_query($conn, $sql);
                             if (mysqli_num_rows($result) > 0) {
                                  while($row = mysqli_fetch_assoc($result)) {
                                      echo "<option value='".$row['province_c']."'";
                                      if ($province == $row['province_c']){ 
                                        echo "selected"; 
                                      }
                                      echo ">".$row['province_m']."</option>";
                                  }
                              }

                    ?>
                  </select>
              </div>
              <!-- /.form-group -->
            </div>

            <div class="col-md-2" id="c" <?php if($_SESSION['level']>3 || $_SESSION['level']<3){ echo 'style="display: none;"'; } ?>>
              <div class="form-group">
                  <label for="exampleInputEmail1">City / Municipality</label>
                  <select class="form-control" id="citymun" name="citymun" <?php if($access_level == '3'){ echo "disabled";} ?> required>
                  <?php
                      $sql = "Select citymun_c, citymun_m from citymun where region_c = '".$region."' and province_c = '".$province."'";
                      if($access_level == '3'){
                          $sql = "Select citymun_c, citymun_m from citymun where region_c = '".$region."' and province_c = '".$province."'";
                      }
                      $result = mysqli_query($conn, $sql);
                      if (mysqli_num_rows($result) > 0) {
                          while($row = mysqli_fetch_assoc($result)) {
                              echo '<option class="form-control" value="'.$row["citymun_c"].'"';
                              if ($citymun == $row["citymun_c"]) { echo "selected"; } 
                              echo '>'.$row["citymun_m"].'</option>';
                          }
                      }
                    ?>
                  </select>
              </div>
              <!-- /.form-group -->
            </div>

          </div>
          </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="button" class="btn btn-success float-right" onclick="generateReport()">Generate Report</button>

            </div>

          </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
        <div class="col-12">
          <div class="card card-danger">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                Generated Report Form | <button type="button" class="btn btn-success btn-sm" onclick="download()">Download Report</button>
                </h3>
              </div>
              <!-- /.box-header -->
              <div id="box" class="card-body no-padding">
                <table class="table table-striped" style="text-align: left;" border="1" id="datatable">

                  <tr>
                  <th style="color: red;">No report generated / No data encoded for the selected report</th>
                  </tr>

                </table>
              </div>
              <!-- /.box-body -->
            </div>

            <!-- /.box-body -->
          </div>
        </div>
      </div> 
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include '../template/footer.php'; ?>

<script language="javascript">

function download() {
    var x = $('#type').val();
    var filename = "Report.xls";

    let file = new Blob([$('#box').html()], {type:"application/vnd.ms-excel"});
    let url = URL.createObjectURL(file);
    let a = $("<a />", {
      href: url,
      download: filename}).appendTo("body").get(0).click();
      e.preventDefault();
}

function generateReport(x){
    var url=$("#type").val()+".php";
    var year = $("#year").val();
    var province = $("#province").val();
    var citymun = $("#citymun").val();
    var month = $("#month").val();
    var start_date = $("#start_date").val();
    var end_date = $("#end_date").val();
    var region = '<?= $region; ?>';

    $.ajax({
      type: "GET",
      url: "../reports/"+url,
      data: {month, year, region, province, citymun, start_date, end_date},
      cache: false,
      beforeSend: function() {
        $('#datatable').html("<tr><td colspan='7' align='center'><img src='../images/loading.gif' /></td></tr>");
              },
      success: function(data){
        $("#datatable").html(data);
      }
    }); 
  }

function onChange(){
    if($("#type").val() == 'FRMA' || $("#type").val() == 'FRMB'){
        $('#mon').hide();
        $('#province').prop('disabled', true);
        <?php if($_SESSION['level']>3){echo "$('#c').hide();";} ?>
    }
    else if($("#type").val() == 'FRMA3'){
        $('#mon').hide();
        $('#c').show();
    }
    else if($("#type").val() == 'SUM_AE'){
        $('#mon').hide();
        $('#sdate').hide();
        $('#edate').hide();
    }
    else if($("#type").val() == 'SUM_TA'){
        $('#mon').hide();
        $('#sdate').hide();
        $('#edate').hide();
    }
    else if($("#type").val() == 'SUM_AEM'){
      $('#mon').show();  
      $('#sdate').show();
        $('#edate').show();
    }
    else if($("#type").val() == 'SUM_TAM'){
      $('#mon').show();  
      $('#sdate').show();
        $('#edate').show();
    }

    else{
      $('#mon').show();
      $('#c').hide();
      $('#province').prop('disabled', true);
      $('#sdate').hide();
      $('#edate').hide();
    }
}

function loadCM(province_c){
      var region_c = '<?= $region; ?>';
        $.ajax({
          type: "GET",
          url: "../crud/loadCityMun.php",
          cache: false,
          data: {region_c, province_c},
          success: function(data){
            $("#citymun").html(data);
          }
        });
}

</script>