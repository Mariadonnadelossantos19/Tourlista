<?php
session_start();
include '../../connection/connection.php';
include '../../connection/logs.php';

// Check if 'ae_user' is set in the query parameters
if (isset($_GET['ae_user'])) {
    $_SESSION['ae_user'] = $_GET['ae_user'];
    recordLog("Sync Accommodation Data");

    header("Location:../core/ae_monthly_encoding.php?year=".$_GET['year']);
    exit();
} else {
    // Handle the error case, e.g., redirecting to an error page or showing a message
    echo "Error: ae_user parameter is missing.";
    exit();
}
?>
