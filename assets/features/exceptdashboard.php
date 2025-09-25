
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>tourLISTA - Tourism Live-Inventory and Statistics of Tourist Arrivals</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../cms/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../cms/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../cms/bower_components/Ionicons/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../cms/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../cms/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../cms/dist/css/skins/_all-skins.min.css">
  <link rel="icon" href="../images/tl.png">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body>
<div>
  <!-- Left side column. contains the logo and sidebar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div><h1 style="color: #0099F1;">TOURLISTA REGIONAL SUMMARY AND STATISTICS</h1></div>
      <h1>
        Application Dashboard
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-hotel"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Accommodation Establishments</span>
              <span class="info-box-number">
                <?php
                    include '../../cms/connection/connection.php';
                    $sql = "select count(*) as num from accommodation_establishment where approve_status = '1'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo $row["num"];
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
            <span class="info-box-icon bg-red"><i class="fa fa-flag"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Tourist Attractions</span>
              <span class="info-box-number">
                 <?php
                    include '../../cms/connection/connection.php';
                    $sql = "select count(*) as num from tourist_attraction where approve_status = '1'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo $row["num"];
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
            <span class="info-box-icon bg-green"><i class="fa  fa-bicycle"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Local Tourist</span>
              <span class="info-box-number">

                <?php
                    include '../../cms/connection/connection.php';
                    $local_ae = 0;
                    $local_ta = 0;
                    $total = 0;
                    $sql = "select sum(local_tourist) as local_tourist from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id where year = '".date("Y")."' and approve_status = '1'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $local_ae+=$row["local_tourist"];
                        }
                    }

                    $sql1 = "select sum(r_male) as r_male,sum(r_female) as r_female,sum(nr_male) as nr_male,sum(nr_female) as nr_female from ta_daily_task a left join tourist_attraction b on a.ta_id = b.ta_id where year = '".date("Y")."' and approve_status = '1'";
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
                    echo $total;
                    

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
            <span class="info-box-icon bg-yellow"><i class="fa  fa-plane"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Foreign Tourist</span>
              <span class="info-box-number">
                  <?php
                    include '../../cms/connection/connection.php';
                    $foreign_ae = 0;
                    $foreign_ta = 0;
                    $total = 0;
                    $sql = "select sum(foreign_tourist) as foreign_tourist from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id where year = '".date("Y")."' and approve_status = '1'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $foreign_ae+=$row["foreign_tourist"];
                        }
                    }

                    $sql1 = "select sum(fo_male) as fo_male,sum(fo_female) as fo_female from ta_daily_task a left join tourist_attraction b on a.ta_id = b.ta_id where year = '".date("Y")."' and approve_status = '1'";
                    $result1 = mysqli_query($conn, $sql1);
                    if (mysqli_num_rows($result1) > 0) {
                        while($row1 = mysqli_fetch_assoc($result1)) {
                            $foreign_ta+=$row1["fo_male"];
                            $foreign_ta+=$row1["fo_female"];
                        }
                    }

                    $total = ($foreign_ae+$foreign_ta);
                    echo $total;
                    

                ?>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Monthly Recap Report</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-wrench"></i></button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </div>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
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

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
          <!-- MAP & BOX PANE -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Tourism Map</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="row">
                  <div class="col-md-12">
                    <iframe src="../features/map.php" width="100%" height="400px"> </iframe>
              </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- /.row -->

          <!-- TABLE: LATEST ORDERS -->
          <div class="col-md-6">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Top 5 Accommodation Establishment</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Rank</th>
                    <th>Establishment</th>
                    <th>Type</th>
                    <th>Total Guest</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  include '../../cms/connection/connection.php';
                      $sql = "select ae_name, type, sum(local_tourist+foreign_tourist) as total from ae_daily_task dt left join accommodation_establishment ae on dt.ae_id = ae.ae_id where approve_status = '1' group by dt.ae_id order by total desc limit 5";
                      $result = mysqli_query($conn, $sql);
                      $x = 1;
                      if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "
                            <tr>
                            <td>".$x."</td>
                            <td>".$row["ae_name"]."</td>
                            <td><span class='label label-success'>".$row["type"]."</span></td>
                            <td>".$row["total"]."</td>
                            </tr>";
                            $x++;
                        }
                        
                      }
                ?>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Establishments</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>

        <div class="col-md-6">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Top 5 Tourist Attraction</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table class="table no-margin">
                <thead>
                <tr>
                  <th>Rank</th>
                  <th>Attraction</th>
                  <th>Type</th>
                  <th>Total Visitors</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  include '../../cms/connection/connection.php';
                      $sql = "select ta_name, ta_type, sum(nr_male+nr_female+r_male+r_female+fo_male+fo_female) as total from ta_daily_task dt left join tourist_attraction ta on dt.ta_id = ta.ta_id left join ta_type on ta.type = ta_type.ta_type_id where approve_status='1' group by dt.ta_id order by total desc limit 5";
                      $result = mysqli_query($conn, $sql);
                      $x = 1;
                      if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "
                            <tr>
                            <td>".$x."</td>
                            <td>".$row["ta_name"]."</td>
                            <td><span class='label label-info'>".$row["ta_type"]."</span></td>
                            <td>".$row["total"]."</td>
                            </tr>";
                            $x++;
                        }

                      }
                ?>
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix">
            <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Attractions</a>
          </div>
          <!-- /.box-footer -->
        </div>
        <!-- /.box -->
      </div>
      </div>
        <!-- /.col -->
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>


</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../cms/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../cms/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../cms/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../cms/dist/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="../cms/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="../cms/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../cms/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="../cms/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<script src="../cms/bower_components/chart.js/Chart.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../cms/dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
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
            include '../../cms/connection/connection.php';
            $date = array("1","2","3","4","5","6","7","8","9","10","11","12");
            $data = "";
            for($x = 0; $x<12; $x++){
                $sql = "select sum(local_tourist) as num from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id where approve_status='1' and year = '".date("Y")."' and month ='".$date[$x]."' group by month";
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
            include '../../cms/connection/connection.php';
            $date = array("1","2","3","4","5","6","7","8","9","10","11","12");
            $data = "";
            for($x = 0; $x<12; $x++){
                $sql = "select sum(r_male) as num1, sum(r_female) as num2, sum(nr_male) as num3, sum(nr_female) as num4 from ta_daily_task a left join tourist_attraction b on a.ta_id = b.ta_id where approve_status='1' and year = '".date("Y")."' and month ='".$date[$x]."' group by month";
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
            include '../../cms/connection/connection.php';
            $date = array("1","2","3","4","5","6","7","8","9","10","11","12");
            $data = "";
            for($x = 0; $x<12; $x++){
                $sql = "select sum(foreign_tourist) as num from ae_daily_task a left join accommodation_establishment b on a.ae_id = b.ae_id where approve_status='1' and year = '".date("Y")."' and month ='".$date[$x]."' group by month";
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
            include '../../cms/connection/connection.php';
            $date = array("1","2","3","4","5","6","7","8","9","10","11","12");
            $data = "";
            for($x = 0; $x<12; $x++){
                $sql = "select sum(fo_male) as num1, sum(fo_female) as num2 from ta_daily_task a left join tourist_attraction b on a.ta_id = b.ta_id where approve_status='1' and year = '".date("Y")."' and month ='".$date[$x]."' group by month";
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
