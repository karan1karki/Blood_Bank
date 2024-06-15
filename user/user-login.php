<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../database/connection_database.php');
session_start();

$type = $_POST['type'];

if ($type === "donor") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT firstname, password FROM donor WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    $stmt->bind_result($firstname, $stored_password);
    $stmt->fetch();

    echo "Debug: Email found, now verifying password.<br>";
    // Verify the password
    if ($password === $stored_password) {
        // Password is correct, start the session
        echo "Debug: Password verified.<br>";
        $_SESSION['firstname'] = $firstname;
        $_SESSION['email'] = $email;
        $_SESSION['type'] = $type; 

        // Redirect to the dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        // Incorrect password
        echo "Invalid email or password";
    }
    // if ($stmt->num_rows > 0) {
    // } else {
    //     // No user found with that email
    //     echo "Invalid email or password";
    // }

    $stmt->close();
    $conn->close();
} else {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT firstname, password FROM needer WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    $stmt->bind_result($firstname, $stored_password);
    $stmt->fetch();

    echo "Debug: Email found, now verifying password.<br>";
    // Verify the password
    if ($password === $stored_password) {
        // Password is correct, start the session
        echo "Debug: Password verified.<br>";
        $_SESSION['firstname'] = $firstname;
        $_SESSION['email'] = $email;
        $_SESSION['type'] = $type;

        // Redirect to the dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        // Incorrect password
        echo "Invalid email or password";
    }
    // if ($stmt->num_rows > 0) {
    // } else {
    //     // No user found with that email
    //     echo "Invalid email or password";
    // }

    $stmt->close();
    $conn->close();
}
