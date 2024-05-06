<?php
session_start();
include ('./admin/connection.php');
$umail = $_SESSION['user'];
$query="SELECT * FROM patients where Pemail='$umail'";  
    $go_query=mysqli_query($connection,$query);  
    while($out=mysqli_fetch_array($go_query))
    { 
        $db_pname = $out['Pname'];
        $db_profile = $out['Pprofile_img'];
        $db_email = $out['Pemail'];
        $db_phone = $out['Pphone'];
        $db_dob = $out['Pdob'];
        $db_password = $out['Ppassword'];
        $db_address = $out['Paddress'];
    }
if (isset($_POST['edprofile'])) {
    global $connection;
    $newname = $_POST['pname'];
    $newphone = $_POST['pphone'];
    $newdob = $_POST['dob'];
    $newpass = $_POST['password'];
    $newaddress = $_POST['paddress'];
    $photo = $_FILES['profileImage']['name'];

    if($photo == ''){
        $query = "UPDATE patients SET Pname='$newname',Pphone='$newphone',Pdob='$newdob',Ppassword='$newpass',Paddress='$newaddress' WHERE Pemail='$umail'";
        $go_query = mysqli_query($connection, $query);
        
        if (!$go_query) {
            die("QUERY FAILED" . mysqli_error($connection));
        } else {
            echo '<script>alert("Successfully Update Information!")</script>';
            echo "<script>window.location.href='index.php'</script>";
        }
    }else{
        $query = "UPDATE patients SET Pname='$newname',Pphone='$newphone',Pdob='$newdob',Ppassword='$newpass',Paddress='$newaddress',Pprofile_img='$photo' WHERE Pemail='$umail'";
        $go_query = mysqli_query($connection, $query);
        echo "<script>alert('Successfully Update Information!')</script>";
        if (!$go_query) {
            die("QUERY FAILED" . mysqli_error($connection));
        } else {
            move_uploaded_file($_FILES['profileImage']['tmp_name'], 'photo/' . $photo);
            echo '<script>alert("Successfully Update Information!")</script>';
            echo "<script>window.location.href='index.php'</script>";
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
    <link href="./css/login.css" rel="stylesheet">
    <link href="./css/register.css" rel="stylesheet">
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
    <section class="container regcontainer">
        <div class="row align-items-center">
            <div class="col-md-5">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group text-center" style="position: relative;" >
                        <span class="img-div">
                            <div class="text-center img-placeholder"  onClick="triggerClick()">
                                <h4>Upload image</h4>
                            </div>
                            <?php //echo '<img src="photo/'.$db_profile.'" onClick="triggerClick()" id="profileDisplay">' ?>
                            <img src="photo/<?php echo $db_profile ?>" onClick="triggerClick()" id="profileDisplay">
                        </span>
                        <input type="file" value="<?php echo $db_profile ?>" name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;">
                    </div>
            </div>
            <div class="col-md-5">
                <div class="col">
                        <!-- User name -->
                        <input type="text" value="<?php echo $db_pname  ?>" required name="pname" class="mb-4" placeholder="Patient name">
                    </div>

                    <div class="col">
                        <!-- E-mail -->
                        <input type="email" readonly value="<?php echo $db_email ?>" name="pemail" class="mb-4" placeholder="Patient E-mail">
                    </div>

                    <div class="col">
                        <!-- Phone number -->
                        <input type="text" value="<?php echo $db_phone ?>" required name="pphone" class="mb-4" placeholder="Patient Phone number">
                    </div>

                    <div class="col">
                        <!-- date of Birth -->
                        <input type="date" value="<?php echo $db_dob ?>" required name="dob" class="mb-4" placeholder="Patient Date Of Birth">
                    </div>

                    <div class="col">
                        <!-- Password -->
                        <input type="password" value="<?php echo $db_password ?>" required name="password" class="mb-4" placeholder="Patient Password">
                    </div>

                    <div class="col">
                        <!-- Address -->
                        <div class="form-group">
                            <textarea type="text" required class="rounded-0" name="paddress" rows="3" placeholder="Patient Address"><?php echo $db_address ?></textarea>
                        </div>
                    </div>
                <div class="col">
                <div class="form-group saveprtient">
                    <button type="submit" name="edprofile" class="btn-block">Edit Patient</button>
                </div>
                </div>
            </div>
        </form>
            
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
                        <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita
                            valies darta donna mare fermentum iaculis eu non diam phasellus.</p>
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
    <script src="./js/register.js"></script>
</body>

</html>