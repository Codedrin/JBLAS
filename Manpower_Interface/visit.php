<?php
include "../connection.php";

// Check if all required parameters are set and not empty
if(isset($_GET['book_id'], $_GET['email'], $_GET['name'], $_GET['date']) &&
   !empty($_GET['book_id']) && !empty($_GET['email']) && !empty($_GET['name']) && !empty($_GET['date'])) {

    // Sanitize input parameters
    $book_id = $connection->real_escape_string($_GET['book_id']);
    $email = $connection->real_escape_string($_GET['email']);
    $name = $connection->real_escape_string($_GET['name']);
    $date = $connection->real_escape_string($_GET['date']);

    // Update the status to "onvisit" in the database
    $sql = "UPDATE services_tbl SET status = 'onvisit' WHERE book_id = ?";
    
    // Prepare and execute the SQL statement
    if ($stmt = $connection->prepare($sql)) {
        $stmt->bind_param("s", $book_id);
        if ($stmt->execute()) {
            include("sendEmail.php");
            // Redirect to a specific page after successful update
            header("Location: ".$_SERVER['HTTP_REFERER']);
        exit();
        } else {
            echo "Error updating record: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $connection->error;
    }
} else {
    echo "Invalid parameters";
}
?>
