<?php
  $page = "register_establishment";
  include '../template/header.php';
  recordLog("Visited Register Establishment");
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Register Accommodation Establishment   </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Register Accommodation Establishment  </li>
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
                <h3 class="card-title">Basic Information</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form action="../crud/save_ae.php" method="POST" enctype="multipart/form-data">

              <div class="row">
                    <div class="col-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name of Accommodation Establishment</label>
                        <input type="text" name="establishment_name" class="form-control" placeholder="Enter name of accomodation establishment" required>
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label for="exampleInputEmail1">Complete Address</label>
                        <input type="text" name="complete_address" class="form-control" placeholder="Enter address of accomodation establishment" required>
                    </div>
                    <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Contact Number</label>
                        <input type="text" name="contact_number" class="form-control" placeholder="Enter contact number" required>
                    </div>
                    <!-- /.form-group -->
                                         <div class="form-group">
                         <label for="exampleInputEmail1">Email Address</label>
                         <input type="email" name="email" class="form-control" placeholder="Enter email address" required>
                     </div>
                     <!-- /.form-group -->
                     <div class="form-group">
                         <label for="exampleInputEmail1">Website Link</label>
                         <input type="url" name="website_link" class="form-control" placeholder="Enter website URL (e.g., https://www.example.com)" required>
                     </div>
                     <!-- /.form-group -->
                     </div>
                    <div class="col-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Type of Establishment</label>
                        <select class="form-control" name="type" required>
                            <option value="">Select Establishment Type</option>
                            <option value="Hotel">Hotel</option>
                            <option value="Condotel">Condotel</option>
                            <option value="Serviced Residence">Serviced Residence</option>
                            <option value="Resort">Resort</option>
                            <option value="Apartelle">Apartelle</option>
                            <option value="Motel">Motel</option>
                            <option value="Pension House">Pension House</option>
                            <option value="Home Stay Site">Home Stay Site</option>
                            <option value="Tourist Inn">Tourist Inn</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label for="exampleInputEmail1">General Manager</label>
                        <input type="text" name="manager" class="form-control" placeholder="Name of General Manager" required>
                    </div> 
                    <!-- /.form-group -->
                    </div>
                    
                    <div class="col-3"> 
                    <div class="form-group">
                        <label for="exampleInputEmail1">Establishment Accredited?</label>
                        <select class="form-control" name="is_accredited" id="is_accredited" required onchange="toggleAccreditationFields()">
                            <option value="yes">YES</option>
                            <option value="no">NO</option>
                        </select>
                    </div>
                    <!-- /.form-group -->
                    </div>

                    <div class="col-3" id="accreditation_number_div">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Accreditation Number</label>
                        <input type="text" name="accreditation_number" id="accreditation_number" class="form-control" placeholder="Enter accreditation number">
                    </div>
                    <!-- /.form-group -->
                    </div>

                    
                    <div class="col-3" id="valid_from_div">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Validity From</label>
                        <input type="date" name="valid_from" id="valid_from" class="form-control" placeholder="Accreditation Validity Period From">
                    </div>
                    <!-- /.form-group -->
                    </div>

                    
                    <div class="col-3" id="valid_to_div">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Validity To</label>
                        <input type="date" name="valid_to" id="valid_to" class="form-control" placeholder="Accreditation Validity Period To">
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
                        <input type="number" name="no_rooms" class="form-control" placeholder="Enter Number of Rooms" min="0" max="300" required>
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
                        <input type="number" name="room_capacity" class="form-control" placeholder="Enter Total Capacity of Rooms" min="0" max="1000" required>
                        </div>
                        <!-- /.input group -->
                    </div>

                    <div class="form-group">
                        <label>Type of Rooms:</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-address-card"></i></span>
                        </div>
                        <input type="text" name="room_type" class="form-control" placeholder="Enter Room Type (e.g. Suite, Deluxe, Regular, etc.)" required>
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
                        <input type="number" name="no_function_room" id="num_of_function_rooms" class="form-control" min="0" max="20" placeholder="Enter Number of Function Rooms">
                        <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="addDetailsBtn"  data-bs-toggle="modal" data-bs-target="#functionRoomModal">Add Details</button>
                            </div>  
                      </div>


                        <!-- /.input group -->
                    </div>

                    <div class="form-group">
                        <label>Capacity of Function Rooms:</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-users"></i></span>
                        </div>
                        <input type="text" name="function_room_capacity" id="function_room_capacity" class="form-control" placeholder="Capacity of Function Rooms" readonly>
                        </div>
                        <!-- /.input group -->
                    </div>

                    <div class="form-group" style="display: none">
                        <label>Detail of Function Rooms:</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-users"></i></span>
                        </div>
                        <input type="text" name="function_room_details" id="function_room_details" class="form-control" placeholder="Detail of Function Rooms" readonly>
                        </div>
                        <!-- /.input group -->
                    </div>

                    <div class="form-group">
                        <label>Number of Regular Employees:</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-male"></i></span>
                        </div>
                        <input type="number" name="no_regular_m" class="form-control" placeholder="Enter Number of Male Regular Employees" min="0" max="200" required>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-female"></i></span>
                        </div>
                        <input type="number" name="no_regular_f" class="form-control" placeholder="Enter Number of Female Regular Employees" min="0" max="200" required>
                        </div>
                        <!-- /.input group -->
                    </div>

                    <div class="form-group">
                        <label>Number of On-Call Employees:</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-male"></i></span>
                        </div>
                        <input type="number" name="no_on_call_m" class="form-control" placeholder="Number of Male on-call employees" min="0" max="200" required>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-female"></i></span>
                        </div>
                        <input type="number" name="no_on_call_f" class="form-control" placeholder="Number of Female on-call employees" min="0" max="200" required>
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
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
                    <input type="text" name="geolocation" class="form-control" id="location" placeholder="Geolocation" readonly>
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
                    <input type="file" name="aephoto" id="aephoto" accept=".jpeg, .jpg, .png, .gif" class="form-control-file">
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
            <input type="submit" class="btn btn-success btn-lg" value="Register Establishment" />
            </div>
        </div>
        </div>

      </form>

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


      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>

document.getElementById('addDetailsBtn').addEventListener('click', function () {
    const addDetailsBtn = document.getElementById('addDetailsBtn');
    const dynamicFields = document.getElementById('dynamicFields');
    const functionRoomDetails = document.getElementById('function_room_details');
    const numRoomsInput = document.getElementById('num_of_function_rooms');

    if (addDetailsBtn.innerText === "Add Details") {
        // Add new details
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
    } else if (addDetailsBtn.innerText === "Edit Detail") {
        // Load and populate existing data
        const roomDetails = JSON.parse(functionRoomDetails.value || "[]");
        numRoomsInput.value = roomDetails.length;
        dynamicFields.innerHTML = ''; // Clear previous rows

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

function toggleAccreditationFields() {
  var isAccredited = document.getElementById('is_accredited').value;
  var accreditationNumberDiv = document.getElementById('accreditation_number_div');
  var validFromDiv = document.getElementById('valid_from_div');
  var validToDiv = document.getElementById('valid_to_div');
  var accreditationNumber = document.getElementById('accreditation_number');
  var validFrom = document.getElementById('valid_from');
  var validTo = document.getElementById('valid_to');
  
  if (isAccredited === 'yes') {
    // Show accreditation fields
    accreditationNumberDiv.style.display = 'block';
    validFromDiv.style.display = 'block';
    validToDiv.style.display = 'block';
    
    // Enable fields
    accreditationNumber.disabled = false;
    validFrom.disabled = false;
    validTo.disabled = false;
    
    // Add required attribute
    accreditationNumber.required = true;
    validFrom.required = true;
    validTo.required = true;
  } else {
    // Hide accreditation fields
    accreditationNumberDiv.style.display = 'none';
    validFromDiv.style.display = 'none';
    validToDiv.style.display = 'none';
    
    // Disable fields
    accreditationNumber.disabled = true;
    validFrom.disabled = true;
    validTo.disabled = true;
    
    // Remove required attribute and clear values
    accreditationNumber.required = false;
    validFrom.required = false;
    validTo.required = false;
    
    // Clear the values
    accreditationNumber.value = '';
    validFrom.value = '';
    validTo.value = '';
  }
}

// Initialize the form on page load
document.addEventListener('DOMContentLoaded', function() {
  toggleAccreditationFields();
});
</script>
<?php include '../template/footer.php'; ?>

