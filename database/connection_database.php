<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "blood";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_errno) {
    echo "database is not connected";
}
