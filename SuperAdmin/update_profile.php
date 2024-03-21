<?php include('super_admin_dashboard.php'); ?>
<?php 

include('Session_Data.php');


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $newUsername = $_POST['newUsername'];
  $newEmail = $_POST['newEmail'];

  // Set the acc_type value (assuming it comes from the session)
  $accType = $_SESSION['acc_type']; // Adjust as per your session variable name

  // Include the database connection
  include('connection.php');

  // Update admin profile information in the database
  $query = "UPDATE admin SET username=?, email=? WHERE acc_type = ?";
  $stmt = $connection->prepare($query);

  // Bind parameters
  $stmt->bind_param("sss", $newUsername, $newEmail, $accType); // "sss" indicates three string parameters

  // Execute query
  $stmt->execute();

  // Check if update was successful
  if ($stmt->affected_rows > 0) {
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
