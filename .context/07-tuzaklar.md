# Tuzaklar

> ÜRETİLDİ — lint / tip / test YAPILANDIRMA dosyalarından ÇIKARILDI.
> Buradaki her satır bir KURALDIR: ihlal eden yama doğrulama
> zincirinde DÜŞER. Tavsiye ya da genel iyi uygulama YOKTUR.

- Ölçülebilir kural bulunamadı: depo lint/tip/test yapılandırma dosyası TAŞIMIYOR. Bu bir 'kural yok' BEYANI DEĞİL, bir ölçüm sınırıdır.
- `dai/data/class.php` içinde oturum kontrolü `header('location ./login.php')` çağırır (ÖLÇÜLDÜ, satır 17): `Location` küçük harfle ve değer string birleşimiyle yazılmıştır; bu satırı davranış değiştirmeden düzenlemek istiyorsan önce dosyadaki diğer `header()` çağrılarıyla tutarlılığı kontrol et.
- `dai/connect.php` bağlantı bilgilerini (host=localhost, db=admin, user=root, şifre boş) düz metin olarak koda gömer (ÖLÇÜLDÜ); bu dosyaya dokunan bir yama ortam değişkeni/config dosyası icat ETMEMELİ, zira depoda böyle bir katman YOKTUR.
