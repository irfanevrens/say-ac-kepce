<!DOCTYPE h3 PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

	<head>
	
		<title>Say.ac Kepçe (Captcha) Uygulaması</title>
		
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	</head>

	<body>

		<h3>Üye Girişi</h3>
		
		{if $tamam}
		
			Tamam: {$tamam}
			
			<br />
			<br />
			
		{else}
		
			{if $hata}
			
				Hata: {$hata}
				
				<br />
				<br />
			
			{/if}
	
			<form action="test.php" method="post">
			
				Güvenlik Kodu Giriniz: <input type="text" name="guvenlik_kodu" value="{$guvenlik_kodu}" />
				
				<br />
				<br />
				
				<img src="guvenlik_kodu.php" />
				
				<br />
				<br />
				
				<input type="submit" value="Giriş Yap" />
			
			</form>
		
		{/if}

	</body>

</html>