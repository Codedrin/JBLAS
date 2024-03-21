<?php
include "../connection.php";

// Initialize variables
$book_id = $email = $name = $date = $issue = '';

// Retrieve values from the URL if available
$book_id = isset($_GET['book_id']) ? $_GET['book_id'] : '';
$email = isset($_GET['email']) ? $_GET['email'] : '';
$name = isset($_GET['name']) ? $_GET['name'] : '';
$date = isset($_GET['date']) ? $_GET['date'] : '';
$issue = isset($_GET['issue']) ? $_GET['issue'] : '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $book_id = $_POST['book_id'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $date = $_POST['date'];
    $issue = $_POST['issue'];

    // Sanitize input parameters
    $book_id = $connection->real_escape_string($book_id);
    $email = $connection->real_escape_string($email);
    $name = $connection->real_escape_string($name);
    $date = $connection->real_escape_string($date);
    $issue = $connection->real_escape_string($issue);

    // Additional form data
    $payment_method = $connection->real_escape_string($_POST['payment_method']);
    $materials_needed = $connection->real_escape_string($_POST['materials_needed']);
    $workers_name = $connection->real_escape_string($_POST['workers_name']);
    $total_price = $connection->real_escape_string($_POST['total_price']);
// Insert data into reports_tbl
$sql_insert = "INSERT INTO reports_tbl (book_id, email, name, date, issue, payment_method, materials_needed, workers_name, total_price, payment_status) VALUES ('$book_id', '$email', '$name', '$date', '$issue', '$payment_method', '$materials_needed', '$workers_name', '$total_price', 'onpayment')";

// Delete data from services_tbl
$sql_delete = "DELETE FROM services_tbl WHERE book_id = '$book_id'";

// Perform the deletion and insertion
$connection->begin_transaction();
$delete_result = $connection->query($sql_delete);
$insert_result = $connection->query($sql_insert);

// Check if both queries were successful
if ($delete_result && $insert_result) {
    $connection->commit();
    header("Location: repairs.php");
    exit();
} else {
    $connection->rollback();
    echo "Error: " . $connection->error;
}
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Report</title>
<!-- bootstrap link--->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <!-- Font Awesome Kit -->
  <script src="https://kit.fontawesome.com/23688bd133.js" crossorigin="anonymous"></script>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap" rel="stylesheet">

</head>
<body>


<div class="container" style="padding: 10%;">
<h2 style="text-align: center; " >Create a Report</h2>
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Repair/Renovation Form</h5>
    <form method="post">
      <div class="mb-3">
        <label for="book_id" class="form-label">Book ID:</label>
        <input type="text" class="form-control" id="book_id" name="book_id" value="<?php echo htmlspecialchars($book_id); ?>" readonly>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" readonly>
      </div>
      <div class="mb-3">
        <label for="name" class="form-label">Name:</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" readonly>
      </div>
      <div class="mb-3">
        <label for="issue" class="form-label">Issue/Problems:</label>
        <textarea class="form-control" id="issue" name="issue" rows="5" readonly><?php echo htmlspecialchars($issue); ?></textarea>
      </div>
      <div class="mb-3">
        <label for="date" class="form-label">Date of Repair/Renovation:</label>
        <input type="text" class="form-control" id="date" name="date" value="<?php echo htmlspecialchars($date); ?>" readonly>
      </div>
      <div class="mb-3">
        <label for="payment_method" class="form-label">Payment Method:</label>
        <select class="form-select" id="payment_method" name="payment_method">
          <option value="cash">Cash</option>
          <option value="gcash">GCash</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="materials_needed" class="form-label">Materials Needed:</label>
        <textarea class="form-control" id="materials_needed" name="materials_needed" rows="5" required autocomplete="off" ></textarea>
      </div>
      <div class="mb-3">
        <label for="workers_name" class="form-label">Worker's Name:</label>
        <input type="text" class="form-control" id="workers_name" name="workers_name" value="" required autocomplete="off" >
      </div>
      <div class="mb-3">
        <label for="total_price" class="form-label">Total Price:</label>
        <input type="tel" class="form-control" id="total_price" name="total_price" value="" required autocomplete="off" >
      </div>
      <button type="submit" class="btn btn-primary mb-3" >Submit</button>
    </form>
    <a class="btn btn-danger" href="repairs.php">Cancel</a>
  </div>
</div>
</div>

</body>
</html>
