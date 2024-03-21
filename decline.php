<?php
session_start(); // Make sure to start the session

include "connection.php";

if (isset($_SESSION['user_id']) && isset($_GET['cluster'])) {
    $user_id = $_SESSION['user_id'];
    $cluster = $_GET['cluster'];
    echo "User ID: $user_id, Cluster: $cluster"; // Debugging output
    // Determine the table based on the cluster
    $table_name = '';
    switch ($cluster) {
        case 'Dental Health Care':
            $table_name = 'confirmedappointment';
            break;
        case 'Check-Up':
            $table_name = 'confirmedcheckup';
            break;
        // Add more cases for other clusters if needed

        default:
            echo "Invalid cluster";
            exit(); // Exit if the cluster is not recognized
    }

    // Use a prepared statement to delete the appointment from the appropriate table
    $deleteSql = "DELETE FROM $table_name WHERE user_id=?";
    $stmt = $connection->prepare($deleteSql);

    // Check if the prepare statement succeeded
    if ($stmt) {
        // Bind the parameter, assuming 'user_id' is an integer
        $stmt->bind_param("i", $user_id);

        if ($stmt->execute()) {
            // Successfully declined appointment
            $_SESSION['message'] = "Appointment declined successfully.";
            header("Location: account.php");
            exit(); // Always exit after a header redirect
        } else {
            echo "Error updating record: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $connection->error;
    }
} else {
    echo "Invalid request.";
}

$connection->close();
?>
