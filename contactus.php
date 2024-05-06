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
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i&display=swap"
        rel="stylesheet">

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
    <main id="main">
        <!-- ======= Features Section ======= -->
        <section class="features">
            <div class="container">

                <div class="section-title">
                    <h2>Contact Us</h2>
                    <p>Welcome to Thant Dental Clinic's contact page! We are delighted that you're reaching out to us. At Thant Dental Clinic, we are committed to providing exceptional dental care in a warm and friendly environment. Your dental health and comfort are our top priorities.</p>
                </div>

                <div class="row" data-aos="fade-up">
                    <div class="col-md-5">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d61107.15763568194!2d96.11833489139595!3d16.816562831710346!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c1ed7f628bbbef%3A0xef59d8fcf183a407!2sThant%20Dental%20%26%20Medical%20Clinic!5e0!3m2!1sen!2smm!4v1714080314395!5m2!1sen!2smm" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        <!-- <img src="assets/img/features-1.svg" class="img-fluid" alt=""> -->
                    </div>
                    <div class="col-md-7 pt-4 addresscard">
                        <?php
                        $query = "SELECT * FROM clinicinfo WHERE clinicID=1";
                        $go_query = mysqli_query($connection, $query);
                        while ($out = mysqli_fetch_array($go_query)) { 
                            $clinicName = $out['clinicName'];
                            $clinicadd = $out['clinicAddress'];
                            $clinicPhone = $out['clinicPhone'];

                            echo '
                                <h3>'.$clinicName.'</h3>
                                <ul>
                                    <li>
                                        <i class="bi bi-check"></i>
                                        '.$clinicadd.'
                                    </li>
                                    <li>
                                        <i class="bi bi-check"></i>
                                        '.$clinicPhone.'
                                    </li>
                                </ul>
                            ';
                        }
                        ?>
                    </div>
                </div>

                <div class="row" data-aos="fade-up">
                    <div class="col-md-5 order-1 order-md-2">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3819.407025501316!2d96.17289217163074!3d16.806152083918768!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c1ed3369e78285%3A0x8f14e3023c0b0f50!2sThant%20Dental%20Clinic%20-%202!5e0!3m2!1sen!2smm!4v1714080394343!5m2!1sen!2smm" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        <!-- <img src="assets/img/features-2.svg" class="img-fluid" alt=""> -->
                    </div>
                    <div class="col-md-7 pt-4 addresscard">
                        <?php
                        $query = "SELECT * FROM clinicinfo WHERE clinicID=2";
                        $go_query = mysqli_query($connection, $query);
                        while ($out = mysqli_fetch_array($go_query)) {
                            $clinicName = $out['clinicName'];
                            $clinicadd = $out['clinicAddress'];
                            $clinicPhone = $out['clinicPhone'];

                            echo '
                                <h3>' . $clinicName . '</h3>
                                <ul>
                                    <li>
                                        <i class="bi bi-check"></i>
                                        ' . $clinicadd . '
                                    </li>
                                    <li>
                                        <i class="bi bi-check"></i>
                                        ' . $clinicPhone . '
                                    </li>
                                </ul>
                            ';
                        }
                        ?>
                        </div>
                </div>

                <div class="row" data-aos="fade-up">
                    <div class="col-md-5">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30555.75475318047!2d96.13469341591379!3d16.803056615903035!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c1ecc954979211%3A0x605f16add7b0c28d!2sThant%207%20Dental%20Clinic!5e0!3m2!1sen!2smm!4v1714080820924!5m2!1sen!2smm" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        <!-- <img src="assets/img/features-3.svg" class="img-fluid" alt=""> -->
                    </div>
                    <div class="col-md-7 pt-4 addresscard">
                        <?php
                        $query = "SELECT * FROM clinicinfo WHERE clinicID=3";
                        $go_query = mysqli_query($connection, $query);
                        while ($out = mysqli_fetch_array($go_query)) {
                            $clinicName = $out['clinicName'];
                            $clinicadd = $out['clinicAddress'];
                            $clinicPhone = $out['clinicPhone'];

                            echo '
                                <h3>' . $clinicName . '</h3>
                                <ul>
                                    <li>
                                        <i class="bi bi-check"></i>
                                        ' . $clinicadd . '
                                    </li>
                                    <li>
                                        <i class="bi bi-check"></i>
                                        ' . $clinicPhone . '
                                    </li>
                                </ul>
                            ';
                        }
                        ?>
                    </div>
                </div>

                <div class="row" data-aos="fade-up">
                    
                    <div class="col-md-12 pt-5">
                        <?php
                        if (!empty($_SESSION['user'])):
                            $usermail = $_SESSION['user'];
                            $query = "SELECT * FROM patients WHERE Pemail='$usermail'";
                                $go_query = mysqli_query($connection, $query);
                                while ($out = mysqli_fetch_array($go_query)) {
                                $db_pid= $out['PatientID'];
                            }



                            if (isset($_POST['addfeedback'])) {
                                global $connection;
                                $message = $_POST['message'];
                                if ($message != "") {
                                    date_default_timezone_set("Asia/Yangon");
                                    $nowdate = date("Y-m-d");
                                    $query = "INSERT INTO message (pID,message,messageDate) VALUES ('$db_pid','$message','$nowdate')";
                                    $ch_query = mysqli_query($connection, $query);
                                    if (!$ch_query) {
                                        die("QUERY FAILED" . mysqli_error($connection));
                                    } else {
                                        echo "<script>window.alert('successfully give feedback')</script>";
                                        echo "<script>window.location.href='contactus.php'</script>";
                                    }
                                }
                            }
                            ?>
                            
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="col-md-12">
                                    <div class="form-floating feedbackform">
                                        <textarea class="form-control" name="message" placeholder="Clinic Address" id="floatingTextarea" style="height: 150px;"></textarea>
                                        <label for="floatingTextarea">Please Write feedback</label>
                                    </div>
                                </div>
                                <div class="text-center mt-5 feedbtn">
                                    <button type="submit" name="addfeedback" class="btn col-md-12">Add Feedback</button>
                                </div>
                            </form>
                            <?php
                        endif;
                        ?>
                        
                    </div>
                </div>

            </div>
        </section><!-- End Features Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php 
    
    ?>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

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