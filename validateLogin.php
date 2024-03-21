<?php
// Function to validate login credentials and get user role
// Function to sanitize input data
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

    // Sanitize input
    $username = sanitizeInput($username);

    // Retrieve hashed password from the database
    $stmt = $conn->prepare("SELECT acc_type, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $hashedPassword = $user['password'];
        $acc_type = $user['acc_type']; // Retrieve account type

        // Debugging: Display retrieved account type
        echo "Retrieved Account Type: $acc_type<br>";

        // Verify the entered password against the stored hashed password
        if (password_verify($password, $hashedPassword)) {
            // Password is correct
            return $acc_type; // Return user account type
        } else {
            // Invalid password
            return false;
        }
    } else {
        // User not found
        return false;
    }
}
?>