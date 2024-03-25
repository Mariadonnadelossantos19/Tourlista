<?php
  $page = "consultancy_masterlist";
  include 'template/header.php';
?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Consultancy</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Consultancy</li>
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
                <h3 class="card-title">Masterlist of Consultancies</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>Type</th>
                  <th>Project</th>
                  <th>Cooperator</th>
                  <th>Service Provider</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Implementor</th>
                  <th>Consultancy Cost</th>
                  <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                      include '../../connection/connection.php';

                      // SQL query to retrieve data
                      $sql = "select consultancy_id, con_type_name, project_title, coop_name, 
                      sp_name, consultancy_start, consultancy_end, implementor_name, consultancy_cost
                      from consultancies c
                      left join psi_consultancy_types t on t.con_type_id = c.consultancy_type
                      left join projects p on p.project_id = c.project_id
                      left join psi_cooperators cc on c.cooperator_id = cc.coop_id
                      left join psi_service_providers s on s.sp_id = c.service_provider_id
                      left join psi_implementors i on i.implementor_id = c.implementor_id
                      order by c.date_encoded desc";

                      // Execute the query
                      $result = $conn->query($sql);

                      if ($result->num_rows > 0) {
                          while($row = $result->fetch_assoc()) {
                              echo "<tr>";
                              echo "<td>".$row["con_type_name"]."</td>";
                              echo "<td>".$row["project_title"]."</td>";
                              echo "<td>".$row["coop_name"]."</td>";
                              echo "<td>".$row["sp_name"]."</td>";
                              echo "<td>".$row["consultancy_start"]."</td>";
                              echo "<td>".$row["consultancy_end"]."</td>";
                              echo "<td>".$row["implementor_name"]."</td>";
                              echo "<td>PhP ".number_format($row["consultancy_cost"],2)."</td>";
                              echo '
                              <td style="text-align: center;">
                                  <div class="btn-group" role="group" aria-label="Basic example">
                                  <a href="view_consultancy.php?id='.$row["consultancy_id"].'" type="button" class="btn btn-primary btn-sm" title="view details">
                                    <i class="fas fa-eye"></i>
                                  </a>
                                  <a href="edit_consultancy.php?id='.$row["consultancy_id"].'" type="button" class="btn btn-success btn-sm" title="edit project">
                                    <i class="fas fa-edit"></i>
                                  </a>
                                  <a href="../backend/delete_consultancy.php?id='.$row["consultancy_id"].'" type="button" class="btn btn-danger btn-sm" title="delete project">
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
                  <th>Type</th>
                  <th>Project</th>
                  <th>Cooperator</th>
                  <th>Service Provider</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Implementor</th>
                  <th>Consultancy Cost</th>
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
 