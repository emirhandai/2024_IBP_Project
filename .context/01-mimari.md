# Mimari

> ÜRETİLDİ (baglam-tazeleme) — kod içeriğinden ÖLÇÜLMÜŞ olgular.

- Kök dizin tek bir uygulama klasörü içerir: `dai/`. Kök seviyede `package.json`,
  `composer.json` ya da benzer bir bağımlılık/derleme manifestosu YOKTUR (ÖLÇÜLDÜ:
  bulunamadı).
- Sunucu tarafı: düz PHP (framework yok, router yok). Her `.php` dosyası bir
  sayfa/uç noktadır; sayfalar `include_once` ile `header.php` / `footer.php` /
  `init.php` parçalarını birleştirir (örnek: `dai/index.php` sadece
  `header.php`, `slider.php`, `footer.php`'i include eder).
- Veritabanı erişimi iki paralel katmanda yapılır:
  - `dai/connect.php`: ham `mysqli_connect` ile doğrudan bağlantı
    (host=localhost, db=admin, user=root, şifre boş).
  - `dai/data/class.php` (`AdminClass`) ve `dai/data/class.users.php`
    (`AdminUsersClass`): `PDO` ile aynı `admin` veritabanına bağlanan iki ayrı
    sınıf. Her ikisi de bağlantı bilgilerini (host/db/user/pass) kendi içinde
    tekrar tanımlar — ortak bir config/DI katmanı YOKTUR.
- Kimlik doğrulama `$_SESSION` üzerinden yürütülür (`login`, `mail`,
  `user_id`, `role`, `firstname`, `lastname`). `dai/login.php` şifreyi
  `password_verify` ile doğrular, `role == 1` olan kullanıcıyı
  `admin_panel.php`'e, diğerlerini `index2.php`'e yönlendirir.
  `AdminClass::__construct` oturum yoksa `header('location ./login.php')`
  çağırır (ÖLÇÜLDÜ: `location` küçük harfli ve değer string birleşimiyle
  yazılmış — büyük/küçük harf veya boşluk farkı tarayıcıya göre yönlendirmeyi
  etkisiz kılabilir, bkz. `dai/data/class.php`).
- Girdi temizleme merkezi değildir: her iki sınıfta tekrarlanan
  `getSecurity()` metodu `htmlspecialchars` + `stripslashes` uygular; SQL
  tarafı `pdoInsert()` üzerinden hazırlanmış ifadelerle (`prepare`/`execute`)
  çalışır, ancak her sayfa bunu çağırıp çağırmamakta özgürdür (merkezi bir
  giriş noktası/middleware YOKTUR).
- İstemci tarafı kod tabanının büyük çoğunluğu (ÖLÇÜLDÜ: 934 js dosyasının
  neredeyse tamamı) `dai/plugins/` ve `dai/dist/` altında vendor olarak
  taşınan üçüncü taraf kütüphanelerdir (bootstrap, jquery, datatables,
  select2, summernote, chart.js, vb. — bir AdminLTE şablonu seti). Bunlar
  elle yazılmış uygulama kodu DEĞİLDİR; proje dilinin "javascript" olarak
  ölçülmesinin sebebi budur, asıl iş mantığı PHP tarafındadır (33 dosya).
- `dai/pages/` altındaki `.html` dosyaları (örn. `calendar.html`,
  `widgets.html`, `kanban.html`) şablon galerisinden kalan statik örnek
  sayfalardır; uygulamanın asıl akışına `include_once` ile bağlanmazlar
  (ÖLÇÜLDÜ: `index.php`/`admin_panel.php` bu dosyaları referans etmez).
- Derleme/paketleme adımı YOKTUR: CSS/JS dosyaları `dai/css`, `dai/js`,
  `dai/dist`, `dai/plugins` altında doğrudan statik olarak servis edilir
  (bundler/transpiler yapılandırması ölçülemedi).

Varsayım: Dosya içerikleri yalnızca örnekleme amaçlı okundu (tüm 33 PHP
dosyası tek tek incelenmedi); yukarıdaki tespitler incelenen dosyalarda
(connect.php, init.php, login.php, index.php, header.php, admin_panel.php,
data/class.php, data/class.users.php) gözlenen desenlerin genellemesidir.
