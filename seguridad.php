<?php
session_start();
if (!isset($_SESSION['logeado']))
    header("location:index.php");
?>