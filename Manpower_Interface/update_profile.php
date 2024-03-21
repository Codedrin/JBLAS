<title>Update Profile</title>
<?php 
session_start();
include('dbcon.php');
include('navbar.php');
      include('Session_Data.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $newUsername = $_POST['newUsername'];
    $newEmail = $_POST['newEmail'];
    
    // Update admin profile information in the database
    $query = "UPDATE manpower SET username=?, email=? WHERE user_id=?"; // Adjust column names and table name as per your database structure
    $stmt = $conn->prepare($query);
    
    // Bind parameters
    $stmt->bindParam(1, $newUsername);
    $stmt->bindParam(2, $newEmail);
    $stmt->bindParam(3, $_SESSION['user_id']); // Assuming you have stored admin ID in session
    
    // Execute query
    $stmt->execute();
     
    // Check if update was successful
    if ($stmt->rowCount() > 0) {
        echo '';
    } else {
        echo '<div class="alert alert-danger" role="alert">Failed to update profile. Please try again.</div>';
    }
}

?>

<div class="container mb-5">
  <div class="card">
    <div class="card-body">
      <h2 class="card-title" style="color: #116D6E;">Update Profile</h2>
      <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
          <label for="newUsername">New Username:</label>
          <input type="text" class="form-control" id="newUsername" name="newUsername" placeholder="Enter New Username" autocomplete="new-username" required>
        </div>
        <div class="form-group">
          <label for="newEmail">New Email:</label>
          <input type="email" class="form-control" id="newEmail" name="newEmail" placeholder="Enter New Email" autocomplete="new-email" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block" style="background-color: #4E3636;">Update Profile</button>
      </form>
    </div>
  </div>
</div>

<?php include('footer.php'); ?>

