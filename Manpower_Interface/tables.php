<?php
include('dbcon.php');
?>

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
$sql = "SELECT * FROM services_tbl WHERE service_type='$serviceType' AND status='approved'";
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
                    <th>Phone number</th>
                    <th>Issue</th>
                    <th>Home visit</th>
                    <th>Visit for repair</th>
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
                            <td>{$row['contact_number']}</td>
                            <td>{$row['issue']}</td>
                            <td>{$row['schedule_homevisit']}</td>
                            <td>{$row['schedule_repair']}</td>
                            <td>
                                <a href='visit.php?book_id={$row['book_id']}&email={$row['email']}&name={$row['name']}&date={$row['schedule_homevisit']}' class='btn btn-info btn-sm me-1' style='margin-right:5px;'>Visit</a>
                            </td>
                        </tr>";
                    }
                } else {
                    // Display "No Job" message if no rows are returned
                    echo "<tr><td colspan='8'><h3 style='opacity: 0.5;'>No Job</h3></td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

    </div>
 </div>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                    <script>
                    $(document).ready(function() {
                            // Function to update pending task count
                            function updatePendingCount() {
                                $.ajax({
                                    url: 'get_pending_count.php',
                                    type: 'GET',
                                    dataType: 'json',
                                    success: function(response) {
                                        // Update pending count
                                        $('#pending-count').text(response);
                                    },
                                    error: function(xhr, status, error) {
                                        console.error(xhr.responseText);
                                    }
                                });
                            }

                            // Function to remove row from table
                            function removeRow(row) {
                                row.fadeOut('slow', function() {
                                    row.remove();
                                });
                            }

                            // Initial call to update pending count on page load
                            updatePendingCount();

                            // Set interval to update pending count every 5 seconds (3000 milliseconds)
                            setInterval(updatePendingCount, 3000);

                            // Change status button click event
                            $('.btn-change-status').click(function() {
                                var id = $(this).data('id');
                                var row = $(this).closest('tr');
                                // Send AJAX request to update status
                                $.ajax({
                                    url: 'update_status.php',
                                    type: 'POST',
                                    data: { id: id },
                                    success: function(response) {
                                        if (response === 'done') {
                                            // Remove the row from the table
                                            removeRow(row);
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        // Handle error
                                        console.error(xhr.responseText);
                                    }
                                });
                            });
                        });
                        
                    </script>