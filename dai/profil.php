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
            <li class="nav-item ">
              <a class="nav-link" href="index2.php">Ana Menü<span class="sr-only">(current)</span></a>
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
            <li class="nav-item active">
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
  <!-- end header section -->
  
  <div class="container">
    <?php 
    session_start();
    include 'connect.php'; // Veritabanı bağlantı dosyasını dahil edin

    if(isset($_SESSION["mail"])){
        echo "<h3>".$_SESSION["firstname"]." Hoşgeldin</h3>";
        echo "<h3>".$_SESSION["mail"]."</h3>";
    } else {
        echo "<p>Bu sayfayı görüntüleme yetkiniz yok. Lütfen giriş yapın.</p>";
        exit(); // Eğer oturum yoksa sayfanın devamını yüklemeyi durdur
    }

    // Kullanıcının mesajlarını ve admin cevaplarını getirme
    $user_id = $_SESSION["user_id"];
    $query = "SELECT * FROM messages WHERE user_id = '$user_id'";
    $result = mysqli_query($baglanti, $query);
    ?>

    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link" href="send_message.php">Admine Mesaj Gönder</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="user_admin.php">Gelen Mesajlar</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="update_password.php">Şifre Güncelle</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Çıkış Yap</a>
      </li>
    </ul>

    <h2 style="color:white;">Admine Gönderilen Mesajlar ve Cevaplar</h2>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th style="color:white;">Mesaj</th>
          <th style="color:white;">Admin Cevabı</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        while($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>" . $row['message'] . "</td>";
          echo "<td>" . (!empty($row['admin_reply']) ? $row['admin_reply'] : 'Henüz cevaplanmadı') . "</td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

</div>

<!-- jQuery -->
<script src="js/jquery-3.4.1.min.js"></script>
<!-- bootstrap js -->
<script src="js/bootstrap.js"></script>
<!-- custom js -->
<script src="js/custom.js"></script>
</body>
</html>
