<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container d-flex justify-content-between align-items-center">

        <div class="logo">
            <!-- <h1 class="text-light"><a href="index.html"><span>Thant</span></a></h1> -->
            <!-- Uncomment below if you prefer to use an image logo -->
            <a href="index.php"><img src="./assets/logo.png" alt="" class="img-fluid"></a>
        </div>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="active " href="index.php">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="services.html">Medical Service</a></li>
                <li><a href="portfolio.html">Doctor Lists</a></li>
                <li><a href="contactus.php">Contact Us</a></li>
                <li class="dropdown"><a href="#"><span>
                    <?php
                    if(!empty($_SESSION["user"])){
                        $profile = $_SESSION["user"]; // email
                        $query = "SELECT * FROM patients WHERE Pemail='$profile'";
                        $go_query = mysqli_query($connection, $query);
                        while($out = mysqli_fetch_array($go_query)){
                            $db_name = $out['Pname'];
                            $db_pid = $out['PatientID'];
                            $db_profile = $out['Pprofile_img'];

                            echo "<img src='photo/{$db_profile}' alt='profile_img' style='border-radius:50%' width=30px height=30px>";
                        }
                    } 
                    ?>
                    <!-- Profile -->
                </span> 
                <!-- <i class="bi bi-chevron-down"></i> -->
                </a>
                    <ul>
                        <li><a href="setting.php">Setting</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->