<?php
session_start();
include ('./connection.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">




    <!-- Vendor CSS Files -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../vendor/simple-datatables/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.9.2/themes/smoothness/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.8.3.min.js"></script>
    <script src="https://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>

   
    <!-- Template Main CSS File -->
    <link href="../css/adminstyle.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css">




    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jan 29 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <?php include ('./header.php'); ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">
                        <?php if (!empty($_SESSION['manager'])): ?>
                            Manager
                        <?php elseif (!empty($_SESSION['dentists'])): ?>
                            Dentist
                        <?php elseif (!empty($_SESSION['receptionists'])): ?>
                            Receptionist
                        <?php else: ?>
                            NiceAdmin
                        <?php endif; ?>
                    </li>
                    <li class="breadcrumb-item active">Account Setting</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-12">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">Overview</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                        Profile</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#profile-change-password">Change Password</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h5 class="card-title">Profile Details</h5>
                                    <?php
                                    if (!empty($_SESSION['manager'])) {
                                        $manager = $_SESSION['manager']; // mail
                                        $query = "SELECT * FROM managers WHERE mGmail='$manager'";
                                        $go_query = mysqli_query($connection, $query);
                                        while ($out = mysqli_fetch_array($go_query)) {
                                            $db_managerid= $out['mID'];
                                            $db_name = $out['mName'];
                                            $role = 'manager';
                                            $db_mpassword = $out['mPassword'];
                                            $db_gmail = $out['mGmail'];

                                            echo'
                                                <div class="row">
                                                <div class="col-lg-3 col-md-4 label ">Name</div>
                                                <div class="col-lg-9 col-md-8">'.$db_name.'</div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4 label">Gmail</div>
                                                    <div class="col-lg-9 col-md-8">'.$db_gmail.'</div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4 label">Role</div>
                                                    <div class="col-lg-9 col-md-8">'.$role.'</div>
                                                </div>
                                            ';
                                        }
                                    }elseif(!empty($_SESSION['receptionists'])){
                                        $receptionists = $_SESSION['receptionists']; // mail
                                        $query = "SELECT * FROM receptionists,clinicinfo WHERE recGmail='$receptionists' AND receptionists.clinicID=clinicinfo.clinicID";
                                        $go_query = mysqli_query($connection, $query);
                                        while ($out = mysqli_fetch_array($go_query)) {
                                            $db_recrid = $out['recID'];
                                            $db_recname = $out['recName'];
                                            $role = 'receptionists';
                                            $db_recpassword = $out['recpassword'];
                                            $db_recgmail = $out['recGmail'];
                                            $db_recphone = $out['contactNumber'];
                                            $db_clinic = $out['clinicID'];
                                            $db_clinicName = $out['clinicName'];

                                            echo '
                                                <div class="row">
                                                <div class="col-lg-3 col-md-4 label ">Name</div>
                                                <div class="col-lg-9 col-md-8">' . $db_recname . '</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4 label">Contact Number</div>
                                                    <div class="col-lg-9 col-md-8">' . $db_recphone . '</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4 label">Gmail</div>
                                                    <div class="col-lg-9 col-md-8">' . $db_recgmail . '</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4 label">Clinic Name</div>
                                                    <div class="col-lg-9 col-md-8">' . $db_clinicName . '</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4 label">Role</div>
                                                    <div class="col-lg-9 col-md-8">' . $role . '</div>
                                                </div>
                                            ';
                                        }
                                    } elseif (!empty($_SESSION['dentists'])) {
                                        $dentist = $_SESSION['dentists']; // mail
                                        $query = "SELECT * FROM dentists WHERE dentistGmail='$dentist'";
                                        $go_query = mysqli_query($connection, $query);
                                        while ($out = mysqli_fetch_array($go_query)) {
                                            $db_dentistid = $out['dentistID'];
                                            $db_denname = $out['dentistName'];
                                            $role = 'dentists';
                                            $db_dpassword = $out['dpassword'];
                                            $db_dengmail = $out['dentistGmail'];
                                            $db_dphone = $out['contactNumber'];
                                            $db_special = $out['specialization'];

                                            echo '
                                                <div class="row">
                                                <div class="col-lg-3 col-md-4 label ">Name</div>
                                                <div class="col-lg-9 col-md-8">' . $db_denname . '</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4 label">Contact Number</div>
                                                    <div class="col-lg-9 col-md-8">' . $db_dphone . '</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4 label">Gmail</div>
                                                    <div class="col-lg-9 col-md-8">' . $db_dengmail . '</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4 label">Specialization</div>
                                                    <div class="col-lg-9 col-md-8">' . $db_special . '</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4 label">Role</div>
                                                    <div class="col-lg-9 col-md-8">' . $role . '</div>
                                                </div>
                                            ';
                                        }
                                    }
                                    ?>
                                    
                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                    <?php if (!empty($_SESSION['manager'])): ?>
                                    <?php
                                    if (isset($_POST['editprofile'])) {
                                        global $connection;
                                        $new_name = $_POST['newName'];
                                        $query = "UPDATE managers SET mName='$new_name' WHERE mID='$db_managerid'";
                                        $go_query = mysqli_query($connection, $query);
                                        echo "<script>window.location.href='accsetting.php'</script>";
                                    } 
                                    ?>
                                    <!-- Profile Edit Form -->
                                    <form method="post" enctype="multipart/form-data">    
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full
                                                Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="newName" type="text" class="form-control" id="fullName"
                                                    value="<?php echo $db_name ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="newemail" disabled type="email" class="form-control" id="Email"
                                                    value="<?php echo $db_gmail ?>">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" name="editprofile" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                    <?php elseif (!empty($_SESSION['receptionists'])): ?>
                                    <?php
                                    if (isset($_POST['receditprofile'])) {
                                        global $connection;
                                        $recName = $_POST['recName'];
                                        $recPhone = $_POST['recPhone'];
                                        $editclinic = $_POST['editclinic'];
                                        $query = "UPDATE receptionists SET recName='$recName',contactNumber='$recPhone',clinicID='$editclinic' WHERE recID='$db_recrid'";
                                        $go_query = mysqli_query($connection, $query);
                                        if (!$go_query) {
                                            die("QUEYR FAILED" . mysqli_error($connection));
                                        } else {
                                            echo "<script>window.location.href='accsetting.php'</script>";
                                        }
                                    } 
                                    ?>
                                    <!-- Profile Edit Form -->
                                    <form method="post" enctype="multipart/form-data">    
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full
                                                Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="recName" type="text" class="form-control" id="fullName"
                                                    value="<?php echo $db_recname ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Contact Number</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="recPhone" type="text" class="form-control" id="fullName"
                                                    value="<?php echo $db_recphone ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Clinic Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <select name="editclinic" class="form-select" id="validationDefault04" required>
                                                <!-- <option selected disabled value="">Choose Clinic</option> -->
                                                <?php
                                                        $go_query = mysqli_query($connection, "SELECT * FROM clinicinfo WHERE clinicID='$db_clinic'");
                                                        while ($row = mysqli_fetch_array($go_query)) {
                                                            $clinicID = $row['clinicID'];
                                                            $clinicName = $row['clinicName'];
                                                            echo "<option selected value={$clinicID}>{$clinicName}</option>";
                                                        }
                                                        $go_query = mysqli_query($connection, "SELECT * FROM clinicinfo EXCEPT SELECT * FROM clinicinfo WHERE clinicID='$db_clinic'");
                                                        while ($row = mysqli_fetch_array($go_query)) {
                                                            $clinicID = $row['clinicID'];
                                                            $clinicName = $row['clinicName'];
                                                            echo "<option value={$clinicID}>{$clinicName}</option>";
                                                        }
                                                        ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="newemail" disabled type="email" class="form-control" id="Email"
                                                    value="<?php echo $db_recgmail ?>">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" name="receditprofile" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                    <?php elseif (!empty($_SESSION['dentists'])): ?>
                                        <?php
                                        if (isset($_POST['deneditprofile'])) {
                                            global $connection;
                                            $denName = $_POST['denName'];
                                            $denPhone = $_POST['denPhone'];
                                            $special = $_POST['special'];
                                            $query = "UPDATE dentists SET dentistName='$denName',contactNumber='$denPhone',specialization='$special' WHERE dentistID='$db_dentistid'";
                                            $go_query = mysqli_query($connection, $query);
                                            if (!$go_query) {
                                                die("QUEYR FAILED" . mysqli_error($connection));
                                            } else {
                                                echo "<script>window.location.href='accsetting.php'</script>";
                                            }
                                        }
                                        ?>
                                        <!-- Profile Edit Form -->
                                        <form method="post" enctype="multipart/form-data">    
                                            <div class="row mb-3">
                                                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full
                                                    Name</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="denName" type="text" class="form-control" id="fullName"
                                                        value="<?php echo $db_denname ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Contact Number</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="denPhone" type="text" class="form-control" id="fullName"
                                                        value="<?php echo $db_dphone ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="Special" class="col-md-4 col-lg-3 col-form-label">Specialization</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="special" type="text" class="form-control" id="Special"
                                                        value="<?php echo $db_special ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="newemail" disabled type="email" class="form-control" id="Email"
                                                        value="<?php echo $db_dengmail ?>">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" name="deneditprofile" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                    <?php endif; ?>
                                </div>

                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <!-- Change Password Form -->
                                    <?php 
                                    if (!empty($_SESSION['manager'])){
                                        if(isset($_POST['changepass'])){
                                            global $connection;
                                            $mloginGmail = $_SESSION['manager'];
                                            $curpass = $_POST['curpassword'];
                                            $newpass = $_POST['newpassword'];
                                            $confirmpass = $_POST['renewpassword'];
                                            if($db_mpassword == $curpass AND $newpass==$confirmpass){
                                                $query = "UPDATE managers SET mPassword='$newpass' WHERE mGmail='$mloginGmail'";
                                                $go_query = mysqli_query($connection, $query);
                                                echo "<script>window.location.href='accsetting.php'</script>";    
                                            }else{
                                                echo "<script>alert('Please check your password')</script>";
                                            }
                                            
                                        }
                                    }elseif(!empty($_SESSION['receptionists'])){
                                        if (isset($_POST['changepass'])) {
                                            global $connection;
                                            $recloginGmail = $_SESSION['receptionists'];
                                            $curpass = $_POST['curpassword'];
                                            $newpass = $_POST['newpassword'];
                                            $confirmpass = $_POST['renewpassword'];
                                            if ($db_recpassword == $curpass and $newpass==$confirmpass) {
                                                $query = "UPDATE receptionists SET recpassword='$newpass' WHERE recGmail='$recloginGmail'";
                                                $go_query = mysqli_query($connection, $query);
                                                echo "<script>window.location.href='accsetting.php'</script>";
                                            } else {
                                                echo "<script>alert('Please check your password')</script>";
                                            }

                                        }
                                    } elseif (!empty($_SESSION['dentists'])) {
                                        if (isset($_POST['changepass'])) {
                                            global $connection;
                                            $denloginGmail = $_SESSION['dentists'];
                                            $curpass = $_POST['curpassword'];
                                            $newpass = $_POST['newpassword'];
                                            $confirmpass = $_POST['renewpassword'];
                                            if ($db_dpassword == $curpass and $newpass == $confirmpass) {
                                                $query = "UPDATE dentists SET dpassword='$newpass' WHERE dentistGmail='$denloginGmail'";
                                                $go_query = mysqli_query($connection, $query);
                                                echo "<script>window.location.href='accsetting.php'</script>";
                                            } else {
                                                echo "<script>alert('Please check your password')</script>";
                                            }

                                        }
                                    }
                                    ?>
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="row mb-3">
                                            <label for="currentPassword"
                                                class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="curpassword" required type="password" class="form-control"
                                                    id="currentPassword">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New
                                                Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="newpassword" required type="password" class="form-control"
                                                    id="newPassword">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter
                                                New Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="renewpassword" required type="password" class="form-control"
                                                    id="renewPassword">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" name="changepass" class="btn btn-primary">Change Password</button>
                                        </div>
                                    </form><!-- End Change Password Form -->
                                    
                                </div>

                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php include ('footer.php') ?>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/chart.js/chart.umd.js"></script>
    <script src="../vendor/echarts/echarts.min.js"></script>
    <script src="../vendor/quill/quill.min.js"></script>
    <script src="../vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../vendor/tinymce/tinymce.min.js"></script>
    <script src="../vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../js/adminmain.js"></script>

</body>

</html>