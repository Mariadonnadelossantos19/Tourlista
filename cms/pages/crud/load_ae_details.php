<?php
     include '../../connection/connection.php';
     $id = $_GET['id'];
     $sql = "select * from accommodation_establishment where ae_id = '".$id."'";
     $result = mysqli_query($conn, $sql);
     if (mysqli_num_rows($result) > 0) {
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
        echo json_encode($data);
     }
?>