<?php
session_start();
include('dbcon.php');

// Handle delete functionality
if(isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $delete_query = "DELETE FROM users WHERE id = :id";
    $delete_statement = $conn->prepare($delete_query);
    $delete_statement->execute([':id' => $delete_id]);
    // Redirect or refresh the page as needed after deletion
    header("Location: repairs.php"); // Redirect to the same page after deletion
    exit(); // Terminate script execution after redirection
}

// Fetch records from the database and prioritize pending tasks
$query = "SELECT * FROM users ORDER BY status ASC"; // Prioritize pending tasks
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>JBLAS</title>
    <!-- Website icon-->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="favicon_io/site.webmanifest">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
    <?php include('navbar.php'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard<small style = "color: #503C3C">/Repairs
            </small></h1>
        </div>

        <div class="container-fluid">
            <div class="card mb-4 borer">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>Email</th>
                                    <th>Phone number</th>
                                    <th>Problem for repair</th>
                                    <th>Home visit</th>
                                    <th>Visit for repair</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['firstname']; ?></td>
                                        <td><?php echo $row['lastname']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['phonenumber']; ?></td>
                                        <td><?php echo $row['repairproblem']; ?></td>
                                        <td><?php echo $row['homevisit']; ?></td>
                                        <td><?php echo $row['visitrepair']; ?></td>
                                        <td>
                                            <?php if ($row['status'] == 0): ?>
                                                <button class="btn btn-warning btn-change-status" data-id="<?php echo $row['id']; ?>">Pending</button>
                                            <?php else: ?>
                                                <span class="text-success">Done</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <form method="post" action="repairs.php" onsubmit="return confirm('Are you sure you want to delete this record?')">
                                                <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
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
    </div>
    
    <?php include('footer.php'); ?>

</body>
</html>
