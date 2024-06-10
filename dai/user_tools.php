<?php
include 'header.php';
session_start();
include 'connect.php';




// AI Araçları getirme
$query = "SELECT * FROM ai_tools";
$result = mysqli_query($baglanti, $query);
$ai_tools = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>AI Araçları</title>
</head>
<body>
    <h2 style="color:white;">AI Araçları</h2>
    <table border="1">
        <tr>
            <th style="color:white;">ID</th>
            <th style="color:white;">Araç Adı</th>
            <th style="color:white;">Açıklama</th>
        </tr>
        <?php foreach ($ai_tools as $tool) { ?>
            <tr>
                <td style="color:white;"><?php echo $tool['id']; ?></td>
                <td style="color:white;"><?php echo $tool['tool_name']; ?></td>
                <td style="color:white;"><?php echo $tool['description']; ?></td>
            </tr>
        <?php } ?>
    </table>
    <li class="nav-item">
                <a class="nav-link" href="admin_tools.php"> Yeni ekle</a>
              </li>
</body>
</html>
