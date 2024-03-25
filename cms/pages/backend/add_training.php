<?php
// Start Session
session_start();

// Get the actual date in Manila
date_default_timezone_set('Asia/Manila');

// Remove unauthorized users
if($_SESSION['id']=="") header("Location:../../../");

// Include the  database connection php script
include '../../connection/connection.php';

// Get form data
$training_title = $_GET['training_title'];
$training_type = $_GET['training_type'];
$requesting_party = $_GET['requesting_party'];
$training_desc = $_GET['training_desc'];
$cooperator = $_GET['cooperator'];
$service_provider = $_GET['service_provider'];
$sectors = $_GET['sectors'];
$start_date = $_GET['start_date'];
$end_date = $_GET['end_date'];
$training_cost = $_GET['training_cost'];
$overall_csf = $_GET['overall_csf'];
$implementor = $_GET['implementor'];
$remarks = $_GET['remarks'];
$female_participants = $_GET['female_participants'];
$male_participants = $_GET['male_participants'];
$pwd_participants = $_GET['pwd_participants'];
$sr_participants = $_GET['sr_participants'];
$firm_participants = $_GET['firm_participants'];
$po_participants = $_GET['po_participants'];
$street = $_GET['street'];
$province = $_GET['province'];
$city_mun = $_GET['city_mun'];
$barangay = $_GET['barangay'];

$date_encoded = date("Y-m-d | H:i:s");

// Prepare SQL statement
$sql = "INSERT INTO trainings (training_title, training_type, requesting_party, training_desc, cooperator, service_provider, sectors,
start_date, end_date, training_cost, overall_csf, implementor, remarks, female_participants, male_participants, 
pwd_participants, sr_participants, firm_participants, po_participants, street, province, city_mun, barangay, user_id, date_encoded)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare and bind parameters
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssiisssddisiiiiiiiiiis", $training_title, $training_type, $requesting_party, $training_desc, $cooperator, $service_provider, $sectors,
$start_date, $end_date, $training_cost, $overall_csf, $implementor, $remarks, $female_participants, $male_participants,
$pwd_participants, $sr_participants, $firm_participants, $po_participants, $street, $province, $city_mun, $barangay, $_SESSION['id'],
$date_encoded);

// Execute statement
if ($stmt->execute()) {
    header("Location: ../frontend/training_masterlist.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
