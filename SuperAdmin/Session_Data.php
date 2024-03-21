<?php
// Initialize session

// Check if user is logged in
if (isset($_SESSION['user_id']) && isset($_SESSION['username']) && isset($_SESSION['acc_type'])) {
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $acc_type = $_SESSION['acc_type'];

    $clientUsername = $_SESSION['user_id'];

    include "connection.php";

    // Fetch client-specific data
    $sql = "SELECT * FROM admin WHERE user_id = '$clientUsername'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $clientData = $result->fetch_assoc();
    } else {
        // Redirect to the login page if client data is not found
        header('Location: ../../../login.php');
        exit();
    }
    $userID = $_SESSION['user_id'];
} else {
    // Redirect to the login page if the user is not logged in
    header('Location: ../../../login.php');
    exit();
}
?>
