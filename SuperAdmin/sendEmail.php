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
$subject = "Email Receipt: Start Your Renovation Service with JBLAS Home Renovation Services";
$emailbody = '
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>JBLAS Company</title>
  <!-- bootstrap link--->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <!-- Font Awesome Kit -->
  <script src="https://kit.fontawesome.com/23688bd133.js" crossorigin="anonymous"></script>

</head>
<div class="card">
    <div class="card-body mx-4">
        <div class="container">
            <p class="my-5 mx-5" style="font-size: 30px;">Thank for your Payment!</p>
            <div class="row">
                <ul class="list-unstyled">
                    <li class="text-black">Name:' . $name . '</li>
                    <li class="text-muted mt-1"><span class="text-black">Book ID:</span>'. $book_id.'</li>
                    <li class="text-black mt-1">Start of Renovation: ' . $date . '</li>
                </ul>
                <hr>
                <div class="col-xl-10">
                    <p>Renovation Details:</p>
                </div>
                <div class="col-xl-2">
                    <p class="float-end">'.$issue .'</p>
                </div>
            </div>
           
                <hr style="border: 2px solid black;">
            </div>
            <div class="row text-black">
                <div class="col-xl-12">
                    <p class="float-end fw-bold">Total: '. $total .'</p>
                </div>
                <hr style="border: 2px solid black;">
            </div>
            <div class="text-center" style="margin-top: 90px;">
                <p>JBLAS Home Renovation Services</p>
            </div>
        </div>
    </div>
</div>
</body>

</html>
';

smtp_mailer($receiverEmail, $subject, $emailbody);
?>
