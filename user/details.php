<?php
session_start();
require_once('../database/connection_database.php');

if ($type === "donor"){
  // Check if the user is logged in
  if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
  }
    // Retrieve user ID from the URL
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
  } else {
    echo "User ID not provided.";
    exit();
  }

  // Prepare and execute the query to get the user details
  $stmt = $conn->prepare("SELECT firstname, lastname, email, password , `group`, dob, gender, 'DONOR' AS type, pint FROM donor WHERE id = ?");
  if ($stmt) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
      $stmt->bind_result($firstname, $lastname, $email, $password , $group, $dob, $gender, $type, $pint);
      $stmt->fetch();
    } else {
      echo "No user found with the ID: " . htmlspecialchars($id);
    }

    $stmt->close();
  } else {
    // Query preparation failed
    echo "Query preparation failed: " . $conn->error;
  }
}else {
  // Check if the user is logged in
  if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
  }
    // Retrieve user ID from the URL
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
  } else {
    echo "User ID not provided.";
    exit();
  }

  // Prepare and execute the query to get the user details
  $stmt = $conn->prepare("SELECT firstname, lastname, email, password , `group`, dob, gender, 'NEEDER' AS type, pint FROM needer WHERE id = ?");
  if ($stmt) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
      $stmt->bind_result($firstname, $lastname, $email, $password , $group, $dob, $gender, $type, $pint);
      $stmt->fetch();
    } else {
      echo "No user found with the ID: " . htmlspecialchars($id);
    }

    $stmt->close();
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
  <title>Nepal Blood Bank - connect the donors</title>

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
        <a href="#" class="logo">Welcome, <?php echo htmlspecialchars($firstname); ?></a>
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
    <article>
      <section class="section hero" id="home" style="margin: 0%;" aria-label="hero">
        <!-- Login and Registration Form -->
        <div class="container">

          <div class="form-container">
            <div class="form-title">Your Details</div>
            <form action="UserController.php? id=<?php echo htmlspecialchars($id); echo htmlspecialchars($type); ?>" method="POST">
              <!-- Login Information -->
              <div class="form-section">
                <div class="form-field">
                  <label for="first-name">FIRST NAME</label>
                  <input type="text" id="first-name" name="first_name" value="<?php echo htmlspecialchars($firstname); ?>">
                </div>
                <div class="form-field">
                  <label for="last-name">LAST NAME</label>
                  <input type="text" id="last-name" name="last_name" value="<?php echo htmlspecialchars($lastname); ?>">
                </div>
                <div class="form-field">
                  <label for="email">EMAIL</label>
                  <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                </div>
                <div class="form-field">
                  <label for="password">PASSWORD</label>
                  <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($password); ?>" placeholder="<?php echo htmlspecialchars($password); ?>">
                </div>
              </div>
              <!-- Donor Information -->
              <div class="form-section">
                <div class="form-field">
                  <label for="blood-group">BLOOD GROUP</label>
                  <select id="blood-group" name="blood_group">
                    <option value="<?php echo htmlspecialchars($group); ?>"><?php echo htmlspecialchars($group); ?></option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                  </select>
                </div>
                <div class="form-field">
                  <label for="birth-date">BIRTH DATE</label>
                  <input type="date" id="birth-date" name="birth_date" value="<?php echo htmlspecialchars($dob); ?>">
                </div>
                <div class="form-field">
                  <label for="gender">GENDER</label>
                  <select id="gender" name="gender">
                    <option value="<?php echo htmlspecialchars($gender); ?>" disabled selected><?php echo htmlspecialchars($gender); ?></option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                  </select>
                </div>
                <div class="form-field">
                  <label for="type">REGISTER TYPE</label>
                  <input type="text" name="type" placeholder="<?php echo htmlspecialchars($type); ?>" id="type" readonly>
                </div>
              </div>
                <div class="form-field">
                  <label for="pint">PINT</label>
                  <input type="text" name="pint" value="<?php echo htmlspecialchars($pint); ?>" id="type">
                </div>
              <!-- </div>
                <div class="form-field">
                  <label for="type">REGISTER TYPE</label>
                  <input type="text" name="type" placeholder="<?php echo htmlspecialchars($type); ?>" id="type">
                </div>
              </div> -->
              <button type="submit" class="btn">Update</button>
            </form>
          </div>
        </div>
      </section>

      <!--FOOTER-->
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
      </footer>c

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