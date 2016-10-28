<?php
	include ('db.php'); //подключение к БД
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
	<title>Welcome to the 110 contact office</title>
</head>
<body>
	<!-- Secondary menu -->
	<div id="secondarymenu">
		<div class="secondarybutton">
			<p>Вернуться на главную</p>
			<a href="index.php"><img src="images/icon/home.png" alt=""></a>
		</div>
		<div class="secondarybutton">
			<p>Добавить контакт</p>
			<a href="shops.php"><img src="images/icon/add.png" alt=""></a>
		</div>
		<div class="secondarybutton">
			<p>Удаление контакта</p>
			<a href="shops.php"><img src="images/icon/del.png" alt=""></a>
		</div>
	</div>
	<div class="clear"></div>

	<div class="search-field">
		<form class="form-wrapper cf" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
			<input type="hidden" name="action" value="ip">
			<input type="text" placeholder="Поиск по IP..." id="IP" name="IP" required>
			<button type="submit">Искать</button> 
		</form> 
		<form class="form-wrapper cf" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
			<input type="hidden" name="action" value="fio">
			<input type="text" placeholder="Поиск по ФИО..." id="name_fio" name="name_fio" required>
			<button type="submit">Искать</button> 
		</form> 
		<form class="form-wrapper cf" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
			<input type="hidden" name="action" value="otdel">
			<select name="otdel">
				<?php $sql_otdel = 'SELECT * FROM otdel ORDER BY who';
				$result_select_otdel = mysql_query($sql_otdel);	?>
				<label>Отдел</label>
				<option value = '' ></option>
				<?php 
				while($object = mysql_fetch_object($result_select_otdel))	{ ?>
				<option value="<?php echo $object->id ?>" > <?php echo $object->who ?></option>"; 
				<?php }?>
			</select>
			
		</select>
		<button type="submit">Отдел</button> 
	</form> 
</div>

<h2 class="center">Контакты офиса</h2>



<div class="table-contact-list">
	<table class="center" border="1" cellspacing="0" cellpadding="4">
		<?php
		$bool_serch = 0;
		switch ($_POST['action']) {
			case "ip":
			$IP = $_POST['IP'];
			if ($IP != "") {
				$bool_serch = 0;
				$bool_otdel = 0;
				$q_p = "SELECT * FROM contact WHERE tel LIKE '$IP%'";
				if ($name_fio != "") {
					$q_p = "SELECT * FROM contact WHERE LOWER(fio) LIKE '%$name_fio%' or fio LIKE '$name_fio% ORDER BY fio'";
				}
				else if($otdel != "")	{
					$q_p = "SELECT * FROM contact WHERE who = '$otdel' ORDER BY id";
					$bool_otdel = 1;
				}
				$result = mysql_query($q_p) or die('Введите данные в поле поиска');

				echo "
				<tr>
					<th width = 325px ALIGN=CENTER><b>ФИО</b></td>
						<th ALIGN=CENTER><b>Должность</b></td>
							<th width = 125px ALIGN=CENTER><b>Телефон</b></td>
								<th width = 80px ALIGN=CENTER><b>Изменить</b></td>
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
									<th colspan=4>".$aut_otdel['who']."</th>
								</tr>";
							}
							echo "
							<tr>
								<td>".$author['fio']."&nbsp;</td>
								<td>".$author['spec']."&nbsp;</td>
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
									<th colspan=4><b>&nbsp;</b></td>
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
			}
			break;
			case "fio":
			$name_fio = $_POST['name_fio'];
			$q_otdel = "SELECT * FROM otdel WHERE id=".$otdel.""; //Выберем все отделы
			$result_otdel = mysql_query($q_otdel) or die('Нет списка отделов');
			while($aut_otdel = mysql_fetch_array($result_otdel))
			{
				echo "
				<tr>
					<th colspan=4>".$aut_otdel['who']."</th>
				</tr>";
			}
			while($author = mysql_fetch_array($result))	{
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
		echo "</table>";
		break;
		case "otdel":
		$otdel = $_POST['otdel'];
		$q_otdel = "SELECT * FROM otdel ORDER BY id"; //Выберем все отделы
		$result_otdel = mysql_query($q_otdel) or die('Нет списка отделов');

		if($result_otdel && $bool_serch == 0)
		{

			echo "
			<tr>
				<th width = 325px ALIGN=CENTER><b>ФИО</b></td>
					<th ALIGN=CENTER><b>Должность</b></td>
						<th width = 125px ALIGN=CENTER><b>Телефон</b></td>
							<th width = 80px ALIGN=CENTER><b>Изменить</b></td>
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
						while($aut_otdel = mysql_fetch_array($result_otdel)) {
							echo "
							<tr>
								<th colspan=4>".$aut_otdel['who']."</th>
							</tr>";
							$q_p = "SELECT * FROM contact WHERE who=".$aut_otdel['id']." ORDER BY id";
							$result = mysql_query($q_p) or die('Введите данные в поле поиска');

							while($author = mysql_fetch_array($result))	{
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
					break;
				}

			}


			?></div>
		</body>
