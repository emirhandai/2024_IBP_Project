<?php
$host = 'localhost';
$dbname = 'admin';
$username = 'root';
$password = '';
$charset = 'utf8';
$vt = "admin";

$baglanti = mysqli_connect($host, $username, $password, $vt);

if (!$baglanti) {
    die("Bağlantı hatası: " . mysqli_connect_error());
}
mysqli_set_charset($baglanti, $charset);
?>
