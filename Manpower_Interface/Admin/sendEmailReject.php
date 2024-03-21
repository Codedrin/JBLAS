<?php
include('smtp/PHPMailerAutoload.php');
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
          $subject = "Notice of Rejected Booking: JBLAS Home Renovation Services";
          $emailbody = "Hello $name,<br><br>We regret to inform you that your booking request for renovation services through our website at JBLAS Home Renovation Services has been rejected. This maybe due to misinformation you submitted, availability and schedule of our workers.<br>Thank you for considering JBLAS Home Renovation Services for your renovation needs. We appreciate your understanding and hope to have the opportunity to assist you in the future.<b>";
          smtp_mailer($receiverEmail, $subject, $emailbody . "</b><br><br>Please do not reply in this message.<br><br>Best regards,<br>JBLAS Home Renovation Services");

?>