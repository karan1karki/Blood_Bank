<?php
// Start or resume a session
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['admin_id'])) {
    // If not logged in, redirect to the login page
    header("Location: index.html");
    exit; // Terminate script execution after redirect
}

// If logged in, continue displaying the dashboard
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/login.css">
    <script src="../assets/js/script.js"></script>
</head>

<body id="top">
    <header class="header">
        <div class="header-top">

        </div>
        <div class="header-bottom" data-header>
            <div class="container">
                <a href="../" class="logo">Nepal Blood Bank</a>
                <nav class="navbar container">
                </nav>
            </div>
        </div>
    </header>
    <main>
        <div class="box">
            <div class="content">
                <div class="admin-dashboard">
                    <div class="user-registration">
                        <a href="admin-list/userregestration.php" class="btn">User Registration</a>
                    </div>
                    <div class="stocklist">
                        <a href="admin-list/stock.php" class="btn">Stock Blood list</a>
                    </div>

                </div>
            </div>
        </div>
    </main>

</body>

</html>