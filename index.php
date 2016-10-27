<?php
$dateTime = new DateTime();

$dateTime->setTimeZone(new DateTimeZone('America/New_York'));
$ny = $dateTime->format('m/d/Y H:i:s');
?>

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
	
	<script>
	jQuery(function () {
	    jQuery('#localClock').clock({
	        graduations: 0,
	        size: 250
	    });
	});
  </script>
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
				<a href="shops.php"><img src="images/icon/news.png" alt=""></a>
			</div>
			<div class="menubutton">
				<p>Магазины</p>
				<img src="images/icon/shop.png" alt="">
			</div>
			<div class="menubutton">
				<p>Контакты ОП</p>
				<img src="images/icon/contactop.png" alt="">			
			</div>
			<div class="menubutton">
				<p>Контакты офиса</p>
				<a href="contact_list.php"><img src="images/icon/contactoffice.png" alt=""></a>	
			</div>
			<div class="menubutton">
				<p>Инструкции</p>
				<img src="images/icon/info.png" alt="">
			</div>
			<div class="menubutton">
				<p>График дежурств</p>
				<img src="images/icon/grafic.png" alt="">
			</div>
			<div class="menubutton">
				<p>Доп. данные</p>
				<img src="images/icon/data.png" alt="">
			</div>
			<div class="menubutton">
				<p>Заявки по офису</p>
				<img src="images/icon/zayavki.png" alt="">
			</div>
			<div class="clear"></div>	
		</div>
	</div>	
</body>
</html>