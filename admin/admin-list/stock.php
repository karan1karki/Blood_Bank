<?php
require("../connection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Fetch donor data
$data = "SELECT pint FROM donor";


$result = $conn->query($data);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $donor = new stdClass();
        $donor->pint = $row['pint'];
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
        $neederObj->pint = $column['pint'];
        // Add any other fields here

        $needers[] = $neederObj;
    }
} else {
    echo "Error fetching needers: " . $conn->error;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-Dashboard</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/login.css">
    <script src="../../assets/js/script.js"></script>
</head>

<body id="top">
    <header class="header">
        <div class="header-top">
        </div>
        <div class="header-bottom" data-header>
            <div class="container">
                <a href="../" class="logo">Nepal Blood Bank</a>
                <nav class="navbar container">
                    <a href="../dashboard.php">Back</a>
                </nav>
            </div>
        </div>
    </header>
    <main>
        <div class="box">
            <div class="content">
                <div class="donor">
                    <a href="#" class="btn">List of Donors PINT</a>
                    <table border="1">
                        <thead>
                            <tr>
                                <td>Quantity</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($donors)) {
                                foreach ($donors as $donor) {
                                    echo <<<DONORLIST
                                        <tr> 
                                            <td><div class="item-field"><p class="text-font">{$donor->pint}</p></div></td>
                                        </tr>
                                    DONORLIST;
                                }
                            } else {
                                echo "<tr><td colspan='4'>No donor data available.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="needer">
                    <a href="#" class="btn">List of Needers PINT</a>
                    <table border="1">
                        <thead>
                            <tr>
                                <td>Quantity</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($needers)) {
                                foreach ($needers as $needer) {
                                    echo <<<NEEDERLIST
                                        <tr> 
                                            <td><div class="item-field"><p class="text-font">{$needer->pint}</p></div></td>
                                        </tr>
                                    NEEDERLIST;
                                }
                            } else {
                                echo "<tr><td colspan='4'>No needer data available.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
