
<?php
//database connection
$servername = "localhost"; 
$username = "u161527944_JBLAS123"; 
$password = "JBLAS@password123"; 
$database = "u161527944_jblas_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo ""; 
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}   
?>



