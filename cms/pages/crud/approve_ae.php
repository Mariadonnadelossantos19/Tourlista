<?php
      session_start();
      if($_SESSION['id']=="") header("Location:../../../");

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

          require '../../../vendor/autoload.php'; // Ensure you include the autoload file for PHPMailer

          include '../../connection/connection.php';
          include '../../connection/logs.php';
          recordLog("Approved accommodation establishment with ID=".$_GET['id']);
          $id=$_GET['id'];
          $email = "";
          $username = "";
          $sql = "UPDATE accommodation_establishment set approve_status='1' WHERE ae_id='".$id."'";
          if (mysqli_query($conn, $sql)) {
            //QUERY FOR USER DETAILS
            $sql1 = "select username,a.email as email from ts_users a left join accommodation_establishment b on a.user_id = b.user_id where ae_id = '".$id."'";
            $result1 = mysqli_query($conn, $sql1);
            if (mysqli_num_rows($result1) > 0) {
                while($row1 = mysqli_fetch_assoc($result1)) {
                    $email = base64_decode($row1["email"]);
                    $username = $row1["username"];
                }
            
            //EMAIL
			  $to = $email;
			  $subject = "TourLISTA Accommodation Establishment Registration Approval";
			  $message = "
			  Dear USER - ".$username.",
		      <br><br> 
			  Your accommodation establishment enrollment has been successfully approved by your LGU Web Administrator <br />
			  You may now encode your daily tourist arrivals in the TourLISTA Content Management System.<br />
			  
			  <br /> <br /> 
		
			  <br /><br />
			  Thank you,<br /><br />
			  <b>TOURLISTA Administrator</b>
			  <br /> <br />

			  <small>Privacy Note: All information entered in this site (including names, contact number and email address) will be used exclusively for the stated purposes of this site and will not be made available for any other purpose or to any other party. This is an automatically generated email, please do not reply</small>.
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
                header("Location: ../core/manage_accommodation.php");
            } catch (Exception $e) {
                echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            }else{
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

              
          } 

          mysqli_close($conn);
?> 
