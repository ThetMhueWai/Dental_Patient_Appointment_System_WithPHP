<?php
session_start();
include('./connection.php');

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    global $connection;
    $cinfo = $_GET['cinfo_id'];
    $query = "DELETE FROM clinicinfo WHERE clinicID = '$cinfo'";
    $go_query = mysqli_query($connection, $query);
    echo "<script>window.location.href='clinicinfo.php'</script>";
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
    <?php

    if (isset($_POST['addClinicInfo'])) {
        global $connection;
        $cliName = $_POST['clinicName'];
        $cliAddress = $_POST['clinicAddress'];
        if($cliName != "" && $cliAddress != ""){
            $query = "SELECT * FROM clinicinfo WHERE clinicName='$cliName'";
            $go_query = mysqli_query($connection,$query);
            $count = mysqli_num_rows($go_query);
            if($count > 0){
                echo "<script>window.alert('already exits')</script>";
            }else{
                $query = "INSERT INTO clinicinfo (clinicName,clinicAddress) VALUES ('$cliName','$cliAddress')";
                $ch_query = mysqli_query($connection,$query);
                if(!$ch_query){
                    die("QUERY FAILED" . mysqli_error($connection));
                }else{
                    echo "<script>window.alert('successfully inserted')</script>";
                    echo "<script>window.location.href='clinicinfo.php'</script>";
                }
            }
        }
    }

    if(isset($_POST['editClinicInfo'])){
        global $connection;
        $ecliName = $_POST['editcliName'];
        $ecliAddress = $_POST['editcliAddress'];
        $cliID = $_GET['cinfo_id'];

        $query = "UPDATE clinicinfo SET clinicName='$ecliName',clinicAddress='$ecliAddress' WHERE clinicID='$cliID'";
        $go_query = mysqli_query($connection,$query);
        echo "<script>window.location.href='clinicinfo.php'</script>";

    }
    ?>
    <?php include('./header.php'); ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Clinic Information</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <!-- <li class="breadcrumb-item">Create Account</li> -->
                    <li class="breadcrumb-item active">ClinicInfo</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add New Clinic Information</h5>

                            <!-- create clinic information Form -->
                            <form class="row g-3" method="post" enctype="multipart/form-data">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" required name="clinicName" class="form-control" id="floatingName"
                                            placeholder="Clinic Name">
                                        <label for="floatingName">Clinic Name</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea required class="form-control" name="clinicAddress" placeholder="Clinic Address" id="floatingTextarea" style="height: 100px;"></textarea>
                                        <label for="floatingTextarea">Clinic Address</label>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="addClinicInfo" class="btn btn-primary">Add Clinic Information</button>
                                </div>
                            </form>
                            <!-- End clinic information Form -->
                        </div>


                        <div class="card-body">
                            <?php
                            if (isset($_GET['action']) && $_GET['action'] == 'edit') {
                                $cinfoid = $_GET['cinfo_id']; 
                                $query = "SELECT * FROM clinicinfo WHERE clinicID='$cinfoid'";
                                $go_query = mysqli_query($connection,$query);
                                while($out = mysqli_fetch_array($go_query)){
                                    $db_cliName = $out['clinicName'];
                                    $db_cliAddress = $out['clinicAddress'];
                                
                            ?>
                            <h5 class="card-title">Edit Clinic Information</h5>
                            <!-- edit clinic information Form -->
                            <form class="row g-3" method="post" enctype="multipart/form-data">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" required name="editcliName" class="form-control" id="floatingName"
                                            placeholder="Clinic Name" value="<?php echo $db_cliName ?>">
                                        <label for="floatingName">Clinic Name</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" required name="editcliAddress" placeholder="Clinic Address" id="floatingTextarea" style="height: 100px;"><?php echo $db_cliAddress ?></textarea>
                                        <label for="floatingTextarea">Clinic Address</label>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="editClinicInfo" class="btn btn-primary">Edit Clinic Information</button>
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
                                    <h5 class="card-title">Clinic Information</h5>

                                    <!-- Table with Clinic Information rows -->
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Clinic Name</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $query = "SELECT * FROM clinicinfo ORDER BY clinicID DESC";
                                            $go_query = mysqli_query($connection,$query);
                                            while($row = mysqli_fetch_array($go_query)){
                                                $dbcliID = $row['clinicID'];
                                                $dbcliName = $row['clinicName'];
                                                $dbcliAddress = $row['clinicAddress'];

                                                echo"
                                                    <tr>
                                                        <th scope='row'>{$dbcliID}</th>
                                                        <td>{$dbcliName}</td>
                                                        <td>{$dbcliAddress}</td>
                                                        <td>
                                                            
                                                                <a href='clinicinfo.php?action=edit&cinfo_id={$dbcliID}'>
                                                                    <i class='bx bx-edit'></i>
                                                                </a>
                                                            
                                                                <a href='clinicinfo.php?action=delete&cinfo_id={$dbcliID}'>
                                                                    <i class='bx bx-trash'></i>
                                                                </a>
                                                            
                                                        </td>
                                                    </tr>
                                                ";
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                    <!-- End Table with Clinic Information rows -->

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