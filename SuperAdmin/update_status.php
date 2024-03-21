<?php
// Include database connection
include('dbcon.php');

// Check if entry ID is provided
if (isset($_POST['id'])) {
    // Sanitize the input
    $id = $_POST['id'];

    // Update the status in the database
    $query = "UPDATE users SET status = 1 WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->bindParam(':id', $id);
    $result = $statement->execute();

    if ($result) {
        // Increment pending task count
        $query_pending_count = "SELECT COUNT(*) AS count FROM users WHERE status = 0";
        $statement_pending_count = $conn->query($query_pending_count);
        $pending_count = $statement_pending_count->fetch(PDO::FETCH_ASSOC)['count'];
        echo $pending_count;
    } else {
        echo "Error updating status";
    }
} else {
    echo "Entry ID not provided";
}
?>