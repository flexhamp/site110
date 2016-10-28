<HTML>
<HEAD>
	<TITLE>Добавление магазина</TITLE>
</HEAD>
<BODY>

<table width="600" border="1" cellspacing="0" cellpadding="5" align="center">
<tr ALIGN=CENTER><td COLSPAN=2><b>Добавить магазин</b></td></tr>
<form method="post" action="action.php"> 
	<tr><td>Код обмена</td><td><input type="text" size="10" name="kod"></td></tr>
	<tr><td>Префикс регионна</td><td><input type="text" size="10" name="pref"></td></tr>
	<tr><td>Наименование</td><td><input type="text" size="50" name="name"></td></tr>
	<tr><td>Номер</td><td><input type="text" size="10" name="number"></td></tr>
	<tr><td>Регион</td>
	<td>
	<?php
	include ('db.php');
	$sql = 'SELECT * FROM region WHERE id<>1';
	$result_select = mysql_query($sql) or die('Запрос не удался: ' . mysql_error());
	
	echo "<select name = 'region'>";
	while($object = mysql_fetch_object($result_select))
	{ 
		echo "<option value = '$object->name' > $object->name </option>"; 
	}
	echo "</select></td></tr>";
	?>
	</td></tr>
	<tr><td>Город</td><td><input type="text" size="50" name="city"></td></tr>>
	<tr><td>Телефон</td><td><input type="text" size="50" name="tel"></td></tr>
	<tr><td>ICQ</td><td><input type="text" size="50" name="icq"></td></tr>
	<tr><td>Team Viewer</td><td><input type="text" size="50" name="teamviewer"></td></tr>
	<tr><td>e-Mail</td><td><input type="text" size="50" name="mail"></td></tr>
	<tr><td>Настроен</td><td><input type="checkbox" name="check" id="chbxce" value="1" checked></td></tr>
	
	<tr ALIGN=CENTER><td COLSPAN=2><input type="submit" value="Добавить запись"></td></tr>
</form>
</table>
</BODY>
</HTML>