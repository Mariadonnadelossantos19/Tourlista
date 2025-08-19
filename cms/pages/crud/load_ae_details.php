<?php
     include '../../connection/connection.php';
     
     // Debug: Log the request
     error_log("Load AE Details Request - GET params: " . print_r($_GET, true));
     
     // Validate that ID parameter exists and is not empty
     if (!isset($_GET['id']) || empty($_GET['id'])) {
         error_log("Load AE Details Error: Missing or empty ID parameter");
         echo json_encode(array('error' => 'Invalid or missing establishment ID'));
         exit();
     }
     
     $id = mysqli_real_escape_string($conn, $_GET['id']);
     error_log("Load AE Details - Escaped ID: " . $id);
     
     $sql = "select * from accommodation_establishment where ae_id = '".$id."'";
     error_log("Load AE Details Query: " . $sql);
     
     $result = mysqli_query($conn, $sql);
     
     if (!$result) {
         error_log("Load AE Details Database Error: " . mysqli_error($conn));
         echo json_encode(array('error' => 'Database query failed: ' . mysqli_error($conn)));
         exit();
     }
     
     $num_rows = mysqli_num_rows($result);
     error_log("Load AE Details - Number of rows found: " . $num_rows);
     
     if ($num_rows > 0) {
         while($row = mysqli_fetch_assoc($result)) {
             $data = array(
                 'id' => $row['ae_id'],
                 'ae_name' => $row['ae_name'],
                 'complete_address' => $row['complete_address'],
                 'contact_number' => $row['contact_number'],
                 'email' => $row['email'],
                 'type' => $row['type'],
                 'manager' => $row['manager'],
                 'is_accredited' => $row['is_accredited'],
                 'accreditation_number' => $row['accreditation_number'],
                 'valid_from' => $row['valid_from'],
                 'valid_to' => $row['valid_to'],
                 'no_rooms' => $row['no_rooms'],
                 'room_capacity' => $row['room_capacity'],
                 'room_type' => $row['room_type'],
                 'no_function_room' => $row['no_function_room'],
                 'function_room_capacity' => $row['function_room_capacity'],
                 'no_regular_male' => $row['no_regular_male'],
                 'no_regular_female' => $row['no_regular_female'],
                 'no_on_call_male' => $row['no_on_call_male'],
                 'no_on_call_female' => $row['no_on_call_female'],
                 'geolocation' => $row['geolocation']
             );
         }
         error_log("Load AE Details - Successfully loaded data for ID: " . $id);
         echo json_encode($data);
     } else {
         error_log("Load AE Details - No establishment found with ID: " . $id);
         echo json_encode(array('error' => 'Establishment not found with ID: ' . $id));
     }
?>