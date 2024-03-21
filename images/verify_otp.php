<?php
session_start();
include 'connection.php';

// Check if the email parameter is set in the URL
if (isset($_GET['email'])) {
    $email = urldecode($_GET['email']);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $enteredOTP = $_POST['otp'];

        // Check if the OTP matches the one stored in the database
        $otpCheckSql = "SELECT * FROM patients WHERE email = ? AND reset_otp = ? AND reset_timestamp >= NOW() - INTERVAL 10 MINUTE";
        $otpCheckStmt = $connection->prepare($otpCheckSql);
        $otpCheckStmt->bind_param("ss", $email, $enteredOTP);
        $otpCheckStmt->execute();
        $otpResult = $otpCheckStmt->get_result();

        if ($otpResult->num_rows > 0) {
            // OTP is valid, proceed to password reset
            header("Location: reset_password.php?email=" . urlencode($email));
            exit();
        } else {
            $errorMessage = "Invalid OTP. Please try again.";
        }
    }
} else {
    // Redirect the user to the initial forgot password page if email parameter is not set
    header("Location: forgot.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Password Reset</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Font Awesome Kit -->
    <script src="https://kit.fontawesome.com/23688bd133.js" crossorigin="anonymous"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }

        nav.navbar {
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand img {
            height: 50px;
            /* Adjust the height as needed */
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

        .form {
            text-align: center;
        }

        body {
            background-color: #146C94;
        }

        .logo {
            height: 70px;
            width: 70px;
            padding: 10px;
        }

        .otp-field {
            flex-direction: row;
            column-gap: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .otp-field input {
            height: 45px;
            width: 50%;
            border-radius: 6px;
            outline: none;
            font-size: 1.125rem;
            text-align: center;
            border: 1px solid #ddd;
        }

        .otp-field input:focus {
            box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
        }

        .otp-field input::-webkit-inner-spin-button,
        .otp-field input::-webkit-outer-spin-button {
            display: none;
        }

        .resend {
            font-size: 12px;
        }
    </style>
</head>

<body>

    </nav>

    <section class="container-fluid bg-body-tertiary d-block">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-4" style="min-width: 500px;">
                <div class="card bg-white mb-5 mt-5 border-0" style="box-shadow: 0 12px 15px rgba(0, 0, 0, 0.02);">
                    <div class="card-body p-5 text-center">
                        <h4>Verify your Email</h4><br>
                        <?php
                        if (isset($_SESSION['email'])) {
                            $email = $_SESSION['email'];
                            echo '<p>Your code was sent to <br><b>' . $email . '</b></p>';
                        }
                        ?>
                        <form method="POST">

                            <div class="otp-field mb-4">
                                <input type="text" id="otp-input" name="otp" placeholder='Enter OTP' maxlength="6">
                            </div>
                            <button type="submit" class="btn btn-primary mb-3" style="color:white; background-color:#146C94; width:50%;">
                                Verify
                            </button>
                        </form>

                        <?php
                        // Display error message if OTP verification fails
                        if (isset($errorMessage) && !empty($errorMessage)) {
                            echo '<p>' . $errorMessage . '</p>';
                        }
                        ?>

                        <p class="resend text-muted mb-0">
                            Didn't receive code? <a href="">Request again</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

</body>

</html>