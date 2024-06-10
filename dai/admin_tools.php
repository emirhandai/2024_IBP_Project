<?php
session_start();
ob_start();
include 'connect.php';
include 'header2.php';

// Kullanıcı oturumu ve rol kontrolü
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) {
    header('Location: login.php');
    exit();
}

// AI Araçları getirme
$query = "SELECT * FROM ai_tools";
$result = mysqli_query($baglanti, $query);
$ai_tools = mysqli_fetch_all($result, MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_tool'])) {
        // Yeni araç ekleme
        $tool_name = mysqli_real_escape_string($baglanti, $_POST['tool_name']);
        $description = mysqli_real_escape_string($baglanti, $_POST['description']);

        $insert_query = "INSERT INTO ai_tools (tool_name, description) VALUES ('$tool_name', '$description')";
        if (mysqli_query($baglanti, $insert_query)) {
            echo "Yeni araç başarıyla eklendi.";
        } else {
            echo "Araç eklenirken bir hata oluştu.";
        }
    } elseif (isset($_POST['update_tool'])) {
        // Araç güncelleme
        $tool_id = $_POST['tool_id'];
        $new_tool_name = mysqli_real_escape_string($baglanti, $_POST['new_tool_name']);
        $new_description = mysqli_real_escape_string($baglanti, $_POST['new_description']);

        $update_query = "UPDATE ai_tools SET tool_name='$new_tool_name', description='$new_description' WHERE id='$tool_id'";
        if (mysqli_query($baglanti, $update_query)) {
            echo "Araç başarıyla güncellendi.";
        } else {
            echo "Araç güncellenirken bir hata oluştu.";
        }
    } elseif (isset($_POST['delete_tool'])) {
        // Araç silme
        $tool_id = $_POST['tool_id'];

        $delete_query = "DELETE FROM ai_tools WHERE id='$tool_id'";
        if (mysqli_query($baglanti, $delete_query)) {
            echo "Araç başarıyla silindi.";
        } else {
            echo "Araç silinirken bir hata oluştu.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>AI Araç Yönetimi</title>
</head>
<body>
    <h2>AI Araçları Ekle</h2>
    <form method="POST" action="">
        <label for="tool_name">Araç Adı:</label>
        <input type="text" id="tool_name" name="tool_name" required>
        <br>
        <label for="description">Açıklama:</label>
        <textarea id="description" name="description" required></textarea>
        <br>
        <button type="submit" name="add_tool">Araç Ekle</button>
    </form>

    <h2>AI Araçlarını Görüntüle, Güncelle veya Sil</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Araç Adı</th>
            <th>Açıklama</th>
            <th>İşlem</th>
        </tr>
        <?php foreach ($ai_tools as $tool) { ?>
            <tr>
                <td><?php echo $tool['id']; ?></td>
                <td><?php echo $tool['tool_name']; ?></td>
                <td><?php echo $tool['description']; ?></td>
                <td>
                    <form method="POST" action="">
                        <input type="hidden" name="tool_id" value="<?php echo $tool['id']; ?>">
                        <input type="text" name="new_tool_name" placeholder="Yeni Araç Adı" value="<?php echo $tool['tool_name']; ?>">
                        <textarea name="new_description" placeholder="Yeni Açıklama"><?php echo $tool['description']; ?></textarea>
                        <button type="submit" name="update_tool">Güncelle</button>
                        <button type="submit" name="delete_tool">Sil</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
