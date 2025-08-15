<?php
    session_start();
    date_default_timezone_set('Asia/Manila');
    if ($_SESSION['id'] == "") header("Location:../../../");
    
    $date = date_create($_POST["mice_date"]);
    include '../../connection/connection.php';
    include '../../connection/logs.php';
    
    // Log the MICE encoding action
    recordLog("Encoded MICE for AE");

    // Insert MICE data into the database
    $sql = "INSERT INTO mice (
                mice_date, day, month, year, event_name, no_of_days, no_of_hours, classification, type, no_male, no_female, 
                local_tourist, foreign_tourist, foreign_details, with_exhibition, num_exhibitors, organizer, contact_person, 
                address, contact_number, remarks, date_time_encoded, ae_ta_id, user_id
            ) VALUES (
                '".date_format($date, "Y-m-d")."', 
                '".date_format($date, "d")."',
                '".date_format($date, "m")."',
                '".date_format($date, "Y")."',
                '".addslashes($_POST["event_name"])."', 
                '".$_POST["no_days"]."', 
                '".$_POST["no_hours"]."', 
                '".$_POST["classification"]."', 
                '".$_POST["type"]."', 
                '".$_POST["no_male"]."',
                '".$_POST["no_female"]."',
                '".$_POST["local_visitor"]."',
                '".$_POST["foreign_visitor"]."',
                '".$_POST["foreign_details"]."',
                '".$_POST["with_exhibition"]."',
                '".$_POST["num_exhibitors"]."',
                '".addslashes($_POST["organizer"])."',
                '".addslashes($_POST["contact_person"])."',
                '".addslashes($_POST["address"])."',
                '".addslashes($_POST["contact_details"])."',
                '".addslashes($_POST["remarks"])."',
                '".date("Y-m-d | H:i:s")."',
                '".$_POST["ae_id"]."',
                '".$_SESSION["id"]."'
            )";

    echo $sql;  // Optional: for debugging SQL query

    if (mysqli_query($conn, $sql)) {
        header('Location: ../core/ae_mice.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
?>
