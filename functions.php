<?php 
	function get_region() {
	$action="shops.php"; //переменная для обновления выбранного из списка регионов
	$sql = 'SELECT * FROM region';
	$result_select = mysql_query($sql) or die('Запрос не удался: ' . mysql_error());
?>	
	<form action=<? echo $action; ?> method=GET >
		<?php
		/*Выпадающий список*/
			echo "<br>";
			echo "<select name = 'reg' style='margin-left:20px'>";
			while($object = mysql_fetch_object($result_select))
			{ 
				echo "<option value = '$object->name' > $object->name </option>"; 
			}
			echo "</select>";
		?>
	<INPUT TYPE=submit class=button VALUE="Выбрать">
	</form>
<?php }
	function get_list_magazine() {
		$GMT = 7;
		if($_GET['reg']){
			$reg=$_GET['reg'];
			$q = "SELECT GMT FROM region WHERE name='".$reg."'";
			$res = mysql_query($q) or die('Запрос не удался: ' . mysql_error());
			if($res)
			{
				$GMT_res = mysql_fetch_array($res);
				$GMT = $GMT_res['GMT'];
			}
		}
		echo "<p style='margin-left:20px'>".$reg."</p>"; //Вывод региона
		if($reg == "" || $reg == "Все" ||  $reg == "it-отдел")
		{
			$query = 'SELECT * FROM mag order by name';
		}
		else
		{
			$query = "SELECT * FROM mag WHERE region='".$reg."' order by number";
			//$query = "SELECT * FROM mag WHERE name LIKE '".$reg."%'";
		}
		$result = mysql_query($query) or die('Запрос не удался: ' . mysql_error());
		echo "<script> var GMT = '".$GMT."'	</script>";
		if($result)
		{
		  // Определяем таблицу и заголовок
		  echo "<table border='1' cellspacing='0' cellpadding='5' style='margin-left:20px' width = 97%>";
		  echo "
			<tr>
				<td ALIGN=CENTER>Код</td>
				<td ALIGN=CENTER>Префикс</td>
				<td ALIGN=CENTER>Название</td>
				<td ALIGN=CENTER>Регион</td>
				<td ALIGN=CENTER>Телефон</td>
				<td ALIGN=CENTER>Team Viewer</td>
				<td ALIGN=CENTER>icq</td>
				<td ALIGN=CENTER>Почта</td>
				<td ALIGN=CENTER width = 32px>Настроен</td>
				<td ALIGN=CENTER width = 32px>2-ой ФР</td>
				<td ALIGN=CENTER width = 32px>Online</td>
				<td ALIGN=CENTER>Изменить</td>
			</tr>";
		  // Так как запрос возвращает несколько строк, применяем цикл
		  $str_mail = "";
		  while($author = mysql_fetch_array($result))
		  {
			if ($author['mail'] != "")
			{
				$str_mail .= $author['mail'].",";
			}
			$checked = "";
			$checked_fr = "";
			$checked_online = "";
			if($author['chek'])
			{
					$checked = "checked";
			}
			if($author['fr'])
			{
					//echo $author['fr'];
					$checked_fr = "checked";
			}
			if($author['online'])
			{
					$checked_online = "checked";
			}			
			echo "<tr class='storepos'>
			<td ALIGN=CENTER>".$author['kod']."&nbsp;</td>
			<td ALIGN=CENTER>".$author['pref']."&nbsp </td>
			<td><a href='actt.php?name=".$author['name']."'>".$author['name']."&nbsp;</td>
			<td ALIGN=CENTER>".$author['region']."&nbsp;</td>
			<td>".$author['tel']."&nbsp;</td>
			<td>".$author['teamviewer']."&nbsp;</td>			
			<td ALIGN=CENTER>".$author['icq']."&nbsp;</td>
			<td ALIGN=CENTER>".$author['mail']."&nbsp;</td>
			<td ALIGN=CENTER><input type='checkbox' id = '".$author['id']."'   onchange = 'showOrHide(".$author['id'].")' ".$checked."></td>
			<td ALIGN=CENTER><input type='checkbox' name = '".$author['id']."' id = '".$author['id']."12'   onchange = 'showOrHidefr(".$author['id']."12)' ".$checked_fr."></td>
			<td ALIGN=CENTER><input type='checkbox' name = '".$author['id']."' id = '".$author['id']."14'   onchange = 'showOrHideOnline(".$author['id']."14)' ".$checked_online."></td>
			<td ALIGN=CENTER>
				<form method='post' action='updateall.php'>
					<input type='hidden' name='update' value='".$author['id']."' />
					<input type='hidden' name='region' value='".$reg."' />
					<input type='submit' name='".$author['id']."' value='Изменить'>
				</form>
			</td>
			</tr>";
		  }
		  echo "</table>";
		  echo "<script> var str = '".mb_substr($str_mail,0,-1)."'	</script>";
		  //----------------  Вывод сотрудников  ------------------------------------------
		  $q_p = "SELECT * FROM peoples WHERE region='".$reg."'";
		  echo "<br>";
			echo "<p align='center'>Сотрудники офиса</p>";
			//Выведем пользователей
			$res_q_p = mysql_query($q_p) or die('Запрос не удался: ' . mysql_error());
			if($res_q_p)
			{
				echo "<table border='1' cellspacing='0' cellpadding='5' align='center' style='margin-left:20px' width = 97%>";
				echo "
				<tr>
					<td ALIGN=CENTER>ФИО</td>
					<td ALIGN=CENTER>Должность</td>
					<td ALIGN=CENTER>Телефон</td>
					<td ALIGN=CENTER>ICQ</td>
					<td ALIGN=CENTER>Почта</td>
					<td ALIGN=CENTER>Skype</td>
					<td ALIGN=CENTER>Изменить</td>
				</tr>";
				while($people_res = mysql_fetch_array($res_q_p))
				{
					echo "<tr>
					<td width = 20%>".$people_res['fio']."&nbsp;</td>
					<td width = 30%>".$people_res['whois']."&nbsp </td>
					<td>".$people_res['tel']."&nbsp;</td>
					<td>".$people_res['icq']."&nbsp;</td>
					<td>".$people_res['mail']."&nbsp;</td>
					<td>".$people_res['skype']."&nbsp;</td>
					<td ALIGN=CENTER>
						<form method='post' action='update_people.php'>
							<input type='hidden' name='update' value='".$people_res['id']."' />
							<input type='hidden' name='region' value='".$reg."' />
							<input type='submit' name='".$people_res['id']."' value='Изменить'>
						</form>
					</td>
					</tr>";
				}
				echo "</table>";
				//-------------------------  ***  ------------------------------------------------------
			}
		}
		else
		{
		  echo "<p><b>Error: ".mysql_error()."</b><p>";
		  exit();
		}
			// Освобождаем память от результата
		mysql_free_result($result);
	}	
	function serch_magazine() {
		$GMT = 7;
		if($_GET['reg']){
			$reg=$_GET['reg'];
			$q = "SELECT GMT FROM region WHERE name='".$reg."'";
			$res = mysql_query($q) or die('Запрос не удался: ' . mysql_error());
			if($res)
			{
				$GMT_res = mysql_fetch_array($res);
				$GMT = $GMT_res['GMT'];
			}
		}
		echo "<script> var GMT = '".$GMT."'	</script>";
		$f = fopen("serch.txt", "r");
		// Читать построчно до конца файла
		//$str = "'";
		while(!feof($f)) { 
			$str = fgets($f);
			$trimmed .= "'".rtrim($str)."',";
		}
		fclose($f);

		$query = "SELECT * FROM mag WHERE name IN (".$trimmed."'reh') ORDER by number";
		//$query = "SELECT * FROM mag WHERE name LIKE '".$reg."%'";
		
		$result = mysql_query($query) or die('Запрос не удался: ' . mysql_error());
		if($result)
		{
		  // Определяем таблицу и заголовок
		  echo "<table border='1' cellspacing='0' cellpadding='5' style='margin-left:20px' width = 97%>";
		  echo "
			<tr>
				<td ALIGN=CENTER>Код</td>
				<td ALIGN=CENTER>Префикс</td>
				<td ALIGN=CENTER>Название</td>
				<td ALIGN=CENTER>Регион</td>
				<td ALIGN=CENTER>Телефон</td>
				<td ALIGN=CENTER>Team Viewer</td>
				<td ALIGN=CENTER>icq</td>
				<td ALIGN=CENTER>Почта</td>
				<td ALIGN=CENTER>Настроен</td>
				<td ALIGN=CENTER width = 32px>2-ой ФР</td>
				<td ALIGN=CENTER>Изменить</td>
			</tr>";
		  // Так как запрос возвращает несколько строк, применяем цикл
		  while($author = mysql_fetch_array($result))
		  {
			$checked = "";
			$checked_fr = "";
			if($author['chek'])
			{
					$checked = "checked";
			}
			if($author['fr'])
			{
					$checked_fr = "checked";
			}
			echo "<tr>
			<td>".$author['kod']."&nbsp;</td>
			<td>".$author['pref']."&nbsp </td>
			<td><a href='actt.php?name=".$author['name']."'>".$author['name']."&nbsp;</td>
			<td>".$author['region']."&nbsp;</td>
			<td>".$author['tel']."&nbsp;</td>
			<td>".$author['teamviewer']."&nbsp;</td>			
			<td>".$author['icq']."&nbsp;</td>
			<td>".$author['mail']."&nbsp;</td>
			<td><input type='checkbox' id = '".$author['id']."'   onchange = 'showOrSerch(".$author['id'].")' ".$checked."></td>
			<td ALIGN=CENTER><input type='checkbox' name = '".$author['id']."' id = '".$author['id']."12'   onchange = 'showOrSerchfr(".$author['id']."12)' ".$checked_fr."></td>
			<td>
				<form method='post' action='updateall.php'>
					<input type='hidden' name='update' value='".$author['id']."' />
					<input type='hidden' name='region' value='".$reg."' />
					<input type='submit' name='".$author['id']."' value='Изменить'>
				</form>
			</td>
			</tr>";
		  }
		  echo "</table>";
		}
		else
		{
		  echo "<p><b>Error: ".mysql_error()."</b><p>";
		  exit();
		}
			// Освобождаем память от результата
		mysql_free_result($result);
	}	
	
	function fr_magazine() {
		$GMT = 7;
		if($_GET['reg']){
			$reg=$_GET['reg'];
			$q = "SELECT GMT FROM region WHERE name='".$reg."'";
			$res = mysql_query($q) or die('Запрос не удался: ' . mysql_error());
			if($res)
			{
				$GMT_res = mysql_fetch_array($res);
				$GMT = $GMT_res['GMT'];
			}
		}
		echo "<script> var GMT = '".$GMT."'	</script>";
		$query = "SELECT * FROM mag WHERE fr = 1 ORDER by name";
		//$query = "SELECT * FROM mag WHERE name LIKE '".$reg."%'";
		
		$result = mysql_query($query) or die('Запрос не удался: ' . mysql_error());
		if($result)
		{
		  // Определяем таблицу и заголовок
		  echo "<table border='1' cellspacing='0' cellpadding='5' style='margin-left:20px' width = 97%>";
		  echo "
			<tr>
				<td ALIGN=CENTER>Код</td>
				<td ALIGN=CENTER>Префикс</td>
				<td ALIGN=CENTER>Название</td>
				<td ALIGN=CENTER>Регион</td>
				<td ALIGN=CENTER>Телефон</td>
				<td ALIGN=CENTER>Team Viewer</td>
				<td ALIGN=CENTER>icq</td>
				<td ALIGN=CENTER>Почта</td>
				<td ALIGN=CENTER>Настроен</td>
				<td ALIGN=CENTER width = 32px>2-ой ФР</td>
				<td ALIGN=CENTER>Изменить</td>
			</tr>";
		  // Так как запрос возвращает несколько строк, применяем цикл
		  $str_mail = "";
		  while($author = mysql_fetch_array($result))
		  {
			
			if ($author['mail'] != "")
			{
				$str_mail .= $author['mail'].",";
			}
			
			$checked = "";
			$checked_fr = "";
			if($author['chek'])
			{
					$checked = "checked";
			}
			if($author['fr'])
			{
					$checked_fr = "checked";
			}
			echo "<tr>
			<td>".$author['kod']."&nbsp;</td>
			<td>".$author['pref']."&nbsp </td>
			<td><a href='actt.php?name=".$author['name']."'>".$author['name']."&nbsp;</td>
			<td>".$author['region']."&nbsp;</td>
			<td>".$author['tel']."&nbsp;</td>
			<td>".$author['teamviewer']."&nbsp;</td>			
			<td>".$author['icq']."&nbsp;</td>
			<td>".$author['mail']."&nbsp;</td>
			<td><input type='checkbox' id = '".$author['id']."'   onchange = 'showOrSerch(".$author['id'].")' ".$checked." disabled='disabled'></td>
			<td ALIGN=CENTER><input type='checkbox' name = '".$author['id']."' id = '".$author['id']."12'   onchange = 'showOrSerchfr(".$author['id']."12)' ".$checked_fr." disabled='disabled'></td>
			<td>
				<form method='post' action='updateall.php'>
					<input type='hidden' name='update' value='".$author['id']."' />
					<input type='hidden' name='region' value='".$reg."' />
					<input type='submit' name='".$author['id']."' value='Изменить'>
				</form>
			</td>
			</tr>";
		  }
		  echo "</table>";
		  echo "<script> var str = '".mb_substr($str_mail,0,-1)."'	</script>";
		}
		else
		{
		  echo "<p><b>Error: ".mysql_error()."</b><p>";
		  exit();
		}
			// Освобождаем память от результата
		mysql_free_result($result);
	}
	
	function chek_magazine() {
		$GMT = 7;
		if($_GET['reg']){
			$reg=$_GET['reg'];
			$q = "SELECT GMT FROM region WHERE name='".$reg."'";
			$res = mysql_query($q) or die('Запрос не удался: ' . mysql_error());
			if($res)
			{
				$GMT_res = mysql_fetch_array($res);
				$GMT = $GMT_res['GMT'];
			}
		}
		echo "<script> var GMT = '".$GMT."'	</script>";
		$query = "SELECT * FROM mag WHERE chek = 1 ORDER by name";
		//$query = "SELECT * FROM mag WHERE name LIKE '".$reg."%'";
		
		$result = mysql_query($query) or die('Запрос не удался: ' . mysql_error());
		if($result)
		{
		  // Определяем таблицу и заголовок
		  echo "<table border='1' cellspacing='0' cellpadding='5' style='margin-left:20px' width = 97%>";
		  echo "
			<tr>
				<td ALIGN=CENTER>Код</td>
				<td ALIGN=CENTER>Префикс</td>
				<td ALIGN=CENTER>Название</td>
				<td ALIGN=CENTER>Регион</td>
				<td ALIGN=CENTER>Телефон</td>
				<td ALIGN=CENTER>Team Viewer</td>
				<td ALIGN=CENTER>icq</td>
				<td ALIGN=CENTER>Почта</td>
				<td ALIGN=CENTER>Настроен</td>
				<td ALIGN=CENTER width = 32px>2-ой ФР</td>
				<td ALIGN=CENTER>Изменить</td>
			</tr>";
		  // Так как запрос возвращает несколько строк, применяем цикл
		  while($author = mysql_fetch_array($result))
		  {
			if ($author['mail'] != "")
			{
				$str_mail .= $author['mail'].",";
			}
			
			$checked = "";
			$checked_fr = "";
			if($author['chek'])
			{
					$checked = "checked";
			}
			if($author['fr'])
			{
					$checked_fr = "checked";
			}
			echo "<tr>
			<td>".$author['kod']."&nbsp;</td>
			<td>".$author['pref']."&nbsp </td>
			<td><a href='actt.php?name=".$author['name']."'>".$author['name']."&nbsp;</td>
			<td>".$author['region']."&nbsp;</td>
			<td>".$author['tel']."&nbsp;</td>
			<td>".$author['teamviewer']."&nbsp;</td>			
			<td>".$author['icq']."&nbsp;</td>
			<td>".$author['mail']."&nbsp;</td>
			<td><input type='checkbox' id = '".$author['id']."'   onchange = 'showOrSerch(".$author['id'].")' ".$checked." disabled='disabled'></td>
			<td ALIGN=CENTER><input type='checkbox' name = '".$author['id']."' id = '".$author['id']."12'   onchange = 'showOrSerchfr(".$author['id']."12)' ".$checked_fr." disabled='disabled'></td>
			<td>
				<form method='post' action='updateall.php'>
					<input type='hidden' name='update' value='".$author['id']."' />
					<input type='hidden' name='region' value='".$reg."' />
					<input type='submit' name='".$author['id']."' value='Изменить'>
				</form>
			</td>
			</tr>";
		  }
		  echo "</table>";
		  echo "<script> var str = '".mb_substr($str_mail,0,-1)."'	</script>";
		}
		else
		{
		  echo "<p><b>Error: ".mysql_error()."</b><p>";
		  exit();
		}
			// Освобождаем память от результата
		mysql_free_result($result);
	}
	
	function online_magazine() {
		$GMT = 7;
		if($_GET['reg']){
			$reg=$_GET['reg'];
			$q = "SELECT GMT FROM region WHERE name='".$reg."'";
			$res = mysql_query($q) or die('Запрос не удался: ' . mysql_error());
			if($res)
			{
				$GMT_res = mysql_fetch_array($res);
				$GMT = $GMT_res['GMT'];
			}
		}
		echo "<script> var GMT = '".$GMT."'	</script>";
		$query = "SELECT * FROM mag WHERE online = 1 ORDER by region, number";
		//$query = "SELECT * FROM mag WHERE name LIKE '".$reg."%'";
		
		$result = mysql_query($query) or die('Запрос не удался: ' . mysql_error());
		if($result)
		{
		  // Определяем таблицу и заголовок
		  echo "<table border='1' cellspacing='0' cellpadding='5' style='margin-left:20px' width = 97%>";
		  echo "
			<tr>
				<td ALIGN=CENTER>Код</td>
				<td ALIGN=CENTER>Префикс</td>
				<td ALIGN=CENTER>Название</td>
				<td ALIGN=CENTER>Регион</td>
				<td ALIGN=CENTER>Телефон</td>
				<td ALIGN=CENTER>Team Viewer</td>
				<td ALIGN=CENTER>icq</td>
				<td ALIGN=CENTER>Почта</td>
				<td ALIGN=CENTER>Настроен</td>
				<td ALIGN=CENTER width = 32px>2-ой ФР</td>
				<td ALIGN=CENTER width = 32px>Online</td>
				<td ALIGN=CENTER>Изменить</td>
			</tr>";
		  // Так как запрос возвращает несколько строк, применяем цикл
		  while($author = mysql_fetch_array($result))
		  {
			if ($author['mail'] != "")
			{
				$str_mail .= $author['mail'].",";
			}
			
			$checked = "";
			$checked_fr = "";
			$checked_online = "";
			if($author['chek'])
			{
					$checked = "checked";
			}
			if($author['fr'])
			{
					$checked_fr = "checked";
			}
			if($author['online'])
			{
					$checked_online = "checked";
			}
			echo "<tr>
			<td>".$author['kod']."&nbsp;</td>
			<td>".$author['pref']."&nbsp </td>
			<td><a href='actt.php?name=".$author['name']."'>".$author['name']."&nbsp;</td>
			<td>".$author['region']."&nbsp;</td>
			<td>".$author['tel']."&nbsp;</td>
			<td>".$author['teamviewer']."&nbsp;</td>			
			<td>".$author['icq']."&nbsp;</td>
			<td>".$author['mail']."&nbsp;</td>
			<td ALIGN=CENTER><input type='checkbox' id = '".$author['id']."'   onchange = 'showOrSerch(".$author['id'].")' ".$checked." disabled='disabled'></td>
			<td ALIGN=CENTER><input type='checkbox' name = '".$author['id']."' id = '".$author['id']."12'   onchange = 'showOrSerchfr(".$author['id']."12)' ".$checked_fr." disabled='disabled'></td>
			<td ALIGN=CENTER><input type='checkbox' name = '".$author['id']."' id = '".$author['id']."14'   onchange = 'showOrHideOnline(".$author['id']."14)' ".$checked_online." disabled='disabled'></td>
			<td>
				<form method='post' action='updateall.php'>
					<input type='hidden' name='update' value='".$author['id']."' />
					<input type='hidden' name='region' value='".$reg."' />
					<input type='submit' name='".$author['id']."' value='Изменить'>
				</form>
			</td>
			</tr>";
		  }
		  echo "</table>";
		  echo "<script> var str = '".mb_substr($str_mail,0,-1)."'	</script>";
		}
		else
		{
		  echo "<p><b>Error: ".mysql_error()."</b><p>";
		  exit();
		}
			// Освобождаем память от результата
		mysql_free_result($result);
	}
	
	function online_magazine_end() {
		$GMT = 7;
		if($_GET['reg']){
			$reg=$_GET['reg'];
			$q = "SELECT GMT FROM region WHERE name='".$reg."'";
			$res = mysql_query($q) or die('Запрос не удался: ' . mysql_error());
			if($res)
			{
				$GMT_res = mysql_fetch_array($res);
				$GMT = $GMT_res['GMT'];
			}
		}
		echo "<script> var GMT = '".$GMT."'	</script>";
		$query = "SELECT * FROM mag WHERE online = 0 ORDER by region, number";
		//$query = "SELECT * FROM mag WHERE name LIKE '".$reg."%'";
		
		$result = mysql_query($query) or die('Запрос не удался: ' . mysql_error());
		if($result)
		{
		  // Определяем таблицу и заголовок
		  echo "<table border='1' cellspacing='0' cellpadding='5' style='margin-left:20px' width = 97%>";
		  echo "
			<tr>
				<td ALIGN=CENTER>Код</td>
				<td ALIGN=CENTER>Префикс</td>
				<td ALIGN=CENTER>Название</td>
				<td ALIGN=CENTER>Регион</td>
				<td ALIGN=CENTER>Телефон</td>
				<td ALIGN=CENTER>Team Viewer</td>
				<td ALIGN=CENTER>icq</td>
				<td ALIGN=CENTER>Почта</td>
				<td ALIGN=CENTER>Настроен</td>
				<td ALIGN=CENTER width = 32px>2-ой ФР</td>
				<td ALIGN=CENTER width = 32px>Online</td>
				<td ALIGN=CENTER>Изменить</td>
			</tr>";
		  // Так как запрос возвращает несколько строк, применяем цикл
		  while($author = mysql_fetch_array($result))
		  {
			if ($author['mail'] != "")
			{
				$str_mail .= $author['mail'].",";
			}
			
			$checked = "";
			$checked_fr = "";
			$checked_online = "";
			if($author['chek'])
			{
					$checked = "checked";
			}
			if($author['fr'])
			{
					$checked_fr = "checked";
			}
			if($author['online'])
			{
					$checked_online = "checked";
			}
			echo "<tr>
			<td>".$author['kod']."&nbsp;</td>
			<td>".$author['pref']."&nbsp </td>
			<td><a href='actt.php?name=".$author['name']."'>".$author['name']."&nbsp;</td>
			<td>".$author['region']."&nbsp;</td>
			<td>".$author['tel']."&nbsp;</td>
			<td>".$author['teamviewer']."&nbsp;</td>			
			<td>".$author['icq']."&nbsp;</td>
			<td>".$author['mail']."&nbsp;</td>
			<td ALIGN=CENTER><input type='checkbox' id = '".$author['id']."'   onchange = 'showOrSerch(".$author['id'].")' ".$checked." disabled='disabled'></td>
			<td ALIGN=CENTER><input type='checkbox' name = '".$author['id']."' id = '".$author['id']."12'   onchange = 'showOrSerchfr(".$author['id']."12)' ".$checked_fr." disabled='disabled'></td>
			<td ALIGN=CENTER><input type='checkbox' name = '".$author['id']."' id = '".$author['id']."14'   onchange = 'showOrHideOnline(".$author['id']."14)' ".$checked_online."></td>
			<td>
				<form method='post' action='updateall.php'>
					<input type='hidden' name='update' value='".$author['id']."' />
					<input type='hidden' name='region' value='".$reg."' />
					<input type='submit' name='".$author['id']."' value='Изменить'>
				</form>
			</td>
			</tr>";
		  }
		  echo "</table>";
		  echo "<script> var str = '".mb_substr($str_mail,0,-1)."'	</script>";
		}
		else
		{
		  echo "<p><b>Error: ".mysql_error()."</b><p>";
		  exit();
		}
			// Освобождаем память от результата
		mysql_free_result($result);
	}
	
	
	function testIE(){
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		$browserIE = false;
		if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.0') ) $browserIE = true;
		if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 7.0') ) $browserIE = true;
		if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 8.0') ) $browserIE = true;
		if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 9.0') ) $browserIE = true;
		if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 10.0') ) $browserIE = true;
		return $browserIE;
	}
	
?>