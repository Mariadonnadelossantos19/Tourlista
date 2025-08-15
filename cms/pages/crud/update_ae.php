<?php
session_start();
date_default_timezone_set('Asia/Manila');

if (empty($_SESSION['id'])) {
    header("Location: ../../../");
    exit();
}

include '../../connection/connection.php';
include '../../connection/logs.php';

try {
    recordLog("Updated AE details");

    // Prepare SQL query
    $sql = "UPDATE accommodation_establishment SET 
        ae_name = ?, 
        request_edit = '0', 
        complete_address = ?, 
        contact_number = ?, 
        email = ?, 
        type = ?, 
        manager = ?, 
        is_accredited = ?, 
        accreditation_number = ?, 
        valid_from = ?, 
        valid_to = ?, 
        no_rooms = ?, 
        room_capacity = ?, 
        room_type = ?, 
        no_function_room = ?, 
        function_room_capacity = ?, 
        function_room_details = ?, 
        no_regular_male = ?, 
        no_regular_female = ?, 
        no_on_call_male = ?, 
        no_on_call_female = ?, 
        geolocation = ? 
        WHERE user_id = ?";

    $stmt = $conn->prepare($sql);

    // Verify the count of variables and placeholders
    $stmt->bind_param(
        "sssssssssssssssssssssi", 
        $_POST["establishment_name"],
        $_POST["complete_address"],
        $_POST["contact_number"],
        $_POST["email"],
        $_POST["type"],
        $_POST["manager"],
        $_POST["is_accredited"],
        $_POST["accreditation_number"],
        $_POST["valid_from"],
        $_POST["valid_to"],
        $_POST["no_rooms"],
        $_POST["room_capacity"],
        $_POST["room_type"],
        $_POST["no_function_room"],
        $_POST["function_room_capacity"],
        $_POST["function_room_details"],
        $_POST["no_regular_m"],
        $_POST["no_regular_f"],
        $_POST["no_on_call_m"],
        $_POST["no_on_call_f"],
        $_POST["geolocation"],
        $_SESSION["id"]
    );

    if ($stmt->execute()) {
        header('Location: ../core/registered_establishment.php');
        exit();
    } else {
        throw new Exception("Error executing query: " . $stmt->error);
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    echo "An error occurred: " . $e->getMessage();
} finally {
    $stmt->close();
    $conn->close();
}
?>
