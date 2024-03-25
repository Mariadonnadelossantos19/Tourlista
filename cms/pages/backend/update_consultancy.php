<?php 
// Start Session
session_start();

// Get the actual date in Manila
date_default_timezone_set('Asia/Manila');

// Remove unauthorized users
if(empty($_SESSION['id'])) {
    header("Location: ../../../");
    exit(); // Stop further execution
}

// Include the database connection php script
include '../../connection/connection.php';

// Get data from the URL parameters
$consultancy_id = $_GET['consultancy_id'];
$cooperator = $_GET['cooperator'];
$service_provider = $_GET['service_provider'];
$consultancy_type = $_GET['consultancy_type'];
$consultancy_start = $_GET['consultancy_start'];
$consultancy_end = $_GET['consultancy_end'];
$implementor = $_GET['implementor'];
$no_participants = $_GET['no_participants'];
$no_firms = $_GET['no_firms'];
$no_po = $_GET['no_po'];
$consultancy_cost = $_GET['consultancy_cost'];
$remarks = $_GET['remarks'];
$street = $_GET['street'];
$province = $_GET['province'];
$city_mun = $_GET['city_mun'];
$barangay = $_GET['barangay'];

// Prepare SQL query to update data in the database
$sql = "UPDATE consultancies SET cooperator_id=?, service_provider_id=?, consultancy_type=?, consultancy_start=?, consultancy_end=?, 
implementor_id=?, no_participants=?, no_firms=?, no_po=?, consultancy_cost=?, remarks=?, street=?, province=?, city_mun=?, barangay=?, user_id=?, date_encoded=? WHERE consultancy_id=?";

// Prepare and bind parameters
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiisssiiiiidsiiiisi", $cooperator, $service_provider, $consultancy_type, $consultancy_start, $consultancy_end, $implementor, 
$no_participants, $no_firms, $no_po, $consultancy_cost, $remarks, $street, $province, $city_mun, $barangay, $_SESSION['id'], date("Y-m-d H:i:s"), $consultancy_id);

// Execute statement
if ($stmt->execute()) {
    header("Location: ../frontend/edit_consultancy.php");
    exit(); // Stop further execution
} else {
    echo "Error updating record: " . $conn->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
