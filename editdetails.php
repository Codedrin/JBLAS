<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and validate the updated contact number, email, and username
    $newContactNumber = $_POST['contact_number'];
    $newEmail = $_POST['email'];
    $newUsername = $_POST['username'];
    
    // Database connection
    include "connection.php";

    // Update the contact number and email in the database
    $userID = $_SESSION['user_id'];
    
//putangina neto pinahirapan ako hhaha
    $sql = "UPDATE clients SET mobile_number = ?, email = ?, username = ? WHERE user_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sssi", $newContactNumber, $newEmail, $newUsername, $userID);

    if ($stmt->execute() === TRUE) {
        // Successfully updated the data
        header("Location: account.php"); 
        // Handle the case where the update fails (you can display an error message)
        echo "Error updating record: " . $connection->error;
    }


    $stmt->close();
}
?>
