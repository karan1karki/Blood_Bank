<?php
require('../database/connection_database.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Fetch donor data
$data = "SELECT * FROM donor";
$donors = array();

$result = $conn->query($data);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $donor = new stdClass();
        $donor->id = $row['id'];
        $donor->firstname = $row['firstname'];
        $donor->lastname = $row['lastname'];
        $donor->email = $row['email'];
        $donor->password = $row['password'];
        $donor->blood_group = $row['group'];
        $donor->dob = $row['dob'];
        $donor->gender = $row['gender'];
        // Add any other fields here

        $donors[] = $donor;
    }
} else {
    echo "Error fetching donors: " . $conn->error;
}

// Fetch needer data
$sql = "SELECT * FROM needer";
$needers = array();

$store = $conn->query($sql);

if ($store) {
    while ($column = $store->fetch_assoc()) {
        $neederObj = new stdClass();
        $neederObj->id = $column['id'];
        $neederObj->firstname = $column['firstname'];
        $neederObj->lastname = $column['lastname'];
        $neederObj->email = $column['email'];
        $neederObj->password = $column['password'];
        $neederObj->group = $column['group'];
        $neederObj->dob = $column['dob'];
        $neederObj->gender = $column['gender'];
        // Add any other fields here

        $needers[] = $neederObj;
    }
} else {
    echo "Error fetching needers: " . $conn->error;
}

$conn->close();
?>
