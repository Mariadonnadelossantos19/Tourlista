<?php
     include '../../connection/connection.php';
     $id = $_GET['id'];
     $sql = "select * from mice where mice_id = '".$id."'";
     $result = mysqli_query($conn, $sql);
     if (mysqli_num_rows($result) > 0) {
         while($row = mysqli_fetch_assoc($result)) {
          $date=date_create($row["mice_date"]);
           $data = array(
               'mice_date' => date_format($date,"Y-m-d"),
               'event_name' => $row['event_name'],
               'no_of_days' => $row['no_of_days'],
               'no_of_hours' => $row['no_of_hours'],
               'classification' => $row['classification'],
               'type' => $row['type'],
               'no_male' => $row['no_male'],
               'no_female' => $row['no_female'],
               'local_tourist' => $row['local_tourist'],
               'foreign_tourist' => $row['foreign_tourist'],
               'foreign_details' => $row['foreign_details'],
               'with_exhibition' => $row['with_exhibition'],
               'num_exhibitors' => $row['num_exhibitors'],
               'organizer' => $row['organizer'],
               'contact_person' => $row['contact_person'],
               'address' => $row['address'],
               'contact_details' => $row['contact_number'],
               'remarks' => $row['remarks']
           );
        }
        echo json_encode($data);
     }
?>