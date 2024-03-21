<?php
session_start();
include("session.php");
include("connection.php");
include("dbcon.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>Profile</title>
<!-- Website icon-->
<link rel="icon" type="image/png" sizes="32x32" href="../Admin/favicon_io/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../Admin/favicon_io/favicon-16x16.png">
<link rel="manifest" href="../Admin/favicon_io/site.webmanifest">


<!-- Custom fonts for this template-->
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

<!-- Custom styles for this template-->
<link href="css/sb-admin-2.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/sb-admin-min-2.css">

</head>
<body>
<?php include('../Admin/navbar.php'); ?>
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
                                <p><strong>Name: <?php echo $clientData['name']; ?></strong> </p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <p><strong>Username: <?php echo $clientData['username']; ?></strong></p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <p><strong>Email: <?php echo $clientData['email']; ?></strong></p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <p><strong>Type of Service: <?php echo $clientData['servicename']; ?></strong></p>
                            </div>
                        </div>
             
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <a href="../Admin/update_profile.php" style="color: gray" ><i class="fas fa-edit"></i></a>
                                
                            </div>
                 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../Admin/footer.php'); ?>
</body>
</html>
