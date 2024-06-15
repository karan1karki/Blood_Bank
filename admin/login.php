<?php
require('connection.php');

// Start or resume a session
session_start();

$email = $_POST['email'] ?? ''; // Null coalescing operator to handle undefined index
$password = $_POST['password'] ?? '';

// Check if the user is already logged in
if (isset($_SESSION['admin_id'])) {
    // If already logged in, redirect to the dashboard
    header("Location: dashboard.php");
    exit; // Terminate script execution after redirect
}

if ($conn) {
    // Prepare a SQL statement with placeholders to prevent SQL injection
    $sql = "SELECT * FROM admin WHERE email = ? AND password = ?";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind parameters and execute the statement
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();

    // Get the result set
    $result = $stmt->get_result();

    // Check if there's at least one row returned
    if ($result->num_rows > 0) {
        // Admin account found, retrieve user details
        $row = $result->fetch_assoc();

        // Store user information in session variables
        $_SESSION['admin_id'] = $row['id'];
        $_SESSION['admin_email'] = $row['email'];

        // Redirect the user to the dashboard
        header("Location: dashboard.php");
        exit; // Terminate script execution after redirect
    } else {
        // No admin account found, redirect back to login page
        $_SESSION['login_error'] = true;
        
        header("Location: index.html");
        exit; // Terminate script execution after redirect
    }

    // Close the prepared statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Database connection failed";
}
