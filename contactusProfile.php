
<?php 
session_start();
// Check if user is logged in
if (isset($_SESSION['user_id']) && isset($_SESSION['username']) && isset($_SESSION['acc_type'])) {
  $user_id = $_SESSION['user_id'];
  $username = $_SESSION['username'];
  $acc_type = $_SESSION['acc_type'];
  
    $clientUsername= $_SESSION['username'];

  include "connection.php";
  
  // Fetch patient-specific data
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

  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Contact Us!</title>
   
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
  
  <style>
    /* Custom CSS for positioning the FAQs icon */
    body {
  max-width: 100%;
  margin: 0;
  padding: 0;
  text-align: center;
  line-height: normal;
}

    .logo {
      height: 70px;
      width: 70px;
      padding: 10px;
    }
    .logoo {
      height: 250px;
      width: 250px;
      padding: 10px;
    }
    #about{
      color: black;
        padding:5% 10%;
    }
    .dropdown:hover .dropdown-menu {
    display: block;
  }
 .designBG{
  background-image:url(images/HouseBG.png ) ;
  background-repeat: no-repeat;
  background-size:cover;
 }
  </style>
</head>

<body>

<?php include "navbarProfile.php" ?>  

 <div class="designBG" style="width: 100%; height: 250px; color:white; padding: 5%;  text-align:center;"  >
  <div class="col-lg-8 col-md-12 col-sm-12" >
  <h2 style="color:white;" >JBLAS Home Renovation Services</h2>
  <h6>"Your One-Stop-Shop for Home Renovation/ Repair Services"</h6>
  <br><div class="gap-2 col-12 col-md-6 mx-auto">
    <a href="contactus.php" type="button" class="btn btn-outline-light btn-lg btn-block" style="border-radius: 20px;">
        Call Us: (042) 785-1886
    </a>
</div>
  </div>
  </div>
 </div>

  <section id="about">
   
      <div class="row">
    <div class="col-lg-6">
    <img class="p-2 logoo" src="images/MODERNHOME1.png" alt="">
        <b><h3>JBLAS</h3></b>
        <h4>Home Renovation Services</h4><br>
        <b><p>Connect with Us:</p></b>
        <p style="line-height: 1.5rem; text-align:justify;" >CONTACTS: <br><i class="fa-solid fa-phone"></i> 042- 785-1886
		<br><br><i class="fa-solid fa-mobile-screen-button"></i> Mobile Contact: <br>Globe/TM: 09956612009
			   <br>Smart/TNT: 09982283504
<br><br>
         <br><i class="fa-solid fa-location-dot"></i> Office Address
         <br>Arellano Subdivision, 1, Sariaya, 4322 Quezon
</p>

    </div>
    <div class="col-lg-6">
        <!-- Content for the second column including the iframe -->
        <h5>Main Office Location:</h5>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1935.9422742886984!2d121.52878159513055!3d13.965476989334467!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd4ea5eb52791f%3A0x77f53ba3c2bb89e2!2sCSTC%20-%20College%20of%20Sciences%2C%20Technology%20and%20Communication%2C%20Inc.!5e0!3m2!1sen!2sph!4v1709010458885!5m2!1sen!2sph" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>


<div class="row mb-5" style="padding:3% ; text-align:justify;" >
        <div class="col-lg-6 col-md-6">
          <img class="imgOffer" src="images/housee.png" alt="">
        </div>
        <div class="col-lg-6 col-md-6 mt-5 mb-5">
          <h4>JBLAS Renovation Services</h4>
          <h6>From comprehensive house renovation services including ceiling enhancements, painting, flooring, window repairs, garden landscaping, and door repairs to essential utility services such as electrical work, plumbing, and water pipe maintenance, we ensure every aspect of your home is perfected. Elevate your living space with our professional installation services for security systems and cabinets, adding both security and organization to your home. With a commitment to quality craftsmanship and customer satisfaction, JBLAS is dedicated to turning your vision into reality. Experience the JBLAS difference today and unlock the full potential of your home."</h6>    </div>
      </div>
  </section>

  <?php include ("footer.php") ?>
</body>

</html>