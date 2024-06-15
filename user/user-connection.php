<?php
session_start();
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('../database/connection_database.php');

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validate and sanitize input data (basic validation)
$firstname = $_POST['first_name'] ?? '';
$lastname = $_POST['last_name'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$blood_group = $_POST['blood_group'] ?? '';
$dob = $_POST['birth_date'] ?? '';
$gender = $_POST['gender'] ?? '';
$type = $_POST['type'] ?? '';



if ($type === "donor") {
    // Prepare an SQL statement for execution
    $stmt = $conn->prepare("INSERT INTO donor (firstname, lastname, email, password, `group`, dob, gender) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    // Check if statement preparation was successful
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("sssssss", $firstname, $lastname, $email, $password, $blood_group, $dob, $gender);

    //Atemptting the session in the global for making the login option
    
    $_SESSION['password'] = $checkpassword; 
    
    // Attempt to execute the prepared statement
    if ($stmt->execute()) {
        $_SESSION['firstname'] = $firstname;
        $_SESSION['email'] = $email; 
        $_SESSION['type'] = $type; 
        header("location: dashboard.php");
        exit;
    } else {
        echo "Error executing statement: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
     // Prepare an SQL statement for execution
     $sql = $conn->prepare("INSERT INTO needer (firstname, lastname, email, password, `group`, dob, gender) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
     // Check if statement preparation was successful
     if ($sql === false) {
         die("Error preparing statement: " . $conn->error);
     }
 
     // Bind variables to the prepared statement as parameters
     $sql->bind_param("sssssss", $firstname, $lastname, $email, $password, $blood_group, $dob, $gender);
     
     // Attempt to execute the prepared statement
     if ($sql->execute()) {
         $_SESSION['firstname'] = $firstname;         
         $_SESSION['email'] = $email;         
         $_SESSION['type'] = $type; 
         header("location: dashboard.php");
         exit;
     } else {
         echo "Error executing statement: " . $stmt->error;
     }
 
     // Close the statement
     $sql->close();
}

// Close the database connection
$conn->close();
?>
