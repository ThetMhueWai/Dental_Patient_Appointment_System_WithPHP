<?php
session_start();
unset($_SESSION['manager']);
unset($_SESSION['dentists']);
unset($_SESSION['receptionists']);
header("location:index.php");

?>