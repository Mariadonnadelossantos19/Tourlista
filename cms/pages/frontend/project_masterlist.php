<?php
  $page = "project_masterlist";
  include 'template/header.php';
?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Project Masterlist</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Project Masterlist</li>
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Masterlist of Encoded Projects</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>Tags</th>
                  <th>Project Code</th>
                  <th>Program Type</th>
                  <th>Year Approved</th>
                  <th>Project Title</th>
                  <th>Beneficiaries</th>
                  <th>Implementor</th>
                  <th>Status</th>
                  <th>Project Cost</th>
                  <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                      include '../../connection/connection.php';

                      // SQL query to retrieve data
                      $sql = "select project_id, project_code, short, year_approved, project_title, coop_name, implementor_name, prj_status_name, project_cost
                      from projects p
                      left join psi_project_types t on p.project_type = t.prj_type_id
                      left join psi_cooperators c on p.beneficiaries = c.coop_id
                      left join psi_implementors i on p.implementor = i.implementor_id
                      left join psi_project_status s on p.status = s.prj_status_id
                      order by p.date_encoded desc";

                      // Execute the query
                      $result = $conn->query($sql);

                      if ($result->num_rows > 0) {
                          while($row = $result->fetch_assoc()) {
                              echo "<tr>";
                              echo "<td></td>";
                              echo "<td>".$row["project_code"]."</td>";
                              echo "<td>".$row["short"]."</td>";
                              echo "<td>".$row["year_approved"]."</td>";
                              echo "<td>".$row["project_title"]."</td>";
                              echo "<td>".$row["coop_name"]."</td>";
                              echo "<td>".$row["implementor_name"]."</td>";
                              echo "<td>".$row["prj_status_name"]."</td>";
                              echo "<td>PhP ".number_format($row["project_cost"],2)."</td>";
                              echo '
                              <td style="text-align: center;">
                                  <div class="btn-group" role="group" aria-label="Basic example">
                                  <a href="view_project.php?id='.$row["project_id"].'" type="button" class="btn btn-primary btn-sm" title="view details">
                                    <i class="fas fa-eye"></i>
                                  </a>
                                  <a href="edit_project.php?id='.$row["project_id"].'" type="button" class="btn btn-success btn-sm" title="edit project">
                                    <i class="fas fa-edit"></i>
                                  </a>
                                  <a href="../backend/delete_project.php?id='.$row["project_id"].'" type="button" class="btn btn-danger btn-sm" title="delete project">
                                    <i class="fas fa-trash-alt"></i>
                                  </a>
                                </div>
                              </td>';
                              echo "</tr>";
                          }
                      } else {
                          echo "0 results";
                      }

                      // Close connection
                      $conn->close();

                      ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Tags</th>
                    <th>Project Code</th>
                    <th>Project Type</th>
                    <th>Year Approved</th>
                    <th>Project Title</th>
                    <th>Beneficiaries</th>
                    <th>Implementor</th>
                    <th>Status</th>
                    <th>Project Cost</th>
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
<?php
  include 'template/footer.php';
?>
 