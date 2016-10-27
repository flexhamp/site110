<?php
	include ('db.php'); //подключение к БД
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
	<script src="script.js"></script>
	<script src="jquery-1.9.1.js"></script>
	<script src="jquery-ui.js"></script>
	<script type="text/javascript" src="autocomplete.js"></script>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<style type="text/css">
			a {
		text-decoration: none; /* Отменяем подчеркивание у ссылки */
		  display: inline-block;
		  padding: 4px;
		  outline: 0;
		  color: #3a599d;
		  -webkit-transition-duration: 0.25s;
		  -moz-transition-duration: 0.25s;
		  -o-transition-duration: 0.25s;
		  transition-duration: 0.25s;
		  -webkit-transition-property: -webkit-transform;
		  -moz-transition-property: -moz-transform;
		  -o-transition-property: -o-transform;
		  transition-property: transform;
		  -webkit-transform: scale(1) rotate(0);
		  -moz-transform: scale(1) rotate(0);
		  -o-transform: scale(1) rotate(0);
		  transform: scale(1) rotate(0);
		}
		a:hover {
		  background: #3a599d;
		  text-decoration: none;
		  color: #fff;
		  -webkit-border-radius: 4px;
		  -moz-border-radius: 4px;
		  -o-border-radius: 4px;
		  border-radius: 4px;
		  -webkit-transform: scale(1.05) rotate(-1deg);
		  -moz-transform: scale(1.05) rotate(-1deg);
		  -o-transform: scale(1.05) rotate(-1deg);
		  transform: scale(1.05) rotate(-1deg);
		}
		a:nth-child(2n):hover {
		  -webkit-transform: scale(1.05) rotate(1deg);
		  -moz-transform: scale(1.05) rotate(1deg);
		  -o-transform: scale(1.05) rotate(1deg);
		  transform: scale(1.05) rotate(1deg);
		}

        </style>
</head>
<body>
<div ALIGN=CENTER>
	<br>
	<a href='index.php' style='margin-left:20px'>Вернуться на главную</a>
	<a href='add_contact_list.php' style='margin-left:20px'>Добавить контакт</a>
	<a href='del_contact_list.php' style='margin-left:20px'>Удаление контакта</a>
</div>

<table ALIGN=CENTER>
	<tr>
		<td style='padding:25px'>
			<?php echo '<form action="'.$_SERVER['PHP_SELF'].'" method="POST">'; ?>
				<label>Поиск по IP</label>
				<input size="20" type="text" id="IP" name="IP">
				<input type="submit" value="Искать">
			</form> 
		</td>
		<td style='padding:25px'>
			<?php echo '<form action="'.$_SERVER['PHP_SELF'].'" method="POST">'; ?>
				<label>Поиск по ФИО</label>
				<input size="50" type="text" id="name_fio" name="name_fio">
				<input type="submit" value="Искать">
			</form> 
		</td>
		
		<td style='padding:25px'>
			<?php echo '<form action="'.$_SERVER['PHP_SELF'].'" method="POST">';
					$sql_otdel = 'SELECT * FROM otdel ORDER BY who';
					$result_select_otdel = mysql_query($sql_otdel);// or die('Запрос не удался: ' . mysql_error());			
					echo "<label style='margin-left:10px'>Отдел</label>";
					echo "<select name = 'otdel' style='margin-left:5px'>";
					echo "<option value = '' ></option>"; 
						while($object = mysql_fetch_object($result_select_otdel))
						{ 
							echo "<option value = '$object->id' > $object->who </option>"; 
						}
					echo "</select>";
			?>
				<input type="submit" value="Выбрать">
			</form> 
		</td>
	</tr>
</table>
<?php
	$bool_serch = 0;
	
	
	if($_POST['IP'])
	{
		$IP = $_POST['IP'];
	}
	else if($_POST['name_fio'])
	{
		$name_fio = $_POST['name_fio']; // передаем переменной значение глобального массива POST
	}
	else if($_POST['otdel'])
	{
		$otdel = $_POST['otdel'];
	}
	if ($_POST['IP'] != "" || $name_fio != "" || $otdel != "")
	{
		$bool_serch = 0;
		$bool_otdel = 0;
		$q_p = "SELECT * FROM contact WHERE tel LIKE '$IP%'";
		if ($name_fio != "")
		{
			$q_p = "SELECT * FROM contact WHERE LOWER(fio) LIKE '%$name_fio%' or fio LIKE '$name_fio% ORDER BY fio'";
		}
		else if($otdel != "")
		{
			$q_p = "SELECT * FROM contact WHERE who = '$otdel' ORDER BY id";
			$bool_otdel = 1;
		}
		$result = mysql_query($q_p) or die('Введите данные в поле поиска');
			echo "
			<h3 align='center'><b>Контакты офиса</b></h3>";
			//Выведем пользователей		
			
			echo "<table border='1' cellspacing='0' cellpadding='4' align='center'  width = 57%>";
				echo "
				<tr>
					<td width = 325px ALIGN=CENTER><b>ФИО</b></td>
					<td ALIGN=CENTER><b>Должность</b></td>
					<td width = 125px ALIGN=CENTER><b>Телефон</b></td>
					<td width = 80px ALIGN=CENTER><b>Изменить</b></td>
				</tr>";
				if($bool_otdel == 0) //Если не выбран отдел
				{
					while($author = mysql_fetch_array($result))
					{
						if ($author['who'] != 0)
						{
							$q_otdel = "SELECT * FROM otdel WHERE id=".$author['who'].""; //Выберем все отделы
							$result_otdel = mysql_query($q_otdel) or die('Нет списка отделов');
							while($aut_otdel = mysql_fetch_array($result_otdel))
							{
								echo "
								<tr>
									<td ALIGN=CENTER colspan=4><b>".$aut_otdel['who']."</b></td>
								</tr>";
							}
							echo "<tr>
							<td>".$author['fio']."&nbsp;</td>
							<td ALIGN=CENTER>".$author['spec']."&nbsp;</td>
							<td>IP ".($author['tel'])."&nbsp</td>
							<td ALIGN=CENTER>
								<form method='post' action='update_contact.php'>
									<input type='hidden' name='update' value='".$author['id']."' />
									<input type='submit' name='".$author['id']."' value='Изменить'>
								</form>
							</td>
							</tr>";
						}
						else
						{
							if($bool == 0)
							{
								echo "
								<tr>
									<td ALIGN=CENTER colspan=4><b>&nbsp;</b></td>
								</tr>";
								$bool=1;
							}
							echo "<tr>
							<td>".$author['fio']."&nbsp;</td>
							<td ALIGN=CENTER>".$author['spec']."&nbsp;</td>
							<td>IP ".($author['tel'])."&nbsp</td>
							<td ALIGN=CENTER>
								<form method='post' action='update_contact.php'>
									<input type='hidden' name='update' value='".$author['id']."' />
									<input type='submit' name='".$author['id']."' value='Изменить'>
								</form>
							</td>
							</tr>";
						}
					}
				}
				else
				{
					$q_otdel = "SELECT * FROM otdel WHERE id=".$otdel.""; //Выберем все отделы
					$result_otdel = mysql_query($q_otdel) or die('Нет списка отделов');
					while($aut_otdel = mysql_fetch_array($result_otdel))
					{
						echo "
						<tr>
							<td ALIGN=CENTER colspan=4><b>".$aut_otdel['who']."</b></td>
						</tr>";
					}
					while($author = mysql_fetch_array($result))
					{
						echo "<tr>
						<td>".$author['fio']."&nbsp;</td>
						<td ALIGN=CENTER>".$author['spec']."&nbsp;</td>
						<td>IP ".($author['tel'])."&nbsp</td>
						<td ALIGN=CENTER>
							<form method='post' action='update_contact.php'>
								<input type='hidden' name='update' value='".$author['id']."' />
								<input type='submit' name='".$author['id']."' value='Изменить'>
							</form>
						</td>
						</tr>";
					}
				}
			echo "</table>";
					//-------------------------  ***  ------------------------------------------------------		
	}	
	else
	{
		$q_otdel = "SELECT * FROM otdel ORDER BY id"; //Выберем все отделы
		$result_otdel = mysql_query($q_otdel) or die('Нет списка отделов');
		echo "
		<h3 align='center'><b>Контакты офиса</b></h3>";
		//Выведем пользователей		
		if($result_otdel && $bool_serch == 0)
		{
			echo "<table border='1' cellspacing='0' cellpadding='4' align='center'  width = 57%>";
			echo "
			<tr>
				<td width = 325px ALIGN=CENTER><b>ФИО</b></td>
				<td ALIGN=CENTER><b>Должность</b></td>
				<td width = 125px ALIGN=CENTER><b>Телефон</b></td>
				<td width = 80px ALIGN=CENTER><b>Изменить</b></td>
			</tr>";
			
			$q_p = "SELECT * FROM contact WHERE who=0 ORDER BY fio";
			$result = mysql_query($q_p) or die('Введите данные в поле поиска');
				
			while($author = mysql_fetch_array($result))
			{
				echo "<tr>
				<td>".$author['fio']."&nbsp;</td>
				<td ALIGN=CENTER>".$author['spec']."&nbsp;</td>
				<td>IP ".($author['tel'])."&nbsp</td>
				<td ALIGN=CENTER>
					<form method='post' action='update_contact.php'>
						<input type='hidden' name='update' value='".$author['id']."' />
						<input type='submit' name='".$author['id']."' value='Изменить'>
					</form>
				</td>
				</tr>";
			}		
			mysql_free_result($result);
			while($aut_otdel = mysql_fetch_array($result_otdel))
			{
				echo "
				<tr>
					<td ALIGN=CENTER colspan=4><b>".$aut_otdel['who']."</b></td>
				</tr>";
				$q_p = "SELECT * FROM contact WHERE who=".$aut_otdel['id']." ORDER BY id";
				$result = mysql_query($q_p) or die('Введите данные в поле поиска');
				
				while($author = mysql_fetch_array($result))
				{
					echo "<tr>
					<td>".$author['fio']."&nbsp;</td>
					<td ALIGN=CENTER>".$author['spec']."&nbsp;</td>
					<td>IP ".($author['tel'])."&nbsp</td>
					<td ALIGN=CENTER>
						<form method='post' action='update_contact.php'>
							<input type='hidden' name='update' value='".$author['id']."' />
							<input type='submit' name='".$author['id']."' value='Изменить'>
						</form>
					</td>
					</tr>";
				}				
			}
			echo "</table>";
					//-------------------------  ***  ------------------------------------------------------
					
		}
		else
		{
		  echo "<p><b>Error: ".mysql_error()."</b><p>";
		  exit();
		}
		mysql_free_result($result_otdel);
	}
	
	// Освобождаем память от результата	
	mysql_free_result($result);
?>
</body>
