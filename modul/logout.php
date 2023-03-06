<?php
session_start();
session_destroy();
header('location:../modul/login.php');
?>