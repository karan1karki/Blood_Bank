<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nepal Blood Bank</title>

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
        <a href="#" class="logo">Nepal Blood Bank</a>
        <nav class="navbar container" data-navbar>
          <ul class="navbar-list">
            <li>
              <a href="../" class="navbar-link" data-nav-link>Home</a>
            </li>

            <li>
              <a href="../#about" class="navbar-link" data-nav-link>About Us</a>
            </li>
            <li>
              <a href="../#services" class="navbar-link" data-nav-link>Services</a>
            </li>
            <li>
              <a href="others/contact.php" class="navbar-link" data-nav-link>Contact</a>
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
            <div class="form-title">Register</div>
            <form action="../user/user-connection.php" method="POST">
              <!-- Login Information -->
              <div class="form-section">
                <div class="form-field">
                  <label for="first-name">FIRST NAME</label>
                  <input type="text" id="first-name" name="first_name" >
                </div>
                <div class="form-field">
                  <label for="last-name">LAST NAME</label>
                  <input type="text" id="last-name" name="last_name" >
                </div>
                <div class="form-field">
                  <label for="email">EMAIL</label>
                  <input type="email" id="email" name="email" >
                </div>
                <div class="form-field">
                  <label for="password">PASSWORD</label>
                  <input type="password" id="password" name="password" >
                </div>
              </div>
              <!-- Donor Information -->
              <div class="form-section">
                <div class="form-field">
                  <label for="blood-group">BLOOD GROUP</label>
                  <select id="blood-group" name="blood_group" >
                    <option value="" disabled selected>Select Blood Group</option>
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
                  <input type="date" id="birth-date" name="birth_date" >
                </div>
                <div class="form-field">
                  <label for="gender">GENDER</label>
                  <select id="gender" name="gender" >
                    <option value="" disabled selected>Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                  </select>
                </div>
                <div class="form-field">
                  <label for="type">REGISTER TYPE</label>
                  <select name="type" id="type" required>
                    <option value="" disabled selected>SELECT REGISTER TYPE</option>
                    <option value="donor">DONOR</option>
                    <option value="needer">NEEDER</option>
                  </select>
                </div>
              </div>
              <!-- Contact Information -->
              <!-- <div class="form-section">
                <div class="form-field">
                  <label for="state">STATE</label>
                  <input type="text" id="state" name="state" required>
                </div>
                <div class="form-field">
                  <label for="district">DISTRICT</label>
                  <input type="text" id="district" name="district" required>
                </div>
                <div class="form-field">
                  <label for="zip-code">ZIP CODE</label>
                  <input type="text" id="zip-code" name="zip_code" required>
                </div>
                <div class="form-field">
                  <label for="area">AREA</label>
                  <input type="text" id="area" name="area" required>
                </div>
              </div> -->
              <!-- <div class="form-field">
                <label for="area">Landmarks</label>
                <input type="text" id="landmarks" name="landmarks" required>
              </div> -->
              <button type="submit" class="btn">Register</button>
            </form>
            <div class="form-title">Already Registered? <u><a href="login.php" style="display: inline; color: #216aca;" onmouseover="this.style.color='#03d9ff'" onmouseout="this.style.color='#216aca'">Login Here</a></u></div>
          </div>
          <figure class="hero-banner">
            <img src="../assets/images/bg.svg" width="587" height="839" alt="hero banner" class="w-100">
            <center>
              <h2>New Here ?</h2>
            </center>
          </figure>
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
          </li>
          <li class="footer-item">
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