<?php
ob_start();
session_start();
session_destroy();

header("location:../Vue/logindashboard.php");

ob_flush();
?>