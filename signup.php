<?php
session_start();
include 'connection.php';
include('smtp/PHPMailerAutoload.php');

$userID = "";
$accountType = "";
$firstName = "";
$lastName = "";
$midName = "";
$street = "";
$barangay = "";
$municipality = "";
$province = "";
$gender = "";
$dateOfBirth = "";
$mobileNumber = "";
$email = "";
$username = "";
$password = "";
$email_status = "Verified";
$errorMessage = '';
$errorEmail = '';
$errorname = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get data from the form
  $firstName = $_POST["firstName"];
  $lastName = $_POST["lastName"];
  $midName = $_POST["midName"];
  $street = $_POST["street"];
  $barangay = $_POST["barangay"];
  $municipality = $_POST["municipality"];
  $province = $_POST["province"];
  $gender = $_POST["gender"];
  $dateOfBirth = $_POST["birthday"];
  $mobileNumber = $_POST["mobileNumber"];
  $email = $_POST["email"];
  $username = $_POST["user_name"];
  $password = $_POST['password'];

  // Check if the email is valid
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo '<script>alert("Invalid email address.");</script>';
  } else {
    // Check if the email is not already in use
    $emailCheckSql = "SELECT COUNT(*) AS emailCount FROM clients WHERE email = ?";
    $emailCheckStmt = $connection->prepare($emailCheckSql);
    $emailCheckStmt->bind_param("s", $email);
    $emailCheckStmt->execute();
    $emailCheckResult = $emailCheckStmt->get_result();
    $emailCountRow = $emailCheckResult->fetch_assoc();

    if ($emailCountRow['emailCount'] > 0) {
      $errorEmail = "Email address is already in use. Please use a different email.";
    } else {
      $errorEmail = ''; // Reset the error message

      // Check if the combination of first name and last name is not already in use
      $nameCheckSql = "SELECT COUNT(*) AS nameCount FROM clients WHERE first_name = ? AND last_name = ?";
      $nameCheckStmt = $connection->prepare($nameCheckSql);
      $nameCheckStmt->bind_param("ss", $firstName, $lastName);
      $nameCheckStmt->execute();
      $nameCheckResult = $nameCheckStmt->get_result();
      $nameCountRow = $nameCheckResult->fetch_assoc();
      if ($nameCountRow['nameCount'] > 0) {
        $errorName = "Name is already in use. Please use a different name.";
      } else {
        $errorName = ''; // Reset the error message

        if (!validatePassword($password)) {
          $errorMessage = "Password must be at least 8 characters long and contain uppercase, lowercase, number, and symbol (excluding underscore).";
        } else {
          $errorMessage = ''; // Reset the error message

          $otp = rand(100000, 999999);
          $receiverEmail = $email;
          $subject = "Email Verification";
          $emailbody = "Hello,<br><br>Welcome to JBLAS Home Renovation Company!<br> Your One-Stop-Shop!, An online booking for your home renovation and repair services.<br><br>Please enter your 6-digit OTP code given below to verify your email and complete registration.<br><b><h3>";
          smtp_mailer($receiverEmail, $subject, $emailbody . $otp . "</h3></b><br><br>Please do not reply in this message.<br><br>Best regards,<br>JBLAS Home Renovation");

          $currentDate = date("mdy");

          // Query the database to count the number of clients who registered on the current day
          $sql = "SELECT COUNT(*) AS clientCount FROM clients WHERE registration_date = ?";
          $stmt = $connection->prepare($sql);
          $stmt->bind_param("s", $currentDate);
          $stmt->execute();
          $result = $stmt->get_result();
          $row = $result->fetch_assoc();

          $userID = "User" . substr(uniqid(), 5);
          // Set the account type to "Patient" for users who register using the signup page
          $accountType = "client";

          $sql = "INSERT INTO clients (user_id, first_name, last_name,midName, street, barangay, municipality, province, gender, date_of_birth, mobile_number, email, username, password, acc_type, otp_code, email_status)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?,?)";
          $stmt = $connection->prepare($sql);
          $stmt->bind_param("sssssssssssssssss", $userID, $firstName, $lastName,$midName,$street,$barangay,$municipality,$province, $gender, $dateOfBirth, $mobileNumber, $email, $username, $password, $accountType, $otp, $email_status);
          $_SESSION['email'] = $email; // Set the email as a session variable

          if ($stmt->execute()) {
            header("Location: otp_verification.php");
            exit(); // Ensure no further code execution after the redirect
          } else {
            echo '<script>alert("Error: ' . $sql . ' ' . $connection->error . '");</script>';
          }
        }
      }
    }
  }
}

function smtp_mailer($to, $subject, $msg)
{
  $mail = new PHPMailer();
  $mail->IsSMTP();
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = 'tls';
  $mail->Host = "smtp.gmail.com";
  $mail->Port = 587;
  $mail->IsHTML(true);
  $mail->CharSet = 'UTF-8';
  //$mail->SMTPDebug = 2;
  $mail->Username = "jblas.home@gmail.com"; // Sender's Email
  $mail->Password = "ufmsdrowbkffrkga"; //Sender's Email App Password
  $mail->SetFrom("jblas.home@gmail.com"); // Sender's Email
  $mail->Subject = $subject;
  $mail->Body = $msg;
  $mail->AddAddress($to);
  $mail->SMTPOptions = array('ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => false
  ));
  if (!$mail->Send()) {
    return false;
  } else {
    return true;
  }
}

function validatePassword($password)
{
  // Define the regular expressions for each type of character
  $uppercaseRegex = '/[A-Z]/';
  $lowercaseRegex = '/[a-z]/';
  $digitRegex = '/\d/';
  $symbolRegex = '/[^A-Za-z0-9_]/'; // Excluding underscore

  return (
    strlen($password) >= 8 &&
    preg_match($uppercaseRegex, $password) &&
    preg_match($lowercaseRegex, $password) &&
    preg_match($digitRegex, $password) &&
    preg_match($symbolRegex, $password)
  );
}
?>




<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SignUp</title>
    <!-- Stylesheet -->
    <link rel="stylesheet" href="style/indexStyle.css">
    <link rel="stylesheet" href="style.css">
    <!-- bootstrap link--->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Font Awesome Kit -->
    <script src="https://kit.fontawesome.com/23688bd133.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css">

    <!-- Favicon -->

    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="favicon_io/site.webmanifest">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap" rel="stylesheet">
    <style media="screen" >
    label {
      font-size: .80em;
    }
  </style>
  <script>
    function validateForm() {
      var errorMessage = document.getElementById("error-message");
      var username = document.getElementById("username").value;
      var password = document.getElementById("password").value;
      var confirmPassword = document.getElementById("confirmPassword").value;
      var firstName = document.getElementById("firstName").value;
      var lastName = document.getElementById("lastName").value;
      var birthday = document.getElementById("birthday").value;
      var gender = document.getElementById("gender").value;
      var mobileNumber = document.getElementById("mobileNumber").value;
      var email = document.getElementById("email").value;

      errorMessage.textContent = ""; // Clear any previous error message
      errorMessage.style.display = "none"; // Hide the error message

      if (username.includes('_')) {
        errorMessage.textContent = "Usernames cannot contain underscore(_) symbol.";
        errorMessage.style.display = "block"; // Show the error message
        document.getElementById("username").value = ""; // Clear the username field
        return false;
      }

      if (
        username === "" ||
        username.length < 8 && username.length >= 13 || // Add this condition for minimum 10 characters
        password === "" ||
        confirmPassword === "" ||
        firstName === "" ||
        lastName === "" ||
        birthday === "" ||
        gender === "" ||
        mobileNumber === "" ||
        email === ""
      ) {
        errorMessage.textContent = "All fields must be filled, and the username must be at least 8 characters.";
        errorMessage.style.display = "block"; // Show the error message
        return false;
      }

      if (password !== confirmPassword) {
        errorMessage.textContent = "Passwords do not match.";
        errorMessage.style.display = "block"; // Show the error message
        return false;
      }

      return true;
    }
  </script>

  <style>
    .toggle-password {
      opacity: 0.2;
      /* Initial low opacity */
      transition: opacity 0.2s;
      /* Smooth transition */
    }

    #password-strength {
      font-size: 14px;
      /* Set your desired font size */
    }

    .logo {
      height: 70px;
      width: 70px;
      padding: 10px;
    }

    .logoo {
      height: 70px;
      width: 70px;
      padding: 10px;
    }

    .required::after {
      content: " *";
      color: red;
    }

    .modal-dialog {
      max-width: 100%;
      padding: 0 5%;
    }
    #signup{
      background-image: url(images/HouseBG.png);
      background-repeat: no-repeat;
      background-size: cover;
            margin:0;
            max-width:100%;
            padding:0;
            text-align: center;
            color: white;
    }
    .dropdown:hover .dropdown-menu {
    display: block;
  }
  </style>
</head>

<body>
 <?php include("navbar.php"); ?>

  <section id="signup" >
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 px-0 d-none d-md-block">
          <img src="images/LoginLogo.png" alt="Login image" class="w-100 vh-100" style="object-fit: auto; object-position: center; padding:10%;">
          <h2>JBLAS Online Booking for Home Renovation</h2>
        </div>
        <div class="col-md-6" style="background-color:transparent;   padding:2%;">

          <div class="d-flex align-items-center justify-content-center" style="background-color:transparent; border:3px solid #F3BB83; padding: 5%; height:100%; border-radius:20px;">

            <form style="color: white;" method="POST" onsubmit="return validateForm();">
              <h3 style="color:#F3BB83;"><b>Sign Up</b></h3>
              <p style="text-align:left;color:#F3BB83;"><b>Personal Info</b></p>
              <p id="error-message" style="display:none; color: #ff6666; font-weight: bold; background-color: #ffe6e6; padding: 5px;"></p>
              <div class="row">
                <div class="col">
                  <div class="mb-3 form-floating">
                    <input style="color:white; border-color:#F3BB83; background-color:transparent; text-transform:capitalize;" type="text" name="firstName" class="form-control" id="firstName" placeholder=" " value="<?php echo $firstName; ?>" autocomplete="off" maxlength="20" required>
                    <label for="firstName" class="form-label">First Name<span class="required"></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="mb-3 form-floating">
                    <input style="color:white; border-color:#F3BB83; background-color:transparent; text-transform:capitalize;" type="text" name="midName" class="form-control" id="midName" placeholder=" " value="<?php echo $midName; ?>" autocomplete="off" maxlength="20" required>
                    <label for="midName" class="form-label">Middle Name</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="mb-3 form-floating">
                    <input style="color:white; border-color:#F3BB83; background-color:transparent; text-transform:capitalize;" type="text" name="lastName" class="form-control" id="lastName" placeholder=" " value="<?php echo $lastName; ?>" maxlength="20" autocomplete="off" required>
                    <label for="lastName" class="form-label">Last Name<span class="required"></label>
                  </div>
                </div>
              </div>
              <?php
              if (isset($errorName)) {
                echo '<p style="color: red;">' . $errorName . '</p>';
              }
              ?>



              <div class="row">
                <div class="col">
                  <div class="mb-3 form-floating">
                    <input style="color:white; border-color:#F3BB83; background-color:transparent;" type="date" name="birthday" class="form-control" id="birthday" value="<?php echo $birthday; ?>" autocomplete="off" required oninput="validateAge()">
                    <label for="birthday" class="form-label">Birthday<span class="required"></label>
                  </div>
                  <p id="ageError" style="color: red;"></p>
                </div>

                <script>
                  function validateAge() {
                    var birthdayInput = document.getElementById('birthday');
                    var ageError = document.getElementById('ageError');
                    var minAgeDate = new Date();
                    minAgeDate.setFullYear(minAgeDate.getFullYear() - 18);

                    if (new Date(birthdayInput.value) > minAgeDate) {
                      ageError.innerHTML = 'You must be 18 years old or above.';
                      birthdayInput.setCustomValidity('You must be 18 years old or above.');
                    } else {
                      ageError.innerHTML = '';
                      birthdayInput.setCustomValidity('');
                    }
                  }
                </script>

                <div class="col">
                  <div class="mb-3 form-floating">
                    <select style="color:white; border-color:#F3BB83; background-color:transparent;" name="gender" class="form-select" id="gender" value="<?php echo $gender; ?>" autocomplete="off" required>
                      <option selected disabled></option>
                      <option style="color:black;" value="male">Male</option>
                      <option style="color:black;" value="female">Female</option>
                      <option style="color:black;" value="other">Other</option>
                    </select>
                    <label for="gender" class="form-label">Gender<span class="required"></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="mb-3 form-floating">
                    <input style="color:white; border-color:#F3BB83; background-color:transparent" name="mobileNumber" type="tel" class="form-control" id="mobileNumber" placeholder="09*********" value="<?php echo $mobileNumber; ?>" autocomplete="off" maxlength="11" required>
                    <label for="mobileNumber" class="form-label">Mobile Number<span class="required"></label>
                  </div>
                </div>
                <div class="col">
                  <div class="mb-3 form-floating">
                    <input type="email" style="color:white; border-color:#F3BB83; text-transform: lowercase; background-color:transparent;" class="form-control" name="email" id="email" placeholder=" " value="<?php echo $email; ?>" autocomplete="off" required>
                    <label for="email" class="form-label">Email<span class="required"></label>
                  </div>
                </div>
              </div>
              <?php
              if (isset($errorEmail)) {
                echo '<p style="color: red;">' . $errorEmail . '</p>';
              }
              ?>
              <p style="text-align:left; color:#F3BB83;"><b>Address</b></p>
              <div class="row">
                <div class="col">
                  <div class="mb-3 form-floating">
                    <input style="color:white; border-color:#F3BB83; background-color:transparent; text-transform:capitalize;" type="text" name="street" class="form-control" id="street" placeholder=" " value="<?php echo $street; ?>" autocomplete="off" maxlength="20" required>
                    <label for="street" class="form-label">Street/Purok/Sitio<span class="required"></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="mb-3 form-floating">
                    <input style="color:white; border-color:#F3BB83; background-color:transparent; text-transform:capitalize;" type="text" class="form-control" name="barangay" id="barangay" required autocomplete="off">
                    <label for="barangay" class="form-label">Barangay<span class="required"></label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="mb-3 form-floating">
                      <input style="color:white; border-color:#F3BB83; background-color:transparent" type="text"  name="municipality" class="form-control" id="municipality" placeholder=" " required autocomplete="off">
                      <label for="municipal" class="form-label">Municipality/City<span class="required"></label>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="mb-3 form-floating">
                      <input style="color:white; border-color:#F3BB83; background-color:transparent" type="text"  name="province" class="form-control" id="province" placeholder=" " required autocomplete="off">
                      <label for="province" class="form-label">Province<span class="required"></label>
                    </div>
                  </div>
                </div>
              </div>
              <p style="text-align:left; color:#F3BB83; background-color:transparent"><b>Create new username and password</b></p>

              <div class="row">
                <div class="col">
                  <div class="mb-3 form-floating">
                    <input style="color:white; border-color:#F3BB83; background-color:transparent" name="user_name" type="text" class="form-control" id="username" placeholder=" " autocomplete="off" required maxlength="32">
                    <label for="username" class="form-label">Username (Atleast 8 characters)<span class="required"></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="mb-3 form-floating">
                    <input style="color:white; border-color:#F3BB83;background-color:transparent" type="password" name="password" class="form-control" id="password" placeholder=" " oninput="checkPasswordStrength()" maxlength="32" autocomplete="off" required>
                    <label for="password" class="form-label">Password (Must atleast 8 characters)<span class="required"></label>
                    <i class="toggle-password fas fa-eye position-absolute top-50 end-0 p-2 translate-middle-y" onclick="togglePassword1('password')"></i>
                  </div>
                </div>
              </div>
              <?php
              if (isset($errorMessage)) {
                echo '<p style="color: red;">' . $errorMessage . '</p>';
              }
              ?>
              <div class="row">
                <div class="col">
                  <div class="mb-3 form-floating">
                    <input style="color:white; border-color:#F3BB83; background-color:transparent;" type="password" name="confirmPassword" class="form-control" id="confirmPassword" placeholder=" " autocomplete="off" required>
                    <label for="confirmPassword" class="form-label">Confirm Password<span class="required"></label>
                    <i class="toggle-password fas fa-eye position-absolute top-50 end-0 p-2 translate-middle-y" onclick="togglePassword2('confirmPassword')"></i>
                  </div>
                </div>
              </div>
              <!-- Add the password strength feedback div here -->
              <div class="row">
                <div class="col p-3">
                  <div id="password-strength" class="text-muted"></div>
                </div>
              </div>
              <div class="form-check d-flex justify-content-center mb-5">
                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" required />
                <label class="form-check-label" for="form2Example3">
                  <p class="pb-2 mt-1"  >I agree in all <a style="color:#F3BB83;" href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Terms and Conditions</a></p>
                </label>
              </div>
              <input id="button" value="Register" type="submit" class="btn btn-primary" style="color:white; background-color:#F3BB83; width:50%;">
              <br><br><br>
              <p>Already have an account? <a style="color:#F3BB83;" href="login.php" class="link-info">Login Now</a></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- Modal for Terms and Conditions -->
  <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <img class="logoo" src="images/MODERNHOME.png" alt="" />
          <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body " style="text-align: justify;">
          <!-- Add your terms and conditions content here -->

          <br><b>IMPORTANT NOTE</b>
          <br>Your privacy and the protection of your private data are of key importance to us. We will never share them with any third party. Nevertheless, in order to use any of our sites you must be a healthcare professional. If you are not falling into this category the access of our site is prohibited.
          <br><br>
          <br><b>Terms and Conditions of Use</b>
          <strong>Important</strong>
          <br><br>Please read these terms and conditions (the "Terms") carefully before using the JBLAS website ("Site"). Using the Site you consent to these Terms.
          <br><br> Using the Service (as defined below), you agree that you have read, understood, accepted, and agreed with the Terms of Use. You further agree to the representations made by yourself below. If you do not agree to or fall within the Terms of Use of the Service and wish to discontinue using the Service, please do not continue using the Application (as defined below) or the Service. 
         <br>The Terms of Use stated herein (collectively, the “Terms of Use” or this “Agreement”) constitute a legal agreement between you (the “User”) and JBLAS HOME RENOVATION AND SERVICES ONE STOP SHOP (the “Company”). 
          <br><br>Any Questions?</b>
          <br>If you have any questions in respect to the site, the data security or any other issue concerning the Terms please contact us at any time.
          <br><br>
          <br>JBLAS | Home Renovation
     
          <br>Telephone Number: 042- 785-1886
          <br>Mobile Number: Globe/Tm 09956612009 | Smart/TNT 09982283504
          <br>Email: info@jblashomerenovation.com

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-bs-dismiss="modal"><b>Close</b></button>
        </div>
      </div>
    </div>
  </div>

  <script>
    function togglePassword1(inputId) {
      var input = document.getElementById(inputId);
      var icon = document.querySelector('i.toggle-password');
      if (input.type === "password") {
        input.type = "text";
        icon.style.opacity = 1; // Normal opacity when showing password
      } else {
        input.type = "password";
        icon.style.opacity = 0.2; // Low opacity when hiding password
      }
    }
    function togglePassword2(inputId) {
      var input = document.getElementById(inputId);
      var icon = document.querySelector('i.toggle-password');
      if (input.type === "password") {
        input.type = "text";
        icon.style.opacity = 1; // Normal opacity when showing password
      } else {
        input.type = "password";
        icon.style.opacity = 0.2; // Low opacity when hiding password
      }
    }


    function checkPasswordStrength() {
      var password = document.getElementById("password").value;
      var passwordStrength = document.getElementById("password-strength");

      // Define the regular expressions for each type of character
      var uppercaseRegex = /[A-Z]/;
      var lowercaseRegex = /[a-z]/;
      var digitRegex = /\d/;
      var symbolRegex = /[^A-Za-z0-9_]/;

      var strength = 0;

      // Check for uppercase letters
      if (password.match(uppercaseRegex)) {
        strength += 1;
      }

      // Check for lowercase letters
      if (password.match(lowercaseRegex)) {
        strength += 1;
      }

      // Check for digits
      if (password.match(digitRegex)) {
        strength += 1;
      }

      // Check for symbols (excluding underscore)
      if (password.match(symbolRegex)) {
        strength += 1;
      }

      // Set the feedback based on password strength
      if (strength < 2) {
        passwordStrength.textContent = "Password is weak";
        passwordStrength.style.color = "red";
      } else if (strength < 4) {
        passwordStrength.textContent = "Password is moderate";
        passwordStrength.style.color = "orange";
      } else {
        passwordStrength.textContent = "Password is strong";
        passwordStrength.style.color = "green";
      }
    }
  </script>


</body>

</html>