<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "blood";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_errno) {
    echo "database is not connected";
} else {
    return true;
    // echo "database connected sucessfully";
}
