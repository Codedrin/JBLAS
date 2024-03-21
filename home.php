<?php
session_start();
// Check if user is logged in
if (isset($_SESSION['user_id']) && isset($_SESSION['username']) && isset($_SESSION['acc_type'])) {
  $user_id = $_SESSION['user_id'];
  $username = $_SESSION['username'];
  $acc_type = $_SESSION['acc_type'];
  
    $clientUsername= $_SESSION['username'];

  include "connection.php";
  
  // Fetch client-specific data
$sql = "SELECT * FROM clients WHERE username = '$clientUsername'";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    $clientData = $result->fetch_assoc();
}

} else {
  // Redirect to the login page if the user is not logged in
  header('Location:login.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>JBLAS Company</title>
           <!-- Stylesheet -->
           <link rel="stylesheet" href="style/indexStyle.css">
    <link rel="stylesheet" href="style.css">
    <!-- bootstrap link--->
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
  <style>
    .dropdown:hover .dropdown-menu {
    display: block;
  }
 
  </style>
</head>

<body>
  <?php include "navbarProfile.php"; ?>
  <section id="carouselSection" >
    <div class="container" style="padding: 0; margin: 0; max-width: 100%; height: 100%; "  >
    <video width="100%" autoplay loop muted>
    <source src="images/Video.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>
</div>
  </section>

  <!-- What we offer -->
  <section style="background-color:white; color:black; text-align:center; padding:5% 15%;">
    <div class="container mt-5 p-5" style=" color:#184375; ">
      <h2>Our Services</h2>
      <div class="row mb-5">
        <div class="col-lg-6 col-md-6">
          <img class="imgOffer" src="images/housee.png" alt="">
        </div>
        <div class="col-lg-6 col-md-6 mt-5 mb-5">
          <h4>House Renovation Services</h4>
          <p> "JBLAS offers a comprehensive suite of house renovation services to elevate your living space. From ceiling enhancements to painting, flooring, window repair, garden landscaping, and door repairs, our skilled professionals are here to revitalize your home. Contact us today to transform your house into your dream home with JBLAS."</p>
          <br><a href="clientdashboard.php" type="button" class="btn btn-primary btn-rounded" style="color:white; background-color:black; width:70%;">View Services  <i class="fa-solid fa-arrow-right"></i></a>
        </div>
      </div>

      <div class="row mb-5">
        <div class="col-lg-6 col-md-6 mt-5 mb-5">
          <h4>Utility Services</h4>
          <p> "At JBLAS, we provide essential utility services to ensure your home runs smoothly. From electrical work and plumbing to water pipe maintenance, our expert team is here to handle all your utility needs with precision and care. Trust JBLAS to keep your home functioning efficiently. Contact us today for reliable utility services.""</p>
          <br><a href="utility.php" type="button" class="btn btn-primary btn-rounded" style="color:white; background-color:black; width:70%;">View Services  <i class="fa-solid fa-arrow-right"></i></a>
        </div>
        <div class="col-lg-6 col-md-6">
          <img class="imgOffer" src="images/utility.png" alt="">
        </div>
      </div>

      <div class="row">
        <div class="col-lg-6 col-md-6">
          <img class="imgOffer" src="images/installation.png" alt="">
        </div>
        <div class="col-lg-6 col-md-6 mt-5 mb-5">
          <h4>Installation Services</h4>
          <p> "JBLAS offers professional installation services to enhance your home's security and organization. From security system installations to cabinet installations, our expert team ensures precision and reliability in every project. Elevate your home with JBLAS installation services. Contact us today to discuss your installation needs."</p>
          <br><a href="installation.php" type="button" class="btn btn-primary btn-rounded" style="color:white; background-color:black; width:70%;">View Services  <i class="fa-solid fa-arrow-right"></i></a>
        </div>
      </div>


    </div>

  </section>

  <section id="sectionX" style=" color:white; text-align:center; padding:5% 15%; ">
    <h4>"Discover the difference with JBLAS, your trusted partner in home transformation."</h4>
      <br><h6>From comprehensive house renovation services including ceiling enhancements, painting, flooring, window repairs, garden landscaping, and door repairs to essential utility services such as electrical work, plumbing, and water pipe maintenance, we ensure every aspect of your home is perfected. Elevate your living space with our professional installation services for security systems and cabinets, adding both security and organization to your home. With a commitment to quality craftsmanship and customer satisfaction, JBLAS is dedicated to turning your vision into reality. Experience the JBLAS difference today and unlock the full potential of your home."</h6>
      <br><div class="gap-2 col-12 mx-auto"  ><a href="contact.php" type="button" class="btn btn-outline-light btn-rounded" style="color:#F3BB83; background-color:none; border-width:2px; border-color:#F3BB83;  width:50%; height:50px; border-radius: 20px; font-size:22px;">Contact Us</a>
    </section>


<section id="Testimony" style=" color:black; text-align:center; padding:5% 15%; " >
<div class="container" >
<div class="row" >
<div class="col-lg-4 col-md-4 col-sm-12 mt-5" >
<h4>What Our Customers Says About Our Home Renovation Services</h4>
</div>
<div class="col-lg-8 col-md-8 col-sm-12" style="background-color:darkgrey;">
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000"> 
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/6.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="images/7.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="images/8.png" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</div>

</div>
</div>
</section>

<?php include ("faq.php"); ?>
<?php include ("footer.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.js"></script>
  <script>
    function toggleContent() {
      var hiddenContent = document.querySelector('.hidden-content');
      var button = document.querySelector('button');

      if (hiddenContent.style.display === 'none') {
        hiddenContent.style.display = 'inline'; // or 'block', 'inline-block', etc., depending on your layout
        button.style.display === 'none';
      } else {
        hiddenContent.style.display = 'none';
        button.textContent = 'See more...';
      }
    }
  </script>
</body>

</html>