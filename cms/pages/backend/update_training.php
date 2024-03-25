<?php
// Start Session
session_start();

// Get the actual date in Manila
date_default_timezone_set('Asia/Manila');

// Remove unauthorized users
if($_SESSION['id']=="") header("Location:../../../");

// Include the  database connection php script
include '../../connection/connection.php';


// Execute the statement
if ($stmt->execute()) {
    header("Location: ../frontend/edit_training.php");
} else {
    echo "Error: " . $conn->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
