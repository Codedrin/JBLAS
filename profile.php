<?php
session_start();
//no backend pa to fetch the data of the user wala kasi ako login dinako gumawa
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
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="favicon_io/site.webmanifest">

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
<?php include('navbar.php'); ?>
<div class="container">
    <div class="container-lg">
        <div class="row justify-content-center mt-5">
            <div class="col-lg-8">
                <div class="card box mb-5">
                    <div class="card-body shadow">
                        <div class="row mb-3">
                            <div class="col-md-12 text-center">
                                <img src="img/undraw_profile.svg" alt="Profile Image" class="svg-image img-fluid" style="max-width: 100px;">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <p><strong>First Name:</strong> </p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <p><strong>Last Name:</strong></p>
                            </div>
                            
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <p><strong>username:</strong></p>
                            </div>
                            
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <p><strong>Email:</strong></p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <p><strong>Phone Number:</strong></p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <p><strong>Service:</strong></p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <p><strong>Address:</strong></p>
                                <a href="update_profile.php" style="color: gray" ><i class="fas fa-edit"></i></a>
                                
                            </div>
                 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
</body>
</html>
