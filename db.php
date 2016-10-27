<?php
	// Соединяемся, выбираем базу данных	
	$link = mysql_connect('localhost', 'root') or die('Не удалось соединиться: ' . mysql_error());
	//echo 'Соединение успешно установлено';
	mysql_select_db('magazin') or die('Не удалось выбрать базу данных');
	mysql_query("SET NAMES utf8");
?>