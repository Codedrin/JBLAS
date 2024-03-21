<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id']) && isset($_SESSION['username']) && isset($_SESSION['acc_type'])) {
    $user_id = $_SESSION['user_id'];
    $session_username = $_SESSION['username'];
    $acc_type = $_SESSION['acc_type'];
} else {
    // Redirect to the login page if the user is not logged in
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Appointment</title>
    <!-- Favicon -->

    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="favicon_io/site.webmanifest">
  <!-- Bootstrap link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <!-- Font Awesome Kit -->
  <script src="https://kit.fontawesome.com/23688bd133.js" crossorigin="anonymous">

  </script>
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap" rel="stylesheet">
  <!-- Stylesheet -->
  <link rel="stylesheet" href="style.css">


  <style>
    body {
      background-image: url(images/payment_background.png);
            background-repeat: no-repeat;
            background-size: cover;
            
    }

  </style>

<script>
    setTimeout(function() {
      window.location.href = 'clientdashboard.php';
    }, 10000); // 5000 milliseconds = 5 seconds
  </script>
</head>

<body>


  <section class="container-fluid bg-body-tertiary d-block">
    <div class="row justify-content-center">
      <div class="col-12 col-md-6 col-lg-4" style="min-width: 500px;">
        <div class="card bg-white mb-5 mt-5 border-0" style="box-shadow: 0 12px 15px rgba(0, 0, 0, 0.02); ">
          <div class="card-body p-5 text-center">
          <i class="fa-solid fa-circle-check fa-5x" style="color: #04c311;"></i>
            <h3>You have successfully booked!</h3>
            <br>
            <br>
            <p>Please wait for approval, We will send you detailed information about your booked service via email.  </p>
            <h5>Thank You!</h5>
            <br>
            <a href="clientdashboard.php" type="button" class="btn btn-success mb-3" style="color:white; width:50%;">
                Ok
</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  
</body>

</html>