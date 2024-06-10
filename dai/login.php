<?php
session_start();
ob_start();
include_once 'data/class.users.php';
$app = new AdminUsersClass();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $mail = trim($app->getSecurity($_POST['mail']));
    $password = trim($app->getSecurity($_POST['password']));

    if (empty($mail) || empty($password)) {
        print '<div class="alert alert-danger">Boş alan bırakmayınız</div>';
    } else {
        $users = $app->getUser($mail);
        if (isset($users['password'])) {
            if (password_verify($password, $users['password'])) {
                $_SESSION['login'] = true;
                $_SESSION['mail'] = $users['mail'];
                $_SESSION['firstname'] = $users['firstname'];
                $_SESSION['lastname'] = $users['lastname'];
                $_SESSION['user_id'] = $users['user_id'];
                $_SESSION['role'] = $users['role'];

                if ($users['role'] == 1) {
                    // Admin ise admin paneline yönlendir
                    $_SESSION['admin_id'] = $users['user_id'];
                    header('Location: ./admin_panel.php');
                } else {
                    // Kullanıcı ise kullanıcı paneline yönlendir
                    header('Location: ./index2.php');
                }
                exit();
            } else {
                print '<div class="alert alert-danger">Bilgileriniz yanlış</div>';
            }
        } else {
            print '<div class="alert alert-danger">Bilgileriniz yanlış</div>';
        }
    }
}
?>

<!DOCTYPE html>
<html>

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
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.php" class="h1"><b>Dai</b>Kullanıcı<b>Giriş</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Lütfen Oturum Açınız</p>

      <form method="post" action="">
        <input type="hidden" name="login" value="1">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="mail" placeholder="Mailiniz" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Şifreniz" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Beni Hatırla
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Giriş Yap</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-1">
        <a href="forgot-password.html">Şifremi unuttum</a>
      </p>
      <p class="mb-0">
        <a href="register.php" class="text-center">Yeni Hesap Aç</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
