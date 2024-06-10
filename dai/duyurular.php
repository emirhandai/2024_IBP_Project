<?php include_once 'header.php' ; ?>

<?php
session_start();
ob_start();
include 'connect.php'; // Veritabanı bağlantı dosyasını dahil edin

// Kullanıcı oturumu kontrolü ve rol kontrolü
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] != 1 ||  $_SESSION['role'] != 0)) {
    echo "Bu sayfayı görüntüleyemezsiniz";
    exit();
}
