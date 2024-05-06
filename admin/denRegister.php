<?php
session_start();
include('./connection.php');

if(isset($_POST['denCreateAcc'])){
    $denName = $_POST['denName'];
    $denEmail = $_POST['denEmail'];
    $denPassword = $_POST['denPassword'];
    $denPhone = $_POST['denPhone'];
    $special = $_POST['special'];
    if(strlen($denName)<3){
        echo "<script>window.alert('Dentists need to be longer!')</script>";
        echo "<script>window.location.href='denRegister.php'</script>";
    }
    if(strlen($denPassword)<5){
        echo "<script>window.alert('Password need to be longer!')</script>";
    }
    else if($denName != "" && $denEmail != "" && $denPassword != "" && $denPhone != "" && $special != ""){
        global $connection;
        global $denName;
        global $denEmail;
        global $denPassword;
        global $denPhone;
        global $special;

        $query = "SELECT * FROM dentists WHERE dentistName='$denName' AND dpassword='$denPassword'";
        $dentistquery = mysqli_query($connection,$query);
        // $count = mysqli_num_rows($dentistquery);
        // if($count > 0){
        //     echo "<script>window.alert('already exits')</script>";
        // }

        $query1 = "SELECT * FROM dentists";
        $go_query = mysqli_query($connection,$query1);
        while($row= mysqli_fetch_array($go_query)){
            $dbdenName = $row['dentistName'];
            $dbdenEmail = $row['dentistGmail'];
            $dbdenPhone = $row['contactNumber'];
        }
        if($denName == $dbdenName){
            echo "<script>window.alert('This dentists Name is Already Exits!!!')</script>";
            echo "<script>window.location.href='denRegister.php'</script>";
        }
        elseif($denEmail == $dbdenEmail){
            echo "<script>window.alert('This Email is Already Exits!!!')</script>";
            echo "<script>window.location.href='denRegister.php'</script>";
        }
        elseif($denPhone == $dbdenPhone){
            echo "<script>window.alert('This Phone is Already Exits!!!')</script>";
            echo "<script>window.location.href='denRegister.php'</script>";
        }
        else{
            $myquery = "INSERT INTO dentists(dentistName,dpassword,specialization,contactNumber,dentistGmail)";
            $myquery .= "VALUES('$denName','$denPassword','$special','$denPhone','$denEmail')";
            $go_query = mysqli_query($connection,$myquery);
            if(!$go_query){
                die("QUERY FAILED" . mysqli_error($connection));
            }
            else{
                echo "<script>window.alert('You successfully created an account')</script>";
                echo "<script>window.location.href='denRegister.php'</script>";
            }
        }

    }
}

if (isset($_POST['EditDenAcc'])) {
    global $connection;
    $denName = $_POST['denName'];
    $denID = $_GET['den_id'];
    $denEmail = $_POST['denEmail'];
    $denPassword = $_POST['denPassword'];
    $denPhone = $_POST['denPhone'];
    $special = $_POST['special'];

    $query = "UPDATE dentists SET dentistName='$denName', dpassword='$denPassword', specialization='$special',contactNumber='$denPhone',dentistGmail='$denEmail' WHERE dentistID='$denID'";
    $go_query = mysqli_query($connection,$query);
    if(!$go_query){
        die("QUEYR FAILED" . mysqli_error($connection));
    }else{
        echo "<script>window.location.href='denRegister.php'</script>";
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
      <h1>Create Account Dentists</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Create Account</li>
          <li class="breadcrumb-item active">Dentists</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
            <!-- Create New Dentists -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">New Dentists Information</h5>

              <!-- create account dentists Form -->
              <form class="row g-3" method="post" enctype="multipart/form-data">
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="text" required name="denName" class="form-control" id="floatingName" placeholder="Dentists Name">
                    <label for="floatingName">Dentists Name</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="email" required name="denEmail" class="form-control" id="floatingEmail" placeholder="Dentists Email">
                    <label for="floatingEmail">Dentists Email</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="password" required name="denPassword" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" required name="denPhone" class="form-control" id="floatingEmail" placeholder="Phone Number">
                    <label for="floatingEmail">Phone Number</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" required name="special" class="form-control" id="floatingPassword" placeholder="Specialization">
                    <label for="floatingPassword">Specialization</label>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" name="denCreateAcc" class="btn btn-primary">Create Account Dentitsts</button>
                </div>
              </form>
              <!-- End create account dentists Form -->

            </div>
          </div>

            <?php 
            if(isset($_GET['action']) && $_GET['action'] == 'edit') {
                $denID = $_GET['den_id'];
                $query = "SELECT * FROM dentists WHERE dentistID='$denID'";
                $go_query = mysqli_query($connection,$query);
                while($out=mysqli_fetch_array($go_query)){
                    $db_denID = $out['dentistID'];
                    $db_denName = $out['dentistName'];
                    $db_denpass = $out['dpassword'];
                    $db_special = $out['specialization'];
                    $db_phone = $out['contactNumber'];
                    $db_gmail = $out['dentistGmail'];
                ?>
                <!-- Edit Dentists -->
            <div class="card">
            <div class="card-body">
            <h5 class="card-title">Edit Dentists information</h5>
            <form class="row g-3" method="post" enctype="multipart/form-data">
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="text" required name="denName" value="<?php echo $db_denName ?>" class="form-control" id="floatingName" placeholder="Dentists Name">
                    <label for="floatingName">Dentist Name</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="email" required name="denEmail" value="<?php echo $db_gmail ?>" class="form-control" id="floatingEmail" placeholder="Dentists Email">
                    <label for="floatingEmail">Dentist Email</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="password" required name="denPassword" value="<?php echo $db_denpass ?>" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" required name="denPhone" value="<?php echo $db_phone ?>" class="form-control" id="floatingEmail" placeholder="Phone Number">
                    <label for="floatingEmail">Phone Number</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" required name="special" value="<?php echo $db_special ?>" class="form-control" id="floatingPassword" placeholder="Specialization">
                    <label for="floatingPassword">Specialization</label>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" name="EditDenAcc" class="btn btn-primary">Edit Dentist Information</button>
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
                            <h5 class="card-title">Dentists Lists</h5>
                            <!-- Table with stripped rows -->
                            <table class="table datatable mydatatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Dentist Name</th>
                                        <th>Specialization</th>
                                        <th>Phone Number</th>
                                        <th>Gmail</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM dentists";
                                    $go_query = mysqli_query($connection, $query);
                                    while ($row = mysqli_fetch_array($go_query)) {
                                        $denID = $row['dentistID'];
                                        $denName = $row['dentistName'];
                                        $denSpecial = $row['specialization'];
                                        $denPhone = $row['contactNumber'];
                                        $denEmail = $row['dentistGmail'];
                                                               
                                        echo "
                                            <tr>
                                                <td>{$denID}</td>
                                                <td>{$denName}</td>
                                                <td>{$denSpecial}</td>
                                                <td>{$denPhone}</td>
                                                <td>{$denEmail}</td>
                                                <td>
                                                    <a href='denRegister.php?action=edit&den_id={$denID}'>
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