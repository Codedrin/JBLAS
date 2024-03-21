<?php
// Include database connection
include('dbcon.php');

try {
    // Query to count pending tasks
    $query = "SELECT COUNT(*) AS count FROM users WHERE status = 0";
    $statement = $conn->query($query);
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    // Check if the count was retrieved successfully
    if ($result) {
        // Return the count as plain text
        echo $result['count'];
    } else {
        echo "Error: Unable to retrieve pending count";
    }
} catch(PDOException $e) {
    // Handle database connection error
    echo "Error: " . $e->getMessage();
}
?>
