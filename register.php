<?php
    include('./admin/connection.php');

    if (isset($_POST['save_profile'])) {
        $pname = $_POST['pname'];
        $pemail = $_POST['pemail'];
        $pphone = $_POST['pphone'];
        $dob = $_POST['dob'];
        $ppassword = $_POST['password'];
        $paddress = $_POST['paddress'];
        $profile = $_FILES['profileImage']['name'];

        $errors = array(
            'pname'=>'',
            'pemail'=>'',
            'pphone'=>'',
            'dob'=>'',
            'password'=> '',
            'profileImage'=>''
        );
        if($pname==''){
            echo "<script>window.alert('Patient Name could not be Empty')</script>";
            echo "<dcript>window.locatin.href='register.php'</script>";
        }else{
            if(strlen($pname)<3){
                echo "<script>window.alert('Patient Name need to be longer!')</script>";
                echo "<script>window.location.href='register.php'</script>";
            }
        }
        if(strlen($ppassword)<8){
            echo "<script>window.alert('Password need to be longer!')</script>";
            echo "<script>window.location.href='register.php'</script>";
        }else if(!preg_match('/^(?=.*[\W])(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,50}$/', $ppassword)) {
            echo "<script>window.alert('Use at least 8 characters and a mix of letters (uppercase and lowercase), numbers, and symbols.')</script>";
            echo "<script>window.location.href='register.php'</script>";
        }
        if($pemail==''){
            echo "<script>window.alert('Email could not be empty!')</script>";
            echo "<script>window.location.href='register.php'</script>";
        }
        if($pphone==''){
            echo "<script>window.alert('Phone Number could not be empty!')</script>";
            echo "<script>window.location.href='register.php'</script>";
        }
        if($paddress==''){
            echo "<script>window.alert('Address could not be empty!')</script>";
            echo "<script>window.location.href='register.php'</script>";
        }
        if($profile==''){
            echo "<script>window.alert('Profile image could not be empty')</script>";
            echo "<script>window.location.href='register.php'</script>";
        }
        foreach ($errors as $key => $value) {
            if (empty($value)) {
                unset($errors[$key]);
            }
        }
        if($pname != "" && $pemail != "" && $pphone != "" && $dob != "" && $ppassword != "" && $paddress != "" && $profile != ""){
            global $connection;
            global $pname;
            global $pemail;
            global $pphone;
            global $dob;
            global $ppassword;
            global $paddress;
            global $profile;


            date_default_timezone_set('Asia/Yangon');
            $rdate = date('Y-m-d h:i:s A', time());

            $query = "SELECT * FROM patients WHERE Pemail='$pemail' AND Ppassword='$ppassword'";
            $patientquery = mysqli_query($connection, $query);
            // $count = mysqli_num_rows($patientquery);
            // if ($count > 0) {
            //     echo "<script>window.alert('Already exits')</script>";
            // }

            $query1 = "SELECT * FROM patients";
            $go_query = mysqli_query($connection,$query1);
            while($row = mysqli_fetch_array($go_query)){
                $dbname = $row['Pname'];
                $dbemail = $row['Pemail'];
                $dbphone = $row['Pphone'];
            }
            if($pname == $dbname){
                echo "<script>window.alert('This Patient Name is already exists!!!')</script>";
                echo "<script>window.location.href='register.php'</script>";
            }elseif ($pemail == $dbemail) {
                echo "<script>window.alert('This email is already exists!!!')</script>";
                echo "<script>window.location.href='index.php'</script>";
            }elseif ($pphone == $dbphone) {
                echo "<script>window.alert('This phone is already exists!!!')</script>";
                echo "<script>window.location.href='index.php'</script>";
            }else{
                $myquery = "INSERT INTO patients(Pname,Pemail,Pphone,Pdob,Ppassword,Paddress,Pprofile_img,regDate)";
                $myquery .= "VALUES('$pname','$pemail','$pphone','$dob','$ppassword','$paddress','$profile','$rdate')";
                $go_query = mysqli_query($connection, $myquery);
                if(!$go_query){
                    die("QUERY FAILED" . mysqli_error($connection));
                }
                else{
                    move_uploaded_file($_FILES['profileImage']['tmp_name'],'photo/'.$profile);
                }
                echo "<script>window.alert('You successfully created an account')</script>";
                echo "<script>window.location.href='login.php'</script>";
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
    if(empty($_SESSION['user'])):
        include('noaccheader.php');
    ?>
    <?php else : ?>
        <?php
        include('header.php');
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
                            <img src="./assets/placeholder.png" onClick="triggerClick()" id="profileDisplay">
                        </span>
                        <input type="file" required name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;">
                    </div>
            </div>
            <div class="col-md-5">
                <div class="col">
                        <!-- User name -->
                        <input type="text" required name="pname" class="mb-4" placeholder="Patient name">
                    </div>

                    <div class="col">
                        <!-- E-mail -->
                        <input type="email" required name="pemail" class="mb-4" placeholder="Patient E-mail">
                    </div>

                    <div class="col">
                        <!-- Phone number -->
                        <input type="text" required name="pphone" class="mb-4" placeholder="Patient Phone number">
                    </div>

                    <div class="col">
                        <!-- date of Birth -->
                        <input type="date" required name="dob" class="mb-4" placeholder="Patient Date Of Birth">
                    </div>

                    <div class="col">
                        <!-- Password -->
                        <input type="password" required name="password" class="mb-4" placeholder="Patient Password">
                    </div>

                    <div class="col">
                        <!-- Address -->
                        <div class="form-group">
                            <textarea type="text" required class="rounded-0" name="paddress" rows="3" placeholder="Patient Address"></textarea>
                        </div>
                    </div>
                <div class="col">
                <div class="form-group saveprtient">
                    <button type="submit" name="save_profile" class="btn-block">Save Patient</button>
                </div>
                </div>
            </div>
        </form>
            
        </div>
    </section>




    <!-- <section class="container">
        <div class="sign-in">
            <div class="form">
                <h1 class="title">
                    Register
                </h1>
                <div class="input-box">
                    <form action="">
                        <input type="text" placeholder="First Name" class="username">
                        <input type="text" placeholder="Sur Name" class="username">
                        <input type="text" placeholder="Email" class="username">
                        <input type="text" placeholder="Phone" class="username">
                        <input type="date" placeholder="Date Of Birth" class="username">
                        <div class="password-box">
                            <input type="password" placeholder="Password" class="password">
                            <i class='bx bx-low-vision vision'></i>
                        </div>
                        <button class="btn">
                            Register
                        </button>
                    </form>
                </div>
            </div> -->
            <!-- <div class="form">
                <div class="input-box">
                    <input type="text" placeholder="Username" class="username">
                    <input type="text" placeholder="Email" class="username">
                    <input type="text" placeholder="Phone" class="username">
                    <div class="password-box">
                        <input type="password" placeholder="Password" class="password">
                        <i class='bx bx-low-vision vision'></i>
                    </div>
                </div>
                <button class="btn">
                    Sign in
                </button>
            </div> -->
            
        <!-- </div>
    </section> -->


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