<?php

// bu satır önemlidir. oturum başlatmak zorunludur.
// oluşturulan güvenlik kodu oturumda saklanarak 
// sayfalar arası iletişimi sağlama konusunda bize 
// çözüm sunmaktadır. biz işte bu çözümü kullanarak 
// güvenlik kodu uygulaması yazabiliriz. detaylı bilgi için
// http://www.php.net/manual/tr/function.session-start.php
session_start();

// bu satırda güvenlik kodumuzu oluşturuyoruz. burada 
// dikkat edilmesi gereken şey, ne çok uzun ne de çok 
// kısa bir kod üretilmelidir. 5 karakterli kod yeterli 
// olacaktır, basit spam botlarını devre dışı bırakması 
// bize yeterli olacaktır. bir banka uygulaması gibi 
// güvenliğin ön planda tutulması gereken uygulamalarda 
// bu güvenlik kodu üzerinde ayrı bir çalışma gerekecektir.
// burada kullanılan mt_rand fonksiyonu belli bir aralıkda 
// sayı üretmek için kullanılmaktadır. detaylı bilgi için
// http://www.php.net/manual/tr/function.mt-rand.php
$guvenlik_kodu = mt_rand(11111, 99999);

// oluşturduğumuz bu güvenlik kodunu daha önce başlattığımız 
// oturum üzerine kaydediyoruz. böylece burada oluşturulan 
// güvenlik koduna diğer sayfalardan erişebileceğiz.
$_SESSION['guvenlik_kodu'] = $guvenlik_kodu;

// güvenlik kodunu ekrana basmak için bir font belirlememiz 
// gerekiyor. burada kullanılan font önemlidir. fontların 
// basit olmamasına ve de çok fazla karmaşık olmamasına 
// dikkat edilmelidir. hedef kitlemize uygun bir font seçebiliriz. 
// font seçimi de güvenlik kodu oluşturmak gibidir. bir banka 
// uygulamasında kullanılan font'un daha karmaşık bir yazı 
// stili olmalı. böylece spam botları daha iyi engelleyebilir.
$font = 'fontlar/jstart.ttf';

// güvenlik kodumuzun genişliğini ve yüksekliğini düşünerek 
// bir genişlik belirliyoruz. bu kısım test aşamasında isteğe 
// göre ayarlanarak oluşturulan güvenlik kodunun tam görünmesi 
// sağlanabilir. detaylı bilgi almak için
// http://www.php.net/manual/tr/function.imagecreatetruecolor.php
$resim = imagecreatetruecolor(100, 40);

// oluşturduğumuz resim nesnesinden beyaz rengini elde ediyoruz.
// bu rengi, ekrana güvenlik kodunu yazmak için kullanacağız. 
// detaylı bilgi almak için
// http://www.php.net/manual/tr/function.imagecolorallocate.php
$white = imagecolorallocate($resim, 255, 255, 255);

// resim nesnemizin üzerine oluşturduğumuz güvenlik kodunu 
// ilgili fontumuzu kullanarak ve belli bir ebat dikkate alınarak 
// yazdırıyoruz. bu fonksiyon hakkında detaylı bilgi almak için
// http://www.php.net/manual/tr/function.imagefttext.php
imagefttext($resim, 20, 0, 10, 28, $white, $font, $guvenlik_kodu);

// güvenlik kodumuzu ekrana resim olarak basmamız için burada 
// gerekli başlık (header) bilgilerini tanımlıyoruz. cache yapmaması
// için ikinci bir başlık (header) bilgisi tanımlanmaktadır. 
// detaylı bilgi için
// http://www.php.net/manual/tr/function.header.php
header('Content-type: image/png');
header('Cache-Control: max-age=1, must-revalidate');

// oluşturduğumuz ve üzerine güvenlik kodumuzu ekrana basmak 
// için gönderiyoruz. detaylı bilgi için
// http://www.php.net/manual/tr/function.imagepng.php
imagepng($resim);

// resim nesnemizi yok ederek hafızadan tasarruf ediyoruz ve 
// font kullanımını da serbest bırakacağız böylece
imagedestroy($resim);