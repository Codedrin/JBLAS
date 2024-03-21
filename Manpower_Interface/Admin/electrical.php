<?php session_start();
include('../dbcon.php');
?>

<!DOCTYPE html>
<html lang="en">

 
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>Electrical Service Repair</title>
<!-- Website icon-->
<link rel="icon" type="image/png" sizes="32x32" href="../Admin/favicon_io/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../Admin/favicon_io/favicon-16x16.png">
<link rel="manifest" href="../Admin/favicon_io/site.webmanifest">



<!-- Custom fonts for this template-->
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

<!-- Custom styles for this template-->
<link href="../css/sb-admin-2.css" rel="stylesheet">
<link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>
    <body>
        <?php include('../Admin/navbar.php'); ?>
        <div class="container-fluid">
    
    <div class="card mb-4 borer">
        <div class="card-header py-3" style="background-color: #607274;">
            <div class="row align-items-center justify-content-between">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-light">Jobs</h6>
                </div>

            </div>
        </div>
        <div class="card-body  " style="font-size: 12px;" >
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
                        <tbody>
                        <?php
                include "../../connection.php";
                //read all row from database table
                $sql = "SELECT * FROM services_tbl WHERE service_type='electrical' AND status='pending'";
                $result = $connection->query($sql);

                if (!$result) {
                    die("Invalid query: " . $connection->error);
                }
                //read data each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>$row[book_id]</td>
                        <td>$row[name]</td>
                        <td>$row[email]</td>
                        <td>$row[contact_number]</td>
                        <td>$row[issue]</td>
                        <td>$row[schedule_homevisit]</td>
                        <td>$row[schedule_repair]</td>
                        <td>
                        <a href='approve.php?book_id={$row['book_id']}&email={$row['email']}&name={$row['name']}' class='btn btn-info btn-sm me-1'>Approve</a>
                        <a href='reject.php?book_id={$row['book_id']}&email={$row['email']}&name={$row['name']}' class='btn btn-danger btn-sm'>Reject</a>
                    </td>
                </tr>";
            }
            ?>


                  </tbody>

              </thead>

          </table>
      </div>
  </div>
    </div>
    </div>
    </div>
</body>
</html>
<?php include('../Admin/footer.php'); ?>




