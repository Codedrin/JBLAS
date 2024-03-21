
<?php include("super_admin_dashboard.php"); ?>
<?php

// Check if user is logged in
if (isset($_SESSION['user_id']) && isset($_SESSION['username']) && isset($_SESSION['acc_type'])) {
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $acc_type = $_SESSION['acc_type'];

    $clientUsername = $_SESSION['username'];

    include "../connection.php";

    // Fetch client-specific data
    $sql = "SELECT * FROM admin WHERE username = '$clientUsername'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $clientData = $result->fetch_assoc();
    }
    $userID = $_SESSION['user_id'];
} else {
    // Redirect to the login page if the user is not logged in
    header('Location:../login.php');
    exit();
}
?>

<div class="col py-3">


    <div class="container mt-3">
    <div class="table-responsive">
    <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th colspan="7" class="text-center py-3">List of Admin Accounts</th>
                </tr>
                <tr>
                    <th class="py-3">Name</th>
                    <th class="py-3">Username</th>
                    <th class="py-3">Service</th>
                    <th class="py-3">Email</th>
                    <th class="py-3">Date</th>
                    <th class="py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "../connection.php";
                //read all row from database table
                $sql = "SELECT * FROM admin WHERE acc_type='admin' 
                        UNION 
                        SELECT * FROM manpower WHERE acc_type='manpower'";
                $result = $connection->query($sql);

                if (!$result) {
                    die("Invalid query: " . $connection->error);
                }
                //read data each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>$row[name]</td>
                        <td>$row[username]</td>
                        <td>$row[servicename]</td>
                        <td>$row[email]</td>
                        <td>$row[date_created]</td>
                        <td>
                             <a class='btn btn-danger btn-sm btn-open-delete-modal' data-id='{$row['user_id']}' data-bs-toggle='modal' data-bs-target='#deleteModal'>Delete</a>
            </td>
                        </tr>
                        ";
                }
                ?>

            </tbody>
        </table>

    </div>
    </div>
       
   
</div>

<script>
            document.addEventListener("DOMContentLoaded", function() {
                const deleteLinks = document.querySelectorAll('.btn-open-delete-modal');

                deleteLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        const userId = link.getAttribute('data-id');
                        const deleteLink = document.getElementById('deleteLink');
                        deleteLink.href = `delete.php?id=${userId}`;
                    });
                });
            });
        </script>
</body>
<?php include('footer.php'); ?>
</html>