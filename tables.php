<?php
include('dbcon.php');
$query = "SELECT * FROM users";
$result = $conn->query($query);
?>

<div class="container-fluid">
    
    <div class="card mb-4 borer">
        <div class="card-header py-3" style="background-color: #607274;">
            <div class="row align-items-center justify-content-between">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-light">Jobs</h6>
                </div>
                <div class="col-auto">
                    <a href="reports.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>username</th>
                            <th>Email</th>
                            <th>Phone number</th>
                            <th>Problem for repair</th>
                            <th>Home visit</th>
                            <th>Visit for repair</th>
                            <th>Status</th>
                     
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr class="<?php echo $row['status'] == 1 ? 'd-none' : ''; ?>">
                                <td><?php echo $row['firstname']; ?></td>
                                <td><?php echo $row['lastname']; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['phonenumber']; ?></td>
                                <td><?php echo $row['repairproblem']; ?></td>
                                <td><?php echo $row['homevisit']; ?></td>
                                <td><?php echo $row['visitrepair']; ?></td>
                              
                                <td>
                                    <?php if ($row['status'] == 0): ?>
                                        <button class="btn btn-warning btn-change-status" data-id="<?php echo $row['id']; ?>">Pending</button>
                                    <?php else: ?>
                                        <button class="btn btn-success" disabled>Done</button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php
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

                            
                            function removeRow(row) {
                                row.fadeOut('slow', function() {
                                    row.remove();
                                });
                            }

                        
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