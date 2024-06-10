<?php
session_start();
include 'header2.php';
include 'connect.php';

// Admin oturumunun açık olduğunu kontrol edin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) {
    echo "Admin oturumu bulunamadı. Lütfen giriş yapın.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message_id = $_POST['message_id'];
    $admin_reply = mysqli_real_escape_string($baglanti, $_POST['admin_reply']);

    // Mesaja admin cevabını güncelle
    $update_query = "UPDATE messages SET admin_reply='$admin_reply' WHERE message_id='$message_id'";
    if (mysqli_query($baglanti, $update_query)) {
        echo "Cevap başarıyla gönderildi.";
    } else {
        echo "Cevap gönderilirken bir hata oluştu: " . mysqli_error($baglanti);
    }
}

// Tüm mesajları çek
$query = "SELECT * FROM messages";
$result = mysqli_query($baglanti, $query);
$messages = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Gelen Mesajlar</title>
</head>
<body>
    <h2>Gelen Mesajlar</h2>
    <table border="1">
        <tr>
            <th>Kullanıcı ID</th>
            <th>Mesaj</th>
            <th>Admin Cevabı</th>
            <th>İşlem</th>
        </tr>
        <?php foreach ($messages as $msg) { ?>
            <tr>
                <td><?php echo $msg['user_id']; ?></td>
                <td><?php echo $msg['message']; ?></td>
                <td><?php echo $msg['admin_reply']; ?></td>
                <td>
                    <form method="POST" action="">
                        <input type="hidden" name="message_id" value="<?php echo $msg['message_id']; ?>">
                        <textarea name="admin_reply" placeholder="Admin Cevabı" required><?php echo $msg['admin_reply']; ?></textarea>
                        <br>
                        <button type="submit">Cevapla</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
