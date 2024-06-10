<?php
session_start();
include 'connect.php'; // Veritabanı bağlantı dosyasını dahil edin
include 'header2.php';

// Kullanıcı oturumu kontrolü
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Kullanıcı oturumunun geçerli olup olmadığını kontrol et
    if (!isset($_SESSION['user_id'])) {
        echo "Kullanıcı oturumu geçerli değil.";
        exit;
    }

    $user_id = $_SESSION['user_id'];
    echo "User ID: " . $user_id . "<br>"; // Hata ayıklama için user_id'yi yazdır

    $current_password = mysqli_real_escape_string($baglanti, $_POST['current_password']);
    $new_password = mysqli_real_escape_string($baglanti, $_POST['new_password']);

    // Mevcut şifreyi kontrol et
    $query = "SELECT password FROM qp_users WHERE user_id='$user_id'";
    echo "Query: " . $query . "<br>"; // Hata ayıklama için sorguyu yazdır

    $result = mysqli_query($baglanti, $query);

    // Sorgunun başarılı olup olmadığını kontrol et
    if (!$result) {
        echo "Sorgu başarısız: " . mysqli_error($baglanti);
        exit;
    }

    // Sorgu sonucunu kontrol et
    if (mysqli_num_rows($result) == 0) {
        echo "Kullanıcı bulunamadı.";
        exit;
    }

    // Kullanıcı verilerini getir
    $user = mysqli_fetch_assoc($result);

    // Kullanıcı verisinin bulunup bulunmadığını kontrol et
    if (!$user) {
        echo "Kullanıcı verisi alınamadı.";
        exit;
    }

    // Mevcut şifrenin doğru olup olmadığını kontrol et
    if (password_verify($current_password, $user['password'])) {
        // Yeni şifreyi hash'leyin ve güncelleyin
        $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
        $update_query = "UPDATE qp_users SET password='$new_password_hashed' WHERE user_id='$user_id'";

        if (mysqli_query($baglanti, $update_query)) {
            echo "Şifre başarıyla güncellendi.";
            header("Location: ./index2.php");
            exit;
        } else {
            echo "Şifre güncellenirken bir hata oluştu: " . mysqli_error($baglanti);
        }
    } else {
        echo "Mevcut şifre yanlış.";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Şifre Güncelle</title>
</head>
<body>
    <form method="POST" action="">
        <label for="current_password">Mevcut Şifre:</label>
        <input type="password" id="current_password" name="current_password" required>
        <br>
        <label for="new_password">Yeni Şifre:</label>
        <input type="password" id="new_password" name="new_password" required>
        <br>
        <button type="submit">Şifreyi Güncelle</button>
    </form>
</body>
</html>
