<?php
session_start();
include 'connection.php'; // Include  database connection script

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $enteredOTP = $_POST['otp']; // OTP input field is named 'otp'

  // Retrieve the email associated with the session
  if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Retrieve the OTP associated with the user's email from the database
    $sql = "SELECT otp_code FROM patients WHERE email = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $storedOTP = $row['otp_code'];


    if ($enteredOTP === $storedOTP) {
      // OTP is correct; mark the user's email as verified
      $updateSql = "UPDATE patients SET email_status = 'Verified' WHERE email = ?";
      $updateStmt = $connection->prepare($updateSql);
      $updateStmt->bind_param("s", $email);

      if ($updateStmt->execute()) {
        // Email verification successful
        echo '<script>alert("Email verification successful. You can now log in.");</script>';
        // Redirect the user to the login page or any other desired location
        header("Location: login.php");
      } else {
        echo '<script>alert("Error updating email verification status.");</script>';
      }
    } else {
      echo '<script>alert("Incorrect OTP. Please try again.");</script>';
    }
  } else {
    echo '<script>alert("Session error. Please try again later.");</script>';
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Font Awesome Kit -->
    <script src="https://kit.fontawesome.com/23688bd133.js" crossorigin="anonymous"></script>

    <!-- Favicon -->

    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="favicon_io/site.webmanifest">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap" rel="stylesheet">

  <style>
    body {
      background-color: #146C94;
    }

    /* Reduce padding for the entire navigation bar */
    nav.navbar {
      padding: 1%;
      /* Adjust the value as needed */
      position: sticky;
      margin: 0.5rem 1rem;
      background-color: white;
    }

    /* Reduce padding for the navigation links (nav-link class) */
    .navbar-nav .nav-link {
      padding: 0.5rem 1rem;
      /* Adjust the values as needed */
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

            <p> Didn't receive code? <br> <span id="resendcode" >Resend code in </span> <span id="countdown"> </span>
            <span class="resend text-muted mb-0" id="resend-link"> <a href="resend.php">Request again</a>
           </span>
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      var countdownElement = document.getElementById("countdown");
      var resendLink = document.getElementById("resend-link");
      var resendCode = document.getElementById("resendcode");
      // Initial setup: hide the link
      resendLink.style.display = "none";

      // Set the initial countdown time to 5 minutes
      var timeInSeconds = 300;
      updateCountdown();

      // Update countdown every second
      var timer = setInterval(function () {
        timeInSeconds--;
        updateCountdown();

        // Show the link after the timer runs out
        if (timeInSeconds <= 0) {
          resendLink.style.display = "block";
          countdownElement.style.display = "none";
          resendCode.style.display = "none";
          // Clear the timer to stop it from running continuously
          clearInterval(timer);
        }
      }, 1000);

      function updateCountdown() {
        var minutes = Math.floor(timeInSeconds / 60);
        var seconds = timeInSeconds % 60;
        countdownElement.textContent = padLeft(minutes) + ":" + padLeft(seconds);
      }

      function padLeft(value) {
        return value < 10 ? "0" + value : value;
      }
    });
  </script>
</body>

</html>