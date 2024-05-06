<?php
session_start();
include ('./admin/connection.php');
if(isset($_POST['btnLogin'])){
  $userEmail = $_POST['userEmail'];
  $uPassword = $_POST['userPassword'];
  $errors = array('userEmail'=>'','userPassword'=>'');
  if($userEmail == ''){
    $errors['userEmail'] = "This field could not br empty";
  }
  if($uPassword == ''){
    $errors['userPassword'] = "This field could not be empty";
  }

  $query = "SELECT * FROM patients";
  $go_query = mysqli_query($connection, $query);
  while($out = mysqli_fetch_array($go_query)){
    $db_email = $out['Pemail'];
    $db_password = $out['Ppassword'];

    if($db_password != $uPassword){
      echo"<script>window.alert('Password is wrong')</script>";
      echo"<script>window.location.href='login.php'</script>";
    }else if($db_email==$userEmail && $db_password == $uPassword){
      $_SESSION['user'] = $userEmail;
      header('location:index.php');
      break;
    }
  }
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Thant Dental Clinic</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="./assets/logo.png" rel="icon">
    <!-- <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="./vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="./vendor/aos/aos.css" rel="stylesheet">
    <link href="./vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="./vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="./vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="./vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="./css/style.css" rel="stylesheet">
    <link href="./css/login.css" rel="stylesheet">
</head>
<body>
    <?php
    include ('noaccheader.php');
    ?>
    <section class="logincontainer">
        <div class="sign-in">
            <img class="loginimg" src="assets/logo.png" alt="">
            <div class="form">
                <h1 class="title">
                    Sign in
                </h1>
                <p class="sub-title">
                    Welcome to the Thant Dental Clinic
                </p>
                <form method="post">
                <div class="input-box">
                    <input type="email" required name="userEmail" placeholder="Email" class="username">
                    <div class="password-box">
                        <input type="password" required name="userPassword" placeholder="Password" class="password">
                        <i class='bx bx-low-vision vision'></i>
                    </div>
                </div>
                <a href="register.php">I don't have an account</a>
                <button class="btn" name="btnLogin">
                    Sign in
                </button>
                </form>
            </div>
        </div>
    </section>


    <!-- ======= Footer ======= -->
  <footer id="footer" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">

    <div class="footer-newsletter">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <h4>Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
          </div>
          <div class="col-lg-6">
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br><br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>

          </div>

          <div class="col-lg-3 col-md-6 footer-info">
            <h3>About Moderna</h3>
            <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus.</p>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Moderna</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/free-bootstrap-template-corporate-moderna/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="./vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="./vendor/aos/aos.js"></script>
  <script src="./vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="./vendor/glightbox/js/glightbox.min.js"></script>
  <script src="./vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="./vendor/swiper/swiper-bundle.min.js"></script>
  <script src="./vendor/waypoints/noframework.waypoints.js"></script>
  <script src="./vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="./js/login.js"></script>
  <script src="./js/main.js"></script>
</body>
</html>