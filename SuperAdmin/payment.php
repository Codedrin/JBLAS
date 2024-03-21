<?php include('super_admin_dashboard.php'); ?>
<?php

// Check if user is logged in
if (isset($_SESSION['user_id']) && isset($_SESSION['username']) && isset($_SESSION['acc_type'])) {
  $user_id = $_SESSION['user_id'];
  $username = $_SESSION['username'];
  $acc_type = $_SESSION['acc_type'];
  
    $clientUsername= $_SESSION['username'];

  include "../connection.php";
  
  // Fetch client-specific data
$sql = "SELECT * FROM admin WHERE username = '$clientUsername'";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    $clientData = $result->fetch_assoc();
}
$userID=$_SESSION['user_id'];

} else {
  // Redirect to the login page if the user is not logged in
  header('Location:../login.php');
  exit();
}
?>


        <div class="col py-3">
 
        <br><br>
        <div class="container-fluid">
    
    <div class="card mb-4 borer">
        <div class="card-header py-3" style="background-color: #607274;">
            <div class="row align-items-center justify-content-between">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-light">Jobs</h6>
                </div>
            </div>
        </div>
        <?php
include "../connection.php";

// Read all rows from database table
$sql = "SELECT * FROM reports_tbl WHERE payment_status='paid'";
$result = $connection->query($sql);

if (!$result) {
    die("Invalid query: " . $connection->error);
}

?>

<div class="card-body" style="font-size: 12px;">
    <div class="table-responsive">
        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Book_ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Issue</th>
                    <th>Start of Renovation</th>
                    <th>Reference ID</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if there are any rows returned by the query
                if ($result->num_rows > 0) {
                    // Read data for each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['book_id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['issue']}</td>
                            <td>{$row['date']}</td>
                            <td>{$row['reference_id']}</td>
                            <td class='btn-group text-small me-2'>
                                <a href='paid.php?book_id={$row['book_id']}&email={$row['email']}&name={$row['name']}&issue={$row['issue']}&date={$row['date']}&total={$row['total_price']}' class='btn btn-success btn-sm me-1' style='margin-right:5px;'>Confirm</a>
                            </td>
                        </tr>";
                    }
                } else {
                    // Display "No Job" message if no rows are returned
                    echo "<tr><td colspan='8'><h3 style='opacity: 0.5;'>No Pending Payment</h3></td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

    </div>
 </div>
        </div>

    </div>

<?php include('footer.php'); ?>
</body>
</html>