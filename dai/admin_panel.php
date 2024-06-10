<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="images/dai.png" type="">

  <title> Dynamic Artificial Intelligence </title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

</head>
<?php
session_start();
include 'connect.php'; // Veritabanı bağlantı dosyasını dahil edin

// Kullanıcı oturumu kontrolü ve admin rolü kontrolü


// Kullanıcıları getir
$query = "SELECT * FROM qp_users";
$result = mysqli_query($baglanti, $query);

// Veritabanı sorgusu başarısızsa hata iletisi göster
if (!$result) {
    die("Veritabanı sorgusu başarısız: " . mysqli_error($baglanti));
}

$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_user'])) {
        // Yeni kullanıcı ekleme işlemi
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $mail = mysqli_real_escape_string($baglanti, $_POST['mail']);
        $password = password_hash(mysqli_real_escape_string($baglanti, $_POST['password']), PASSWORD_DEFAULT);
        $role = $_POST['role'];

        $insert_query = "INSERT INTO qp_users (firstname, lastname, mail, password, role) VALUES ('$firstname', '$lastname', '$mail', '$password', '$role')";
        if (mysqli_query($baglanti, $insert_query)) {
            echo "Yeni kullanıcı başarıyla eklendi.";
        } else {
            echo "Kullanıcı eklenirken bir hata oluştu: " . mysqli_error($baglanti);
        }
    } elseif (isset($_POST['update_user'])) {
        // Kullanıcı güncelleme işlemi
        $user_id = $_POST['user_id'];
        $new_mail = mysqli_real_escape_string($baglanti, $_POST['new_mail']);
        $new_password = password_hash(mysqli_real_escape_string($baglanti, $_POST['new_password']), PASSWORD_DEFAULT);
        $role = $_POST['role'];

        $update_query = "UPDATE qp_users SET mail='$new_mail', password='$new_password', role='$role' WHERE user_id='$user_id'";
        if (mysqli_query($baglanti, $update_query)) {
            echo "Kullanıcı bilgileri başarıyla güncellendi.";
        } else {
            echo "Kullanıcı güncellenirken bir hata oluştu: " . mysqli_error($baglanti);
        }
    } elseif (isset($_POST['delete_user'])) {
        // Kullanıcı silme işlemi
        $user_id = $_POST['user_id'];

        $delete_query = "DELETE FROM qp_users WHERE user_id='$user_id'";
        if (mysqli_query($baglanti, $delete_query)) {
            echo "Kullanıcı başarıyla silindi.";
        } else {
            echo "Kullanıcı silinirken bir hata oluştu: " . mysqli_error($baglanti);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kullanıcı Yönetimi</title>
</head>
<body>

<div class="hero_area">

  <div class="hero_bg_box">
    <div class="bg_img_box">
      <img src="images/hero-bg.png" alt="">
    </div>
  </div>

  <!-- header section strats -->
  <header class="header_section">
    <div class="container-fluid">
      <nav class="navbar navbar-expand-lg custom_nav-container ">
        <a class="navbar-brand" href="index2.php">
          <span>
          Dynamic Artificial Intelligence
          </span>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class=""> </span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav  ">
            <li class="nav-item active">
              <a class="nav-link" href="index2.php">Ana Menü <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about2.php"> Hakkımızda</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="user_tools2.php"> Yapay Zeka Araçları</a>
              </li>
            <li class="nav-item">
            <a class="nav-link" href="duyurular2.php"> Duyurular</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="profil.php"> <i class="fa fa-user" aria-hidden="true"></i> Profil</a>
            </li>
            <form class="form-inline">
              <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                <i class="fa fa-search" aria-hidden="true"></i>
              </button>
            </form>
          </ul>
        </div>
      </nav>
    </div>
  </header>
    <h2>Kullanıcı Ekle</h2>
    <form method="POST" action="">
        <label for="firstname">İsim:</label>
        <input type="firstname" id="firstname" name="firstname" required>
        <br>
        <label for="lastname">Soyisim:</label>
        <input type="lastname" id="lastname" name="lastname" required>
        <br>
        <label for="mail">E-mail:</label>
        <input type="text" id="mail" name="mail" required>
        <br>
        <label for="password">Şifre:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <label for="role">Rol:</label>
        <select name="role" id="role">
            <option value="0">Standart Kullanıcı</option>
            <option value="1">Admin</option>
        </select>
        <br>
        <button type="submit" name="add_user">Kullanıcı Ekle</button>
    </form>

    <h2>Kullanıcıları Görüntüle, Güncelle veya Sil</h2>
    <table border="1">
        <tr>
            <th>Kullanıcı Adı</th>
            <th>Rol</th>
            <th>İşlem</th>
        </tr>
        <?php foreach ($users as $user) { ?>
            <tr>
                <td><?php echo $user['mail']; ?></td>
                <td><?php echo ($user['role'] == 1) ? 'Admin' : 'Standart Kullanıcı'; ?></td>
                <td>
                    <form method="POST" action="">
                        <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                        <input type="text" name="new_mail" placeholder="Yeni e-mail">
                        <input type="password" name="new_password" placeholder="Yeni Şifre">
                        <select name="role" id="role">
                            <option value="0">Standart Kullanıcı</option>
                            <option value="1">Admin</option>
                        </select>
                        <button type="submit" name="update_user">Güncelle</button>
                        <button type="submit" name="delete_user">Sil</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
    <li class="nav-item">
                <a class="nav-link" href="admin_user.php"> <i class="fa fa-user" aria-hidden="true"></i> Gelen Mesajlar</a>
              </li>
</body>
</html>
