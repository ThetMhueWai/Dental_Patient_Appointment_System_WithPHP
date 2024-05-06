<?php
session_start();
include ('./connection.php');
$perpage = 5;

$recloginGmail = $_SESSION['receptionists'];
$query = "SELECT * FROM receptionists,clinicinfo WHERE recGmail='$recloginGmail' AND receptionists.clinicID=clinicinfo.clinicID";
$go_query = mysqli_query($connection, $query);
while ($out = mysqli_fetch_array($go_query)) {
    $clinicID = $out['clinicID'];
    $clinicName = $out['clinicName'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - NiceAdmin Bootstrap Template</title>
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


    <!-- Template Main CSS File -->
    <link href="../css/adminstyle.css" rel="stylesheet">


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
            <h1>Patients Message</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="recdashboard.php">Home</a></li>
                    <li class="breadcrumb-item">Receptionist</li>
                    <li class="breadcrumb-item active">Message</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">
                        <?php
                            if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                            $show_product = ($page * $perpage) - $perpage;
                        } else {
                            $page = 1;
                        }
                        $num_per_page = 5;
                        $start_form = ($page - 1) * 5;

                        $query = "SELECT * FROM patients,message WHERE patients.PatientID=message.pID ORDER BY mID DESC LIMIT $start_form,$num_per_page";
                        $go_query = mysqli_query($connection, $query);
                        while ($row = mysqli_fetch_array($go_query)) {
                            $mid = $row['mID'];
                            $pID = $row['pID'];
                            $mes = $row['message'];
                            $mdate = $row['messageDate'];
                            $pname = $row['Pname'];

                            echo '
                                <div class="col-xxl-4 col-md-12">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">'.$pname.'<span> | '.$mdate.'</span></h5>

                                    <div class="d-flex align-items-center">
                                        <p>
                                            '.$mes.'
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                            ';
                        }
                        ?>
                    </div>
                </div>
                <div class="button-box">
                    <?php
                    $pr_query = "SELECT * FROM message";
                    $pr_result = mysqli_query($connection, $pr_query);
                    $total_record = mysqli_num_rows($pr_result);
                    // echo $total_record;
                    
                    $total_page = ceil($total_record / $num_per_page);
                    // echo $total_page;
                    
                    if ($page > 1) {
                        echo "<a href='message.php?page=" . ($page - 1) . "'>
                        <button class='pagebtn'>
                            << Previous
                        </button>
                        </a>";
                    }

                    for ($i = 1; $i < $total_page; $i++) {
                        "<a href='message.php?page=" . $i . "'>$i</a>";
                    }

                    if ($i > $page) {
                        echo "<a href='message.php?page=" . ($page + 1) . "'>
                        <button class='pagebtn'>
                            Next >>
                        </button>
                        </a>";
                    }
                    ?>
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