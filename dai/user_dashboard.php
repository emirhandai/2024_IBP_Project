<?php
session_start();
include 'header2.php';
include 'connect.php';

// Kullanıcı oturumunun açık olduğunu ve gerekli bilginin mevcut olduğunu kontrol edin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 0) {
    echo "Kullanıcı oturumu bulunamadı. Lütfen giriş yapın.";
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = mysqli_real_escape_string($baglanti, $_POST['message']);

    // Mesajı veritabanına kaydet
    $insert_query = "INSERT INTO messages (user_id, message) VALUES ('$user_id', '$message')";
    if (mysqli_query($baglanti, $insert_query)) {
        echo "Mesaj başarıyla gönderildi.";
    } else {
        echo "Mesaj gönderilirken bir hata oluştu: " . mysqli_error($baglanti);
    }
}

// Kullanıcının mesajlarını ve cevaplarını çek
$query = "SELECT * FROM messages WHERE user_id='$user_id'";
$result = mysqli_query($baglanti, $query);
$messages = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Mesajlarınız</title>
</head>
<body>
    <form method="POST" action="">
        <label for="message">Mesajınız:</label>
        <textarea id="message" name="message" required></textarea>
        <br>
        <button type="submit">Mesajı Gönder</button>
    </form>

    <h2>Gönderilen Mesajlar</h2>
    <table border="1">
        <tr>
            <th>Mesaj</th>
            <th>Admin Cevabı</th>
        </tr>
        <?php foreach ($messages as $msg) { ?>
            <tr>
                <td><?php echo $msg['message']; ?></td>
                <td><?php echo $msg['admin_reply']; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
