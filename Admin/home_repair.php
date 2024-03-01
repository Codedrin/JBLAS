<?php session_start();
include('../dbcon.php');
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


</head>
<body>
    <?php include('../Admin/navbar.php'); ?>
                    <!-- Begin Page Content -->
                    <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800">Dashboard<small style = "color: #43766C">/Home Renovation/Repair Services
            </small></h1>

</div>
        <!-- Content Row -->
                    <div class="row align-items-center">
                        <!-- Pending Requests -->

            <div class="col-xl-4 col-md-6 mb-4">
                <a href="#" class="card-link">
                    <div class="card shadow h-100 py-2 margin">
                        <div class="card-body text-center">
                            <div class="mb-1">
                                <img src="../Admin/img/celling.jpg" alt="electrical" class="img-fluid" style = "border-radius: 5px; width: 260px; height: 127px;">
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 mt-3"></div>
                            <a href="../Admin/celling.php" class="btn btn-sm btn-block" style="background-color: #76453B; color:white;">Celling Renovation<span class="badge bg-danger" id="pending-count"></span></a>
                            <!-- Display pending count here -->
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <a href="#" class="card-link">
                    <div class="card shadow h-100 py-2 margin">
                        <div class="card-body text-center">
                            <div class="mb-1">
                                <img src="../Admin/img/painting.jpg" alt="electrical" class="img-fluid" style = "border-radius: 5px; width: 260px; height: 127px;">
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 mt-3"></div>
                            <a href="../Admin/wallpainting.php" class="btn btn-sm btn-block" style="background-color: #76453B; color:white;">Wall Painting <span class="badge bg-danger" id="pending-count"></span></a>
                            <!-- Display pending count here -->
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <a href="#" class="card-link">
                    <div class="card shadow h-100 py-2 margin">
                        <div class="card-body text-center">
                            <div class="mb-1">
                                <img src="../Admin/img/flooring.jpg" alt="electrical" class="img-fluid" style = "border-radius: 5px; width: 260px; height: 127px;">
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 mt-3"></div>
                            <a href="../Admin/floor_renovation.php" class="btn btn-sm btn-block" style="background-color: #76453B; color:white;">Flooring Renovation<span class="badge bg-danger" id="pending-count"></span></a>
                            <!-- Display pending count here -->
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <a href="#" class="card-link">
                    <div class="card shadow h-100 py-2 margin">
                        <div class="card-body text-center">
                            <div class="mb-1">
                                <img src="../Admin/img/windowrepair.jpg" alt="electrical" class="img-fluid" style = "border-radius: 5px; width: 260px; height: 127px;">
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 mt-3"></div>
                            <a href="../Admin/window_glass.php" class="btn btn-sm btn-block" style="background-color: #76453B; color:white;">Window Repair <span class="badge bg-danger" id="pending-count"></span></a>
                            <!-- Display pending count here -->
                        </div>
                    </div>
                </a>
            </div>

                    
            <div class="col-xl-4 col-md-6 mb-4">
                <a href="#" class="card-link">
                    <div class="card shadow h-100 py-2 margin">
                        <div class="card-body text-center">
                            <div class="mb-1">
                                <img src="../Admin/img/gardenlandscaping.jpg" alt="electrical" class="img-fluid" style = "border-radius: 5px; width: 260px; height: 127px;">
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 mt-3"></div>
                            <a href="../Admin/garden_landscaping.php" class="btn btn-sm btn-block" style="background-color: #76453B; color:white;">Garden Landscaping <span class="badge bg-danger" id="pending-count"></span></a>
                            <!-- Display pending count here -->
                        </div>
                    </div>
                </a>
            </div>
                      
            <div class="col-xl-4 col-md-6 mb-4">
                <a href="#" class="card-link">
                    <div class="card shadow h-100 py-2 margin">
                        <div class="card-body text-center">
                            <div class="mb-1">
                                <img src="../Admin/img/doorrepair.jpg" alt="electrical" class="img-fluid" style = "border-radius: 5px; width: 260px; height: 127px;">
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 mt-3"></div>
                            <a href="../Admin/door_renovation.php" class="btn btn-sm btn-block" style="background-color: #76453B; color:white;">Door Renovation <span class="badge bg-danger" id="pending-count"></span></a>
                            <!-- Display pending count here -->
                        </div>
                    </div>
                </a>

            </div>
          
</body>

</html>
<?php include('../Admin/footer.php'); ?>