<?php
include ("session_data.php");
include("connection.php");
$name = "";
$contact_number = "";
$address = "";
$issue="";
$schedule1 = "";
$schedule2 = "";
$service = "Utility Services";
$serviceType="plumbing";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Form data
    $name = $_POST['name'];
    $contact_number = $_POST['mobile_number'];
    $address = $_POST['address'];
    $issue= $_POST['issue'];
    $email= $_POST['email'];
    $schedule1 = $_POST['schedule_homevisit'];
    $schedule2 = $_POST['schedule_repair'];
    $bookID = "Book" . substr(uniqid(), 5);
    $status="pending";
    // Insert data into the table
    $sql = "INSERT INTO services_tbl (book_id,name, contact_number,email, address, issue,schedule_homevisit,schedule_repair, user_id, service, service_type,status)
VALUES ('$bookID','$name', '$contact_number','$email', '$address','$issue', '$schedule1','$schedule2','$userID', '$service', '$serviceType','$status')";

    if ($connection->query($sql) === TRUE) {
        header("Location: success.php");
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }


    // Close the database connection
    $connection->close();
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plumbing Services</title>
         <!-- Stylesheet -->
         <link rel="stylesheet" href="style/indexStyle.css">
  
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
    <style>
                  
        section{
            background-image: url(images/bookBG.png);
            background-repeat: no-repeat;
            background-size: cover;
            color: white;
        }   

        textarea {
        width: 100%;
        height: 5em; /* Adjust the height as needed */
        max-width: 100%;
        max-height: 10em; /* Adjust the max-height as needed */
        resize: vertical; /* Allow vertical resizing */
    }
    </style>
</head>

<body>
    <!-- This is for Navigation Bar -->
    <?php include "navbarProfile.php"; ?>
    
    <section>

        <div class="container " style="padding: 3%; text-align:center; " >
            <form method="POST" onsubmit="return validateForm()" >
                <h3 style="color:white;"><b>Plumbing Service</b></h3>
                <br>
                <div class="row" > 
                <div class="col-lg-6" >
                    <img style="height: 300px; max-width:100%;" src="images/plumbing.png" alt="">
                </div>
                <div class="col-lg-6" >
                <div class="row">
                    <div class="col mt-3">
                        <p style="text-align:left;color:white;"><b>Client Information</b></p>

                        <div class="mb-3 form-floating">
                                    <input style="color: white; border-color: #F3BB83; background-color: transparent" type="text" class="form-control" name="name" id="firstName" placeholder=" " value="<?php echo isset($clientData['first_name']) ? $clientData['first_name'] : ''; ?> <?php echo isset($clientData['midName']) ? $clientData['midName'] : ''; ?> <?php echo isset($clientData['last_name']) ? $clientData['last_name'] : ''; ?>" readonly autocomplete="off" required>
                                    <label for="firstName" class="form-label">Name</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3 form-floating">
                                    <input style="color:white; border-color:#F3BB83; background-color:transparent" type="tel" class="form-control" name="mobile_number" id="mobileNumber" placeholder=" " value=<?php echo $clientData['mobile_number']; ?> readonly autocomplete="off" required>
                                    <label for="mobileNumber" class="form-label">Mobile Number</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3 form-floating">
                                    <input style="color:white; border-color:#F3BB83; background-color:transparent" type="email" class="form-control" name="email" id="mobileNumber" placeholder=" " value=<?php echo $clientData['email']; ?> readonly autocomplete="off" required>
                                    <label for="mobileNumber" class="form-label">Email</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3 form-floating">
                                    <input style="color: white; border-color: #F3BB83; background-color: transparent" type="text" class="form-control" name="address" id="mobileNumber" placeholder=" " autocomplete="off" value="<?php echo isset($clientData['street']) ? $clientData['street'] : ''; ?> <?php echo isset($clientData['barangay']) ? $clientData['barangay'] : ''; ?> <?php echo isset($clientData['municipality']) ? $clientData['municipality'] : ''; ?><?php echo isset($clientData['municipality']) && isset($clientData['province']) ? ', ' : ''; ?><?php echo isset($clientData['province']) ? $clientData['province'] : ''; ?>" readonly required>
                                    <label for="mobileNumber" class="form-label">Address</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="row mt-3 ">
                        <b><p style="text-align:left;color:white;">Issue/Repair Problem</p></b>
                    <div class="col">
                        <div class="mb-3 form-floating">
                        <textarea  style="color:white; border-color:#F3BB83; background-color:transparent " id="text-input" name="issue" rows="5" maxlength="200" autocomplete="off" required placeholder="Type here..."></textarea>
                        </div>
                    </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <p style="text-align:left;color:white;"><b>Schedule for date of home inspection:</b></p>
                            <div class="mb-3 form-floating">
                                <input  style="color:white; border-color:#F3BB83; background-color:transparent;" type="date" class="form-control flatpickr-input" name="schedule_homevisit" id="Schedule" required>
                                <i class=" fas fa-calendar position-absolute top-50 end-0 p-2 translate-middle-y"></i>
                                <label for="schedule" class="form-label">Date</label>
                            </div>
                        </div>
                        <div class="col">
                            <p style="text-align:left;color:white;"><b>Schedule for date of renovation/repair:</b></p>
                            <div class="mb-3 form-floating">
                                <input  style="color:white; border-color:#F3BB83; background-color:transparent;" type="date" class="form-control flatpickr-input" name="schedule_repair" id="Schedule" required>
                                <i class=" fas fa-calendar position-absolute top-50 end-0 p-2 translate-middle-y"></i>
                                <label for="schedule" class="form-label">Date</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            <button type="submit" class="btn btn-primary btn-rounded d-inline-block text-center" style="color:black; background-color:#F2EAD3; width:40%; height:40px; border-radius: 20px;"><b>Submit</b></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <a href="utility.php" type="button" class="btn btn-primary btn-rounded d-inline-block text-center" style="color:black; background-color:#F2EAD3; width:40%; height:40px; border-radius: 20px;"><b>Back</b></a>
                        </div>
            </form>

    </section>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.js"></script>
    <script>
        flatpickr("#Schedule", {
            enable: [
                function(date) {
                    // Enable Tuesday (2) and Thursday (4)
                    return date.getDay() === 1 || date.getDay() === 2 || date.getDay() === 3 || date.getDay() === 4 || date.getDay() === 5 || date.getDay() === 6;
                },
            ],
            minDate: "today", // Disallow past dates
            // Set the date format
            dateFormat: "Y-m-d",
            // Show the calendar when clicking the input field
            clickOpens: true,
        });
    </script>
    <script>
function validateForm() {
    var scheduleHomeVisit = new Date(document.getElementsByName('schedule_homevisit')[0].value);
    var scheduleRepair = new Date(document.getElementsByName('schedule_repair')[0].value);

    // Compare dates
    if (scheduleHomeVisit >= scheduleRepair) {
        alert("Please ensure that the date for home visit is before the date for repair.");
        return false; // Prevent form submission
    }
    return true; // Allow form submission if validation passes
}
</script>
</body>
<?php include("footer.php"); ?>
</html>