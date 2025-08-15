<?php
session_start();
date_default_timezone_set('Asia/Manila');

// Check if user is logged in
if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
    header("Location:../../../");
    exit();
}

// Include connection and logging files
include '../../connection/connection.php';
include '../../connection/logs.php';

// Initialize variables
$uploadDir = '../../uploads/';
$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
$maxFileSize = 10 * 1024 * 1024; // 2MB
$save = 'accommodation.png'; // Default fallback image

// Handle photo upload
if (isset($_FILES['aephoto']) && $_FILES['aephoto']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['aephoto']['tmp_name'];
    $fileName = $_FILES['aephoto']['name'];
    $fileSize = $_FILES['aephoto']['size'];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Validate file type and size
    if (in_array($fileExtension, $allowedExtensions) && $fileSize <= $maxFileSize) {
        // Generate unique file name
        $id = $_SESSION['id'];
        $save = md5($fileName . $id) . '.' . $fileExtension;
        $destPath = $uploadDir . $save;

        // Move file to secure directory
        if (!move_uploaded_file($fileTmpPath, $destPath)) {
            echo "Error: Unable to upload file.";
            exit();
        }
    } else {
        echo "Error: Invalid file type or size.";
        exit();
    }
}

// Sanitize user inputs and prepare the SQL query
$sql = "INSERT INTO accommodation_establishment (
    ae_name, complete_address, contact_number, email, type, manager, is_accredited, accreditation_number,
    valid_from, valid_to, no_rooms, room_capacity, room_type, no_function_room, function_room_capacity, function_room_details,
    no_regular_male, no_regular_female, no_on_call_male, no_on_call_female, geolocation, photo, user_id
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "sssssssssssssssssssssss",
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
    $save,
    $_SESSION["id"]
);

// Execute query and handle success or error
if ($stmt->execute()) {
    recordLog("Encoded Accommodation Establishment");
    header('Location: ../core/registered_establishment.php');
    exit();
} else {
    echo "Error: " . $stmt->error;
}

// Close database connection
$stmt->close();
$conn->close();
?>
