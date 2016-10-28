<!DOCTYPE html>
<html lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="description" content="Описание сайта">
	<meta name="keywords" content="Ключевые слова">
	<meta name="author" content="Кузьменко Никита Сергеевич" />

	<link rel="shortcut icon" href="" type="image/png">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="css/jqClock.css">

	<script src="js/mainScript.js"></script>
	<script src="js/jquery-2.2.3.min.js"></script>
	<script src="js/jqClock.js"></script>	
	<script src="js/core.js"></script>

	<!-- [if lt IE 9]>
	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<!-- Script for Clock -->
	<script>
		jQuery(function () {
			jQuery('#localClock').clock({
				graduations: 0,
				size: 250
			});
		});
	</script>
	<!-- Style for Clock -->
	<style>
		/*For Clock*/
		#header ul {
			position: relative;
			margin: 0px auto;
			list-style: none outside none;
			width: 250px;
		}
		#header ul li {
			height: 250px;
			width: 250px;
		}

		#localClock .jqc-clock-face{
			background: url("images/clock/localclock.png") no-repeat scroll 0 0 transparent;
		}

		.jqc-clock-sec span {
			background: url("images/clock/seconds.png") no-repeat scroll 0 0 transparent;
			box-shadow: 0 0;
			height: 106px;
			margin-top: 36px;
			width: 4px;
		}
		.jqc-clock-min span {
			background: url("images/clock/minutes.png") no-repeat scroll 0 0 transparent;
			box-shadow: 0 0;
			height: 106px;
			margin-top: 51px;
			width: 6px;
		}
		.jqc-clock-hour span {
			background: url("images/clock/hours.png") no-repeat scroll 0 0 transparent;
			box-shadow: 0 0;
			height: 106px;
			margin-top: 69px;
			width: 10px;    
		}

		.box {
			width:50px;
			height:50px;
			display:inline-block;
			margin:20px;
		}

		#green {
			background-color:green;
		}

		#style {
			background-color:green;
		}
	</style>

	<title>Welcome to the 110 website</title>
</head>
<body>
<!-- Проверка на запрещенный в России браузер -->
	<!-- Усли это действительно тот браузер, о котором нельзя говорить, то покажем ... -->
	<?php if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') ) { ?>
	<div id="old-browser">
		<div class="info">Вы используете устаревшую версию браузера. <br> Обновите
			Ваш браузер или установите нормальный и современный<br>
			<a href="https://www.google.com/chrome/browser/desktop/index.html">Google Chrome</a><br>
			<a href="https://www.mozilla.org/ru/firefox/new/">Mozilla Firefox</a><br>
			<a href="http://www.opera.com/ru/computer/windows">Opera</a><br>
			для лучшего отображения данного сайта.
		</div>
	</div>
	<!-- Иначе все ок -->
	<?php } else {?>

	<div id="main">
		<div id="header">
			<ul>
				<li id="localClock"></li>
			</ul>
			<!-- <div class="logo"></div> -->
			<div class="serch">
				<form action="https://www.google.ru/" method="GET">
					<label for=""></label>
					<input type="text" name="q">
					<input type="submit" value="Serch">
				</form>
			</div>
		</div>

		<div id="menu">
			<div class="menubutton">
				<p>Новости/Радио</p>
				<a href="#"><img src="images/icon/news.png" alt=""></a>
			</div>
			<div class="menubutton">
				<p>Магазины</p>
				<a href="shops.php"><img src="images/icon/news.png" alt=""></a>
				<img src="images/icon/shop.png" alt="">
			</div>
			<div class="menubutton">
				<p>Контакты ОП</p>
				<a href="#"><img src="images/icon/contactop.png" alt=""></a>
			</div>
			<div class="menubutton">
				<p>Контакты офиса</p>
				<a href="contact_list.php"><img src="images/icon/contactoffice.png" alt=""></a>	
			</div>
			<div class="menubutton">
				<p>Инструкции</p>
				<a href="#"><img src="images/icon/info.png" alt=""></a>
			</div>
			<div class="menubutton">
				<p>График дежурств</p>
				<a href="#"><img src="images/icon/grafic.png" alt=""></a>
			</div>
			<div class="menubutton">
				<p>Доп. данные</p>
				<a href="#"><img src="images/icon/data.png" alt=""></a>
			</div>
			<div class="menubutton">
				<p>Заявки по офису</p>
				<a href="#"><img src="images/icon/zayavki.png" alt=""></a>
			</div>
			<div class="clear"></div>	
		</div>
	</div>	
	<?php } ?>
</body>
</html>