<?php
session_start();
if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
    header("Location: ../signin");
    exit();
}

require_once("../../connection/connection.php");
include '../../connection/logs.php';
recordLog("Uploaded profile photo");

// Validate and sanitize input
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
if (!isset($_FILES["file"]) || $_FILES["file"]["error"] != UPLOAD_ERR_OK) {
    header('Location: ../core/profile.php');
    exit();
}

$name = basename($_FILES["file"]["name"]);
$ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
$allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];

if (!in_array($ext, $allowed_ext)) {
    header('Location: ../core/profile.php');
    exit();
}

$save = md5($name . $id) . "." . $ext;
$upload_dir = "../../uploads/";
$upload_file = $upload_dir . $save;

// Ensure the uploads directory exists
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

if (move_uploaded_file($_FILES["file"]["tmp_name"], $upload_file)) {
    $stmt = $conn->prepare("UPDATE ts_users SET photo = ? WHERE user_id = ?");
    $stmt->bind_param('si', $save, $_SESSION['id']);
    $stmt->execute();
    $stmt->close();
    mysqli_close($conn);
    header('Location: ../core/profile.php');
    exit();
} else {
    header('Location: ../core/profile.php');
    exit();
}
?>
