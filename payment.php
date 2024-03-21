<?php
include "connection.php";

// Initialize variables
$book_id = $email = $name = $date = $issue = '';

// Retrieve values from the URL if available
$book_id = isset($_GET['book_id']) ? $_GET['book_id'] : '';
$email = isset($_GET['email']) ? $_GET['email'] : '';
$name = isset($_GET['name']) ? $_GET['name'] : '';
$date = isset($_GET['date']) ? $_GET['date'] : '';
$issue = isset($_GET['issue']) ? $_GET['issue'] : '';
$total = isset($_GET['total']) ? $_GET['total'] : '';
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $refID = $_POST['reference_id'];


    // Sanitize input parameters
    $book_id = $connection->real_escape_string($book_id);
    $email = $connection->real_escape_string($email);
    $name = $connection->real_escape_string($name);
    $date = $connection->real_escape_string($date);
    $issue = $connection->real_escape_string($issue);

    // Additional form data
    $refID = $connection->real_escape_string($_POST['reference_id']);
   
    $sql_update = "UPDATE reports_tbl SET payment_status='paid', reference_id='$refID' WHERE book_id='$book_id' ";
    // Perform the deletion and insertion
    $connection->begin_transaction();
    $update_result = $connection->query($sql_update);

    // Check if both queries were successful
    if ($update_result) {
        $connection->commit();
        header("Location: account.php");
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

    <style>
        /* Add custom CSS styles here */
        #qr_code_container {
            display: none;
            /* Hide QR code container by default */
        }
    </style>

</head>

<body>


    <div class="container" style="padding: 10%;">
        <h2 style="text-align: center; ">Payment</h2>
        <div class="card">
            <div class="card-body">
                <h2 class="card-title mb-3 p-5 text-center">JBLAS Home Renovation Services</h2>
                <div class="row">
                    <div class="col">
                        <h5>Renovation/Repair Details: </h5>
                        <h3><?php echo htmlspecialchars($issue); ?></h3>
                    </div>
                    <div class="col">
                        <h5>Total Price: </h5>
                        <h1>Php<?php echo htmlspecialchars($total); ?></h1>
                    </div>
                </div>
                <div class="col">
                    <h6><b>Book ID: </b><?php echo htmlspecialchars($book_id); ?></h6>
                </div>
                <div class="col">
                    <h6><b>Client Name: </b><?php echo htmlspecialchars($name); ?></h6>
                </div>
                <div class="col">
                    <h6><b>Client Email: </b><?php echo htmlspecialchars($email); ?></h6>
                </div>
                <div class="col">
                    <h6><b>Start of Renovation: </b><?php echo htmlspecialchars($date); ?></h6>
                </div>
                <div class="col"></div>
                <form method="POST">

                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Payment Method:</label>
                        <select class="form-select" id="payment_method" name="payment_method">
                            <option value="cash">Cash</option>
                            <option value="gcash">GCash</option>
                        </select>
                    </div>
                    <!-- QR Code Display -->
                    <div id="qr_code_container" style="text-align: center;">
                        Please Scan this QR Code to Pay:
                        <img src="images/myQR.png" alt="">
                    </div>
                    <div class="mb-3">
                        <label for="ref_id" class="form-label">Reference ID of Gcash:</label>
                        <input type="text" class="form-control" id="reference_id" name="reference_id" value="" required>
                    </div>
                    <!-- Buttons -->
                    <button type="submit" class="btn btn-primary mb-3">Submit</button>
                    <a class="btn btn-danger" href="account.php">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paymentMethodSelect = document.getElementById('payment_method');
            const qrCodeContainer = document.getElementById('qr_code_container');

            paymentMethodSelect.addEventListener('change', function() {
                const selectedPaymentMethod = paymentMethodSelect.value;

                if (selectedPaymentMethod === 'gcash') {
                    // Show QR code container if GCash is selected
                    qrCodeContainer.style.display = 'block';
                } else {
                    // Hide QR code container for other payment methods
                    qrCodeContainer.style.display = 'none';
                }
            });
        });
    </script>

</body>

</html>