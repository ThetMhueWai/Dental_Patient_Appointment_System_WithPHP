<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

  
        <a href="index.html" class="logo d-flex align-items-center">
            <img src="assets/img/logo.png" alt="">
            <span class="d-none d-lg-block">
                <?php if (!empty($_SESSION['manager'])): ?>
                    Manager
                <?php elseif (!empty($_SESSION['dentists'])): ?>
                    Dentists
                <?php elseif (!empty($_SESSION['receptionists'])): ?>
                    Receptionists
                <?php else: ?>
                    NiceAdmin
                <?php endif; ?>
          </span>
      </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
  </div><!-- End Logo -->

  <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
            <?php if (!empty($_SESSION['receptionists'])): ?>
            <li class="nav-item dropdown">
                <a class="nav-link nav-icon" href="message.php">
                    <i class="bi bi-chat-left-text"></i>
                </a>
                <!-- End Messages Dropdown Items -->  
            </li>
            <!-- End Messages Nav -->
            <?php endif; ?>
            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"  data-bs-toggle="dropdown">
                    <!-- <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"> -->
                    <span class="d-none d-md-block dropdown-toggle ps-2">
                    <?php
                    if (!empty($_SESSION['manager'])){
                        $manager = $_SESSION['manager']; // mail
                        $query = "SELECT * FROM managers WHERE mGmail='$manager'";
                        $go_query = mysqli_query($connection,$query);
                        while($out = mysqli_fetch_array($go_query)){
                            $db_name = $out['mName'];
                            $role = 'manager';
                            echo $db_name;
                        }
                    }elseif(!empty($_SESSION['receptionists'])){
                        $rece = $_SESSION['receptionists']; // mail
                        $query = "SELECT * FROM receptionists WHERE recGmail='$rece'";
                        $go_query = mysqli_query($connection, $query);
                        while ($out = mysqli_fetch_array($go_query)) {
                            $db_name = $out['recName'];
                            $role = 'receptionists';
                            echo $db_name;
                        }
                    }elseif(!empty($_SESSION['dentists'])){
                        $dentist = $_SESSION['dentists']; // mail
                        $query = "SELECT * FROM dentists WHERE dentistGmail='$dentist'";
                        $go_query = mysqli_query($connection, $query);
                        while ($out = mysqli_fetch_array($go_query)) {
                            $db_name = $out['dentistName'];
                            $role = 'dentists';
                            echo $db_name;
                        }
                    }
                    ?>
                    </span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6><?php echo $db_name ?></h6>
                        <span><?php echo $role ?></span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="accsetting.php">
                            <i class="bi bi-gear"></i>
                            <span>Account Settings</span>
                        </a>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header>
<!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <?php if (!empty($_SESSION['manager'])): ?>
            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link " href="mdashboard.php">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Create Account</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <!-- Dentists Create Account -->
                    <li>
                        <a href="denRegister.php">
                            <i class="bi bi-circle"></i><span>Dentists</span>
                        </a>
                    </li>
                    <!-- Receptionists Create Account -->
                    <li>
                        <a href="recRegister.php">
                            <i class="bi bi-circle"></i><span>Receptionists</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- End Create Account Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>Schedule</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <!-- Add New Reason -->
                    <li>
                        <a href="reason.php">
                            <i class="bi bi-circle"></i><span>Add New Reason</span>
                        </a>
                    </li>
                    <!-- Dentists Reason -->
                    <li>
                        <a href="denreason.php">
                            <i class="bi bi-circle"></i><span>Dentist Reason</span>
                        </a>
                    </li>
                    <!-- New Schedule -->
                    <li>
                        <a href="addNewSchedule.php">
                            <i class="bi bi-circle"></i><span>New Schedule</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-heading">Pages</li>
            <!-- Clinic Info -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="clinicinfo.php">
                    <i class="bi bi-info-circle"></i>
                    <span>Clinic Info</span>
                </a>
            </li>
            <!-- Logout -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="logout.php">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Logout</span>
                </a>
            </li>
        <?php elseif (!empty($_SESSION['receptionists'])): ?>
            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link " href="recdashboard.php">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <!-- View Schedules -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="recViewSchedule.php">
                    <i class="bi bi-journal-text"></i>
                    <span>View Schedules</span>
                </a>
            </li>
            <!-- View Appointments -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="recViewAppointment.php">
                    <i class="bi bi-calendar2-check"></i>
                    <span>View Appointments</span>
                </a>
            </li>
            <!-- Logout -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="logout.php">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Logout</span>
                </a>
            </li>
        <?php elseif (!empty($_SESSION['dentists'])): ?>
            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link " href="dendashboard.php">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <!-- View Schedules -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="denViewSchedule.php">
                    <i class="bi bi-journal-text"></i>
                    <span>View Schedules</span>
                </a>
            </li>
            <!-- View Appointments -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="denViewAppointment.php">
                    <i class="bi bi-calendar2-check"></i>
                    <span>View Appointments</span>
                </a>
            </li>
            <!--  -->
            <!-- Logout -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="logout.php">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Logout</span>
                </a>
            </li><!-- End Login Page Nav -->
        <?php endif; ?>
    </ul>

</aside><!-- End Sidebar-->