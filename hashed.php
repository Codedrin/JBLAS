<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "patientrecord";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection Failed: " . $connection->connect_error);
}


// Retrieve passwords from the database
$sql = "SELECT user_id, password FROM admin_account";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Hash the password using PHP's password_hash function
        $hashed_password = password_hash($row['password'], PASSWORD_DEFAULT);

        // Update the record in the database with the new hashed password
        $update_sql = "UPDATE admin_account SET password = '$hashed_password' WHERE user_id = " . $row['user_id'];
        $connection->query($update_sql);
    }

    echo "Passwords have been updated.";
} else {
    echo "No records found.";
}

$connection->close();
?>
