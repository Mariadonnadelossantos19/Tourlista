<?php
     include '../../connection/connection.php';
     $id = $_GET['id'];
     $sql = "select *from ae_daily_task where ae_task_id = '".$id."'";
     $result = mysqli_query($conn, $sql);
     if (mysqli_num_rows($result) > 0) {
         while($row = mysqli_fetch_assoc($result)) {
          $date=date_create($row["task_date"]);

           $data = array(
               'task_date' => date_format($date,"Y-m-d"),
               'no_rooms_occupied' => $row['no_rooms_occupied'],
               'no_stayed_overnight' => $row['no_stayed_overnight'],
               'no_new_checkin' => $row['no_new_checkin'],
               'no_male' => $row['no_male'],
               'no_female' => $row['no_female'],
               'local_tourist' => $row['local_tourist'],
               'local_details' => $row['local_details'],
               'foreign_tourist' => $row['foreign_tourist'],
               'foreign_details' => $row['foreign_details'],
               'overseas_filipino' => $row['overseas_filipino'],
               'overseas_details' => $row['overseas_details'],
               'remarks' => $row['remarks'],
               'ae_task_id' => $row['ae_task_id']

           );
        }
        echo json_encode($data);
     }
?> 