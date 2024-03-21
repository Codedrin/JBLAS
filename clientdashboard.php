<?php
session_start();
// Check if user is logged in
if (isset($_SESSION['user_id']) && isset($_SESSION['username']) && isset($_SESSION['acc_type'])) {
  $user_id = $_SESSION['user_id'];
  $username = $_SESSION['username'];
  $acc_type = $_SESSION['acc_type'];
  
    $userID= $_SESSION['user_id'];

  include "connection.php";
  
  // Fetch client-specific data
$sql = "SELECT * FROM clients WHERE user_id = '$userID'";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    $clientData = $result->fetch_assoc();
}

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
  <title>JBLAS Home</title>
 
       <!-- Stylesheet -->
       <link rel="stylesheet" href="style/indexStyle.css">

<!-- bootstrap link--->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Font Awesome Kit -->
    <script src="https://kit.fontawesome.com/23688bd133.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css">


    <!-- Favicon -->

    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
  <link rel="manifest" href="favicon_io/site.webmanifest">
  
<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap" rel="stylesheet">

  <style >
    section {
      padding: 5%;
    }

    .imgScheduling {
      height: 120px;
      width: 120px;
    }

    p {
      text-align: justify;
    }

    .logo {
      height: 50px;
      width: 50px;
    }

    #carouselSection{
      height: 100%;
      max-width: 100%;
      padding: 0;
      margin: 0;
    }
    .imgCarousel{
      height: 400px;
      max-width: 100%;
    }
    section{
      padding: 5%;
    }
    .dropdown:hover .dropdown-menu {
    display: block;
  }
  /* Media query for tablets */
@media (max-width: 992px) {
 .navCategory {
   font-size: 15px; /* Adjust font as needed for tablets */
  }
}

/* Media query for mobile phones */
@media (max-width: 768px) {
  .navCategory {
    font-size: 10px; /* Adjust font as needed for mobile*/
  }
}
  </style>
  <script>
    function confirmLogout() {
      var modal = new bootstrap.Modal(document.getElementById('logoutModal'), {
        backdrop: 'static',
        keyboard: false
      });

      modal.show();
    }
  </script>
<style>
    .dropdown:hover .dropdown-menu {
    display: block;
  }


.navbar-nav .choices {
    border-right: 1px solid #ccc; /* Add a solid border to the right of each nav-item */
    padding-right: 10px; /* Add some padding to create space between text and border */
}

.navbar-nav .choices:last-child {
    border-right: none; /* Remove border from the last nav-item */
}
  </style>
</head>

<body>
<?php include "navbarProfile.php"; ?>

  <section id="carouselSection" >
    <div class="container" style="padding: 0; margin: 0; max-width: 100%; height: 100%; "  >
    <video width="100%" autoplay loop muted>
    <source src="images/Videos.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>
</div>
  </section>
  
  <nav class="navbar navbar-expand navbar-light bg-light navCategory">
  <ul class="navbar-nav mx-auto">
    <li class="nav-item choices">
      <b><a class="nav-link active" href="clientdashboard.php"><i class="fa-solid fa-house-chimney"></i> Home Renovation/Repair Services</a></b>
    </li>
    <li class="nav-item choices">
      <a class="nav-link" href="utility.php"><i class="fa-solid fa-screwdriver-wrench"></i> Utility Services</a>
    </li>
    <li class="nav-item choices">
      <a class="nav-link" href="installation.php"><i class="fa-brands fa-get-pocket"></i> Installation Services</a>
    </li>
  </ul>
</nav>

<div class="container" style="padding: 5% 10%; text-align: center; ">
<div class="row row-cols-1 row-cols-md-2 g-4 mb-5">
  <div class="col">
    <div class="card h-100">
      <img src="images/ceiling.png" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Ceiling Renovation Services</h5>
        <p class="card-text">Expert ceiling installation and repair services to enhance the aesthetic appeal and functionality of your space.</p>
        <b><p class="card-title text-center" > Estimated Price: <br>PHP 2,000 - PHP 5,000 per service.</p></b>
      </div>
      <div class="card-footer">
        <small class="text-body-secondary"><a href="Home_ceiling.php" type="button" class="btn btn-primary btn-rounded" style="color:black; background-color:#F3BB83; width:70%;">Book Now</a>
       </small>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <img src="images/floor.png" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Flooring Renovation</h5>
        <p class="card-text"> Professional flooring installation and restoration services using a variety of materials including tiles, wood, and laminate. </p>
        <b><p class="card-title text-center" >Estimated Price: <br>PHP 3,000 - PHP 10,000 per service.</p></b>
      </div>
      <div class="card-footer">
        <small class="text-body-secondary"><a href="Home_flooring.php" type="button" class="btn btn-primary btn-rounded" style="color:black; background-color:#F3BB83; width:70%;">Book Now</a>
        </small>
      </div>
    </div>
  </div>
</div>

<div class="row row-cols-1 row-cols-md-2 g-4 mb-5">
  <div class="col">
    <div class="card h-100">
      <img src="images/window.png" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Window Renovation/Repair Services</h5>
        <p class="card-text">Efficient window repair services to fix issues like broken panes, faulty mechanisms, and draft problems. </p>
        <b><p class="card-title text-center" >Estimated Price: <br>PHP 1,500 - PHP 4,000 per service.</p></b>
      </div>
      <div class="card-footer">
        <small class="text-body-secondary"><a href="Home_window.php" type="button" class="btn btn-primary btn-rounded" style="color:black; background-color:#F3BB83; width:70%;">Book Now</a>
       </small>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <img src="images/garden.png" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Garden Landscaping</h5>
        <p class="card-text">Professional landscaping services to beautify outdoor spaces with plants, hardscaping, and irrigation systems</p>
        <b><p class="card-title text-center" >Estimated Price: <br>PHP 5,000 - PHP 20,000 per service.</p></b>
      </div>
      <div class="card-footer">
        <small class="text-body-secondary"><a href="Home_gardening.php" type="button" class="btn btn-primary btn-rounded" style="color:black; background-color:#F3BB83; width:70%;">Book Now</a>
       </small>
      </div>
    </div>
  </div>
</div>

<div class="row row-cols-1 row-cols-md-2 g-4 mb-5">
  <div class="col">
    <div class="card h-100">
      <img src="images/door.png" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Door Renovation/Repair Services</h5>
        <p class="card-text">Repair and maintenance of doors including fixing hinges, handles, and alignment issues for smooth operation.</p>
        <b><p class="card-title text-center" >Estimated Price: <br>PHP 1,500 - PHP 4,000 per service.</p></b>
      </div>
      <div class="card-footer">
        <small class="text-body-secondary"><a href="Home_door.php" type="button" class="btn btn-primary btn-rounded" style="color:black; background-color:#F3BB83; width:70%;">Book Now</a>
       </small>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <img src="images/painting.png" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Wall Painting</h5>
        <p class="card-text">High-quality interior and exterior painting services to revitalize and protect your home's surfaces.</p>
        <b><p class="card-title text-center" >Estimated Price: <br>PHP 2,500 - PHP 8,000 per service.</p></b>
      </div>
      <div class="card-footer">
        <small class="text-body-secondary"><a href="Home_painting.php" type="button" class="btn btn-primary btn-rounded" style="color:black; background-color:#F3BB83; width:70%;">Book Now</a>
        </small>
      </div>
    </div>
  </div>
</div>

</div>



  <!-- Modal for LogOut Confirmation -->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirm Logout</h5>
          <button type="button btn-outline" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to log out?
        </div>
        <div class="modal-footer">
          <button style="background-color:green;" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger" onclick="window.location.href='logout.php'">Log Out</button>
        </div>
      </div>
    </div>
  </div>




<?php include('footer.php'); ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>