<?php
session_start();
include ('./connection.php');

$pid = $_GET['pid'];
$denloginGmail = $_SESSION['dentists'];
$query = "SELECT * FROM dentists WHERE dentistGmail='$denloginGmail'";
$go_query = mysqli_query($connection, $query);
while ($out = mysqli_fetch_array($go_query)) {
    $denID = $out['dentistID'];
    $dentistName = $out['dentistName'];
}
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    global $connection;
    $h_id = $_GET['hid'];
    $query = "DELETE FROM history WHERE historyid = '$h_id'";
    $go_query = mysqli_query($connection, $query);
    echo "<script>window.location.href='history.php?pid=$pid'</script>";
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
    <?php
    if (isset($_POST['addPatientHistory'])) {
        global $connection;
        date_default_timezone_set("Asia/Yangon");
        $nowdate = date("Y-m-d");
        $rpName = $_POST['rpatientName'];
        $phistory = $_POST['patientHistory'];
        if ($rpName != "" && $phistory != ""){
                $query = "INSERT INTO history (patID,rpatName,history,createdate) VALUES ('$pid','$rpName','$phistory','$nowdate')";
                $ch_query = mysqli_query($connection, $query);
                if (!$ch_query) {
                    die("QUERY FAILED" . mysqli_error($connection));
                } else {
                    echo "<script>window.alert('successfully inserted')</script>";
                    echo "<script>window.location.href='history.php?pid=$pid'</script>";
                }
            }
    }
    if(isset($_POST['editPatientHistory'])){
        global $connection;
        $rpName = $_POST['rpName'];
        $history = $_POST['pHistory'];
        $h_id = $_GET['hid'];

        $query = "UPDATE history SET rpatName='$rpName',history='$history' WHERE historyid='$h_id'";
        $go_query = mysqli_query($connection, $query);
        echo "<script>window.location.href='history.php?pid=$pid'</script>";
    }
    ?>
    <?php include ('./header.php'); ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Patient History For PatientID - <?php echo $pid; ?></h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dendashboard.php">Home</a></li>
                    <li class="breadcrumb-item">View Appointments</li>
                    <li class="breadcrumb-item active">History</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body">
                                    <h5 class="card-title">Add Patient History</span></h5>
                                    <form class="row g-3" method="post" enctype="multipart/form-data">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" disabled name="patientid" value="<?php echo $pid ?>" class="form-control" id="floatingName"
                                                    placeholder="Patient ID">
                                                <label for="floatingName">Patient ID</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input required type="text" name="rpatientName" class="form-control" id="floatingName"
                                                    placeholder="Patient Name">
                                                <label for="floatingName">Real Patient Name</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <textarea required class="form-control" name="patientHistory" placeholder="Patient History" id="floatingTextarea" style="height: 100px;"></textarea>
                                                <label for="floatingTextarea">Patient History</label>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" name="addPatientHistory" class="btn btn-primary">Add Patient History</button>
                                        </div>
                                    </form>
                                </div>
                                <?php 
                                if (isset($_GET['action']) && $_GET['action'] == 'edit') {
                                    $h_id = $_GET['hid'];
                                    $query = "SELECT * FROM history WHERE historyid='$h_id'";
                                    $go_query = mysqli_query($connection, $query);
                                    while ($out = mysqli_fetch_array($go_query)) {
                                        $db_rpname = $out['rpatName'];
                                        $db_history = $out['history'];
                                ?>
                                <div class="card-body">
                                    <h5 class="card-title">Edit Patient History</span></h5>
                                    <form class="row g-3" method="post" enctype="multipart/form-data">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" disabled name="patientid" value="<?php echo $pid ?>" class="form-control"
                                                    id="floatingName" placeholder="Patient ID">
                                                <label for="floatingName">Patient ID</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" name="rpName" value="<?php echo $db_rpname ?>" class="form-control" id="floatingName"
                                                    placeholder="Patient Name">
                                                <label for="floatingName">Real Patient Name</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <textarea class="form-control" name="pHistory" placeholder="Patient History" id="floatingTextarea"
                                                    style="height: 100px;"><?php echo $db_history ?></textarea>
                                                <label for="floatingTextarea">Patient History</label>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" name="editPatientHistory" class="btn btn-primary">Edit Patient History</button>
                                        </div>
                                    </form>
                                </div>
                                <?php 
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <!-- Patient History Card -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body">
                                    <h5 class="card-title">Patient History list for PatientID - <?php echo $pid ?></span></h5>
                                    <table class="table datatable mydatatable">
                                        <thead>
                                            <tr>
                                                <th>R-Patient Name</th>
                                                <th>Create Date</th>
                                                <th>History</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = "SELECT * FROM history WHERE patID='$pid'";
                                            $go_query = mysqli_query($connection, $query);
                                            while ($row = mysqli_fetch_array($go_query)) {
                                                $hid=$row['historyid'];
                                                $rpName = $row['rpatName'];
                                                $history = $row['history'];
                                                $createDate = $row['createdate'];

                                                echo "
                                                <tr>
                                                <td>{$rpName}</td>
                                                <td>{$createDate}</td>
                                                <td>{$history}</td>";

                                                echo "
                                                <td>
                                                    <a href='history.php?pid={$pid}&action=edit&hid={$hid}'>
                                                        <i class='bx bx-edit'></i>
                                                    </a>
                                                    <a href='history.php?pid={$pid}&action=delete&hid={$hid}'>
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