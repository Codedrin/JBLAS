<?php include('reports_function.php'); 

//the reports will display on the super admin side

?>
<!DOCTYPE html>
<html lang="en">
  
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
<body>
    <?php include ('navbar.php');?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard<small style = "color: #116D6E">/Reports</small></h1>
        </div><div class="row justify-content-center mb-5">
    <!-- Form Column -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 style="color: #7E6363;" class="fw-bolder text-center">Generate Report</h3>
            </div>
            <div class="card-body">
                        <form id="reportForm" action="reports.php" method="post">
                            <label for="fname">First Name *</label><br>
                            <input type="text" id="fname" name="fname" class="form-control mb-3" required autocomplete="given-name">
                            <label for="lname">Last Name *</label><br>
                            <input type="text" id="lname" name="lname" class="form-control mb-3" required autocomplete="family-name">
                            <label for="username">username *</label><br>
                            <input type="text" id="username" name="username" class="form-control mb-3" required autocomplete="family-name">
                            <label for="phone">Phone Number *</label><br>
                            <input type="tel" id="phone" name="phone" class="form-control mb-3" required autocomplete="tel">
                            <label for="email">Email *</label><br>
                            <input type="email" id="email" name="email" class="form-control mb-3" required autocomplete="email">
                            <label for="address">Address *</label><br>
                            <input type="text" id="address" name="address" class="form-control mb-3" required autocomplete="street-address">
                            <label for="home_visit">Home Visit Date *</label><br>
                            <input type="date" id="home_visit" name="home_visit" class="form-control mb-3" required>
                            <label for="visit_repair">Visit Repair Date *</label><br>
                            <input type="date" id="visit_repair" name="visit_repair" class="form-control mb-3" required>
                            <label for="cash">Cash (Optional)</label><br>
                            <input type="number" id="cash" name="cash" class="form-control mb-3">
                            <label for="materials">Materials List *</label><br>
                            <textarea id="materials" name="materials" class="form-control mb-3" required></textarea><br>
                            <input type="submit" value="Submit" class="btn btn-primary btn-block">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php');?>
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>

<script>
    // JavaScript to check if all required fields are filled before submission
    document.getElementById('reportForm').addEventListener('submit', function (event) {
        var form = event.target;
        var isValid = form.checkValidity(); // Check if the form is valid
        if (!isValid) {
            // If the form is not valid, prevent submission
            event.preventDefault();
            event.stopPropagation();
        } else {
            // Show the success message
            alert('You have successfully submitted your report!');
        }
        form.classList.add('was-validated'); // Add Bootstrap's validation styles
    });
</script>

</body>
</html>