<?php
// Include database connection
include('dbcon.php');

// Check if entry ID is provided
if (isset($_POST['id'])) {
    // Sanitize the input
    $id = $_POST['id'];

    // Delete the entry from the database
    $query = "DELETE FROM users WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->bindParam(':id', $id);
    $result = $statement->execute();


    if ($result) {
        // Decrement pending task count
        $query_pending_count = "SELECT COUNT(*) AS count FROM users WHERE status = 0";
        $statement_pending_count = $conn->query($query_pending_count);
        $pending_count = $statement_pending_count->fetch(PDO::FETCH_ASSOC)['count'];
        echo $pending_count;
    } else {
        echo "Error deleting task";
    }
} else {
    echo "Entry ID not provided";
}
?>