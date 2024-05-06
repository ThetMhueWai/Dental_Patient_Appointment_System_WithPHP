<?php
session_start();
include ('./admin/connection.php');
$profile = $_SESSION['user'];
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
        <div class="container" style="margin-top:100px;">
            <div class="col-lg-12">
                
                <div class="col-md-12">
                    <div class="form-floating" id="filter">
                        <select name="fetchval" class="form-select" id="fetchval" id="validationDefault04" required>
                            <option selected disabled value="">Choose Reason</option>
                            <?php 
                                $go_query = mysqli_query($connection,"SELECT * FROM reason");
                                while($row = mysqli_fetch_array($go_query)){
                                    $reasonID = $row['reasonID'];
                                    $reasonName = $row['reasonName'];
                                    echo "<option value='{$reasonID}'>{$reasonName}</option>";
                                }
                            ?>
                        </select>
                        <label for="floatingName">Reason</label>
                    </div>
                    <div class="subcontainer" style="margin-top:50px;">

                    </div>
                    <div class="schedulecontainer" style="margin-top:50px;">
                        
                    </div>
                </div>
            </div>
        </div>
        
    </section>
    <!-- End Hero -->





    <!-- ======= Footer ======= -->
    <?php 
    include("footer.php");
    ?>

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


    <script type="text/javascript">
        $(document).ready(function(){
            $("#fetchval").on('change',function(){
                var value = $(this).val();
                //alert(value);
                $.ajax({
                    url:"fetchreason.php",
                    type:"POST",
                    data:{ request: value},
                    beforeSend:function(){
                        $(".subcontainer").html("<span>Working......</span>");
                    },
                    success:function(data){
                        $(".subcontainer").html(data);
                    }
                });
            });
        });
    </script>

</body>

</html>