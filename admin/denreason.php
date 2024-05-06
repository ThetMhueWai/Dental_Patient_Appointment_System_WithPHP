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
    <?php

    if (isset($_POST['addDenReason'])) {
        global $connection;
        $dentist = $_POST['dentist'];
        $reason = $_POST['reason'];
        if ($dentist != "" && $reason != "") {
            $query = "INSERT INTO denreason (reasonID,dentistsID) VALUES ('$reason','$dentist')";
            $ch_query = mysqli_query($connection, $query);
            if (!$ch_query) {
                die("QUERY FAILED" . mysqli_error($connection));
            } else {
                echo "<script>window.alert('successfully inserted')</script>";
                echo "<script>window.location.href='denreason.php'</script>";
            }
        }
    }
    

    if (isset($_POST['editDenReason'])) {
        global $connection;
        $reaid = $_POST['newreason'];
        $denid = $_POST['newdentist'];
        $denrecID = $_GET['denrec_id'];

        $query = "UPDATE denreason SET reasonID='$reaid',dentistsID='$denid' WHERE denReasonID='$denrecID'";
        $go_query = mysqli_query($connection, $query);
        echo "<script>window.location.href='denreason.php'</script>";

    }
    ?>
    <?php include ('./header.php'); ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dentist Reason</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Schedule</li>
                    <li class="breadcrumb-item active">Dentist Reason</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add New Dentists Reason</h5>

                            <!-- create denists Reason Form -->
                            <form class="row g-3" method="post" enctype="multipart/form-data">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <select name="dentist" class="form-select" id="validationDefault04" required>
                                        <option selected disabled value="">Choose Dentists</option>
                                        <?php
                                        $go_query = mysqli_query($connection,"SELECT * FROM dentists ORDER BY dentistID DESC"); 
                                        while($row=mysqli_fetch_array($go_query)){
                                            $denID = $row['dentistID'];
                                            $denName = $row['dentistName'];

                                            echo "<option value={$denID}>{$denName}</option>";
                                        }
                                        ?>
                                        </select>
                                        <label for="floatingName">Choose Dentists</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <select name="reason" class="form-select" id="validationDefault04" required>
                                        <option selected disabled value="">Choose Reason</option>
                                        <?php
                                            $go_query = mysqli_query($connection, "SELECT * FROM reason ORDER BY reasonID DESC");
                                            while ($row = mysqli_fetch_array($go_query)) {
                                                $reasonID = $row['reasonID'];
                                                $reasonName = $row['reasonName'];

                                                echo "<option value={$reasonID}>{$reasonName}</option>";
                                            }
                                            ?>
                                        </select>
                                        <label for="floatingName">Choose Reason</label>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="addDenReason" class="btn btn-primary">Add Dentist Reason</button>
                                </div>
                            </form>
                            <!-- End clinic information Form -->
                        </div>


                        <div class="card-body">
                            <?php
                            if (isset($_GET['action']) && $_GET['action'] == 'edit') {
                                $denrecID = $_GET['denrec_id'];
                                $query = "SELECT * FROM denreason WHERE denReasonID='$denrecID'";
                                $go_query = mysqli_query($connection, $query);
                                while ($out = mysqli_fetch_array($go_query)) {
                                    $db_reaid = $out['reasonID'];
                                    $db_denid = $out['dentistsID'];
                                    ?>
                                    <h5 class="card-title">Edit Dentist Reason Information</h5>
                                    <!-- edit clinic information Form -->
                                    <form class="row g-3" method="post" enctype="multipart/form-data">
                                    <div class="col-md-12">
                                    <div class="form-floating">
                                    <select name="newdentist" class="form-select" id="validationDefault04" required>
                                        <!-- <option selected disabled value="">Choose Dentists</option> -->
                                        <?php
                                            $go_query = mysqli_query($connection, "SELECT * FROM dentists WHERE dentistID='$db_denid'");
                                            while ($row = mysqli_fetch_array($go_query)) {
                                            $denID = $row['dentistID'];
                                            $denName = $row['dentistName'];

                                                echo "<option selected value={$denID}>{$denName}</option>";
                                            }
                                            $go_query = mysqli_query($connection, "SELECT * FROM dentists EXCEPT SELECT * FROM dentists WHERE dentistID='$db_denid' ORDER BY dentistID DESC");
                                            while ($row = mysqli_fetch_array($go_query)) {
                                                $denID = $row['dentistID'];
                                                $denName = $row['dentistName'];

                                                echo "<option value={$denID}>{$denName}</option>";
                                            }
                                        ?>
                                    </select>
                                    <label for="floatingName">Choose Dentists</label>
                                    </div>
                                    </div>
                                    <div class="col-12">
                                    <div class="form-floating">
                                    <select name="newreason" class="form-select" id="validationDefault04" required>
                                        <!-- <option selected disabled value="">Choose Reason</option> -->
                                        <?php
                                            $go_query = mysqli_query($connection, "SELECT * FROM reason WHERE reasonID='$db_reaid'");
                                            while ($row = mysqli_fetch_array($go_query)) {
                                                $reasonID = $row['reasonID'];
                                                $reasonName = $row['reasonName'];

                                                echo "<option selected value={$reasonID}>{$reasonName}</option>";
                                            }
                                            $go_query = mysqli_query($connection, "SELECT * FROM reason EXCEPT SELECT * FROM reason WHERE reasonID='$db_reaid' ORDER BY reasonID DESC");
                                            while ($row = mysqli_fetch_array($go_query)) {
                                                $reasonID = $row['reasonID'];
                                                $reasonName = $row['reasonName'];

                                                echo "<option value={$reasonID}>{$reasonName}</option>";
                                            }
                                        ?>
                                    </select>
                                    <label for="floatingName">Choose Reason</label>
                                    </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" name="editDenReason" class="btn btn-primary">Edit Dentist Reason Information</button>
                                    </div>
                                </form>
                                <?php
                                }
                            }
                            ?>
                            <!-- End edit clinic information Form -->
                        </div>

                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Dentists Reason</h5>
                            <!-- Table with stripped rows -->
                            <table class="table datatable mydatatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Dentists Name</th>
                                        <th>Reason Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM denreason,dentists,reason WHERE denreason.reasonID=reason.reasonID AND denreason.dentistsID=dentists.dentistID ORDER BY denReasonID DESC";
                                    $go_query = mysqli_query($connection, $query);
                                    while ($row = mysqli_fetch_array($go_query)) {
                                        $denReasonID = $row['denReasonID'];
                                        $reasonID = $row['reasonID'];
                                        $dentistID = $row['dentistsID'];
                                        $denName = $row['dentistName'];
                                        $reaName = $row['reasonName'];
                                    
                                        echo "
                                            <tr>
                                                <td>{$denReasonID}</td>
                                                <td>{$denName}</td>
                                                <td>{$reaName}</td>
                                                <td>
                                                    <a href='denreason.php?action=edit&denrec_id={$denReasonID}'>
                                                        <i class='bx bx-edit'></i> Edit
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