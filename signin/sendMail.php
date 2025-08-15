<?php

$to = 'mis@mimaropa.dost.gov.ph';
$subject = "TourLISTA Application Registration Confirmation";
$message = "
Dear USER,
<br><br>
You have successfully created an account in the TourLISTA Application. <br />
Please click this link to verify your email address: <a href='link'>verify_me</a> <br />
Upon verification, we will notify your LGU Web Administrator to validate and approve your registration! 

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

?>