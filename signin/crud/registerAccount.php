<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php'; // Ensure you include the autoload file for PHPMailer
include '../../cms/connection/connection.php';
date_default_timezone_set('Asia/Manila');

$username = mysqli_real_escape_string($conn, $_POST['username']);

$sql1 = "SELECT * FROM ts_users WHERE username = '$username'";
$result = mysqli_query($conn, $sql1);

if (mysqli_num_rows($result) > 0) {
    header("Location:../register_account.php?stat=0");
    exit();
} else {
    $access_level = mysqli_real_escape_string($conn, $_POST['access_level']);
    $region_c = mysqli_real_escape_string($conn, $_POST['region_c']);
    $province_c = mysqli_real_escape_string($conn, $_POST['province_c']);
    $citymun_c = mysqli_real_escape_string($conn, $_POST['citymun_c']);
    $password = password_hash(sha1($_POST['password']), PASSWORD_BCRYPT);
    $email = base64_encode(strtolower($_POST['email']));
    $date_time_encoded = date("Y-m-d | H:i:s");

    $sql = "INSERT INTO ts_users (access_level, region_c, province_c, citymun_c, username, new_password, email, date_time_encoded) 
            VALUES ('$access_level','$region_c','$province_c','$citymun_c', '" . strtoupper($username) . "', '$password', '$email', '$date_time_encoded')";

    if (mysqli_query($conn, $sql)) {
        $to = $_POST['email'];
        $subject = "TourLISTA Application Registration Confirmation";
        $message = "
        Dear $username,
        <br><br>
        You have successfully created an account in the TourLISTA Application. <br />
        Please click this link to verify your email address: 
        <a href='https://tourlista.ph/signin/verify_account.php?email=$to'>Verify My Email</a> <br />
        We will notify your LGU Web Administrator to validate and approve your registration! 

        <br /><br />
        Thank you,<br /><br />
        <b>TOURLISTA Administrator</b>
        <br /> <br />

        <small>Privacy Note: All information entered in this site (including names, contact numbers, and email addresses) will be used exclusively for the stated purposes of this site and will not be made available for any other purpose or to any other party. This is an automatically generated email, please do not reply. </small>
        ";

        try {
            $mail = new PHPMailer(true);

            // SMTP settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'tourlista.ph@gmail.com';                     //SMTP username
            $mail->Password   = 'erjznkxajxsgyvha';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

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
            $mail->addAddress($to);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $message;

            $mail->send();
            header('Location: ../register_account.php?stat=1');
        } catch (Exception $e) {
            echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
mysqli_close($conn);
?> 
