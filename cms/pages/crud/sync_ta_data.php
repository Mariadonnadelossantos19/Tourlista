<?php
session_start();
include '../../connection/connection.php';
include '../../connection/logs.php';

// Check if 'ta_user' is set in the query parameters
if (isset($_GET['ta_user'])) {
    $_SESSION['ta_user'] = $_GET['ta_user'];
    recordLog("Sync Attraction Data");

    header("Location:../core/ta_monthly_encoding.php?year=".$_GET['year']);
    exit();
} else {
    // Handle the error case, e.g., redirecting to an error page or showing a message
    echo "Error: ae_user parameter is missing.";
    exit();
}
?>
