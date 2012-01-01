<?php 

// oturum nesnesini kullanmamız gerektiği için ilk önce oturumu 
// başlatmamız gerekmektedir. oturum nesnesi ile birden fazla 
// sayfa arasında bilgi alışverişini arka planda güvenli bir şekilde 
// sağlayabiliriz.
session_start();

// bu satırda uygulamanın bulunduğu dizinin kök klasör yolunu 
// bulmamız içindir. bu satır ile elde edilen sonuç gelecek 
// satırlarda kullanılacaktır.
define('URL_ROOT_0', dirname(realpath(__FILE__)));

// bu satır kullanacağımız tema klasörünü temsil etmektedir.
define('URL_ROOT_1', URL_ROOT_0 . '/temalar/basit');

// bu satır smarty tarafından derlenmiş (compile) dosyaları
// içine kaydettiği klasörü temsil etmektedir.
define('URL_ROOT_2', URL_ROOT_0 . '/temalar_c');

// şablon (template) motorunu sayfamıza dahil ediyoruz.
// smarty hakkında detaylı bilgi;
// http://www.smarty.net/docs/en/
require_once URL_ROOT_0 . '/kutuphaneler/smarty317/Smarty.class.php';

// smarty sınıfından bir nesne oluşturalım
$smarty = new Smarty();

// smarty için ilk ayarları yapalım, burada öncelikle şablon 
// dizini ayarlanıyor, sonra da derlenmiş dosyaların koyulacağı 
// dizin ayarlanıyor
$smarty->setTemplateDir(URL_ROOT_1)
	   ->setCompileDir(URL_ROOT_2);

// bu kısım şablonlarda kullanacağımız değişkenleri göstermektedir.
// bu değişkenleri burada boş olarak tanımlıyoruz.
$smarty->assign('hata', '');
$smarty->assign('tamam', '');
$smarty->assign('guvenlik_kodu', '');
	   
// bir form gönderme işlemi yapılmış mı?
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	// evet, bir form gönderme işlemi yapılmış
	
	// formdan kullanıcının girdiği form elemanını alalım
	$guvenlik_kodu = trim($_POST['guvenlik_kodu']);
	
	// hata denetimine başlayalım
	try {
		
		// güvenlik kodu hatalı girilmiş ise hata mesajını fırlatalım
		if ($guvenlik_kodu != $_SESSION['guvenlik_kodu']) throw new Exception('Güvenlik kodunu hatalı girdiniz. Lütfen yeniden deneyiniz.');
	
		// eğer yukarıdaki satırlarda bir hata fırlatılmadıysa bu satıra 
		// geleceğiz. bu durumda gerekli güvenlik aşaması geçilmiş anlamındadır
		// bundan sonra istenildiği gibi hareket edilebilir. güvenlik kodu kontrollü 
		// bir şekilde geçilmiş oldu.
		$smarty->assign('tamam', 'Güvenlik kodunu doğru girdiniz. Tebrikler. Yeniden <a href="test.php">dene</a>');
		
	// istisna (exception) fırlatılırsa yakalayalım
	} catch (Exception $ex) {
	
		// ekranda göstermek üzere hata mesajını smarty'e verelim
		$smarty->assign('hata', $ex->getMessage());
	}
}

// şablon sayfamızı ekranda gösterelim
echo $smarty->fetch('test.tpl');