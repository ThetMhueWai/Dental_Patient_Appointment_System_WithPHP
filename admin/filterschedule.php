<?php
session_start();
include ('./connection.php');
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
            <h1>Appointment Count</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="mdashboard.php">Home</a></li>
                    <li class="breadcrumb-item">Manager</li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">
                        <!-- Available Schedule -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body">
                                    <h5 class="card-title">Available Schedule</h5>

                                    <table class="table datatable mydatatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th data-type="date" data-format="MM/DD/YYYY">Date</th>
                                        <th>Clinic</th>
                                        <th>DentistReason</th>
                                        <th>Total Patient</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                            $query = "SELECT * FROM schedules,denreason,dentists,reason,clinicinfo WHERE clinicinfo.clinicID=schedules.clinicID AND denreason.denReasonID=schedules.denReasonID AND denreason.reasonID=reason.reasonID AND denreason.dentistsID=dentists.dentistID AND schedules.totalPatient>0 AND schedules.date>=CURDATE()";
                                            $go_query = mysqli_query($connection, $query);
                                            while ($row = mysqli_fetch_array($go_query)) {
                                                $schID = $row['scheduleID'];
                                                $schdate = $row['date'];
                                                $stTime = $row['startTime'];
                                                $edTime = $row['endTime'];
                                                $denReason = $row['denReasonID'];
                                                $cid = $row['clinicID'];
                                                $tPatient = $row['totalPatient'];
                                                $dentists = $row['dentistName'];
                                                $reason = $row['reasonName'];
                                                $clinic = $row['clinicName'];
                                                ?>
                                    
                                                <?php
                                                // $go_query = mysqli_query($connection, "SELECT * FROM denreason,dentists,reason WHERE denreason.denReasonID=$denReason AND denreason.reasonID=reason.reasonID AND denreason.dentistsID=dentists.dentistID ORDER BY denReasonID DESC");
                                                // while ($row = mysqli_fetch_array($go_query)) {
                                                //     $dentists = $row['dentistName'];
                                                //     $reason = $row['reasonName'];
                                            

                                                echo "
                                            <tr>
                                                <td>{$schID}</td>
                                                <td>{$stTime}</td>
                                                <td>{$edTime}</td>
                                                <td>{$schdate}</td>
                                                <td>{$clinic}</td>
                                                <td>{$dentists},{$reason}</td>
                                                <td>{$tPatient}</td>
                                                <td>
                                                    <a href='addNewSchedule.php?action=edit&sch_id={$schID}'>
                                                        <i class='bx bx-edit'></i>
                                                    </a>
                                                    <a href='addNewSchedule.php?action=delete&sch_id={$schID}'>
                                                        <i class='bx bx-trash'></i>
                                                    </a>
                                                </td>
                                            </tr>
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