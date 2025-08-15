<?php
session_start();
date_default_timezone_set('Asia/Manila');
    if($_SESSION['id']=="") header("Location:../signin");
    include '../../connection/connection.php';
    include '../../connection/logs.php';
    recordLog("Imported TA Data");
    $sql = "select * from tourist_attraction where user_id='".$_SESSION['id']."'";
    $result = mysqli_query($conn, $sql);
    $ta_id = "";
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $ta_id = $row["ta_id"];
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
                $r_male  = $line[1];
                $r_female  = $line[2];
                $nr_male = $line[3];
                $nr_female = $line[4];
                $fo_male = $line[5];
                $fo_female = $line[6];
                $date_time_encoded = date("Y-m-d | H:i:s");
                
                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT task_date FROM ta_daily_task WHERE ta_id = '".$ta_id."' and task_date = '".$task_date."'";
                $prevResult = $conn->query($prevQuery);
              //  echo $prevQuery;
                
                if($prevResult->num_rows > 0){
                    // Update member data in the database
                    $sql = "UPDATE ta_daily_task SET r_male = '".$r_male."', r_female = '".$r_female."', nr_male = '".$nr_male."', nr_female = '".$nr_female."', fo_male = '".$fo_male."', fo_female = '".$fo_female."', date_time_encoded = '".$date_time_encoded."' WHERE ta_id = '".$ta_id."' and task_date = '".$task_date."'";
                    $conn->query($sql);
                   // echo $sql;
                }else{
                    // Insert member data in the database
                    $sql = "INSERT INTO ta_daily_task (task_date, day, month, year, r_male, r_female, nr_male, nr_female, fo_male, fo_female, date_time_encoded, ta_id, user_id) VALUES ('".$task_date."', '".$d."', '".$m."','".$y."','".$r_male."','".$r_female."','".$nr_male."','".$nr_female."','".$fo_male."','".$fo_female."','".$date_time_encoded."','".$ta_id."','".$_SESSION['id']."')";
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

    header('Location: ../core/sync_data_ta.php'.$qstring);
?>