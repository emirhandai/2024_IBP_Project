<?php
session_start();
ob_start();
include 'header2.php';
include 'connect.php'; // Veritabanı bağlantı dosyasını dahil edin

// Kullanıcı oturumunun açık olduğunu ve gerekli bilginin mevcut olduğunu kontrol edin
if (!isset($_SESSION['user_id'])) {
    echo "Kullanıcı oturumu bulunamadı. Lütfen giriş yapın.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $message = mysqli_real_escape_string($baglanti, $_POST['message']);

    // Mesajı veritabanına kaydet
    $insert_query = "INSERT INTO messages (user_id, message) VALUES ('$user_id', '$message')";
    if (mysqli_query($baglanti, $insert_query)) {
        echo "Mesaj başarıyla gönderildi.";
    } else {
        echo "Mesaj gönderilirken bir hata oluştu: " . mysqli_error($baglanti);
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yöneticiye Mesaj Gönder</title>
</head>
<body>
    <form method="POST" action="">
        <label style="color:white;" for="message">Mesajınız:</label>
        <textarea id="message" name="message" required></textarea>
        <br>
        <button type="submit">Mesajı Gönder</button>
    </form>
</body>
</html>
