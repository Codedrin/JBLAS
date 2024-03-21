<?php

include 'connection.php';
include 'smtp/PHPMailerAutoload.php'; 

session_start();

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Generate a new OTP
    $newOTP = rand(100000, 999999);

    // Update the database with the new OTP
    $updateSql = "UPDATE patients SET otp_code = ? WHERE email = ?";
    $updateStmt = $connection->prepare($updateSql);
    $updateStmt->bind_param("ss", $newOTP, $email);

    if ($updateStmt->execute()) {
        // Send the new OTP to the user's email
        $subject = "Email Verification";
        $emailbody = "Hello,<br><br>
            Welcome to RHU HealthLink!<br>
            Your  OTP code for email verification is: <b><h3>{$newOTP}</h3></b><br><br>
            Best regards,<br>RHU HealthLink";
        
        // Use your existing email sending function
        smtp_mailer($email, $subject, $emailbody);

        // Redirect the user to the verification page
        header("Location: resend_verification.php");
        exit;
    } else {
        echo "Error updating OTP in the database.";
    }
} else {
    echo "Session error. Please try again later.";
}

function smtp_mailer($to, $subject, $msg) {
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
        echo $mail->ErrorInfo;
    } else {
        echo "We've sent a new 6-digit OTP code to your email: " . $to;
    }
}
?>


