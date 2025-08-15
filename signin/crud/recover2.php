<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../../vendor/autoload.php';
include_once '../../cms/connection/connection.php';
date_default_timezone_set('Asia/Manila');

$email = isset($_POST['email']) ? base64_encode($_POST['email']) : '';

function createToken($length = 32) {
    return bin2hex(random_bytes($length));
}

function updateTokenInDatabase($email, $token) {
    global $conn;
    $expiryTime = date('Y-m-d H:i:s', strtotime('+1 hour'));
    
    $query = "UPDATE ts_users SET token = ?, reset_token_expiry = ? WHERE email = ?";
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "sss", $token, $expiryTime, $email);
        return mysqli_stmt_execute($stmt);
    }
    return false;
}

function sendResetLink($email, $token) {
    $resetLink = "https://tourlista.ph/signin/crud/reset.php?token=" . urlencode($token);
    $subject = "Password Reset Request";
    $messageContent = '
        A request to reset your TourLISTA Application account password has been received. <br />
        To reset your password, please click the link below: <br />
        <a href="' . $resetLink . '">Reset My Password</a><br />
        The link will expire in 1 hour.<br /><br />
        
        For your security, choose a strong password and keep it confidential.<br />
        If you did not request this reset, please ignore this email.<br /><br />

        - TourLISTA Administrator
    ';

    $mail = new PHPMailer(true);
    try {
        // SMTP settings
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'tourlista.ph@gmail.com';               // SMTP username
        $mail->Password   = 'erjznkxajxsgyvha';           // SMTP password (use an app-specific password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable implicit TLS encryption
        $mail->Port       = 587;                                    // TCP port to connect to

        // Optional: Bypass SSL verification
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ],
        ];

        // Email settings
        $mail->setFrom('support@tourlista.ph', 'TourLISTA Administrator');
        $mail->addAddress(base64_decode($email));
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $messageContent;

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log('Mailer Error: ' . $mail->ErrorInfo);
        return false;
    }
}

if (!empty($email)) {
    $token = createToken();

    if (updateTokenInDatabase($email, $token)) {
        if (sendResetLink($email, $token)) {
            header("Location:../index.php?status=1");
            exit;
        }
    }
}

header("Location:../index.php?status=0");
exit;
?>
