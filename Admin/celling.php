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

<title>JBLAS</title>
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
<link href="css/sb-admin-2.min.css" rel="stylesheet">


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
                <div class="col-auto">
                    <a href="reports.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
                    </a>
                </div>
                <div class="col-auto">
                    <a href="../Admin/generate_payment.php" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                    <i class="fas fa-money-bill-alt fa-sm text-white-50"></i> Generate Payment
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
                            <th>Payment</th>
                            <th>Status</th>
                     
                        </tr>
                        <tbody>
                            <tr>
                                <td>Boruto</td>
                                <td>Uzumaki</td>
                                <td>uzumakiboruto21</td>
                                <td>uzumakiboruto21@gmail.com</td>
                                <td>09080977243</td>
                                <td>No Water</td>
                                <td>03/2/2024</td>
                                <td>03/05/2024</td>
                                <td>Gcash</td>
                                <td><button class="btn btn-warning btn-change-status">Pending</button></td>     
          
                                </tr>
                  
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