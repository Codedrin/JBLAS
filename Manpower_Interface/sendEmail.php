<?php
include('../smtp/PHPMailerAutoload.php');
function smtp_mailer($to, $subject, $msg)
{
  $mail = new PHPMailer();
  $mail->IsSMTP();
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = 'tls';
  $mail->Host = "smtp.gmail.com";
  $mail->Port = 587;
  $mail->IsHTML(true);
  $mail->CharSet = 'UTF-8';
  //$mail->SMTPDebug = 2;
  $mail->Username = "jblas.home@gmail.com"; // Sender's Email
  $mail->Password = "ufmsdrowbkffrkga"; //Sender's Email App Password
  $mail->SetFrom("jblas.home@gmail.com"); // Sender's Email
  $mail->Subject = $subject;
  $mail->Body = $msg;
  $mail->AddAddress($to);
  $mail->SMTPOptions = array('ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => false
  ));
  if (!$mail->Send()) {
    return false;
  } else {
    return true;
  }
}


$receiverEmail = $email;
          $subject = "Home Visit for Renovation: Start Your Renovation Service with JBLAS Home Renovation Services";
          $emailbody = "Hello $name,<br><br>Your confirmed booked for your home renovation/services on JBLAS Home Renovation Services is on process. We are pleased to inform you that our worker will visit on $date for home visit and discuss the necessary needs for renovation.<br><b>";
          smtp_mailer($receiverEmail, $subject, $emailbody . "</b><br><br>Please do not reply in this message.<br><br>Best regards,<br>JBLAS Home Renovation Services");

?>