
<?php 

if (isset($_SESSION['user_id']) && isset($_SESSION['username']) && isset($_SESSION['acc_type'])) {
  $user_id = $_SESSION['user_id'];
  $username = $_SESSION['username'];
  $acc_type = $_SESSION['acc_type'];
  
  // Include database connection
  include "connection.php";
  
  // Fetch client-specific data based on user_id
  $sql = "SELECT * FROM clients WHERE user_id = ?";
  $stmt = $connection->prepare($sql);
  $stmt->bind_param("s", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();

  // Check if there are any rows returned
  if ($result->num_rows > 0) {

    $clientData = $result->fetch_assoc();
    $userID = $_SESSION['user_id'];
    $email = $clientData['email'];
  } else {

    echo "Error: Client data not found";
    exit();
  }

  // Close the statement
  $stmt->close();
} else {
  // Redirect to the login page if the user is not logged in
  header('Location: login.php');
  exit();
}
?>

<style> 
 .dropdown:hover .dropdown-menu {
    display: block;
  }
</style>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <!-- Logo and brand -->
      <a class="navbar-brand ms-5" href="clientdashboard.php">
        <img class="brand" style = "max-height: 50px;" src="images/MODERNHOME.png" alt="JBLAS">
      </a>
      <!-- Toggle button for mobile -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navbar links -->
      <div class="collapse navbar-collapse justify-content-center justify-content-lg-end me-lg-5" id="navbarNavAltMarkup">
        <ul class="navbar-nav mb-2 mb-lg-0 justify-content-center">
          <li class="nav-item me-lg-4 mt-1">
            <a class="nav-link active" aria-current="page" href="clientdashboard.php">Home</a>
          </li>
          <li class="nav-item dropdown mt-1">
            <a class="nav-link dropdown-toggle text-center" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Services
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="clientdashboard.php"><i class="fa-solid fa-house-chimney"></i> Home Renovation/Repair Services</a></li>
              <li><a class="dropdown-item" href="utility.php"><i class="fa-solid fa-screwdriver-wrench"></i> Utility Services</a></li>
              <li><a class="dropdown-item" href="installation.php"><i class="fa-brands fa-get-pocket"></i> Installation Services</a></li>
            </ul>
          </li>
      
          <li class="nav-item me-lg-4 mt-1">
            <a class="nav-link text-center" href="contactusProfile.php">Contact</a>
          </li>
          <li class="nav-item me-lg-4 mt-1">
            <a class="nav-link text-center" href="aboutProfile.php">About</a>
          </li>
<!-- User icon dropdown menu -->
<div class="nav-item dropdown  me-lg-5">
  <a class="nav-link dropdown text-center " href="#" id="navbarDropdownUserMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="fas fa-user-circle fa-2x" style="color: #F3BB83;"></i>
  </a>
  <ul class="dropdown-menu" aria-labelledby="navbarDropdownUserMenu">
      <li><span class="dropdown-item-text small">
      <?php echo $clientData['first_name'].' '.$clientData['midName'].' '. $clientData['last_name']; ?>
      </span></li>
    <li><a class="dropdown-item" href="account.php">Profile</a></li>
    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a></li>
  </ul>
</div>

    </nav>
    <!-- Button to trigger modal -->
    
    <!-- Logout Confirmation Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="logoutModalLabel">Logout Confirmation</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Are you sure you want to logout?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <a href="logout.php" class="btn btn-danger">Logout</a>
          </div>
        </div>
      </div>
    </div> 