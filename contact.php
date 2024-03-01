<?php

include('dbcon.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    try {
        // Insert data into the "contact" table
        $query = "INSERT INTO contact (name, email, message) VALUES ('$name', '$email', '$message')";
        $result = $conn->query($query);

        if ($result) {
            // Send email using PHPMailer
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'aldrinrosales0428@gmail.com';
            $mail->Password = 'mwfi qnxn fgef ioyb';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('aldrinrosales0428@gmail.com');
            $mail->addAddress($email);  
            $mail->isHTML(true);
            $mail->Body = $_POST["message"];

            if ($mail->send()) {
                // Redirect to success page
                echo "<script> window.location.href = 'success_page.php'; </script>";
                exit();
            } else {
                echo "<script>alert('Error: Failed to send email. Please try again.');</script>";
            }
        } else {
            echo "<script>alert('Error: Form submission failed. Please try again.');</script>";
        }
    } catch (Exception $e) {
        echo "<script>alert('An error occurred: " . $e->getMessage() . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>JBLAS</title>
    <!-- Website icon-->
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="favicon_io/site.webmanifest">



    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>
<body>
  
<div class="container mt-5">
  <div class="row">
    <div class="col-md-6">
      <h5 class="card-title display-4 bold-text"><strong style="color: #607274;">Contact us</strong></h5>
      <div class="card">
        <div class="card-body" style="color: #607274;">
          <form method="post">    
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" name="name" autocomplete="name" placeholder="Enter your name">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" autocomplete="email" placeholder="Enter your email">
            </div>
            <div class="form-group">
              <label for="message">Message</label>
              <textarea class="form-control" id="message" name="message" rows="3" placeholder="Enter your message"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <img src="img/contact.png" class="img-fluid mt-4" alt="Image">
    </div>
  </div>
</div>
</body>
</html>

<?php

// Function to check if the form has been submitted and re-enter the information
function reenterFormData() {
    if (isset($_SESSION['form_data'])) {
        $formData = $_SESSION['form_data'];
        unset($_SESSION['form_data']); // Clear the session data after re-entering

        foreach ($formData as $key => $value) {
            echo '<script>document.getElementById("' . $key . '").value = "' . $value . '";</script>';
        }
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Store form data in session
    $_SESSION['form_data'] = $_POST;

    // Handle form submission...
}
?>
