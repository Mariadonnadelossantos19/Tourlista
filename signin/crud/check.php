<?php
include '../../cms/connection/connection.php';
include '../../cms/connection/logs.php';

// Validate and sanitize input
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = sha1($_POST['security']);

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM ts_users WHERE username = ? AND status = '1'");
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    session_start();
    $row = $result->fetch_assoc();
    $auth = password_verify($password, $row['new_password']);
    if ($auth) {
        $_SESSION['level'] = $row['access_level'];
        $_SESSION['id'] = $row['user_id'];
        recordLog("Signed In");

        // Reset login attempts
        $stmt_reset = $conn->prepare("UPDATE ts_users SET attempts = '0' WHERE user_id = ?");
        $stmt_reset->bind_param('i', $row['user_id']);
        $stmt_reset->execute();

        // Redirect based on user level
        $level = $_SESSION['level'];
        header("Location:../../cms");
        exit();
    } else {
        // Increment login attempts
        $stmt_attempts = $conn->prepare("UPDATE ts_users SET attempts = attempts + 1 WHERE user_id = ?");
        $stmt_attempts->bind_param('i', $row['user_id']);
        $stmt_attempts->execute();

        // Check attempts and possibly deactivate account
        $stmt_check = $conn->prepare("SELECT attempts FROM ts_users WHERE user_id = ?");
        $stmt_check->bind_param('i', $row['user_id']);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();
        $row_check = $result_check->fetch_assoc();

        if ($row_check['attempts'] > 2) {
            $stmt_deactivate = $conn->prepare("UPDATE ts_users SET status = '0' WHERE user_id = ?");
            $stmt_deactivate->bind_param('i', $row['user_id']);
            $stmt_deactivate->execute();
        }

        header("Location:../index.php?status=4&attempts=" . $row_check['attempts']);
        exit();
    }
} else {
    header("Location:../index.php?status=4&attempts=x");
    exit();
}
?>
