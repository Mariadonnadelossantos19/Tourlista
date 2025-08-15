<?php
     include '../../connection/connection.php';
     $id = $_GET['id'];
     $sql = "select * from tourist_attraction where ta_id = '".$id."'";
     $result = mysqli_query($conn, $sql);
     if (mysqli_num_rows($result) > 0) {
         while($row = mysqli_fetch_assoc($result)) {
           $data = array(
               'id' => $row['ta_id'],
               'ta_name' => $row['ta_name'],
               'complete_address' => $row['complete_address'],
               'contact_number' => $row['contact_number'],
               'email' => $row['email'],
               'type' => $row['type'],
               'classification' => $row['classification'],
               'description' => $row['description'],
               'is_accredited' => $row['is_accredited'],
               'accreditation_number' => $row['accreditation_number'],
               'valid_from' => $row['valid_from'],
               'valid_to' => $row['valid_to'],
               'manager' => $row['manager'],
               'no_regular_male' => $row['no_regular_male'],
               'no_regular_female' => $row['no_regular_female'],
               'no_on_call_male' => $row['no_on_call_male'],
               'no_on_call_female' => $row['no_on_call_female'],
               'website' => $row['website'],
               'geolocation' => $row['geo_location']
           );
        }
        echo json_encode($data);
     }
?> 