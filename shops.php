<?php
	include ('db.php'); //подключение к БД
	include ('functions.php');	
	?>


	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="description" content="Описание сайта">
		<meta name="keywords" content="Ключевые слова">
		<meta name="author" content="Кузьменко Никита Сергеевич" />

		<link rel="shortcut icon" href="" type="image/png">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/jqClock.css">
		<link rel="stylesheet" type="text/css" href="css/digital-clock.css" />
		<link rel="stylesheet" type="text/css" href="css/main.css" />

		<script src="js/mainScript.js"></script>
		<script src="js/jquery-2.2.3.min.js"></script>
		<script src="js/jqClock.js"></script>	
		<script src="js/core.js"></script>
		<script src="js/digital_clock.js"></script>

		<style type="text/css">
			.kursrate {
				margin-top: -50px;
				margin-left: 20px;
			}
			.clip_btn {
				width:200px; 
				text-align:center;
				border:1px solid black; 
				background-color:#ccc;
				padding:1px;
			}
			.clip_btn.hover { 
				background-color:#eee; 
			}
			.clip_btn.active { 
				background-color:#aaa; 
			}
		</style>
	</head>
	<body>	
		<div class="time"></div>


		<!-- Проверка на JavaScript -->
		<div id="noscript" style='margin-left:20px' class="error">
			Пожалуйста, включите JavaScript! 
			<a href="javascript_on.html">Как?</a>
		</div>
		<script language="JavaScript">
			$('#noscript').hide();
		</script>
		<!-- Проверка на JavaScript end -->
		
		<div class="auth">
			<a href="auth/index.php"><b>Авторизация</b></a>
		</div>

		<div id="copy_btn" class="clip_btn" style='margin-RIGHT:10px'>
			<b>Копировать для рассылки</b>
		</div>



		<table ALIGN=CENTER border="1">
			<tr><td>
				<form name="clockexam" ><input type="text" style="font-size: 20px; font-weight: bold; text-indent: 10px;" size="9" name="clock"></form> 
			</td></tr>
		</table>
		<!--   ******************                                                      -->

		<?php

		echo "";

		echo "<script> var region = '".$_GET['reg']."'	</script>";
		echo "<br>";

		echo "<table cellpadding='10' ALIGN=CENTER>
		<tr>
			<td>
				<table style='margin:0 auto;
				width: 100%;					
				background: none repeat scroll 0 0 #FFFFCC;
				border: 3px double #CC9933;
				border-radius: 5px;'>
				<tr>

					<td><a href='add.php'>Добавить магазин</a>&nbsp;&nbsp;</td>

					<td><a href='test.php?reg=".$_GET['reg']."'>Удаление магазина</a>&nbsp;&nbsp;</td>
					<td><a href='updateall.php?reg=".$_GET['reg']."'>Изменить магазин</a>&nbsp;&nbsp;</td>
				</tr>
			</table>

		</td>
	</tr>";
	echo '
	<tr>
		<td>
			<div id="wrapper" ALIGN=CENTER>
				<form for="capitals" method="post" action="actt.php" ALIGN=CENTER> 
					<label for="capitals">Поиск</label>
					<input size="50" type="text" id="capitals" name="capitals">
					<input type="submit" value="Показать запись">
				</form>
			</div>
		</td>
	</tr></table>'; ?>
	<script>
		(function($) {
			$(function() {
				$("#blockajax").load("grafik.php");
			})
		})(jQuery)
	</script>
	<script>
		(function($) {
			$(function() {
				$("#kursrate").load("kursrate/index.php");
			})
		})(jQuery)
	</script>
	<div style = "margin-top: -70; margin-left: 20; height: 73px;" id="kursrate" class="kursrate"></div>
	<div id="blockajax"></div>
	<script type="text/javascript" src="zeroclipboard/ZeroClipboard.js"></script>
	<script language="JavaScript">
		var clip = null;
		function init() {
			clip = new ZeroClipboard.Client();
			clip.setHandCursor( true );
			clip.addEventListener('load', function (client) {});
			clip.addEventListener('mouseOver', function (client) {clip.setText(str);});
			clip.addEventListener('complete', function (client, text) {});
			clip.glue( 'copy_btn' );
		}
	</script>

	<?php		
		get_region(); //Выводми список регионов из функцией
		$srt = "";
		
		if($_GET['serch'] == 1)
		{
			serch_magazine();
			$str = '&serch=1';
			mysql_close($link);
		}
		if($_GET['serch'] == 2)
		{
			fr_magazine();
			$str = '&serch=2';
			mysql_close($link);
		}	
		if($_GET['serch'] == 3)
		{
			chek_magazine();
			$str = '&serch=3';
			mysql_close($link);
		}
		if($_GET['serch'] == 4)
		{
			online_magazine();
			$str = '&serch=3';
			mysql_close($link);
		}
		if($_GET['serch'] == 5)
		{
			online_magazine_end();
			$str = '&serch=3';
			mysql_close($link);
		}
		else
		{			
			get_list_magazine();
			mysql_close($link);
		}
		
		
		// Закрываем соединение
		//mysql_close($link);
			// Выводим результаты в html
			//$line = mysql_fetch_array($result);
			//echo "<table>\n";
			//while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {

			//	echo "\t<tr>\n";
			//	echo "<br>имя = ".$line['name']."<br>";

			//    foreach ($line as $col_value) {

			//        echo "\t\t<td>$col_value</td>\n";
			//    }
			//    echo "\t</tr>\n";
			//}
			//echo "</table>\n";
			// Выполняем SQL-запрос		


			//$query = 'INSERT INTO magazin.test (id ,
			//kk ,
			//oiop 
			//)
			//VALUES (NULL , "тест", "тестирование")';
		//echo "<meta http-equiv='Refresh' content='10; url='/index.php?reg=".$reg."' />"; //автообновление страницы каждые 15с
		mysql_close($link);
		?>

				<!-- 	
	<script language="JavaScript" type="text/javascript">
	
				function GoNah(){ 
				var serch = "<?php// echo $str?>";
				 location="/index.php?reg="+region+"&GMT="+GMT+serch; 
				} 
				setTimeout( "GoNah()", 60000 ); 
				
			  </script>
			  //--> 

			</body>
			</html>

