<?php
  $page = "training_masterlist";
  include 'template/header.php';
?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Forum/Training/Seminar Masterlist</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Forum/Training/Seminar Masterlist</li>
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
                <h3 class="card-title">Masterlist of Encoded Forum/Training/Seminar</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>Type</th>
                  <th>Title</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Implementor</th>
                  <th>Sectors</th>
                  <th>Training Cost</th>
                  <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                      include '../../connection/connection.php';

                      // SQL query to retrieve data
                      $sql = "SELECT training_id, fr_type_name, training_title, start_date, end_date, implementor_name, sector_name, training_cost
                      FROM trainings t
                      left join psi_fora_types f on t.training_type = f.fr_type_id
                      left join psi_implementors i on t.implementor = i.implementor_id
                      left join psi_sectors s on t.sectors = s.sector_id
                      order by t.date_encoded desc";


                      // Execute the query
                      $result = $conn->query($sql);

                      if ($result->num_rows > 0) {
                          while($row = $result->fetch_assoc()) {
                              echo "<tr>";
                              echo "<td>".$row["fr_type_name"]."</td>";
                              echo "<td>".$row["training_title"]."</td>";
                              echo "<td>".$row["start_date"]."</td>";
                              echo "<td>".$row["end_date"]."</td>";
                              echo "<td>".$row["implementor_name"]."</td>";
                              echo "<td>".$row["sector_name"]."</td>";
                              echo "<td>PhP ".number_format($row["training_cost"],2)."</td>";
                              echo '
                              <td style="text-align: center;">
                                  <div class="btn-group" role="group" aria-label="Basic example">
                                  <a href="view_training.php?id='.$row["training_id"].'" type="button" class="btn btn-primary btn-sm" title="view details">
                                    <i class="fas fa-eye"></i>
                                  </a>
                                  <a href="edit_training.php?id='.$row["training_id"].'" type="button" class="btn btn-success btn-sm" title="edit project">
                                    <i class="fas fa-edit"></i>
                                  </a>
                                  <a href="../backend/delete_training.php?id='.$row["training_id"].'" type="button" class="btn btn-danger btn-sm" title="delete project">
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
                  <th>Title</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Implementor</th>
                  <th>Sectors</th>
                  <th>Training Cost</th>
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
 