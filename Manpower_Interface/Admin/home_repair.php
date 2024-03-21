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

<title>Home Repair</title>
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
<link href="../css/sb-admin-2.css" rel="stylesheet">
<link href="../css/sb-admin-2.min.css" rel="stylesheet">


</head><body>
    <?php include('../Admin/navbar.php'); ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard<small style="color: #43766C">/Utility Services
                </small></h1>

        </div>
        <!-- Content Row -->
        <div class="row align-items-center">
            <?php
            include "connection.php";

            // Define services and corresponding image paths
            $services = [
                'Ceiling' => '../Admin/img/celling.jpg',
                'Painting' => '../Admin/img/painting.jpg',
                'Flooring' => '../Admin/img/flooring.jpg',
                'Window' => '../Admin/img/windowrepair.jpg',    
                'Gardening' => '../Admin/img/gardenlandscaping.jpg',
                'Door' => '../Admin/img/doorrepair.jpg'
            ];

            // Loop through each service
            foreach ($services as $service => $image) {
                // Query to count pending bookings for the current service
                $sql = "SELECT COUNT(*) AS count FROM services_tbl WHERE service_type='$service' AND status='pending'";
                $result = $connection->query($sql);
                if ($result) {
                    $row = $result->fetch_assoc();
                    $count = $row['count'];
                } else {
                    $count = 0;
                }

                // Output the card for the current service
                echo "
                <div class='col-xl-4 col-md-6 mb-4'>
                    <div class='card shadow h-100 py-2 margin'>
                        <div class='card-body text-center'>
                            <div class='mb-1'>
                                <img src='$image' alt='$service' class='img-fluid' style='border-radius: 5px; width: 260px; height: 127px;'>
                            </div>
                            <div class='h5 mb-0 font-weight-bold text-gray-800 mt-3'></div>
                            <a href='../Admin/" . strtolower(str_replace(' ', '_', $service)) . ".php' class='btn btn-sm btn-block' style='background-color: #76453B; color:white;'>$service <span class='badge bg-danger' id='pending-count'>$count</span></a>
                            <!-- Display pending count here -->
                        </div>
                    </div>
                </div>";
            }
            ?>
        </div>
    </div>
</body>
</html>
<?php include('../Admin/footer.php'); ?>