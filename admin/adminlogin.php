<?php 
session_start();
include('./connection.php');
$role = $_GET['role'];
if(isset($_POST['btnadminlogin'])){
    $adminmail = $_POST['adminmail'];
    $adminpassword = $_POST['adminpass'];
    $errors = array('adminmail'=>'', 'adminpass'=>'');
    if($adminmail == ''){
        $errors['adminmail'] = "Admin Mail is could not be empty";
    }
    if($adminpassword == ''){
        $errors['adminpass'] = "Admin Passwrd is could not be empty";
    }
    if($role == 'manager'){
        $query = "SELECT * FROM managers";
        $go_query = mysqli_query($connection,$query);
        while($out = mysqli_fetch_array($go_query)){
            $db_manager_email = $out['mGmail'];
            $db_manager_pass = $out['mPassword'];

            if($db_manager_pass != $adminpassword){
                echo "<script>window.alert('Password is wrong')</script>";
                echo "<script>window.location.href='index.php'</script>";
            }else if($db_manager_email == $adminmail && $db_manager_pass == $adminpassword){
                $_SESSION['manager'] = $adminmail;
                header('location:mdashboard.php');
                break;
            }
        }
    }
    if($role == 'dentists'){
      $query = "SELECT * FROM dentists";
      $go_query = mysqli_query($connection,$query);
      while($out = mysqli_fetch_array($go_query)){
        $db_dgmail = $out['dentistGmail'];
        $db_dpass = $out['dpassword'];

        if($db_dpass != $adminpassword){
          echo "<script>window.alert('Password is wrong')</script>";
          echo "<script>window.location.href='index.php'</script>";
        }else if($db_dgmail == $adminmail && $db_dpass == $adminpassword){
          $_SESSION['dentists'] = $adminmail;
          header('location:dendashboard.php');
          break;
        }
      }
    }
    if($role == 'receptionist'){
      $query = "SELECT * FROM receptionists";
      $go_query = mysqli_query($connection,$query);
      while($out = mysqli_fetch_array($go_query)){
        $db_rgmail = $out['recGmail'];
        $db_rpass = $out['recpassword'];

        if($db_rpass != $adminpassword){
          echo "<script>window.alert('Password is wrong')</script>";
          echo "<script>window.location.href='index.php'</script>";
        }else if($db_rgmail == $adminmail && $db_rpass == $adminpassword){
          $_SESSION['receptionists'] = $adminmail;
          header('location:recdashboard.php');
          break;
        }
      }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign in</title>
  <link rel="stylesheet" href="../css/adminlogin.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <?php
        // $role = $_GET['role'];
    ?>
  <section class="container">
    <div class="sign-in">
      <img src="../assets/logo.png" alt="">
      <div class="form">
        <h1 class="title">
          Sign in to your account
        </h1>
        <p class="sub-title">
          Welcome to the <?php echo $role ?>
        </p>
        <form action="" method="post">
            <div class="input-box">
            <input type="email" required name="adminmail" placeholder="Gmail" class="username">
            <div class="password-box">
                <input type="password" required name="adminpass" placeholder="Password" class="password">
                <i class='bx bx-low-vision vision'></i>
            </div>
            </div>
            <button class="btn" name="btnadminlogin">
            Sign in
            </button>
        </form>
      </div>
    </div>
  </section>

  <script src="../js/login.js"></script>
  <script src="../js/main.js"></script>
</body>

</html>