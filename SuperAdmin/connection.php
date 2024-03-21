<?php
$servername = "localhost";
$username = "u161527944_JBLAS123";
$password = "JBLAS@password123";
$database = "u161527944_jblas_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Optionally, set charset to utf8
    $conn->exec("SET NAMES utf8");
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
