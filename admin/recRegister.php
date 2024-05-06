<?php
session_start();
include('./connection.php');

if (isset($_POST['recCreateAcc'])) {
    $recName = $_POST['recName'];
    $recEmail = $_POST['recEmail'];
    $recPassword = $_POST['recPassword'];
    $recPhone = $_POST['recPhone'];
    $clinic = $_POST['clinic'];
    if (strlen($recName) < 3) {
        echo "<script>window.alert('Receptionist need to be longer!')</script>";
        echo "<script>window.location.href='denRegister.php'</script>";
    }
    if (strlen($recPassword) < 5) {
        echo "<script>window.alert('Password need to be longer!')</script>";
    } else if ($recName != "" && $recEmail != "" && $recPassword != "" && $recPhone != "") {
        global $connection;
        global $recName;
        global $recEmail;
        global $recPassword;
        global $recPhone;

        $query = "SELECT * FROM receptionists WHERE recName='$recName' AND recpassword='$recPassword'";
        $dentistquery = mysqli_query($connection, $query);
        // $count = mysqli_num_rows($dentistquery);
        // if($count > 0){
        //     echo "<script>window.alert('already exits')</script>";
        // }

        $query1 = "SELECT * FROM receptionists";
        $go_query = mysqli_query($connection, $query1);
        while ($row = mysqli_fetch_array($go_query)) {
            $dbrecName = $row['recName'];
            $dbrecEmail = $row['recGmail'];
            $dbrecPhone = $row['contactNumber'];
        }
        if ($recName == $dbrecName) {
            echo "<script>window.alert('This receptionists Name is Already Exits!!!')</script>";
            echo "<script>window.location.href='recRegister.php'</script>";
        } elseif ($recEmail == $dbrecEmail) {
            echo "<script>window.alert('This Email is Already Exits!!!')</script>";
            echo "<script>window.location.href='recRegister.php'</script>";
        } elseif ($recPhone == $dbrecPhone) {
            echo "<script>window.alert('This Phone is Already Exits!!!')</script>";
            echo "<script>window.location.href='recRegister.php'</script>";
        } else {
            $myquery = "INSERT INTO receptionists(recName,recpassword,contactNumber,recGmail,clinicID)";
            $myquery .= "VALUES('$recName','$recPassword','$recPhone','$recEmail','$clinic')";
            $go_query = mysqli_query($connection, $myquery);
            if (!$go_query) {
                die("QUERY FAILED" . mysqli_error($connection));
            } else {
                echo "<script>window.alert('You successfully created an account')</script>";
                echo "<script>window.location.href='recRegister.php'</script>";
            }
        }

    }
}
if(isset($_POST['EditRecAcc'])){
    global $connection;
    $recID = $_GET['rec_id'];
    $recName = $_POST['recName'];
    $recEmail = $_POST['recEmail'];
    $recPass = $_POST['recPassword'];
    $recPhone = $_POST['recPhone'];
    $editclinic = $_POST['editclinic'];

    $query = "UPDATE receptionists SET recName='$recName',recpassword='$recPass',contactNumber='$recPhone',recGmail='$recEmail',clinicID='$editclinic' WHERE recID='$recID'";
    $go_query = mysqli_query($connection,$query);
    if(!$go_query){
        die("QUEYR FAILED" . mysqli_error($connection));
    }else{
        echo "<script>window.location.href='recRegister.php'</script>";
    }
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

    <?php include('./header.php'); ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Create Account Receptionists</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Create Account</li>
                    <li class="breadcrumb-item active">Receptionists</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">New Receptionistd Information</h5>

                            <!-- create account Receptionists Form -->
                            <form class="row g-3" method="post" enctype="multipart/form-data">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input required type="text" name="recName" class="form-control" id="floatingName"
                                            placeholder="Receptionist Name">
                                        <label for="floatingName">Receptionist Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input required type="text" name="recPhone" class="form-control" id="floatingEmail"
                                            placeholder="Phone Number">
                                        <label for="floatingEmail">Phone Number</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input required type="password" name="recPassword" class="form-control"
                                            id="floatingPassword" placeholder="Password">
                                        <label for="floatingPassword">Password</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input required type="email" name="recEmail" class="form-control" id="floatingEmail"
                                            placeholder="Receptionist Email">
                                        <label for="floatingEmail">Receptionist Email</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select name="clinic" class="form-select" id="validationDefault04" required>
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
                                    <button type="submit" name="recCreateAcc" class="btn btn-primary">Create Account
                                        Receptionist</button>
                                </div>
                            </form>
                            <!-- End create account dentists Form -->

                        </div>
                    </div>

                    <?php
                    if (isset($_GET['action']) && $_GET['action'] == 'edit') {
                        $recID = $_GET['rec_id'];
                        $query = "SELECT * FROM receptionists WHERE recID='$recID'";
                        $go_query = mysqli_query($connection, $query);
                        while ($out = mysqli_fetch_array($go_query)) {
                            $db_recID = $out['recID'];
                            $db_recName = $out['recName'];
                            $db_recpass = $out['recpassword'];
                            $db_recphone = $out['contactNumber'];
                            $db_recgmail = $out['recGmail'];
                            $db_clinic = $out['clinicID'];
                            ?>
                            <!-- Edit Dentists -->
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Edit Receptionists information</h5>
                                    <form class="row g-3" method="post" enctype="multipart/form-data">
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input type="text" required name="recName" value="<?php echo $db_recName ?>" class="form-control"
                                                    id="floatingName" placeholder="Receptionist Name">
                                                <label for="floatingName">Receptionist Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" required name="recPhone" value="<?php echo $db_recphone ?>" class="form-control"
                                                    id="floatingEmail" placeholder="Dentists Email">
                                                <label for="floatingEmail">Phone Number</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="password" required name="recPassword" value="<?php echo $db_recpass ?>" class="form-control"
                                                    id="floatingPassword" placeholder="Password">
                                                <label for="floatingPassword">Password</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input type="text" required name="recEmail" value="<?php echo $db_recgmail ?>" class="form-control"
                                                    id="floatingEmail" placeholder="Receptionist Email">
                                                <label for="floatingEmail">Receptionist Email</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                        <div class="form-floating">
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
                                                <label for="floatingName">Clinic Name</label>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" name="EditRecAcc" class="btn btn-primary">Edit Receptionist Information</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php
                        }
                    }
                    ?>


                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Receptionists Lists</h5>
                            <!-- Table with stripped rows -->
                            <table class="table datatable mydatatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Receptionist Name</th>
                                        <th>Phone Number</th>
                                        <th>Gmail</th>
                                        <th>Clinic</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                               <?php
                                $query = "SELECT * FROM receptionists,clinicinfo WHERE receptionists.clinicID=clinicinfo.clinicID";
                                $go_query = mysqli_query($connection, $query);
                                while ($row = mysqli_fetch_array($go_query)) {
                                    $recID = $row['recID'];
                                    $recName = $row['recName'];
                                    $recPhone = $row['contactNumber'];
                                    $recEmail = $row['recGmail'];
                                    $clinicName = $row['clinicName'];

                                    echo "
                                            <tr>
                                                <td>{$recID}</td>
                                                <td>{$recName}</td>
                                                <td>{$recPhone}</td>
                                                <td>{$recEmail}</td>
                                                <td>{$clinicName}</td>
                                                <td>
                                                    <a href='recRegister.php?action=edit&rec_id={$recID}'>
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