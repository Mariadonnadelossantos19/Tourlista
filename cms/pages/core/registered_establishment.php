<?php
  $page = "registered_establishment";
  include '../template/header.php';
  recordLog("Visited Registered Establishment");
?>

<?php
    $sql1 = "select * from accommodation_establishment where user_id = '".$_SESSION['id']."'";
    $result1 = mysqli_query($conn, $sql1);
    $ae_id = "";
    $ae_name = "";
    $complete_address = "";
    $contact_number = "";
    $email = "";
    $type = "";
    $manager = "";
    $no_rooms = "";
    $room_capacity = "";
    $room_type = "";
    $no_function_room = "";
    $function_room_capacity = "";
    $function_room_details = "";
    $no_regular_male = "";
    $no_regular_female = "";
    $no_on_call_male = "";
    $no_on_call_female = "";
    $geolocation = "";
    $photos = "";
    $edit_request = "";
    $is_accredited = "";
    $accreditation_number = "";
    $valid_from = "";
    $valid_to = "";
    if (mysqli_num_rows($result1) > 0) {
        while($row1 = mysqli_fetch_assoc($result1)) {
          $ae_id = $row1["ae_id"];
          $ae_name = $row1["ae_name"];
          $complete_address = $row1["complete_address"];
          $contact_number = $row1["contact_number"];
          $email = $row1["email"];
          $type = $row1["type"];
          $manager = $row1["manager"];
          $no_rooms = $row1["no_rooms"];
          $room_capacity = $row1["room_capacity"];
          $room_type = $row1["room_type"];
          $no_function_room = $row1["no_function_room"];
          $function_room_capacity = $row1["function_room_capacity"];
          $function_room_details = $row1["function_room_details"];
          $no_regular_male = $row1["no_regular_male"];
          $no_regular_female = $row1["no_regular_female"];
          $no_on_call_male = $row1["no_on_call_male"];
          $no_on_call_female = $row1["no_on_call_female"];
          $geolocation = $row1["geolocation"];
          $photos = $row1["photo"];
          $edit_request = $row1["request_edit"];
          $is_accredited = $row1["is_accredited"];
          $accreditation_number = $row1["accreditation_number"];
          $valid_from = $row1["valid_from"];
          $valid_to = $row1["valid_to"];

        }
    }
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Accommodation Establishment  </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Update Accommodation Establishment </li>
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
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Basic Information |
                  <?php 
                  if($edit_request==0){
                    echo '<a href="../crud/request_edit.php?id='.$ae_id.'" class="badge badge-primary">Request to edit Establishment Name</a>';
                  }
                  if($edit_request==1){
                    echo '<span class="badge badge-warning">Request submitted to LGU Administrator</span>';
                  }
                  if($edit_request==2){
                    echo '<span class="badge badge-success">Request Granted</span>';
                  }
                  ?>

                
                
                
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form action="../crud/update_ae.php" method="POST">

              <div class="row">
                    <div class="col-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name of Accommodation Establishment</label>
                        <input type="text" name="establishment_name" class="form-control" placeholder="Enter name of accomodation establishment" value="<?php echo $ae_name; ?>" required <?php if($edit_request<2){ echo 'readonly'; } ?>>
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label for="exampleInputEmail1">Complete Address</label>
                        <input type="text" name="complete_address" class="form-control" placeholder="Enter address of accomodation establishment" value="<?php echo $complete_address; ?>" required>
                    </div>
                    <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Contact Number</label>
                        <input type="text" name="contact_number" class="form-control" placeholder="Enter contact number" value="<?php echo $contact_number; ?>" required>
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter email address" value="<?php echo $email; ?>" required>
                    </div>
                    <!-- /.form-group -->
                    </div>
                    <div class="col-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Type of Establishment</label>
                        <select class="form-control" name="type" required>
                            <option value="">Select Establishment Type</option>
                            <option value="Hotel" <?php if($type=="Hotel"){ echo "Selected";} ?>>Hotel</option>
                            <option value="Condotel" <?php if($type=="Condotel"){ echo "Selected";} ?>>Condotel</option>
                            <option value="Serviced Residence" <?php if($type=="Serviced Residence"){ echo "Selected";} ?>>Serviced Residence</option>
                            <option value="Resort" <?php if($type=="Resort"){ echo "Selected";} ?>>Resort</option>
                            <option value="Apartelle" <?php if($type=="Apartelle"){ echo "Selected";} ?>>Apartelle</option>
                            <option value="Motel" <?php if($type=="Motel"){ echo "Selected";} ?>>Motel</option>
                            <option value="Pension House" <?php if($type=="Pension House"){ echo "Selected";} ?>>Pension House</option>
                            <option value="Home Stay Site" <?php if($type=="Home Stay Site"){ echo "Selected";} ?>>Home Stay Site</option>
                            <option value="Tourist Inn" <?php if($type=="Tourist Inn"){ echo "Selected";} ?>>Tourist Inn</option>
                            <option value="Others" <?php if($type=="Others"){ echo "Selected";} ?>>Others</option>
                        </select>
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label for="exampleInputEmail1">General Manager</label>
                        <input type="text" name="manager" class="form-control" placeholder="Name of General Manager" value="<?php echo $manager; ?>" required>
                    </div>
                    <!-- /.form-group -->
                    </div>
                    <div class="col-3"> 
                    <div class="form-group">
                        <label for="exampleInputEmail1">Establishment Accredited?</label>
                        <select class="form-control" name="is_accredited" required>
                            <option value="yes" <?php if($is_accredited=="yes"){ echo "Selected";} ?>>YES</option>
                            <option value="no" <?php if($is_accredited=="no"){ echo "Selected";} ?>>NO</option>
                        </select>
                    </div>
                    <!-- /.form-group -->
                    </div>

                    <div class="col-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Accreditation Number</label>
                        <input type="text" name="accreditation_number" class="form-control" placeholder="Enter accreditation number" value="<?php echo $accreditation_number; ?>">
                    </div>
                    <!-- /.form-group -->
                    </div>

                    
                    <div class="col-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Validity From</label>
                        <input type="date" name="valid_from" class="form-control" placeholder="Accreditation Validity Period From" value="<?php echo $valid_from; ?>">
                    </div>
                    <!-- /.form-group -->
                    </div>

                    
                    <div class="col-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Validity To</label>
                        <input type="date" name="valid_to" class="form-control" placeholder="Accreditation Validity Period To" value="<?php echo $valid_to; ?>">
                    </div>
                    <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </div>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-6">
            <!-- /.card -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Rooms and Employees</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                    <!-- Date dd/mm/yyyy -->
                    <div class="form-group">
                        <label>Number of Rooms:</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-hotel"></i></span>
                        </div>
                        <input type="number" name="no_rooms" class="form-control" placeholder="Enter Number of Rooms" value="<?php echo $no_rooms; ?>" min="0" max="300" required>
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->

                    <div class="form-group">
                        <label>Total Capacity of Rooms:</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-users"></i></span>
                        </div>
                        <input type="number" name="room_capacity" class="form-control" placeholder="Enter Total Capacity of Rooms" value="<?php echo $room_capacity; ?>" min="0" max="1000" required>
                        </div>
                        <!-- /.input group -->
                    </div>

                    <div class="form-group">
                        <label>Type of Rooms:</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-address-card"></i></span>
                        </div>
                        <input type="text" name="room_type" class="form-control" placeholder="Enter Room Type (e.g. Suite, Deluxe, Regular, etc.)" value="<?php echo $room_type; ?>" required>
                        </div>
                        <!-- /.input group -->
                    </div>

                    <!-- Date mm/dd/yyyy -->
                    <div class="form-group">
                        <label>Number of Function Rooms:</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-home"></i></span>
                        </div>
                        <input type="number" name="no_function_room" id="num_of_function_rooms" class="form-control" min="0" max="20" placeholder="Enter Number of Function Rooms" value="<?= $no_function_room; ?>">
                        <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="addDetailsBtn"  data-bs-toggle="modal" data-bs-target="#functionRoomModal">Edit Details</button>
                            </div>  
                      </div>

                    <div class="form-group">
                        <label>Capacity of Function Rooms:</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-users"></i></span>
                        </div>
                        <input type="number" name="function_room_capacity" id="function_room_capacity" class="form-control" placeholder="Capacity of Function Rooms" value="<?= $function_room_capacity; ?>" readonly>
                        </div>
                        <!-- /.input group -->
                    </div>

                    <div class="form-group" style="display: none">
                        <label>Detail of Function Rooms:</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-users"></i></span>
                        </div>
                        <textarea name="function_room_details" id="function_room_details" class="form-control" placeholder="Detail of Function Rooms" readonly><?= $function_room_details; ?></textarea>
                        </div>
                        <!-- /.input group -->
                    </div> 

                    <div class="form-group">
                        <label>Number of Regular Employees:</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-male"></i></span>
                        </div>
                        <input type="number" name="no_regular_m" class="form-control" placeholder="Enter Number of Male Regular Employees" min="0" max="200" value="<?php echo $no_regular_male; ?>" required>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-female"></i></span>
                        </div>
                        <input type="number" name="no_regular_f" class="form-control" placeholder="Enter Number of Female Regular Employees" min="0" max="200" value="<?php echo $no_regular_female; ?>" required>
                        </div>
                        <!-- /.input group -->
                    </div>

                    <div class="form-group">
                        <label>Number of On-Call Employees:</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-male"></i></span>
                        </div>
                        <input type="number" name="no_on_call_m" class="form-control" placeholder="Number of Male on-call employees" min="0" max="200" value="<?php echo $no_on_call_male; ?>" required>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-female"></i></span>
                        </div>
                        <input type="number" name="no_on_call_f" class="form-control" placeholder="Number of Female on-call employees" min="0" max="200" value="<?php echo $no_on_call_female; ?>" required>
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div> </div>
          <!-- /.col -->

          <div class="col-6">
            <!-- /.card -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Image and Map Locations</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- Date dd/mm/yyyy -->
                <div class="form-group">
                    <label>Geolocation:</label>
                    <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-map-pin"></i></span>
                    </div>
                    <input type="text" name="geolocation" class="form-control" id="location" placeholder="Geolocation" value="<?php echo $geolocation; ?>" readonly>
                    <div class="input-group-addon">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal2">Change Geolocation</button>
                  </div>
                    </div>
                    <!-- /.input group -->
                </div>

                <div class="form-group">
                    <label>Map:</label>
                    <div>
                    <iframe src="maps.php" width="100%" height="335px"></iframe>
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleInputFile">Establishment Photo:</label>
                    <input type="file" name="aephoto" id="aephoto" accept="image/*" class="form-control-file">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

        </div>
        <div class="row justify-content-center">
        <div class="card-header">
            <div class="form-group">
            <input type="submit" class="btn btn-success btn-lg" id="submitnow" value="Update Information" />
            </div>
        </div>
        </div>

      </form>

      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- Modal -->
<div class="modal fade" id="myModal2" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Geolocation</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Get your geotag by pointing your establishment/attraction location on the map below:</label>
          <div>
            <iframe src="maps.php" width="100%" height="335px"></iframe>
          </div>
          <div class="form-group mt-3">
            <button type="button" class="btn btn-success btn-sm" id="getgeo">Update Geolocation Now!</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  <!-- Modal -->
  <div class="modal fade" id="functionRoomModal" tabindex="-1" aria-labelledby="functionRoomModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="functionRoomModalLabel">Enter Function Room Details</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <form id="functionRoomForm">
                          <table class="table table-bordered">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>Function Room Name</th>
                                      <th>Function Room Capacity</th>
                                  </tr>
                              </thead>
                              <tbody id="dynamicFields">
                                  <!-- Dynamic rows will be appended here -->
                              </tbody>
                          </table>
                      </form>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary" id="saveDetailsBtn">Save</button>
                  </div>
              </div>
          </div>
      </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>

document.addEventListener('DOMContentLoaded', function () {
    const functionRoomDetails = document.getElementById('function_room_details');
    const dynamicFields = document.getElementById('dynamicFields');
    const numRoomsInput = document.getElementById('num_of_function_rooms');

    // Load data from function_room_details on page load
    if (functionRoomDetails.value) {
        const roomDetails = JSON.parse(functionRoomDetails.value);
        numRoomsInput.value = roomDetails.length;
        dynamicFields.innerHTML = ''; // Clear existing rows

        roomDetails.forEach((room, index) => {
            const i = index + 1;
            dynamicFields.innerHTML += `
                <tr>
                    <td>${i}</td>
                    <td>
                        <input type="text" id="room_name_${i}" name="room_name_${i}" class="form-control" value="${room.name}" required>
                    </td>
                    <td>
                        <input type="number" id="room_capacity_${i}" name="room_capacity_${i}" class="form-control" value="${room.capacity}" min="1" required>
                    </td>
                </tr>
            `;
        });
    }
});

document.getElementById('addDetailsBtn').addEventListener('click', function () {
    const addDetailsBtn = document.getElementById('addDetailsBtn');
    const dynamicFields = document.getElementById('dynamicFields');
    const functionRoomDetails = document.getElementById('function_room_details');
    const numRoomsInput = document.getElementById('num_of_function_rooms');

    // Add or edit details based on button text
    if (addDetailsBtn.innerText === "Add Details" || addDetailsBtn.innerText === "Edit Detail") {
        const numRooms = parseInt(numRoomsInput.value, 10);
        dynamicFields.innerHTML = ''; // Clear previous rows

        if (!isNaN(numRooms) && numRooms > 0) {
            for (let i = 1; i <= numRooms; i++) {
                dynamicFields.innerHTML += `
                    <tr>
                        <td>${i}</td>
                        <td>
                            <input type="text" id="room_name_${i}" name="room_name_${i}" class="form-control" placeholder="Function room name" required>
                        </td>
                        <td>
                            <input type="number" id="room_capacity_${i}" name="room_capacity_${i}" class="form-control" min="1" placeholder="Enter capacity" required>
                        </td>
                    </tr>
                `;
            }
        } else {
            alert("Please enter a valid number of function rooms.");
        }

        // Reload data from function_room_details if available
        if (functionRoomDetails.value) {
            const roomDetails = JSON.parse(functionRoomDetails.value);
            dynamicFields.innerHTML = ''; // Clear existing rows

            roomDetails.forEach((room, index) => {
                const i = index + 1;
                dynamicFields.innerHTML += `
                    <tr>
                        <td>${i}</td>
                        <td>
                            <input type="text" id="room_name_${i}" name="room_name_${i}" class="form-control" value="${room.name}" required>
                        </td>
                        <td>
                            <input type="number" id="room_capacity_${i}" name="room_capacity_${i}" class="form-control" value="${room.capacity}" min="1" required>
                        </td>
                    </tr>
                `;
            });
        }
    }
});

// Update dynamic fields when the number of rooms changes
document.getElementById('num_of_function_rooms').addEventListener('input', function () {
    const dynamicFields = document.getElementById('dynamicFields');
    const numRooms = parseInt(this.value, 10);

    dynamicFields.innerHTML = ''; // Clear existing rows

    if (!isNaN(numRooms) && numRooms > 0) {
        for (let i = 1; i <= numRooms; i++) {
            dynamicFields.innerHTML += `
                <tr>
                    <td>${i}</td>
                    <td>
                        <input type="text" id="room_name_${i}" name="room_name_${i}" class="form-control" placeholder="Function room name" required>
                    </td>
                    <td>
                        <input type="number" id="room_capacity_${i}" name="room_capacity_${i}" class="form-control" min="1" placeholder="Enter capacity" required>
                    </td>
                </tr>
            `;
        }
    }
});

document.getElementById('saveDetailsBtn').addEventListener('click', function () {
    const form = document.getElementById('functionRoomForm');
    const formData = new FormData(form);

    // Collect room details into an array
    const roomDetails = [];
    const numRooms = document.getElementById('num_of_function_rooms').value;
    let totalCapacity = 0; // Initialize total capacity

    for (let i = 1; i <= numRooms; i++) {
        const roomName = formData.get(`room_name_${i}`);
        const roomCapacity = formData.get(`room_capacity_${i}`);

        if (roomName && roomCapacity) {
            const capacity = parseInt(roomCapacity, 10);
            roomDetails.push({
                name: roomName,
                capacity: capacity
            });

            totalCapacity += capacity; // Add to total capacity
        }
    }

    // Save as JSON in the hidden input field
    const jsonDetails = JSON.stringify(roomDetails);
    document.getElementById('function_room_details').value = jsonDetails;

    // Update total capacity input field
    document.getElementById('function_room_capacity').value = totalCapacity;

    console.log("Saved JSON:", jsonDetails); // For debugging
    console.log("Total Capacity:", totalCapacity); // For debugging

    // Change button text to "Edit Detail"
    const addDetailsBtn = document.getElementById('addDetailsBtn');
    addDetailsBtn.innerText = "Edit Detail";

    // Close the modal using Bootstrap 5 or fallback to jQuery if using Bootstrap 4
    $('#functionRoomModal').modal('hide');
});



function getLocation(location){
  document.getElementById('location').value=location;
}

$(document).ready(function(){
  $("#getgeo").click(function(){
    $("#submitnow").trigger("click");
  });
});

</script>

<?php include '../template/footer.php'; ?>

