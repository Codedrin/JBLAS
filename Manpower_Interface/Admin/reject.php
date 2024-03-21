<?php
include "../../connection.php";

// Check if book_id and email are set and not empty
if(isset($_GET['book_id']) && !empty($_GET['book_id']) && isset($_GET['email']) && !empty($_GET['email']) && isset($_GET['name']) && !empty($_GET['name'])) {
    $book_id = $_GET['book_id'];
    $email = $_GET['email'];
    $name = $_GET['name'];

    // Sanitize the book_id to prevent SQL injection
    $sanitized_book_id = $connection->real_escape_string($book_id);

    // Update the status to "reject" in the database
    $sql = "UPDATE services_tbl SET status = 'reject' WHERE book_id = ?";
    
    // Prepare the SQL statement
    $stmt = $connection->prepare($sql);
    
    // Bind the parameter
    $stmt->bind_param("s", $sanitized_book_id);
    
    // Execute the statement
    if ($stmt->execute()) {
        include("sendEmailReject.php");
        // Redirect back to the page where the user came from
        header("Location: ".$_SERVER['HTTP_REFERER']);
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    
    // Close the statement
    $stmt->close();
} else {
    echo "Invalid book_id parameter";
}
?>
