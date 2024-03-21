<?php
session_start();
include('Session_Data.php'); 

//the reports will display on the super admin side

?>
<!DOCTYPE html>
<html lang="en">
  
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Reports</title>
    <!-- Website icon-->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
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
<body>
    <?php include ('navbar.php');?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard<small style = "color: #503C3C">/Reports</small></h1>
        </div><div class="row justify-content-center mb-5">
        <?php include "tables2.php"; ?>
        </div>
    </div>
    <?php include('footer.php');?>
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>

<script>
    // JavaScript to check if all required fields are filled before submission
    document.getElementById('reportForm').addEventListener('submit', function (event) {
        var form = event.target;
        var isValid = form.checkValidity(); // Check if the form is valid
        if (!isValid) {
            // If the form is not valid, prevent submission
            event.preventDefault();
            event.stopPropagation();
        } else {
            // Show the success message
            alert('You have successfully submitted your report!');
        }
        form.classList.add('was-validated'); // Add Bootstrap's validation styles
    });
</script>

</body>
</html>