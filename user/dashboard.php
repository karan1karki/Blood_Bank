<?php

require ("../data/data.php");
require ('../database/connection_database.php');
// Start the session
session_start();
if (!isset($_SESSION['firstname'])) {
    // If not, redirect to the login page
    header("Location: ../others/register.php"); // Ensure this path is correct
    exit();
}
if (isset($_SESSION['type'])) {
    // Correctly retrieve the type if it's set
    $type = $_SESSION['type'];
} else {
    echo "User type is not set.";
}   
// Display success message if present
if (isset($_GET['message'])) {
    echo "<p>" . htmlspecialchars($_GET['message']) . "</p>";
}
$firstname = $_SESSION['firstname'];
$email = $_SESSION['email'];
$type = $_SESSION['type'];
if ($type === "donor"){
    $stmtement = $conn->prepare("SELECT id, firstname, lastname, email, `group`, dob, gender FROM donor WHERE email = ?");
    if ($stmtement) {
        $stmtement->bind_param("s", $email);
        $stmtement->execute();
        $stmtement->store_result();
    
        if ($stmtement->num_rows > 0) {
            $stmtement->bind_result($id, $firstname, $lastname, $email, $group, $dob, $gender);
            $stmtement->fetch();
    
            // Store user details in session if needed
            $_SESSION['id'] = $id;
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['group'] = $group;
            $_SESSION['dob'] = $dob;
            $_SESSION['gender'] = $gender;
    
        } else {
            echo "No user found with the email: " . htmlspecialchars($email);
        }
    
        $stmtement->close();
    } else {
        // Query preparation failed
        echo "Query preparation failed: " . $conn->error;
    }
}else{
    $stmtement = $conn->prepare("SELECT id, firstname, lastname, email, `group`, dob, gender FROM needer WHERE email = ?");
    if ($stmtement) {
        $stmtement->bind_param("s", $email);
        $stmtement->execute();
        $stmtement->store_result();
    
        if ($stmtement->num_rows > 0) {
            $stmtement->bind_result($id, $firstname, $lastname, $email, $group, $dob, $gender);
            $stmtement->fetch();
    
            // Store user details in session if needed
            $_SESSION['id'] = $id;
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['group'] = $group;
            $_SESSION['dob'] = $dob;
            $_SESSION['gender'] = $gender;
    
        } else {
            echo "No user found with the email: " . htmlspecialchars($email);
        }
    
        $stmtement->close();
    } else {
        // Query preparation failed
        echo "Query preparation failed: " . $conn->error;
    }

}


$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nepal Blood Bank - Connect the Donors</title>

    <!-- favicon-->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

    <!--css-->
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- google font link-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Roboto:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        hr {
            border: none;
            height: 1px;
            background-color: #c5c7c9;
            margin: 20px 0;
        }

        /* Define the column layout */
        .column {
            width: 33.33%;
            float: left;
            padding: 20px;
            box-sizing: border-box;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* Responsive layout */
        @media screen and (max-width: 1024px) {
            .column {
                width: 100%;
            }
        }

        /* Adjust font size for smaller screens */
        @media screen and (max-width: 768px) {
            h1 {
                font-size: 22px;
            }

            p {
                font-size: 14px;
            }
        }
    </style>

</head>

<body>
    <header class="header">
        <div class="header-top">
            <div class="container">

            </div>
        </div>
        <div class="header-bottom" data-header>
            <div class="container">
                <a href="../" class="logo">Welcome , <?php echo htmlspecialchars($firstname);?></a>
                <nav class="navbar container" data-navbar>
                    <ul class="navbar-list">
                        <li>
                            <a href="details.php?id=<?php echo htmlspecialchars($id); echo htmlspecialchars($type); ?>" class="navbar-link" data-nav-link>My Details</a>
                        </li>
                    </ul>
                </nav>
                <!-- <button class="btn"></button> -->
                <a href="logout.php" class="btn">Logout</a>

            </div>
        </div>
    </header>
    <!--HERO-->
    <section class="section hero" id="home" style="background-image: url('./assets/images/hero-bg.png')" aria-label="hero">
        <div class="container">
            <div class="hero-content">
                <p class="section-subtitle">Account Type is  <?php echo htmlspecialchars($type) ; ?></p>
                <img src="../assets/images/blood-icon.png" alt="ICON" width="70" height="70">
                <p class="section-subtitle">Welcome To Nepal Blood Bank</p>
                <h1 class="h1 hero-title">Adding some quantiy..</h1>
                <form action="">
                    <div class="form-section">
                        <div class="form-field">
                            <label for="pint">Pint</label>
                            <input type="text" name="pint" placeholder="Enter the amount of Pint">
                        </div>
                        <button class="btn">Submit</button>
                    </div>
                </form>
            </div>
            <figure class="hero-banner">
                <img src="../assets/images/about.png" width="587" height="839" alt="hero banner" class="w-100">
            </figure>
        </div>
    </section>
    <section class="section hero" id="home" style="background-image: url('./assets/images/hero-bg.png')" aria-label="hero">
        <div class="container">
            <div class="list-Content">
                <?php 
                $listype = "";
                    if ($type === "donor"){
                        $listype = "NEEDER";
                    }
                    else{
                        $listype = "DONOR";
                    }
                    echo "<p class='section-subtitle'>".$listype." list</p>" 
                ?>
                <div class="grid-list">
                    <?php
                        // Assuming $needers array is already populated
                        if ($type === "donor"){
                            if (isset($needers)) {
                                foreach ($needers as $needer) {
                                    echo <<<neederlist
                                    <div class="needer-item">
                                        <div class="item-field"> <p class="text-font">First Name: {$needer->firstname}</p></div>
                                        <div class="item-field"><p class="text-font">Last Name: {$needer->lastname}</p></div>
                                        <div class="item-field"><p class="text-font">Email: {$needer->email}</p></div>
                                        <a href="request.php?id=$needer->id&currentid=$id&type=$type &name=$needer->firstname"><button class="btn">Donate To Needer </button></a>
                                        <!-- Add more fields as needed -->
                                    </div>
                                    neederlist;
                                }
                            }
                        }else {
                            if (isset($donors)) {
                                foreach ($donors as $donor) {
                                    echo <<<donorlist
                                    <div class="donor-item">
                                        <div class="item-field"><p class="text-font">First Name: {$donor->firstname}</p></div>
                                        <div class="item-field"><p class="text-font">Last Name: {$donor->lastname}</p></div>
                                        <div class="item-field"><p class="text-font">Email: {$donor->email}</p></div>
                                        <a href="request.php?id=$donor->id&currentid=$id &type=$type &name=$donor->firstname "><button class="btn">Request To Donor </button></a>
                                    </div>
                                    donorlist;
                                }
                            }
                        }
                    ?>
                </div>
            </div>
            
            
        </div>
    </section>
    <!--Footer-->
    <footer class="footer">
        <div class="footer-top section">
            <div class="container">
                <div class="footer-brand">
                    <a href="#" class="logo">Nepal Blood Bank</a>
                    <p class="footer-text">
                        We are passionate about connecting blood donors with recipients and bridging the gap in the healthcare
                        industry.
                        We strive to create a community that fosters empathy, support, and solidarity among individuals who are
                        committed to making a difference.
                    </p>
                    <div class="schedule">
                        <div class="schedule-icon">
                            <ion-icon name="time-outline"></ion-icon>
                        </div>
                        <span class="span">
                            24 X 7:<br>
                            365 Days
                        </span>
                    </div>
                </div>
                <ul class="footer-list">
                    <li>
                        <p class="footer-list-title">Other Links</p>
                    </li>
                    <li>
                        <a href="#" class="footer-link">
                            <ion-icon name="add-outline"></ion-icon>
                            <span class="span">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="footer-link">
                            <ion-icon name="add-outline"></ion-icon>
                            <span class="span">Services</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="footer-link">
                            <ion-icon name="add-outline"></ion-icon>
                            <span class="span">About us</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="footer-link">
                            <ion-icon name="add-outline"></ion-icon>
                            <span class="span">Contact</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="footer-link">
                            <ion-icon name="add-outline"></ion-icon>
                            <span class="span">Login</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="footer-link">
                            <ion-icon name="add-outline"></ion-icon>
                            <span class="span">Register</span>
                        </a>
                    </li>
                </ul>
                <ul class="footer-list">
                    <li>
                        <p class="footer-list-title">Our Services</p>
                    </li>
                    <li>
                        <a href="#" class="footer-link">
                            <ion-icon name="add-outline"></ion-icon>
                            <span class="span">xxxxxxxxx</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="footer-link">
                            <ion-icon name="add-outline"></ion-icon>
                            <span class="span">xxxxxxxxx</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="footer-link">
                            <ion-icon name="add-outline"></ion-icon>
                            <span class="span">xxxxxxxxx</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="footer-link">
                            <ion-icon name="add-outline"></ion-icon>
                            <span class="span">xxxxxxxxx</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="footer-link">
                            <ion-icon name="add-outline"></ion-icon>
                            <span class="span">xxxxxxxxx</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="footer-link">
                            <ion-icon name="add-outline"></ion-icon>
                            <span class="span">xxxxxxxxx</span>
                        </a>
                    </li>
                </ul>
                <ul class="footer-list">
                    <li>
                        <p class="footer-list-title">Contact Us</p>
                    </li>
                    <!-- <li class="footer-item">
            <div class="item-icon">
              <ion-icon name="location-outline"></ion-icon>
            </div>
            <a href="https://goo.gl/maps/BYA5MxQUg5B8ZFLcA">
            <address class="item-text">
              Near Thaluk Headquarters,<br>
              Vaikom, Kottayam, Kerala IN
            </address>
          </a>
          </li>
          <li class="footer-item">
            <div class="item-icon">
              <ion-icon name="call-outline"></ion-icon>
            </div>
            <a href="tel:+917052101786" class="footer-link">+91-7558-951-351</a>
          </li> -->
                    <!-- <li class="footer-item">
            <div class="item-icon">
              <ion-icon name="mail-outline"></ion-icon>
            </div>
            <a href="mailto:help@example.com" class="footer-link">redstream001@gmail.com</a>
          </li> -->
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <p class="copyright">
                    &copy; 2024 All Rights Reserved by Nepal Blood Bank
                </p>
                <ul class="social-list">
                    <li>
                        <a href="https://www.facebook.com/andro.pool.54?mibextid=ZbWKwL" class="social-link">
                            <ion-icon name="logo-facebook"></ion-icon>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/_vladimir_putin.___/" class="social-link">
                            <ion-icon name="logo-instagram"></ion-icon>
                        </a>
                    </li>
                    <li>
                        <a href="https://twitter.com/Annabel07785340" class="social-link">
                            <ion-icon name="logo-twitter"></ion-icon>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>

    <!--BACK TO TOP-->
    <a href="#top" class="back-top-btn" aria-label="back to top" data-back-top-btn>
        <ion-icon name="caret-up" aria-hidden="true"></ion-icon>
    </a>

    <!--custom js link-->
    <script src="./assets/js/script.js" defer></script>
    <!--ionicon link-->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>