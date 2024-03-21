<?php
session_start();
include 'connection.php';
include('smtp/PHPMailerAutoload.php');

$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST["email"];

    // Check if the email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script>alert("Invalid email address.");</script>';
    } else {
        // Check if the email exists in the database
        $emailCheckSql = "SELECT * FROM clients WHERE email = ?";
        $emailCheckStmt = $connection->prepare($emailCheckSql);
        $emailCheckStmt->bind_param("s", $email);
        $emailCheckStmt->execute();
        $result = $emailCheckStmt->get_result();

        if ($result->num_rows > 0) {
            $otp = rand(100000, 999999);
            $subject = "Password Reset OTP";
            $emailbody = "Hello,<br><br>
                You have requested to reset your password. Please use the following OTP to proceed:<br><b><h3>";
            echo smtp_mailer($email, $subject, $emailbody.$otp."</h3></b><br><br>Best regards,<br>JBLAS Company");

            // Store the OTP in the database along with the user's email and a timestamp
            $updateSql = "UPDATE clients SET reset_otp = ?, reset_timestamp = NOW() WHERE email = ?";
            $updateStmt = $connection->prepare($updateSql);
            $updateStmt->bind_param("ss", $otp, $email);
            $updateStmt->execute();

            header("Location: verify_otp.php?email=" . urlencode($email));
        } else {
            echo '<script>alert("Email address not found. Please put your email registered to your account. Thank You!");</script>';
        }
    }
}

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
	$mail->Body =$msg;
	$mail->AddAddress($to);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
		echo $mail->ErrorInfo;
	}else{
		return true;
	}
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Password Reset</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- Favicon -->

   <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="favicon_io/site.webmanifest">
    
  <!-- Stylesheet -->
<link rel="stylesheet" href="style/indexStyle.css">
  <!-- bootstrap link--->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <!-- Font Awesome Kit -->
  <script src="https://kit.fontawesome.com/23688bd133.js" crossorigin="anonymous"></script>

 <!-- Google Fonts -->
 <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Belleza&family=Montserrat&display=swap" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <style>
  body {
            background-image: url(images/footer.png);
            background-repeat: no-repeat;
            background-size: cover;
            font-family: 'Montserrat', sans-serif;
        }

        nav.navbar {
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand img {
            height: 50px; /* Adjust the height as needed */
            width: auto;
            padding: 5px;
        }

        .content {
            background-color: #fff;
            padding: 7% 15%;
            margin-top: 5%;
        }
        
        .form-container {
            max-width: 400px;
            margin: auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .error {
            color: red;
        }
        .form{
            text-align: center;
        }
   
        .logo{
            height: 70px;
            width: 70px;
            padding: 10px;
        }
        .dropdown:hover .dropdown-menu {
    display: block;
  }
 
    </style>
</head>

<body>

    <?php include "navbar.php" ?>

    <section class="container-fluid bg-body-tertiary d-block">
    <div class="row justify-content-center">
      <div class="col-12 col-md-6 col-lg-4" style="min-width: 500px;">
        <div class="card bg-white mb-5 mt-5 border-0" style="box-shadow: 0 12px 15px rgba(0, 0, 0, 0.02);">
          <div class="card-body p-5 text-center">
            <form method="POST">

                <h2>Reset your password?</h2>
                <br><br>
                <img style="height:100px; max-width: 100%;" src="images/reset.png" alt=""><br>
                <!-- Email Input -->
                <div class="form-group">
                    <label for="email">Please enter your registered email account:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" autocomplete="off" required>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary mb-3" style="color:white; background-color:#146C94; width:50%;">
                                Reset
                            </button>
            </form>
            </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap JS Bundle (Popper included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
