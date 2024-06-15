<?php

require ('../database/connection_database.php');

if (isset($_GET['type'])) {
    $type = $_GET['type'];
    // print_r($type);die();
    if (isset($_GET['id'], $_GET['currentid'], $_GET['name'])) {
        $id = $_GET['id'];
        $currentid = $_GET['currentid'];
        $name = $_GET['name'];
    } else {
        echo "User ID not provided.";
        exit();
    }

    if ($type === "needer") {
      $requested_stmt = $conn->prepare("SELECT firstname, lastname, email, password, `group`, dob, gender, pint FROM donor WHERE id = ?");
      $requesting_stmt = $conn->prepare ("SELECT firstname, lastname, `group`, pint FROM needer WHERE id= ?");
    } else {
      $requested_stmt = $conn->prepare("SELECT firstname, lastname, email, password, `group`, dob, gender, pint FROM needer WHERE id = ?");
      $requesting_stmt = $conn->prepare ("SELECT firstname, lastname, `group`, pint FROM donor WHERE id= ?");
    }

    if ($requested_stmt) {
        $requested_stmt->bind_param("i", $currentid);
        $requested_stmt->execute();
        $requested_stmt->store_result();
        if ($requested_stmt->num_rows > 0) {
            $requested_stmt->bind_result($cfirstname, $clastname, $cemail, $cpassword, $cgroup, $cdob, $cgender, $cpint);
            $requested_stmt->fetch();
        } else {
            echo "No user found with the ID: " . htmlspecialchars($currentid);
            exit();
        }
        $requested_stmt->close();
    } else {
        // Query preparation failed
        echo "Query preparation failed: " . $conn->error;
        exit();
    }
    
    if ($requesting_stmt){
        $requesting_stmt->bind_param("i", $id);
        $requesting_stmt->execute();
        $requesting_stmt->store_result();
        if ($requesting_stmt->num_rows > 0) {
            $requesting_stmt->bind_result($firstname, $lastname, $group, $pint);
            $requesting_stmt->fetch();
        } else {
            echo "No user found with the ID: " . htmlspecialchars($id);
            exit();
        }
        $requesting_stmt->close();
    } else {
        // Query preparation failed
        echo "Query preparation failed: " . $conn->error;
        exit();
    }
} else {
    echo "User type not provided.";
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nepal Blood Bank - Connect the donors</title>

  <!-- favicon-->
  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

  <!--css-->
  <link rel="stylesheet" href="../assets/css/style.css">

  <!-- google font link-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Roboto:wght@400;500;600&display=swap" rel="stylesheet">

  <style>
    /* Form Styles */
    .form-title {
      color: var(--oxford-blue-1);
      font-family: var(--ff-poppins);
      font-size: 3.4rem;
      font-weight: var(--fw-800);
      text-align: center;
      margin-bottom: 20px;
    }

    .form-section {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
    }

    .form-field {
      flex: 0 0 48%;
      margin-bottom: 20px;
    }

    .form-field label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    .form-field input,
    .form-field select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .form-field input[type="submit"] {
      background-color: #216aca;
      color: #fff;
      cursor: pointer;
      transition: background-color 0.3s ease-in-out;
    }

    .form-field input[type="submit"]:hover {
      background-color: #060952;
    }
  </style>

</head>

<body id="top">
  <!-- HEADER-->
  <header class="header">
    <div class="header-top">
      <div class="container">
        <ul class="social-list">
        </ul>
      </div>
    </div>
    <div class="header-bottom" data-header>
      <div class="container">
        <a href="#" class="logo">Welcome, <?php echo htmlspecialchars($cfirstname); ?></a>
        <nav class="navbar container" data-navbar>
          <ul class="navbar-list">
            <li>
              <a href="dashboard.php" class="navbar-link" data-nav-link>Home</a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </header>
  <main>
  <section class="section hero" id="home" style="margin: 0%;" aria-label="hero">
        <!-- Login and Registration Form -->
        <div class="container">
            <p class="section-subtitle">Thank you for contacting to <?php echo htmlspecialchars($firstname); ?>. We have received your details and requesting to <?php echo htmlspecialchars($type)?>from Account name <?php echo htmlspecialchars($firstname)?> to the <?php echo htmlspecialchars($cfirstname); ?> and the blood group of both are <?php echo htmlspecialchars($group)?> to the <?php echo htmlspecialchars($cgroup)?>.</p>
            <figure class="hero-banner">
                <img src="../assets/images/thankyou.jpg" width="587" height="200" alt="hero banner" class="w-100">
            </figure>
        </div>
  </section>
  </main>
  <footer class="footer">
        <div class="footer-top section">
          <div class="container">
            <div class="footer-brand">
              <a href="#" class="logo">Nepal Blood Bank </a>
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
                  <span class="span">About us</span>
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
