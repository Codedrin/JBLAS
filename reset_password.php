<?php
session_start();
include 'connection.php';

// Initialize a variable to track the status
$status = '';

// Check if the email parameter is set in the URL
if (isset($_GET['email'])) {
    $email = urldecode($_GET['email']);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newPassword = $_POST['new_password'];

        // Update the user's password in the database
        $updatePasswordSql = "UPDATE clients SET password = ? WHERE email = ?";
        $updatePasswordStmt = $connection->prepare($updatePasswordSql);

        if (!$updatePasswordStmt) {
            die("Prepare failed: " . $connection->error);
        }

        $updatePasswordStmt->bind_param("ss", $newPassword , $email);

        if ($updatePasswordStmt->execute()) {
            // Set status to success
            $status = 'success';
        } else {
            // Set status to failure
            $status = 'failure';
        }
    }
} else {
    // Set status to failure
    $status = 'failure';
}

// Display the modal only if the status is success
if ($status === 'success') {
    echo '<script>
        document.addEventListener(\'DOMContentLoaded\', function () {
            var myModal = new bootstrap.Modal(document.getElementById(\'statusModal\'), {
                backdrop: \'static\',
                keyboard: false
            });
            myModal.show();
        });
    </script>';
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Password Reset</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- Favicon -->

      <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="favicon_io/site.webmanifest">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Font Awesome Kit -->
    <script src="https://kit.fontawesome.com/23688bd133.js" crossorigin="anonymous"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <style>
          body {
            background-image: url(images/footer.png);
            background-repeat: no-repeat;
            background-size: cover;
            font-family: 'Montserrat', sans-serif;
        }
        nav.navbar {
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand img {
            height: 50px;
            /* Adjust the height as needed */
            width: auto;
            padding: 5px;
        }

        .content {
            background-color: #fff;
            padding: 7% 15%;
            margin-top: 5%;
        }

        .form-container {
            max-width: 400px;
            margin: auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .error {
            color: red;
        }

        .form {
            text-align: center;
        }

        body {
            background-color: #F3BB83;
        }

        .logo {
            height: 70px;
            width: 70px;
            padding: 10px;
        }

        .otp-field,
        .password-field {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .otp-field input,
        .password-field input {
            height: 45px;
            width: 100%;
            border-radius: 6px;
            outline: none;
            font-size: 1.125rem;
            text-align: center;
            border: 1px solid #ddd;
            margin-bottom: 10px;
        }

        .otp-field input:focus,
        .password-field input:focus {
            box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
        }

        .otp-field input::-webkit-inner-spin-button,
        .otp-field input::-webkit-outer-spin-button,
        .password-field input::-webkit-inner-spin-button,
        .password-field input::-webkit-outer-spin-button {
            display: none;
        }

        .toggle-password {
            cursor: pointer;
        }

        .btn-primary {
            background-color: #146C94;
            color: white;
        }
    </style>
    <style>
    .dropdown:hover .dropdown-menu {
    display: block;
  }
  </style>
</head>

<body>

   <?php include "navbar.php"; ?>

    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4" style="min-width: 500px;">
            <div class="card bg-white mb-5 mt-5 border-0" style="box-shadow: 0 12px 15px rgba(0, 0, 0, 0.02);">
                <div class="card-body p-5 text-center">
                    <img style="height:100px; max-width: 100%;" src="images/forgot-password.png" alt=""><br>
                    <h5>Please enter a new password:</h5><br>
                    <form method="POST" onsubmit="return validateForm()">
                        <!-- Password Input -->
                        <div class="form-group password-field mb-4">
                            <input type="password" id="password-input" name="new_password" placeholder="Enter new password" required autocomplete="off">
                            <i class="fas fa-eye toggle-password p-2" onclick="togglePasswordVisibility('password-input')"></i>
                        </div>

                        <!-- Confirm Password Input -->
                        <div class="form-group password-field mb-4">
                            <input type="password" id="confirm-password-input" name="confirm_password" placeholder="Confirm new password" required autocomplete="off">
                            <i class="fas fa-eye toggle-password p-2" onclick="togglePasswordVisibility('confirm-password-input')"></i>
                        </div>

                        <button type="submit" class="btn btn-primary mb-3" style="width: 50%; color:white; background-color:wood;">
                           <b>Save Password</b> 
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle (Popper included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Font Awesome Kit -->
    <script src="https://kit.fontawesome.com/23688bd133.js" crossorigin="anonymous"></script>

    <script>
        function togglePasswordVisibility(inputId) {
            const passwordInput = document.getElementById(inputId);
            passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
        }

        function validateForm() {
            const passwordInput = document.getElementById('password-input');
            const confirmPasswordInput = document.getElementById('confirm-password-input');
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;

            // Password strength validation (you can customize this based on your requirements)
            const passwordStrengthRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,}$/;

            if (!passwordStrengthRegex.test(password)) {
                alert('Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one digit, and one special character.');
                return false;
            }

            // Confirm password match validation
            if (password !== confirmPassword) {
                alert('Passwords do not match.');
                return false;
            }

            return true;
        }
    </script>
<!-- Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Password changed successfully!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="redirect()">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle (Popper included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
        // Function to redirect after closing the modal
        function redirect() {
            window.location.href = 'login.php?status=<?php echo $status; ?>';
        }
    </script>

    <!-- Bootstrap JS Bundle (Popper included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>
