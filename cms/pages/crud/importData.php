<?php
session_start();
date_default_timezone_set('Asia/Manila');
    if($_SESSION['id']=="") header("Location:../signin");
    include '../../connection/connection.php';
    include '../../connection/logs.php';
    recordLog("Imported Data");
    $sql = "select * from accommodation_establishment where user_id='".$_SESSION['id']."'";
    $result = mysqli_query($conn, $sql);
    $ae_id = "";
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $ae_id = $row["ae_id"];
        }
    }


    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                if($line[0] == ""){
                   break;
                }
                // Get row data
                $date=date_create($line[0]);
                $task_date   = $line[0];
                $d = date_format($date,"d");
                $m = date_format($date,"m");
                $y = date_format($date,"Y");
                $no_rooms_occupied  = $line[1];
                $no_stayed_overnight  = $line[2];
                $no_new_checkin = $line[3];
                $no_male = $line[4];
                $no_female = $line[5];
                $local_tourist = $line[6];
                $foreign_tourist = $line[7];
                $overseas_filipino = $line[8];
                $date_time_encoded = date("Y-m-d | H:i:s");
                $remarks = addslashes($line[9]);
                
                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT task_date FROM ae_daily_task WHERE ae_id = '".$ae_id."' and task_date = '".$task_date."'";
                $prevResult = $conn->query($prevQuery);
              //  echo $prevQuery;
                
                if($prevResult->num_rows > 0){
                    // Update member data in the database
                    $sql = "UPDATE ae_daily_task SET no_rooms_occupied = '".$no_rooms_occupied."', no_stayed_overnight = '".$no_stayed_overnight."', no_new_checkin = '".$no_new_checkin."', no_male = '".$no_male."', no_female = '".$no_female."', local_tourist = '".$local_tourist."', foreign_tourist = '".$foreign_tourist."', overseas_filipino = '".$overseas_filipino."', date_time_encoded = '".$date_time_encoded."', remarks = '".$remarks."' WHERE ae_id = '".$ae_id."' and task_date = '".$task_date."'";
                    $conn->query($sql);
                   // echo $sql;
                }else{
                    // Insert member data in the database
                    $sql = "INSERT INTO ae_daily_task (task_date, day, month, year, no_rooms_occupied, no_stayed_overnight, no_new_checkin, no_male, no_female, local_tourist, foreign_tourist, overseas_filipino, remarks, date_time_encoded, ae_id, user_id) VALUES ('".$task_date."', '".$d."', '".$m."','".$y."','".$no_rooms_occupied."','".$no_stayed_overnight."','".$no_new_checkin."','".$no_male."','".$no_female."','".$local_tourist."','".$foreign_tourist."','".$overseas_filipino."','".$remarks."','".$date_time_encoded."','".$ae_id."','".$_SESSION['id']."')";
                    $conn->query($sql);
                  //  echo $sql;
                }
            }
            
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = '?status=1';
        }else{
            $qstring = '?status=0';
        }
    }else{
        $qstring = '?status=2';
    }

    header('Location: ../core/sync_data.php'.$qstring);
?>