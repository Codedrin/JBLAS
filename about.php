
<?php session_start(); 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>JBLAS</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Website icon-->
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="favicon_io/site.webmanifest">
    <style>
        /* Custom styles */
        .jumbotron {
            background-image: url('https://sentryinsurancevc.com/wp-content/uploads/2019/09/contractor_banner3.jpg');
            background-size: cover;
            background-position: center;
            color: #ffffff;
            text-align: center;
            padding: 100px 0;
            margin-bottom: 0;
        }

        .jumbotron h1 {
            font-size: 3rem;
          color: white;
        }
 

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
            max-width: 800px;
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 1.25rem;
            color: #007bff;
        }

        .card-text {
            font-size: 1rem;
            color: #6c757d;
        }
        .card-title{
            color: #4E3636;
            font-weight: bold;
        }
        
    </style>
</head>
<body>

<div class="jumbotron">
    <div class="container">
        <h1 class="display-4" >Welcome to JBLAS</h1>
        <a href="index.php" style = "text-decoration: none";><p class="display-5" style = "color: white";>Back to Home</p></a>
          
    </div>
</div>

<div class="container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Mission and Vision</h5>
            <h5 class="card-title">Vision</h5>
            <p class="card-text">Our vision is to be recognized as a trusted partner in elevating living spaces, providing innovative solutions, and exceeding customer expectations. To be the premier destination for home renovation and services, setting the standard for excellence and innovation in the industry.</p>
            <h5 class="card-title">Mission</h5>
            <p class="card-text">Our mission is to provide a comprehensive and seamless experience for homeowners, offering top-notch renovation solutions and a wide array of services under one roof and strive to exceed customer expectations through exceptional craftsmanship, superior quality, and unmatched customer service. Our goal is to transform houses into dream homes while fostering lasting relationships built on trust, integrity, reliability, integrity, dedication, and continuous improvement, we strive to be the go-to destination for all home renovation needs, fostering long-lasting relationships with our valued clients.</p>
            <h5 class="card-title">Contacts</h5>
            <p class="card-text">
                <strong>Tel. no:</strong> 042- 785-1886.<br><br>
                <strong>Cel. no:</strong> globe/tm: 09956612009 or  Smart/tnt: 09982283504.<br><br>
                                           
            </p>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
<!-- Bootstrap JS and dependencies -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
