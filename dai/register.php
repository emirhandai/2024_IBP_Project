<?php
include("connect.php"); // Veritabanı bağlantısını sağlayan dosyayı dahil ediyoruz

if(isset($_POST["register"])){
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $password = $_POST["password"];
    $mail = $_POST["mail"];

    // Şifreyi kripto şifreye dönüştürme
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Kullanıcıyı veritabanına ekleme
    $ekle = "INSERT INTO qp_users (firstname, lastname, password, mail) VALUES ('$firstname','$lastname','$hashed_password','$mail')";
    $calistirekle = mysqli_query($baglanti, $ekle);
    if($calistirekle){
        echo '<div class="alert alert-success" role="alert">Kayıt Olma İşlemi Başarılı</div>';
        header('location: ./index2.php');
        exit; // İşlemi sonlandırıyoruz
    } else {
        echo'<div class="alert alert-danger" role="alert">Kayıt Olma İşlemi Başarısız</div>';
    }
}

mysqli_close($baglanti);
?>



<!DOCTYPE html>
<html lang="tr">
<head>
  <!-- Basic -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="images/dai.png" type="">

  <title> Dai | Kullanıcı Giriş </title>

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
<body class="hold-transition register-page">
<form action="register.php" method="POST">
<div class="register-box">
    
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Dai</b>Kayıt<b>Ol</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Yeni bir hesap oluştur</p>

      <form action="../../index.html" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="firstname" placeholder="İsim" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="lastname" placeholder="Soyisim" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="mail" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Şifre" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row">
        
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block" name="register">Kayıt Ol</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


      <a href="login.php" class="text-center">Zaten Bir Hesaba Sahibim</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
