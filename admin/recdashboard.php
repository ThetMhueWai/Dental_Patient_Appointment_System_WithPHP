<?php
session_start();
include ('./connection.php');

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
            <h1>Dashboard for Receptionists <?php echo $clinicName ?></h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="recdashboard.php">Home</a></li>
                    <li class="breadcrumb-item">Receptionist</li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Appointment Card -->
                        <div class="col-xxl-4 col-md-4">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Appointment <span>| Today</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-calendar2-check"></i>
                                        </div>
                                        <div class="ps-3">
                                            <?php
                                            date_default_timezone_set("Asia/Yangon");
                                            $nowdate = date("Y-m-d");
                                            $appcount = "SELECT count(appointmentID) AS totalappo,scheduleID,schID,clinicID FROM appointment,schedules WHERE appoDate='$nowdate' AND appointment.schID=schedules.scheduleID AND schedules.clinicID='$clinicID'";
                                            $appcountResult = mysqli_query($connection, $appcount);
                                            $cvalues = mysqli_fetch_assoc($appcountResult);
                                            $num_rows = $cvalues['totalappo'];
                                            ?>
                                            <h6><?php echo $num_rows ?></h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Revenue Card -->
                        <div class="col-xxl-4 col-md-4">
                            <div class="card info-card revenue-card">
                                <a href="filterschedule.php">
                                    <div class="card-body">
                                        <h5 class="card-title">Schedule <span>for <?php echo $clinicName ?></span></h5>

                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-journal-text"></i>
                                            </div>
                                            <div class="ps-3">
                                                <?php
                                                $schedulecount = "SELECT count(scheduleID) AS totalschedule,totalPatient,date,clinicID FROM schedules WHERE totalPatient>0 AND date>=CURDATE() AND clinicID='$clinicID'";
                                                $schedulecountResult = mysqli_query($connection, $schedulecount);
                                                $cvalues = mysqli_fetch_assoc($schedulecountResult);
                                                $countschedule = $cvalues['totalschedule'];
                                                ?>
                                                <h6><?php echo $countschedule ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- End Revenue Card -->

                        <!-- Customers Card -->
                        <div class="col-xxl-4 col-md-4">

                            <div class="card info-card customers-card">

                                <div class="card-body">
                                    <h5 class="card-title">Arrived Patients <span>| Today</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-person-check"></i>
                                        </div>
                                        <div class="ps-3">
                                            <?php
                                            date_default_timezone_set("Asia/Yangon");
                                            $nowdate = date("Y-m-d");
                                            $apparrivecount = "SELECT count(appointmentID) AS totalarrived,scheduleID,schID,clinicID,arrived FROM appointment,schedules WHERE appoDate='$nowdate' AND arDate='$nowdate' AND appointment.schID=schedules.scheduleID AND schedules.clinicID='$clinicID' AND appointment.arrived='Yes'";
                                            $apparrivecountResult = mysqli_query($connection, $apparrivecount);
                                            $cvalues = mysqli_fetch_assoc($apparrivecountResult);
                                            $num_rows = $cvalues['totalarrived'];
                                            ?>
                                            <h6><?php echo $num_rows ?></h6>
                                            <!-- <span class="text-danger small pt-1 fw-bold">12%</span> <span
                                                class="text-muted small pt-2 ps-1">decrease</span> -->

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div><!-- End Customers Card -->
                        <!-- Recent Appointment -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body">
                                    <h5 class="card-title"> <a href="recViewAppointment.php">Recent Appointment for <?php echo $clinicName ?></a><span> | Show
                                            At least 5 appointment</span></h5>

                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Patient Name</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Appo Date</th>
                                                <th data-type="date" data-format="MM/DD/YYYY">Date</th>
                                                <th>No Of Patients</th>
                                                <th>DentistReason</th>
                                                <th>Status</th>
                                                <th>Arrived</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = "SELECT * FROM appointment,patients,schedules,denreason,dentists,reason,clinicinfo WHERE appointment.patID=patients.PatientID AND appointment.schID=schedules.scheduleID AND clinicinfo.clinicID=schedules.clinicID AND denreason.denReasonID=schedules.denReasonID AND denreason.reasonID=reason.reasonID AND denreason.dentistsID=dentists.dentistID AND schedules.clinicID='$clinicID' ORDER BY appointmentID DESC LIMIT 5";
                                            $go_query = mysqli_query($connection, $query);
                                            while ($row = mysqli_fetch_array($go_query)) {

                                                $appID = $row['appointmentID'];
                                                $schdate = $row['date'];
                                                $stTime = $row['startTime'];
                                                $edTime = $row['endTime'];
                                                $appoDate = $row['appoDate'];
                                                $npatient = $row['numofpatients'];
                                                $dentists = $row['dentistName'];
                                                $reason = $row['reasonName'];
                                                $clinic = $row['clinicName'];
                                                $pname = $row['Pname'];
                                                $appstatus = $row['status'];
                                                $arrived = $row['arrived'];

                                                echo "
                                                <tr>
                                                <td>{$appID}</td>
                                                <td>{$pname}</td>
                                                <td>{$stTime}</td>
                                                <td>{$edTime}</td>
                                                <td>{$appoDate}</td>
                                                <td>{$schdate}</td>
                                                <td>{$npatient} people</td>
                                                <td>{$dentists} - {$reason}</td>";
                                                if ($appstatus == 'Pending') {
                                                    echo "<td>
                                                    <a class='badge bg-warning' href='recViewAppointment.php?action=pend&appo_id={$appID}'>
                                                        Pending
                                                    </a>
                                                    </td>";
                                                } else {
                                                    echo "<td>
                                                    <a class='badge bg-success' href='recViewAppointment.php?action=appro&appo_id={$appID}'>
                                                        Approved
                                                    </a>
                                                    </td>";
                                                }
                                                if ($arrived == 'No') {
                                                    echo "<td>
                                                    <a class='badge bg-danger' href='recViewAppointment.php?action=noarrived&appo_id={$appID}'>
                                                        No
                                                    </a>
                                                    </td>";
                                                } else {
                                                    echo "<td>
                                                    <a class='badge bg-success' href='recViewAppointment.php?action=arrived&appo_id={$appID}'>
                                                        Yes
                                                    </a>
                                                    </td>";
                                                }
                                                
                                                echo "</tr>
                                            ";
                                            }


                                            ?>
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div><!-- End Recent Sales -->

                    </div>
                </div><!-- End Left side columns -->

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