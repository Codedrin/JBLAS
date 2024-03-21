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

// Function to generate unique user_id for new admin users
function generateUserID($connection)
{
    // Count existing admin users
    $countQuery = "SELECT COUNT(*) as count FROM manpower";
    $countResult = $connection->query($countQuery);
    $countData = $countResult->fetch_assoc();
    $count = $countData['count'];

    // Generate user_id
    $user_id = "Manpower_" . str_pad($count + 1, 3, '0', STR_PAD_LEFT);

    return $user_id;
}

// Function to handle form submission
function processFormSubmission($connection)
{
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get data from the form
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $account_type = isset($_POST['acc_type']) ? $_POST['acc_type'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $servicename = isset($_POST['servicename']) ? $_POST['servicename'] : '';
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        // Validate and sanitize input (you should implement this)
        // Set acc_type to "admin"
        $account_type = "manpower";
        // Generate unique user_id
        $user_id = generateUserID($connection);

        // Check if the username already exists
        $existingUsernameCheck = "SELECT COUNT(*) as count FROM admin WHERE username = ?";
        $existingUsernameStmt = $connection->prepare($existingUsernameCheck);
        $existingUsernameStmt->bind_param("s", $username);
        $existingUsernameStmt->execute();
        $existingUsernameResult = $existingUsernameStmt->get_result();
        $existingUsernameData = $existingUsernameResult->fetch_assoc();

        if ($existingUsernameData['count'] > 0) {
            // Username already exists, display an error message
            echo '<script>
                    alert("Username already exists. Please choose a different username.");
                 </script>';
        } else {
            // Prepare and execute the SQL query to insert data
            $sql = "INSERT INTO manpower (user_id, name, username, email, password, servicename, acc_type) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("sssssss", $user_id, $name, $username, $email, $password, $servicename, $account_type);

            if ($stmt->execute()) {
                // Data inserted successfully
                header("Location: success.php");
                exit();
            } else {
                // Error occurred
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        }

        // Close the existingUsername statement
        $existingUsernameStmt->close();
    }
}

include "../connection.php";

// Process form submission
processFormSubmission($connection);

// Close the database connection
$connection->close();
?>

<!-- Rest of your HTML code remains unchanged -->


<div class="col py-3">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card" style="background-color: #E5E5CB;">
                    <div class="card-header text-center">
                        <h3>Add New Man Power</h3>
                    </div>
                    <div class="card-body">
                        <form id="addHealthPersonnelForm" action="" method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required autocomplete="off">
                            </div>
                            <div class="mb-3 ">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required autocomplete="off">
                            </div>
                            <div class="mb-3 form-floating">
                                <select name="servicename" class="form-select" id="service"  autocomplete="off" required>
                                    <option selected disabled></option>
                                    <option style="color:black;" value="ceiling">Ceiling Services</option>
                                    <option style="color:black;" value="gardening">Gardening Services</option>
                                    <option style="color:black;" value="flooring">Flooring Services</option>
                                    <option style="color:black;" value="window">Window Services</option>
                                    <option style="color:black;" value="painting">Painting Services</option>
                                    <option style="color:black;" value="door">Door Services</option>
                                    <option style="color:black;" value="electrical">Electrical Services</option>
                                    <option style="color:black;" value="waterpipe">Water Pipe Services</option>
                                    <option style="color:black;" value="plumbing">Plumbing Services</option>
                                    <option style="color:black;" value="cabinet">Cabinet Services</option>
                                    <option style="color:black;" value="security">Security Installation Services</option>
                                    <option style="color:black;" value="windowinstall">Window Glass Services</option>
                                </select>
                                <label for="service" class="form-label">Type of Service<span class="required"></label>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required autocomplete="off">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required autocomplete="off">
                            </div>

                            <div style="text-align: center;">
                                <button type="submit" class="btn btn-lg" style="color:white; height:20%; width:50%; background-color:#3C2A21;">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include('footer.php'); ?>
</body>

</html>