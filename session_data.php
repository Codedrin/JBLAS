<?php
session_start();
// Check if user is logged in
if (isset($_SESSION['user_id']) && isset($_SESSION['username']) && isset($_SESSION['acc_type'])) {
  $user_id = $_SESSION['user_id'];
  $username = $_SESSION['username'];
  $acc_type = $_SESSION['acc_type'];
  
  // Include database connection
  include "connection.php";
  
  // Fetch client-specific data based on user_id
  $sql = "SELECT * FROM clients WHERE user_id = ?";
  $stmt = $connection->prepare($sql);
  $stmt->bind_param("i", $user_id);
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
