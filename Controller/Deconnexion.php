<?php
//UPLOAD
ob_start();
session_start();
session_destroy();

header("location:Connecter");

ob_flush();
?>