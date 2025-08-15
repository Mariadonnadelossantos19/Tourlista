<?php
// Include database configuration
include '../../cms/connection/config.php'; // Ensure the correct path to your config file

// Initialize error message variable
$errorMsg = '';

// Check if token is present in the URL
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verify the token exists in the database and is not expired
    $sql = "SELECT email, reset_token_expiry FROM ts_users WHERE token = :token";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':token', $token);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Check if token has expired
        if (new DateTime() > new DateTime($user['reset_token_expiry'])) {
            $errorMsg = "The reset link has expired. Please request a new one.";
        } else {
            // Token is valid and not expired, proceed to reset password to default

            // Set the default password
            $defaultPassword = '12345678';
            $hashedPassword = password_hash(sha1($defaultPassword), PASSWORD_DEFAULT);

            // Update the password in the database
            $sql = "UPDATE ts_users SET new_password = :password, token = NULL, reset_token_expiry = NULL WHERE token = :token";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':token', $token);

            if ($stmt->execute()) {
                echo "Your password has been reset to the default value. Your new password is: 12345678. Please log in and change it immediately.";
                header("Location:../index.php?status=2");
            } else {
                $errorMsg = "Failed to reset password. Please try again.";
                header("Location:../index.php?status=6");
            }
        }
    } else {
        $errorMsg = "Invalid token. Please check your link or request a new one.";
        header("Location:../index.php?status=6");
    }
} else {
    $errorMsg = "No token provided.";
    header("Location:../index.php?status=6");
}
?> 