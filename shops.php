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
			<a href="auth/index.php">Авторизация</a>
		</div>

		<div id="copy_btn" class="clip_btn" style='margin-RIGHT:10px'>
			<b>Копировать для рассылки</b>
		</div>	
		
		<!-- Secondary menu -->
		<div id="secondarymenu">
			<div class="secondarybutton">
				<p>Вернуться на главную</p>
				<a href="index.php"><img src="images/icon/home.png" alt=""></a>
			</div>
			<div class="secondarybutton">
				<p>Добавить магазин</p>
				<a href="add.php"><img src="images/icon/add.png" alt=""></a>
			</div>
			<div class="secondarybutton">
				<p>Удалить магазин</p>
				<a href="test.php?reg="<?php $_GET['reg'] ?>"><img src="images/icon/del.png" alt=""></a>
			</div>
		</div>
		<div class="clear"></div>
		<?php echo "<script> var region = '".$_GET['reg']."'</script>"; ?>



		<label for="capitals">Поиск</label>
		<input size="50" type="text" id="capitals" name="capitals">
		<input type="submit" value="Показать запись">

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
		<div id="kursrate" class="kursrate"></div>
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
			  <br>
			</body>
			</html>