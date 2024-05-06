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

if (isset($_GET['action']) && $_GET['action'] == 'pend') {
    global $connection;
    $pend = $_GET['appo_id'];
    $query = "UPDATE appointment SET status='Approved' WHERE appointmentID='$pend'";
    $go_query = mysqli_query($connection, $query);
    echo "<script>window.location.href='recViewAppointment.php'</script>";
}
if (isset($_GET['action']) && $_GET['action'] == 'appro') {
    global $connection;
    $appro = $_GET['appo_id'];
    $query = "UPDATE appointment SET status='Pending'WHERE appointmentID='$appro'";
    $go_query = mysqli_query($connection, $query);
    echo "<script>window.location.href='recViewAppointment.php'</script>";
}
if (isset($_GET['action']) && $_GET['action'] == 'noarrived') {
    global $connection;
    $noarrived = $_GET['appo_id'];
    date_default_timezone_set("Asia/Yangon");
    $nowdate = date("Y-m-d");
    $query = "UPDATE appointment SET arrived='Yes',arDate='$nowdate' WHERE appointmentID='$noarrived'";
    $go_query = mysqli_query($connection, $query);
    echo "<script>window.location.href='recViewAppointment.php'</script>";
}
if (isset($_GET['action']) && $_GET['action'] == 'arrived') {
    global $connection;
    $arrived = $_GET['appo_id'];
    $query = "UPDATE appointment SET arrived='No',arDate='' WHERE appointmentID='$arrived'";
    $go_query = mysqli_query($connection, $query);
    echo "<script>window.location.href='recViewAppointment.php'</script>";
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
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.9.2/themes/smoothness/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.8.3.min.js"></script>
    <script src="https://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>


    <!-- Template Main CSS File -->
    <link href="../css/adminstyle.css" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css">


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
            <h1>View Appointments</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="recdashboard.php">Home</a></li>
                    <li class="breadcrumb-item">Receptionist</li>
                    <li class="breadcrumb-item active">View Appointments</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">
                        <!-- Recent Appointment -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body">
                                    <h5 class="card-title">Recent Appointments for <?php echo $clinicName ?></span></h5>

                                    <table class="table datatable mydatatable">
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
                                            $query = "SELECT * FROM appointment,patients,schedules,denreason,dentists,reason,clinicinfo WHERE appointment.patID=patients.PatientID AND appointment.schID=schedules.scheduleID AND clinicinfo.clinicID=schedules.clinicID AND denreason.denReasonID=schedules.denReasonID AND denreason.reasonID=reason.reasonID AND denreason.dentistsID=dentists.dentistID AND schedules.clinicID='$clinicID'";
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

    <!-- Data Table -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> -->
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
        // $(document).ready(function(){
        //     $("#datepicker").datepicker({
        //         minDate: 1
        //     });
        // })
        $('.mydatatable').DataTable();
    </script>

    <!-- Template Main JS File -->
    <script src="../js/adminmain.js"></script>

</body>

</html>