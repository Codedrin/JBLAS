<?php
$servername = "localhost";
$username = "u161527944_JBLAS123";
$password = "JBLAS@password123";
$database = "u161527944_jblas_db";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection Failed: " . $connection->connect_error);
}

?>