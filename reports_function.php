<?php
session_start();
include('dbcon.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $home_visit = $_POST['home_visit'];
    $visit_repair = $_POST['visit_repair'];
    $cash = $_POST['cash'];
    $materials = $_POST['materials'];
    $email = $_POST['email']; // Adding the email field here

    // Check if the entry already exists
    $stmt = $conn->prepare("SELECT * FROM reports WHERE firstname = :fname AND lastname = :lname AND phonenumber = :phone AND address = :address AND homevisit = :home_visit AND repairvisit = :visit_repair AND email = :email AND cash = :cash AND materials = :materials");
    $stmt->bindParam(':fname', $fname);
    $stmt->bindParam(':lname', $lname);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':home_visit', $home_visit);
    $stmt->bindParam(':visit_repair', $visit_repair);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':cash', $cash);
    $stmt->bindParam(':materials', $materials);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Entry already exists, show alert
        echo "<script>alert('This entry already exists.')</script>";
    } else {
        // Entry does not exist, insert into database
        $stmt = $conn->prepare("INSERT INTO reports (firstname, lastname, phonenumber, address, homevisit, repairvisit, email, cash, materials) VALUES (:firstname, :lastname, :phonenumber, :address, :homevisit, :repairvisit, :email, :cash, :materials)");
        $stmt->bindParam(':firstname', $fname);
        $stmt->bindParam(':lastname', $lname);
        $stmt->bindParam(':phonenumber', $phone);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':homevisit', $home_visit);
        $stmt->bindParam(':repairvisit', $visit_repair);
        $stmt->bindParam(':email', $email); // Binding the email parameter
        $stmt->bindParam(':cash', $cash);
        $stmt->bindParam(':materials', $materials);
        $stmt->execute();

        // Show success message
        echo "<script>alert('Report submitted successfully!')</script>";
    }

    // Redirect to the same page to avoid resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>
