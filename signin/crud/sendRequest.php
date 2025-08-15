<?php
          $to = "allan.acosta24@gmail.com";
          $subject = "TourLISTA Application Request for Access";
          $message = "
          Dear TourLISTA Regional User,
          <br><br>
          A new user request was sent throuh the tourLISTA application with the following details: <br /><br />
          Full Name: ".addslashes($_POST['rname'])."<br />
          Email: ".addslashes($_POST['remail'])."<br />
          Mobile Number: ".addslashes($_POST['rphone'])."<br />
          User Account: ".$_POST['ruser']."<br />
         

          <br /><br />
          Thank you,<br /><br />
          <b>TOURLISTA Administrator</b>
          <br /> <br />

          Privacy Note: All information entered in this site (including names, contact number and email address) will be used exclusively for the stated purposes of this site and will not be made available for any other purpose or to any other party. This is an automatically generated email, please do not reply.
          ";

          // Always set content-type when sending HTML email
          $headers = "MIME-Version: 1.0" . "\r\n";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

          // More headers
          $headers .= 'From: TourLISTA Administrator <support@tourlista.ph>' . "\r\n";

          mail($to,$subject,$message,$headers);

          //SMS

          $ch = curl_init();
          $parameters = array(
              'apikey' => '9febd974b0d1328e27ac52708ecf698b', //Your API KEY
              'number' => '09304577900',
              'message' => 'A new account request was received please check your email for the details.',
              'sendername' => 'DOST4B'
          );
          curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
          curl_setopt( $ch, CURLOPT_POST, 1 );

          //Send the parameters set above with the request
          curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

          // Receive response from server
          curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
          $output = curl_exec( $ch );
          curl_close ($ch);

        header('Location: ../../index.php');
?>
