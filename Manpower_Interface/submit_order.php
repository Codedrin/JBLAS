<?php
include "../connection.php";

// Check if all required parameters are set and not empty
if(isset($_GET['book_id'], $_GET['email'], $_GET['name'], $_GET['date'], $_GET['payment_method'], $_GET['materials_needed'], $_GET['workers_name'], $_GET['total_price']) &&
   !empty($_GET['book_id']) && !empty($_GET['email']) && !empty($_GET['name']) && !empty($_GET['date']) && !empty($_GET['payment_method']) && !empty($_GET['materials_needed']) && !empty($_GET['workers_name']) && !empty($_GET['total_price'])) {

    // Sanitize input parameters
    $book_id = $connection->real_escape_string($_GET['book_id']);
    $email = $connection->real_escape_string($_GET['email']);
    $name = $connection->real_escape_string($_GET['name']);
    $date = $connection->real_escape_string($_GET['date']);
    $payment_method = $connection->real_escape_string($_GET['payment_method']);
    $materials_needed = $connection->real_escape_string($_GET['materials_needed']);
    $workers_name = $connection->real_escape_string($_GET['workers_name']);
    $total_price = $connection->real_escape_string($_GET['total_price']);

    // Insert data into the reports_tbl table
    $sql = "INSERT INTO reports_tbl (book_id, email, name, date, payment_method, materials_needed, workers_name, total_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    // Prepare and execute the SQL statement
    if ($stmt = $connection->prepare($sql)) {
        $stmt->bind_param("sssssssd", $book_id, $email, $name, $date, $payment_method, $materials_needed, $workers_name, $total_price);
        if ($stmt->execute()) {
            // Redirect to a specific page after successful insertion
            header("Location: ".$_SERVER['HTTP_REFERER']);
            exit();
        } else {
            echo "Error inserting record: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $connection->error;
    }
} else {
    echo "Invalid parameters";
}
?>

