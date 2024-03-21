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
  <title>About</title>
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

  <section id="about">
    
    <div   >
      <img class="p-5 logoo" src="images/MODERNHOME1.png" alt="">
        <b><h3>JBLAS</h3></b>
        <h4>Home Renovation Services</h4>
        <h4>One-Stop-Shop</h4>
        <br><br>
        <h6 style="text-align:justify; line-height: 1.5em;" class="mb-3"><b>JBLAS Home Renovation Services</b> offers innovative and creative solutions for all your design and renovation needs. With years of experience, we provide high-quality services tailored to your requirements. From start to finish, we ensure timely delivery of top-notch results. Our attention to detail, excellent customer service, and commitment to excellence set us apart in the design and renovation industry.</h6>
    </div>
    
    <br><br><br>
    <div class="row mb-5">
        <div class="col-lg-4  ">
            <img style="height: 200px; width:200px;" src="images/builder.png" alt="" class="mb-3">
           </div>
        <div class="col-lg-8  ">
            <b><h3 style="text-align:center;">Mission</h3></b>
            <h6 class="mb-3" style="line-height: 1.5em;">
                "Our mission is to provide a comprehensive and seamless experience for homeowners, offering top-notch renovation solutions and a wide array of services under one roof and strive to exceed customer expectations through exceptional craftsmanship, superior quality, and unmatched customer service. Our goal is to transform houses into dream homes while fostering lasting relationships built on trust, integrity, reliability, integrity, dedication, and continuous improvement, we strive to be the go-to destination for all home renovation needs, fostering long-lasting relationships with our valued clients."</h6>
        </div>
    </div>
    <br><br><br><br>
    <div class="row">
        
        <div class="col-lg-8  ">
            <b><h3 style="text-align:center;">Vision</h3></b>
            <h6 class="mb-3" style="line-height: 1.5em;">"Our vision is to be recognized as a trusted partner in elevating living spaces, providing innovative solutions, and exceeding customer expectations. To be the premier destination for home renovation and services, setting the standard for excellence and innovation in the industry."</h6>
        </div>
        <div class="col-lg-4  ">
            <img style="height: 200px; width:200px;"  src="images/holdingHome.png" alt="" class="mb-3">
            </div>
    </div>
  </section>

  <?php include ("footer.php") ?>
</body>

<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.js"></script>
</html>