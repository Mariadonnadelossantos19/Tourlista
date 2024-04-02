<?php
  $page = "project_monitoring";
  include 'template/header.php';

?>

<?php

include '../../connection/connection.php';
$sql = "SELECT * FROM psi_percent p
left join projects proj on p.project_id = proj.project_id
left join psi_project_status projs on p.prj_status_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Fetch each row and store its data into separate variables
  while ($row = $result->fetch_assoc()) {
      $percent = $row['percent'];


  }
} else {
  echo "0 results";
}
$conn->close();
?>


 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Advanced Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Advanced Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

<!-- Default box -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Projects</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
        <i class="fas fa-minus"></i>
      </button>
 
    </div>
  </div>
  <div class="card-body p-0">
    <table class="table table-striped projects">
        <thead>
            <tr>
                <th style="width: 10%">
                    Project Code
                </th>
                <th style="width: 20%">
                    Project Title
                </th>
                <th style="width: 20%">
                    Project Description
                </th>
                </th>
                <th>
                    Project Progress
                </th>
                <th style="width: 8%" class="text-center">
                    Status
                </th>
                <th style="width: 20%" class="text-center">
                Action    
            </th>
            </tr>
        </thead>
        <tbody>
          <?php
              include '../../connection/connection.php';

                      // SQL query to retrieve data
                      $sql = "SELECT percent_id, project_code, project_title, project_desc, percent, prj_status_name FROM psi_percent p
                      left join projects pro on p.project_id = pro.project_id
                      left join psi_project_status projs on p.prj_status_id = projs.prj_status_id";

                      // Execute the query
                      $result = $conn->query($sql);

                      if ($result->num_rows > 0) {
                          while($row = $result->fetch_assoc()) {
                              echo "<tr>";
                              echo "<td>".$row["project_code"]."</td>";
                              echo "<td>".$row["project_title"]."</td>";
                              echo "<td>".$row["project_desc"]."</td>";
                              echo "<td class='project_progress'>
                              <div class='progress progress-sm'>
                                  <div class='progress-bar bg-green' role='progressbar' aria-valuenow='".$row["percent"]."' aria-valuemin='0' aria-valuemax='100' style='width:".$row["percent"]."%'>
                                  </div>
                              </div>
                              <small>
                                  ".$row["percent"]."% Complete
                              </small>
                          </td>";
                              echo "<td class='project-state'><span class='badge badge-success' data-toggle='modal' data-target='#viewMyModal'>".$row["prj_status_name"]."</span></td>";
                              echo '<td class="project-actions text-right">
                    <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#viewMyModal">
                        <i class="fas fa-folder">
                        </i>
                        View 
                    </a>
                    <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#editMyModal">
                        <i class="fas fa-pencil-alt">
                        </i>;
                        Edit
                    </a>
                    <a class="btn btn-danger btn-sm" href="#">
                        <i class="fas fa-trash">
                        </i>
                        Delete
                    </a>
                </td>';
                              }}
                              ?>
        </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->

<div class="modal fade" id="viewMyModal" role="dialog">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          
          <h4 class="modal-title">Modal Header</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p>This is a large modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editMyModal" role="dialog">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Modal Header</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p>This is a large modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>



</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php
  include 'template/footer.php';
?>
 