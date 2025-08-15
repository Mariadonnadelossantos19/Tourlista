<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php'; // Ensure you include the autoload file for PHPMailer
include '../../cms/connection/connection.php';
date_default_timezone_set('Asia/Manila');

// Get email from POST request
$email = $_POST["email"] ?? ''; // Validate if email is passed

// Ensure the email is not empty before proceeding
if (!$email) {
    die("Email is required.");
}

$sql = "SELECT * FROM ts_users WHERE email = '".mysqli_real_escape_string($conn, base64_encode($email))."'";
$id = "";

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['user_id'];
    }

    // Create PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = getenv('tourlista.ph@gmail.com'); // Use environment variable for SMTP credentials
        $mail->Password = getenv('erjznkxajxsgyvha'); 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email settings
        $mail->setFrom('tourlista.ph@gmail.com', 'TourLISTA Administrator');
        $mail->addAddress($email);
        $mail->addReplyTo('tourlista.ph@gmail.com', 'TourLISTA Administrator');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'TourLISTA Account Recovery';
        $mail->Body = '<p>A request to reset your TourLISTA Application Account password was received.<br /><br />
        Click this <a href="tourlista.ph/signin/crud/reset.php?id='.$id.'">link</a> to reset your password to 12345678.<br /><br />
        Please choose a strong password for your account and keep it secret.<br />
        Passwords are safely stored in a strong encrypted form and nobody from the TourLISTA Team can see or decrypt it.<br /><br />
        If you have not made this request, it is likely that another user entered your email address by mistake. You can disregard this email.<br /><br />
        Thank you!<br /><br />
        <b>-TourLISTA Administrator</b><br /><br />
        NOTE: This is a system-generated response, please do not reply to this email.';

        $mail->AltBody = 'If you are unable to view this message, please visit the link in a web browser.';

        // Send email
        if ($mail->send()) {
            header("Location:../index.php?status=1");
            exit();
        } else {
            throw new Exception("Email could not be sent.");
        }
    } catch (Exception $e) {
        error_log("Mailer Error: {$mail->ErrorInfo}"); // Log the error for debugging
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    header("Location:../index.php?status=0");
    exit();
}
?> 
