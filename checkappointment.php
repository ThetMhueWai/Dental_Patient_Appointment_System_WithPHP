<?php
session_start();
include ('./admin/connection.php');
$sid = $_GET['sid'];

if(isset($_POST['confirmApp'])){
    global $connection;
    $numPatient = $_POST['numPatient'];
    $patid = $_POST['patientid'];
    $schid = $_POST['scheduleid'];

    if($numPatient!=''){
        date_default_timezone_set("Asia/Yangon");
        $nowdate = date("Y-m-d");
        $query = "INSERT INTO appointment(appoDate,patID,schID,numofpatients,status,arrived,arDate)VALUES('$nowdate','$patid','$schid','$numPatient','Pending','No','')";
        $go_query = mysqli_query($connection, $query);
        if(!$go_query){
            die("QUERY FAILED" . mysqli_error($connection));
        }else{
            // header("location:appointment.php");
            $normal = "SELECT * FROM schedules WHERE scheduleID='$schid'";
            $getpeople = mysqli_query($connection,$normal);
            while($out = mysqli_fetch_array($getpeople)){
                $db_people = $out['totalPatient'];
                $updatepeople = $db_people-$numPatient;
                $query1 = "UPDATE schedules SET totalPatient='$updatepeople' WHERE scheduleID='$schid'";
                $go_update = mysqli_query($connection,$query1);
            }
            echo "<script>window.alert('Booking Successfully')</script>";
            echo "<script>window.location.href='appointment.php'</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Thant Dental Clinic</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="./assets/logo.png" rel="icon">
    <!-- <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="./vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="./vendor/aos/aos.css" rel="stylesheet">
    <link href="./vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="./vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="./vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="./vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.9.2/themes/smoothness/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.8.3.min.js"></script>
    <script src="https://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>

    <!-- Main CSS File -->
    <link href="./css/style.css" rel="stylesheet">
</head>

<body>
    <?php
    if (empty($_SESSION['user'])):
        include ('noaccheader.php');
        ?>
    <?php else: ?>
        <?php
        include ('header.php');
        ?>
        <?php
    endif;
    ?>
    <!-- ======= Hero Section ======= -->
    <section class="section">
        <div class="container">
        <div class="col-lg-12">
        
            <div class="card-body appointmentdesign">

              <!-- Floating Labels Form -->
              <form class="row g-3" enctype="multipart/form-data" method="POST">
                
                    <?php
                    if(!empty($_SESSION["user"])){
                        $patientEmail = $_SESSION['user'];
                        $query = "SELECT * FROM patients WHERE Pemail='$patientEmail'";
                        $go_query = mysqli_query($connection,$query);
                        while($out = mysqli_fetch_array($go_query)){
                            $db_pname = $out['Pname'];
                            $db_dob = $out['Pdob'];
                            $db_phone = $out['Pphone'];
                            $db_id = $out['PatientID'];

                            echo "
                            <div class='col-md-4'>
                            <div class='form-floating'>
                            <input type='text' readonly value='$db_pname' class='form-control' id='floatingName'>
                            <label for='floatingName'>Your Name</label>
                            </div>
                            </div>
                            <div class='col-md-4'>
                            <div class='form-floating'>
                            <input type='text' readonly value='$db_dob' class='form-control' id='floatingName'>
                            <label for='floatingName'>Date Of Birth</label>
                            </div>
                            </div>
                            <div class='col-md-4'>
                            <div class='form-floating'>
                            <input type='text' readonly value='$db_phone' class='form-control' id='floatingName'>
                            <label for='floatingName'>Phone Number</label>
                            </div>
                            </div>
                            ";
                        }
                    } 
                    ?>
                <?php
                $sid = $_GET['sid'];
                $query = "SELECT * FROM schedules,clinicinfo,denreason,dentists,reason WHERE scheduleID='$sid' AND schedules.denReasonID=denreason.denReasonID AND denreason.reasonID=reason.reasonID AND denreason.dentistsID=dentists.dentistID AND schedules.clinicID=clinicinfo.clinicID";
                $go_query = mysqli_query($connection,$query);
                while($out = mysqli_fetch_array($go_query)){
                    $db_sdate = $out['date'];
                    $db_starttime = $out['startTime'];
                    $db_endtime = $out['endTime'];
                    $db_clinic = $out['clinicName'];
                    $db_reasonName = $out['reasonName'];
                    $db_dentists = $out['dentistName'];

                    echo"
                        <div class='col-md-4'>
                        <div class='form-floating'>
                        <input type='text' readonly value='$db_sdate' class='form-control' id='floatingName'>
                        <label for='floatingName'>Appointment Date</label>
                        </div>
                        </div>
                        <div class='col-md-4'>
                        <div class='form-floating'>
                        <input type='text' readonly value='$db_starttime' class='form-control' id='floatingName'>
                        <label for='floatingName'>Start Time</label>
                        </div>
                        </div>
                        <div class='col-md-4'>
                        <div class='form-floating'>
                        <input type='text' readonly value='$db_endtime' class='form-control' id='floatingName'>
                        <label for='floatingName'>End Time</label>
                        </div>
                        </div>
                        <div class='col-md-3'>
                        <div class='form-floating'>
                        <input type='text' readonly value='$db_clinic' class='form-control' id='floatingName'>
                        <label for='floatingName'>Clinic Name</label>
                        </div>
                        </div>
                        <div class='col-md-3'>
                        <div class='form-floating'>
                        <input type='text' readonly value='$db_reasonName' class='form-control' id='floatingName'>
                        <label for='floatingName'>Reason Name</label>
                        </div>
                        </div>
                        <div class='col-md-3'>
                        <div class='form-floating'>
                        <input type='text' readonly value='$db_dentists' class='form-control' id='floatingName'>
                        <label for='floatingName'>Dentist Name</label>
                        </div>
                        </div>
                    ";
                }
                ?>    
                <div class="col-md-3">
                  <div class="form-floating">
                    <?php 
                        $sid = $_GET['sid'];
                        $query = "SELECT * FROM schedules WHERE scheduleID='$sid'";
                        $go_query = mysqli_query($connection,$query);
                        while($out = mysqli_fetch_array($go_query)){
                            $db_totalpatient = $out['totalPatient'];
                            
                            if($db_totalpatient==1){
                                echo'<input type="number" name="numPatient" min="1" max="1" value="1" class="form-control" id="floatingEmail" placeholder="Number Of Patient">';
                            }elseif ($db_totalpatient==2) {
                                echo '<input type="number" name="numPatient" min="1" max="2" value="1" class="form-control" id="floatingEmail" placeholder="Number Of Patient">';
                            }else{
                                echo '<input type="number" name="numPatient" min="1" max="3" value="1" class="form-control" id="floatingEmail" placeholder="Number Of Patient">';
                            }
                            
                        }                                     
                    ?>
                    <!-- <input type="number" name="numPatient" min="1" max="3" value="1" class="form-control" id="floatingEmail" placeholder="Number Of Patient"> -->
                    <label for="floatingEmail">Number Of Patient</label>
                  </div>
                </div>

                <input type="text" hidden name="patientid" value="<?php echo $db_id ?>" class="form-control" id="floatingEmail">
                <input type="text" hidden name="scheduleid" value="<?php echo $sid ?>" class="form-control" id="floatingEmail">
                
                <div class="text-center">
                  <button name="confirmApp" class="btn btn-primary">Book An Appointment</button>
                  <a href="appointment.php">
                  <button class="btn btn-secondary">Back</button>
                  </a>
                </div>
              </form><!-- End floating Labels Form -->

            </div>                 
        </div>
        </div>  
    </section>
    <!-- End Hero -->





    <!-- ======= Footer ======= -->
    <?php include("footer.php") ?>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="./vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="./vendor/aos/aos.js"></script>
    <script src="./vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./vendor/glightbox/js/glightbox.min.js"></script>
    <script src="./vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="./vendor/swiper/swiper-bundle.min.js"></script>
    <script src="./vendor/waypoints/noframework.waypoints.js"></script>
    <script src="./vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="./js/main.js"></script>

</body>

</html>