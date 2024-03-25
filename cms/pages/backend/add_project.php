<?php
// Start Session
session_start();

// Get the actual date in Manila
date_default_timezone_set('Asia/Manila');

// Remove unauthorized users
if($_SESSION['id']=="") header("Location:../../../");

// Include the  database connection php script
include '../../connection/connection.php';

// Prepare SQL statement
$sql = "INSERT INTO projects (project_code, project_type, year_approved, project_title, project_desc, duration_from, duration_to,
beneficiaries, collaborating_agencies, implementor, date_released, sector, status, street, province, city_mun, barangay,
project_cost, beneficiary_counterpart, other_project_cost, counterpart_desc, user_id, date_encoded)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$date_encoded = date("Y-m-d | H:i:s");

// Prepare and bind parameters
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssssssssiisdddsis",
    $_GET['project_code'],
    $_GET['project_type'],
    $_GET['year_approved'],
    $_GET['project_title'],
    $_GET['project_desc'],
    $_GET['duration_from'],
    $_GET['duration_to'],
    $_GET['beneficiaries'],
    $_GET['collaborating_agencies'],
    $_GET['implementor'],
    $_GET['date_released'],
    $_GET['sector'],
    $_GET['status'],
    $_GET['street'],
    $_GET['province'],
    $_GET['city_mun'],
    $_GET['barangay'],
    $_GET['project_cost'],
    $_GET['beneficiary_counterpart'],
    $_GET['other_project_cost'],
    $_GET['counterpart_desc'],
    $_SESSION['id'],
    $date_encoded
);

// Execute the statement
if ($stmt->execute()) {
    header("Location: ../frontend/project_masterlist.php");
} else {
    echo "Error: " . $conn->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
