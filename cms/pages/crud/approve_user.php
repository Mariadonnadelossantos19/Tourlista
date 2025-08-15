<?php
      session_start();
      if($_SESSION['id']=="") header("Location:../../../");

	  use PHPMailer\PHPMailer\PHPMailer;
	  use PHPMailer\PHPMailer\Exception;

		require '../../../vendor/autoload.php'; // Ensure you include the autoload file for PHPMailer
          include '../../connection/connection.php';
          include '../../connection/logs.php';
          recordLog("Approved user with ID=".$_GET['id']);
          $id=$_GET['id'];
          $mobile = "";
          $email = "";
          $username = "";

          //GET Number

          $sql1 = "Select username,email,mobile from ts_users where user_id = '".$id."'";
		  $result1 = mysqli_query($conn, $sql1);
		  if (mysqli_num_rows($result1) > 0) {
		      while($row1 = mysqli_fetch_assoc($result1)) {
		          $mobile = $row1["mobile"];
		          $email = base64_decode($row1["email"]);
		          $username = $row1["username"];
		      }
		  }

		  //APPROVE

          $sql = "UPDATE ts_users set status='1' WHERE user_id='".$id."'";
          if (mysqli_query($conn, $sql)) {

			$sqlx = "UPDATE ts_users set attempts = '0' where user_id = '".$id."'";
			mysqli_query($conn, $sqlx); 

          	//EMAIL
			  $to = $email;
			  $subject = "TourLISTA Application Registration Confirmation";
			  $message = "
			  Dear USER - ".$username.",
		      <br><br> 
			  Your account has been successfully approved by your LGU Web Administrator. <br />
			  You may now sign in to your account in the TourLISTA Content Management System<br />
			  at <a href='https://tourlista.ph/cms'> tourlista.ph/cms</a>
			  <br /> <br /> 
		
			  <br /><br />
			  Thank you,<br /><br />
			  <b>TOURLISTA Administrator</b>
			  <br /> <br />

			  <small>Privacy Note: All information entered in this site (including names, contact number and email address) will be used exclusively for the stated purposes of this site and will not be made available for any other purpose or to any other party. This is an automatically generated email, please do not reply</small>.
			  ";
	
			  // Always set content-type when sending HTML email
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

              header("Location: ../core/manage_user.php");
			} catch (Exception $e) {
                echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
          }else{
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
          mysqli_close($conn);
?>
