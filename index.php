<?php
session_start();
include ('./admin/connection.php'); 
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
</head>

<body>
    <?php
    if (empty($_SESSION['user'])):
      include ('noaccheader.php');
      ?>
    <?php else: ?>
      <?php
      include ('header.php');
      ?>
    <?php
    endif;
    ?>
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex justify-cntent-center align-items-center">
    <div id="heroCarousel" class="container carousel carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

      <!-- Slide 1 -->
      <div class="carousel-item active">
        <div class="carousel-container">
          <h2 class="animate__animated animate__fadeInDown">Smile Makeovers Await!</h2>
          <p class="animate__animated animate__fadeInUp">Transform your smile with Thant Dental Clinic. Expert care, cutting-edge technology, and personalized treatments for a
          confident, healthier you. Schedule your appointment now.</p>
          <?php
          if(!empty($_SESSION["user"])){
            $patientEmail = $_SESSION['user'];
            // echo $patientEmail;
            $query = "SELECT * FROM patients WHERE Pemail='$patientEmail'";
            $go_query = mysqli_query($connection, $query);
            while ($out = mysqli_fetch_array($go_query)){
              $db_pid = $out['PatientID'];
              // $apbtn = '<a href="appointment.php?id=' . $db_pid . '" class="btn-get-started animate__animated animate__fadeInUp">Appointment Now</a>';
              $apbtn = '<a href="appointment.php" class="btn-get-started animate__animated animate__fadeInUp">Appointment Now</a>';
              echo $apbtn;
            }
          }else{
            $apbtn = '<a href="login.php" class="btn-get-started animate__animated animate__fadeInUp">Appointment Now</a>';
            echo $apbtn;
          } 
          ?>
        </div>
      </div>

      <!-- Slide 2 -->
      <div class="carousel-item">
        <div class="carousel-container">
          <h2 class="animate__animated animate__fadeInDown">Exceptional Dentistry, Exceptional Smiles</h2>
          <p class="animate__animated animate__fadeInUp">At Thant Dental Clinic, we redefine dental care. Comprehensive services, a friendly team, and a commitment to your
          comfort. Your radiant smile begins with us. Book your visit today!</p>
            <?php
            if (!empty($_SESSION["user"])) {
                $patientEmail = $_SESSION['user'];
                // echo $patientEmail;
                $query = "SELECT * FROM patients WHERE Pemail='$patientEmail'";
                $go_query = mysqli_query($connection, $query);
                while ($out = mysqli_fetch_array($go_query)) {
                    $db_pid = $out['PatientID'];
                    // $apbtn = '<a href="appointment.php?id=' . $db_pid . '" class="btn-get-started animate__animated animate__fadeInUp">Appointment Now</a>';
                    $apbtn = '<a href="appointment.php" class="btn-get-started animate__animated animate__fadeInUp">Appointment Now</a>';
                    echo $apbtn;
                }
            } else {
                $apbtn = '<a href="login.php" class="btn-get-started animate__animated animate__fadeInUp">Appointment Now</a>';
                echo $apbtn;
            }
            ?>
        </div>
      </div>

      <!-- Slide 3 -->
      <div class="carousel-item">
        <div class="carousel-container">
          <h2 class="animate__animated animate__fadeInDown">Your Smile, Our Priority</h2>
          <p class="animate__animated animate__fadeInUp">Welcome to Thant Dental Clinic, where your optimal oral health is our mission. Experience personalized care, advanced
          solutions, and a warm atmosphere. Schedule your appointment and embrace a brighter, healthier smile.</p>
            <?php
            if (!empty($_SESSION["user"])) {
                $patientEmail = $_SESSION['user'];
                // echo $patientEmail;
                $query = "SELECT * FROM patients WHERE Pemail='$patientEmail'";
                $go_query = mysqli_query($connection, $query);
                while ($out = mysqli_fetch_array($go_query)) {
                    $db_pid = $out['PatientID'];
                    // $apbtn = '<a href="appointment.php?id=' . $db_pid . '" class="btn-get-started animate__animated animate__fadeInUp">Appointment Now</a>';
                    $apbtn = '<a href="appointment.php" class="btn-get-started animate__animated animate__fadeInUp">Appointment Now</a>';
                    echo $apbtn;
                }
            } else {
                $apbtn = '<a href="login.php" class="btn-get-started animate__animated animate__fadeInUp">Appointment Now</a>';
                echo $apbtn;
            }
            ?>
        </div>
      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bx bx-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bx bx-chevron-right" aria-hidden="true"></span>
      </a>

    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Services Section ======= -->
    <section class="services">
      <div class="container">

        <div class="row">
            <?php
            $query = "SELECT * FROM reason ORDER BY reasonID DESC";
            $go_query = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_array($go_query)) {
                $reasonname = $row['reasonName'];
                $reasonDetail = $row['reasonDetail'];

                echo'
                <div class="col-md-6 col-lg-3 d-flex align-items-stretch">
                    <div class="icon-box icon-box-cyan">
                    <h4 class="title">'.$reasonname.'</h4>
                    <p class="description">'.$reasonDetail.'</p>
                    </div>
                </div>
                ';
            }
            ?>
        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Why Us Section ======= -->
    <section class="why-us section-bg" data-aos="fade-up" date-aos-delay="200">
      <div class="container">

        <div class="row">
          <div class="col-lg-6 video-box">
            <img src="assets/img/YoutubeCover.jpg" class="img-fluid" alt="">
            <a href="https://youtu.be/cRWCHwt4_xQ?si=OftzZRX0-q6bSRLh" class="venobox play-btn mb-4" data-vbtype="video" data-autoplay="true"></a>
          </div>

          <div class="col-lg-6 d-flex flex-column justify-content-center p-5">

            <div class="icon-box">
              <div class="icon"><i class="bx bx-fingerprint"></i></div>
              <h4 class="title"><a href="">Lorem Ipsum</a></h4>
              <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
            </div>

            <div class="icon-box">
              <div class="icon"><i class="bx bx-gift"></i></div>
              <h4 class="title"><a href="">Nemo Enim</a></h4>
              <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque</p>
            </div>

          </div>
        </div>

      </div>
    </section><!-- End Why Us Section -->

    <!-- ======= Features Section ======= -->
    <section class="features">
      <div class="container">

        <div class="section-title">
          <h2>Features</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="row" data-aos="fade-up">
          <div class="col-md-5">
            <img src="assets/img/features-1.svg" class="img-fluid" alt="">
          </div>
          <div class="col-md-7 pt-4">
            <h3>Voluptatem dignissimos provident quasi corporis voluptates sit assumenda.</h3>
            <p class="fst-italic">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
              magna aliqua.
            </p>
            <ul>
              <li><i class="bi bi-check"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
              <li><i class="bi bi-check"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
            </ul>
          </div>
        </div>

        <div class="row" data-aos="fade-up">
          <div class="col-md-5 order-1 order-md-2">
            <img src="assets/img/features-2.svg" class="img-fluid" alt="">
          </div>
          <div class="col-md-7 pt-5 order-2 order-md-1">
            <h3>Corporis temporibus maiores provident</h3>
            <p class="fst-italic">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
              magna aliqua.
            </p>
            <p>
              Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
              velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
              culpa qui officia deserunt mollit anim id est laborum
            </p>
          </div>
        </div>

        <div class="row" data-aos="fade-up">
          <div class="col-md-5">
            <img src="assets/img/features-3.svg" class="img-fluid" alt="">
          </div>
          <div class="col-md-7 pt-5">
            <h3>Sunt consequatur ad ut est nulla consectetur reiciendis animi voluptas</h3>
            <p>Cupiditate placeat cupiditate placeat est ipsam culpa. Delectus quia minima quod. Sunt saepe odit aut quia voluptatem hic voluptas dolor doloremque.</p>
            <ul>
              <li><i class="bi bi-check"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
              <li><i class="bi bi-check"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
              <li><i class="bi bi-check"></i> Facilis ut et voluptatem aperiam. Autem soluta ad fugiat.</li>
            </ul>
          </div>
        </div>

        <div class="row" data-aos="fade-up">
          <div class="col-md-5 order-1 order-md-2">
            <img src="assets/img/features-4.svg" class="img-fluid" alt="">
          </div>
          <div class="col-md-7 pt-5 order-2 order-md-1">
            <h3>Quas et necessitatibus eaque impedit ipsum animi consequatur incidunt in</h3>
            <p class="fst-italic">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
              magna aliqua.
            </p>
            <p>
              Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
              velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
              culpa qui officia deserunt mollit anim id est laborum
            </p>
          </div>
        </div>

      </div>
    </section><!-- End Features Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php 
  include("footer.php");
  ?>

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
  <script src="./js/main.js"></script>

</body>

</html>