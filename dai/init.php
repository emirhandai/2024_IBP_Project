<?php
session_start();
ob_start();
error_reporting(E_ALL);
date_default_timezone_set('Europe/Istanbul');
include_once 'data/class.php';
$adminclass = new AdminClass;
$user_id = $_SESSION['user_id'];
?>