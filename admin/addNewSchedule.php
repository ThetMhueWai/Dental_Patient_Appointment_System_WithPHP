<?php
session_start();
include ('./connection.php');

if (isset ($_GET['action']) && $_GET['action'] == 'delete') {
    global $connection;
    $schid = $_GET['sch_id'];
    $query = "DELETE FROM schedules WHERE scheduleID = '$schid'";
    $go_query = mysqli_query($connection, $query);
    echo "<script>window.location.href='addNewSchedule.php'</script>";
}
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
    <?php

    if (isset ($_POST['addnewSchedule'])) {
        global $connection;
        $denreason = $_POST['denreason'];
        $startTime = $_POST['startTime'];
        $endTime = $_POST['endTime'];
        $date = $_POST['date'];
        $totalPat = $_POST['totalPatient'];
        $clinic = $_POST['clinic'];

        if ($denreason != "" && $startTime != "" && $endTime != "" && $date != "" && $totalPat != "" && $clinic != "") {
            $query = "INSERT INTO schedules (date,startTime,endTime,denReasonID,clinicID,totalPatient) VALUES ('$date','$startTime','$endTime','$denreason','$clinic','$totalPat')";
            $ch_query = mysqli_query($connection, $query);
            if (!$ch_query) {
                die ("QUERY FAILED" . mysqli_error($connection));
            } else {
                echo "<script>window.alert('successfully inserted')</script>";
                echo "<script>window.location.href='addNewSchedule.php'</script>";
            }

        }
    }
    if(isset($_POST['editSchedule'])){
        global $connection;
        $schid = $_GET['sch_id'];
        $new_denreason = $_POST['editdenreason'];
        $new_startTime = $_POST['editstartTime'];
        $new_endTime = $_POST['editendTime'];
        $new_date = $_POST['editdate'];
        $new_totalPat = $_POST['edittotalPatient'];
        $new_clinic = $_POST['editclinic'];

        $query = "UPDATE schedules SET date='$new_date',startTime='$new_startTime',endTime='$new_endTime',denReasonID='$new_denreason',clinicID='$new_clinic',totalPatient='$new_totalPat' WHERE scheduleID='$schid'";
        $go_query = mysqli_query($connection,$query);
        echo "<script>window.location.href='addNewSchedule.php'</script>";

    }
    ?>
    <?php include ('./header.php'); ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Add New Schedule</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="mdashboard.php">Home</a></li>
                    <li class="breadcrumb-item">Schedule</li>
                    <li class="breadcrumb-item active">Add New Schedule</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add New Schedule</h5>

                            <!-- create new schedule Form -->
                            <form class="row g-3" method="post" enctype="multipart/form-data">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <select required name="denreason" class="form-select" id="validationDefault04" required>
                                            <option selected disabled value="">Choose Dentists Reason</option>
                                            <?php
                                            $go_query = mysqli_query($connection, "SELECT * FROM denreason,dentists,reason WHERE denreason.reasonID=reason.reasonID AND denreason.dentistsID=dentists.dentistID ORDER BY denReasonID DESC");
                                            while ($row = mysqli_fetch_array($go_query)) {
                                                $denReasonId = $row['denReasonID'];
                                                $dentistName = $row['dentistName'];
                                                $reasonName = $row['reasonName'];
                                            
                                                echo "<option value={$denReasonId}>{$dentistName} - {$reasonName}</option>";
                                            }
                                            ?>
                                        </select>
                                        <label for="floatingName">Dentists</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input required type="time" name="startTime" class="form-control" id="floatingName"
                                            placeholder="Date">
                                        <label for="floatingName">Start Time</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input required type="time" name="endTime" class="form-control" id="floatingName"
                                            placeholder="Date">
                                        <label for="floatingName">End Time</label>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-floating">
                                        <?php
                                        // date_default_timezone_set('UTC');
                                        // $mindate = date("Y-m-d");
                                        
                                        $tomorrowDate = new DateTime('tomorrow');
                                        $mindate = $tomorrowDate->format('Y-m-d');
                                        ?>
                                        <input required type="date" name="date" min="<?php echo $mindate ?>" class="form-control" id="datemin"
                                            placeholder="Date">
                                        <label for="datemin">Date</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input required type="number" min="1" max="50" name="totalPatient" class="form-control" id="floatingName"
                                            placeholder="totlaPatient">
                                        <label for="floatingName">Total Patient</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <select required name="clinic" class="form-select" id="validationDefault04" required>
                                            <option selected disabled value="">Choose Clinic</option>
                                            <?php
                                            $go_query = mysqli_query($connection, "SELECT * FROM clinicinfo");
                                            while ($row = mysqli_fetch_array($go_query)) {
                                                $clinicID = $row['clinicID'];
                                                $clinicName = $row['clinicName'];
                                                echo "<option value={$clinicID}>{$clinicName}</option>";
                                            }
                                            ?>
                                        </select>
                                        <label for="floatingName">Clinic Name</label>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="addnewSchedule" class="btn btn-primary">Add New Schedule</button>
                                </div>
                            </form>
                            <!-- End clinic information Form -->
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <?php 
                        if(isset($_GET['action']) && $_GET['action'] == 'edit'){
                            $schid = $_GET['sch_id'];
                            $query = "SELECT * FROM schedules,denreason,dentists,reason,clinicinfo WHERE scheduleID='$schid' AND clinicinfo.clinicID=schedules.clinicID AND denreason.denReasonID=schedules.denReasonID AND denreason.reasonID=reason.reasonID AND denreason.dentistsID=dentists.dentistID";
                            $go_query = mysqli_query($connection,$query);
                            while($out = mysqli_fetch_array($go_query)){
                                $db_schID = $out['scheduleID'];
                                $db_schdate = $out['date'];
                                $db_stTime = $out['startTime'];
                                $db_edTime = $out['endTime'];
                                $db_denReason = $out['denReasonID'];
                                $db_cid = $out['clinicID'];
                                $db_tPatient = $out['totalPatient'];
                                $db_dentists = $out['dentistName'];
                                $db_reason = $out['reasonName'];
                                $db_clinic = $out['clinicName'];
                            ?>
                            <h5 class="card-title">Edit Schedule</h5>
                            <!-- edit schedule Form -->
                            <form class="row g-3" method="post" enctype="multipart/form-data">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <select name="editdenreason" class="form-select" id="validationDefault04" required>
                                            <!-- <option selected disabled value="">Choose Dentists Reason</option> -->
                                                <?php
                                                    $go_query = mysqli_query($connection, "SELECT * FROM denreason,dentists,reason WHERE denReasonID='$db_denReason' AND denreason.reasonID=reason.reasonID AND denreason.dentistsID=dentists.dentistID");
                                                    while ($row = mysqli_fetch_array($go_query)) {
                                                        $denReasonId = $row['denReasonID'];
                                                        $dentistName = $row['dentistName'];
                                                        $reasonName = $row['reasonName'];

                                                        echo "<option selected value={$denReasonId}>{$dentistName} - {$reasonName}</option>";
                                                    }
                                                    $go_query = mysqli_query($connection, "SELECT * FROM denreason,dentists,reason WHERE denreason.reasonID=reason.reasonID AND denreason.dentistsID=dentists.dentistID EXCEPT SELECT * FROM denreason,dentists,reason WHERE denReasonID='$db_denReason' AND denreason.reasonID=reason.reasonID AND denreason.dentistsID=dentists.dentistID");
                                                    while ($row = mysqli_fetch_array($go_query)) {
                                                        $denReasonId = $row['denReasonID'];
                                                        $dentistName = $row['dentistName'];
                                                        $reasonName = $row['reasonName'];

                                                        echo "<option value={$denReasonId}>{$dentistName} - {$reasonName}</option>";
                                                    }
                                                ?>
                                            </select>
                                            <label for="floatingName">Dentists - Reason</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="time" value="<?php echo $db_stTime ?>" name="editstartTime" class="form-control" id="floatingName" placeholder="Date">
                                            <label for="floatingName">Start Time</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="time" value="<?php echo $db_edTime ?>" name="editendTime" class="form-control" id="floatingName" placeholder="Date">
                                            <label for="floatingName">End Time</label>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-floating">
                                            <?php
                                            // date_default_timezone_set('UTC');
                                            // $mindate = date("Y-m-d");
                                    
                                            $tomorrowDate = new DateTime('tomorrow');
                                            $mindate = $tomorrowDate->format('Y-m-d');
                                            ?>
                                            <input type="date" value="<?php echo $db_schdate ?>" name="editdate" min="<?php echo $mindate ?>" class="form-control" id="datemin"
                                                placeholder="Date">
                                            <label for="datemin">Date</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="number" value="<?php echo $db_tPatient ?>" min="1" max="50" name="edittotalPatient" class="form-control" id="floatingName"
                                                placeholder="totlaPatient">
                                            <label for="floatingName">Total Patient</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <select name="editclinic" class="form-select" id="validationDefault04" required>
                                                <!-- <option selected disabled value="">Choose Clinic</option> -->
                                                <?php
                                                $go_query = mysqli_query($connection, "SELECT * FROM clinicinfo WHERE clinicID='$db_cid'");
                                                while ($row = mysqli_fetch_array($go_query)) {
                                                    $clinicID = $row['clinicID'];
                                                    $clinicName = $row['clinicName'];
                                                    echo "<option selected value={$clinicID}>{$clinicName}</option>";
                                                }
                                                $go_query = mysqli_query($connection, "SELECT * FROM clinicinfo EXCEPT SELECT * FROM clinicinfo WHERE clinicID='$db_cid'");
                                                while ($row = mysqli_fetch_array($go_query)) {
                                                    $clinicID = $row['clinicID'];
                                                    $clinicName = $row['clinicName'];
                                                    echo "<option value={$clinicID}>{$clinicName}</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="floatingName">Clinic Name</label>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" name="editSchedule" class="btn btn-primary">Edit Schedule</button>
                                    </div>
                                </form>
                            <?php 
                            }
                        }
                        ?>
                    </div>









    

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Schedules</h5>
                            <!-- Table with stripped rows -->
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
                                    $query = "SELECT * FROM schedules,denreason,dentists,reason,clinicinfo WHERE clinicinfo.clinicID=schedules.clinicID AND denreason.denReasonID=schedules.denReasonID AND denreason.reasonID=reason.reasonID AND denreason.dentistsID=dentists.dentistID";
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
                            <!-- End Table with stripped rows -->
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