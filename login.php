<?php
session_start();
$loginError = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "u161527944_JBLAS123";
    $password = "JBLAS@password123";
    $dbname = "u161527944_jblas_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    function sanitizeInput($data)
    {
        global $conn;
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $conn->real_escape_string($data);
    }

    function validateLogin($username, $password)
    {
        global $conn;

        $username = sanitizeInput($username);

        $stmt = $conn->prepare("SELECT user_id,acc_type, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Retrieve hashed password and account type from the database
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $hashedPassword = $user['password'];
            $acc_type = $user['acc_type'];
            $user_id = $user['user_id'];

            // Verify the entered password against the stored hashed password
            if ($password === $hashedPassword) {
                // Password is correct
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $username;
                $_SESSION['acc_type'] = $acc_type;
                return $acc_type; // Return user account type
            } else {
                
                return false;
            }
        } else {
            return false;
        }
    }

    $username = $_POST['username'];
    $password = $_POST['password'];
    $acc_type = validateLogin($username, $password);

    if ($acc_type !== false) {
        switch ($acc_type) {
            case 'superadmin':
                header("Location: SuperAdmin/super_admin_dashboard.php");
                exit();
            case 'admin':
                header("Location: Manpower_Interface/Admin/index.php");
                exit();
            case 'manpower':
                header("Location: Manpower_Interface/index.php ");
                exit();
            case 'client':
                header("Location: clientdashboard.php");
                exit();
            default:
                echo "Invalid account type";
                break;
        }
    } else {
        // Invalid login
        $loginError = "Invalid username or password";
    }

    $conn->close();
}
?>




<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

 <!-- Favicon -->

 <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="favicon_io/site.webmanifest">
    
  <!-- Stylesheet -->
<link rel="stylesheet" href="style/indexStyle.css">
  <!-- bootstrap link--->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <!-- Font Awesome Kit -->
  <script src="https://kit.fontawesome.com/23688bd133.js" crossorigin="anonymous"></script>

 <!-- Google Fonts -->
 <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Belleza&family=Montserrat&display=swap" rel="stylesheet">

  <style>
        .error {
            color: red;
        }

        .logo {
            height: 70px;
            width: 70px;
            padding: 10px;
        }

        .log0 {
            height: 100px;
            width: 100px;
            padding: 10px;
        }

        .logoo {
            height: 400px;
            width: 100%;
        }

        /* On screens that are 600px or less, set the background color to olive */
        @media screen and (max-width: 600px) {
            .logoo {
                display: none;
            }
            h2{
                margin-top: 40px;
            }
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }
        #loginSection{
            padding: 3% 10%;
            background-image: url('images/HouseBG.png');
            background-repeat: no-repeat;
            background-size: cover;
        }
        
    </style>
</head>

<body>
    <!-- This is for Navigation Bar -->
    <?php include "navbar.php"; ?>

    <section id="loginSection">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 " style="color:white; ">
                <img src="images/LoginLogo.png" alt="Login image" class="w-100  logoo mb-3" style=" object-position: center; ">
                <h2>JBLAS Online Booking for Home Renovation</h2>
            </div >
            <div class="col-lg-6 col-md-6 col-sm-6" style="background-color:transparent;  text-align: center; padding:5%;">

                <div class="d-flex align-items-center justify-content-center" style="background-color:transparent;  height:100%; border:5px; border-color:#F3BB83; border-radius:10%;">

                    <form method="POST" style="width: 23rem;">
                        <img class="log0" src="images/Logo.png" alt="" />
                        <h3 class="fw-bold mb-3 pb-3" style="letter-spacing: 1px; color:#F3BB83;">JBLAS</h3>
                        <p class="text-white" >One-Stop-Shop for Home Renovation</p>

                        <div class="form-floating mb-3">
                            <input style="border-color:white; background-color:transparent; border:3px solid #F3BB83; color:white;" type="text" class="form-control" id="floatingInput" name="username" placeholder="username" autocomplete="off" required>
                            <label style="color: white;" for="floatingInput">Username</label>
                        </div>

                        <div class="form-floating">
                            <input style="border-color:white; background-color:transparent; border:3px solid #F3BB83; color:white;" type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" autocomplete="off" required>
                            <label style="color: white;" for="floatingPassword">Password</label>
                            <i style="color:white;" class="toggle-password fas fa-eye position-absolute top-50 end-0 p-2 translate-middle-y" onclick="togglePassword('floatingPassword')"></i>
                        </div>
                        <div>
                            <!-- Display error message for invalid password -->
                            <div class="error mt-3">
                                <?php if (!empty($loginError)) : ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?= $loginError ?>
                                        <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="pt-1 mb-4">
                            <button class="btn btn-lg btn-block w-100" type="submit" style="color:white; width:50%; background-color:#F3BB83;">Login
                            </button>
                        </div>

                        <p class="small mb-5 pb-lg-2" style="color:white;"><a class=" text-white" href="forgot.php">Forgot password?</a></p>
                        <p class="text-white">Don't have an account? <a href="signup.php" class="link-info " style="color:#F3BB83;">Sign Up</a></p>

                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        function togglePassword(inputId) {
            var input = document.getElementById(inputId);
            var icon = document.querySelector('i.toggle-password');

            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>