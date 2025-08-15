<?php
    include '../../cms/connection/connection.php';
    date_default_timezone_set('Asia/Manila');

      $sql1 = "Select * from ts_users where username = '".$_POST['username']."'";
      $result = mysqli_query($conn, $sql1);
      if (mysqli_num_rows($result) > 0){
        header("Location:../register_account.php?stat=0");
      }else{


      $sql = "INSERT INTO ts_users (access_level, region_c, province_c, citymun_c, username, new_password, email, date_time_encoded)
      VALUES ('".$_POST["access_level"]."','".$_POST["region_c"]."','".$_POST["province_c"]."','".$_POST["citymun_c"]."',
        '".strtoupper($_POST["username"])."','".password_hash(sha1($_POST["password"]), PASSWORD_BCRYPT)."','".base64_encode(strtolower($_POST["email"]))."','".date("Y-m-d | H:i:s")."')";
      if (mysqli_query($conn, $sql)) {
          $to = $_POST['email'];
          $subject = "TourLISTA Application Registration Confirmation";
          $message = "
          Dear ".$_POST['username'].",
          <br><br>
          You have successfully created an account in the TourLISTA Application. <br />
          Please click this link to verify your email address: <a href='https://tourlista.ph/signin/verify_account.php?email=".$to."'>verify_my_email</a> <br />
          We will notify your LGU Web Administrator to validate and approve your registration! 

          <br /><br />
          Thank you,<br /><br />
          <b>TOURLISTA Administrator</b>
          <br /> <br />

          <small>Privacy Note: All information entered in this site (including names, contact number and email address) will be used exclusively for the stated purposes of this site and will not be made available for any other purpose or to any other party. This is an automatically generated email, please do not reply. </small>
          ";

          // Always set content-type when sending HTML email
          $headers = "MIME-Version: 1.0" . "\r\n";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

          // More headers
          $headers .= 'From: TourLISTA Administrator <support@tourlista.ph>' . "\r\n";

          mail($to,$subject,$message,$headers);

          //SMS SECTION
          /*
          $ch = curl_init();
          $parameters = array(
              'apikey' => '9febd974b0d1328e27ac52708ecf698b', //Your API KEY
              'number' => $_POST["mobile"],
              'message' => 'You have successfully created an account in the TourLISTA Application. Please notify your LGU Web Administrator to validate and approve your registration!',
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
          */

        header('Location: ../register_account.php?stat=1');
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
    }
      mysqli_close($conn);
?>
