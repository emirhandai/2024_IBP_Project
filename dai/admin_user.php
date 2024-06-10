<?php include_once 'header2.php'; ?>
<?php
session_start();
include 'connect.php'; // Veritabanı bağlantı dosyasını dahil edin



// Kullanıcılardan gelen mesajları getir
$query = "SELECT * FROM messages";
$result = mysqli_query($baglanti, $query);
$messages = mysqli_fetch_all($result, MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['reply_message'])) {
        // Mesaja cevap verme işlemi
        $message_id = $_POST['message_id'];
        $admin_reply = mysqli_real_escape_string($baglanti, $_POST['admin_reply']);

        $insert_query = "INSERT INTO admin_replies (message_id, admin_reply) VALUES ('$message_id', '$admin_reply')";
        if (mysqli_query($baglanti, $insert_query)) {
            echo "Mesaj başarıyla cevaplandı.";
        } else {
            echo "Mesaj cevaplanırken bir hata oluştu.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Mesajlar</title>
</head>
<body>
    <h2>Mesajlar</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Gönderen</th>
            <th>Mesaj</th>
            <th>Cevap</th>
        </tr>
        <?php foreach ($messages as $message) { ?>
            <tr>
                <td><?php echo $message['user_id']; ?></td>
                <td><?php echo $message['firstname']; ?></td>
                <td><?php echo $message['message']; ?></td>
                <td>
                    <?php
                    // Mesaja daha önce verilmiş bir cevap varsa göster
                    $message_id = $message['message_id'];
                    $reply_query = "SELECT * FROM admin_replies WHERE message_id='$message_id'";
                    $reply_result = mysqli_query($baglanti, $reply_query);
                    $reply = mysqli_fetch_assoc($reply_result);
                    if ($reply) {
                        echo $reply['reply'];
                    } else { ?>
                        <form method="POST" action="">
                            <input type="hidden" name="message_id" value="<?php echo $message_id; ?>">
                            <textarea name="admin_reply" placeholder="Cevap"></textarea>
                            <button type="submit" name="reply_message">Cevapla</button>
                        </form>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
