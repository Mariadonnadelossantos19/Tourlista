<?php
  $page = "statistics";
  include '../template/header.php';
  recordLog("Visited Summary and Statistics");
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Summary and Statistics  </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Summary and Statistics  </li>
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
                <h3 class="card-title">Filter the summary to be generated</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                  <label for="exampleInputEmail1">Select Summary Type</label>
                  <select class="form-control" id="type" name="type" onchange="showFilter(this.value)" required>
                    <?php if($access_level == '5'){ ?>
                        <option value="ARS">AE Regional Summary Report</option>
                        <option value="TRS">TA Regional Summary Report</option>
                    <?php } ?>
                    <?php if($access_level == '5' || $access_level == '4'){ ?>
                        <option value="APS">AE Provincial Summary Report</option>
                        <option value="TPS">TA Provincial Summary Report</option>
                    <?php } ?>
                    <option value="ACS">AE City/Municipal Summary Report</option>
                    <option value="TCS">TA City/Municipal Summary Report</option>
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

            <div class="col-md-3" id="p" <?php if($access_level=='4' || $access_level == '3'){ echo 'style="display: block;"'; } else{

            echo 'style="display: none;"';} ?>>
              <div class="form-group">
                  <label for="exampleInputEmail1">Province</label>
                  <select class="form-control" id="province" name="province" onchange="loadCM(this.value)" <?php if($access_level == '4' || $access_level == '3'){ echo "disabled";} ?> required>
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

            <div class="col-md-3" id="c" <?php if($access_level == '3'){ echo 'style="display: block;"'; } else{ echo 'style="display: none;"';} ?>>
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
            <!-- /.col -->
          </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="button" class="btn btn-success float-right" onclick="generateReport()">Generate Summary</button>

            </div>

            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="modal" tabindex="-1" role="dialog" id="myModal" data-backdrop="static">
            <div class="modal-dialog modal-lg" role="document">
            
            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                Accommodation Establishment Encoding Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body" id="dataform">
                
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            
            </div>
        </div>

        <div class="row">
        <div class="col-12">
          <div class="card card-danger">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  Generated Summary Report | <button type="button" class="btn btn-success btn-sm" onclick="download()">Download Report</button>
                </h3>
              </div>
              <!-- /.box-header -->
              <div id="box" class="card-body no-padding">
                <table class="table table-striped" style="text-align: left;" border='1' id="datatable">

                  <tr>
                    <th style="color: red;">No summary generated / No data encoded for the selected report</th>
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
  alert();
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

    $.ajax({
      type: "GET",
      url: "../reports/"+url,
      data: {year,province,citymun},
      cache: false,
      beforeSend: function() {
        $('#datatable').html("<tr><td colspan='7' align='center'><img src='../images/loading.gif' /></td></tr>");
      },
      success: function(data){
        $("#datatable").html(data);
      }
    }); 
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

  function showFilter(report){
      if(report == 'ARS' || report == 'TRS'){
        $('#p').hide();
        $('#c').hide();
      }
      if(report == 'APS' || report == 'TPS'){
        $('#p').show();
        $('#c').hide();
      }
      if(report == 'ACS' || report == 'TCS'){
        $('#p').show();
        $('#c').show();
      }
    }

  function generateReport2(r,y,p,c){
    var report = "";
    if(p<100){
      p="0"+p;
    }
    if(p<10){
      p="0"+p;
    }
    if(c<10){
      c="0"+c;
    }
   // alert(r+"/"+y+"/"+p+"/"+c);

    if(r==0){
        report = "ARS";
    }
    if(r==1){
        report = "TRS";
    }
    if(r==2){
        report = "APS";
    }
    if(r==3){
        report = "TPS";
    }
    if(r==4){
        report = "ACS";
    }
    if(r==5){
        report = "TCS";
    }
    var url=report+".php";
    var year = y;
    var province = p;
    var citymun = c;

    $.ajax({
      type: "GET",
      url: "../reports/"+url,
      data: {year,province,citymun},
      cache: false,
      beforeSend: function() {
        $('#datatable').html("<tr><td colspan='7' align='center'><img src='../images/loading.gif' /></td></tr>");
      },
      success: function(data){
        $("#datatable").html(data);
        $("#type").val(report);

        if(report == 'ARS' || report == 'TRS'){
          $('#p').hide();
        }
        
        if(report == 'APS' || report == 'TPS'){
          $('#p').show();
          $('#c').hide();
          $("#province").val(p);
          loadCM(p);
        }
        if(report == 'ACS' || report == 'TCS'){
          $('#p').show();
          $('#c').show();
          $("#citymun").val(c);
        }
      }
    }); 
  }
  function loadData(r,id,month,year){
    var report = "";
    if(r==6){
        report = "ASS";
    }
    if(r==7){
        report = "TSS";
    }
    var url=report+".php";
    $.ajax({
      type: "GET",
      url: "../reports/"+url,
      data: {id,month,year},
      cache: false,
      success: function(data){
        $("#dataform").html(data);
        
      }
    });

   if(r==6){
            $("#formtitle").html("Accommodation Establishment Encoding Details");
   }
   if(r==7){
            $("#formtitle").html("Tourist Attraction Encoding Details");
    }

    $('#myModal').modal('show');
  }

</script>