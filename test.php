<?php 
	include ('db.php');
	$query = "SELECT id, name FROM region"; 
	$res = mysql_query( $query ); 
	
//	while ( $item = mysql_fetch_array( $res ) ) 
//	{ 
//	   echo '<br>'; 
//	   echo ' '.$item['id']; 
//	   echo ' '.$item['name']; 
//	} 
	
	if($_GET['reg'])
	{
		$reg = $_GET['reg'];
	}
	else $reg ="";
	echo "<a href='index.php?reg=".$reg."'>Вернуться на главную</a>";		
//	$f = fopen("test.txt", "r");
	// Читать построчно до конца файла
//	while(!feof($f)) { 
//		$query = 'INSERT INTO magazin.mag (
//			id ,		
//			name 
//			)
//			VALUES (NULL , "'.fgets($f).'")';
	//$res = mysql_query( $query );
//	}

//	fclose($f);
	
	echo '<h2>Список</h2>';
	echo '<form action="'.$_SERVER['PHP_SELF'].'?reg='.$reg.'" method="POST">';
	if($reg != "")
	{
		if($reg == "Все")
		{
			$query = "SELECT id, name, tel FROM mag WHERE 1 order by name"; 
		}
		else
		$query = "SELECT id, name, tel FROM mag WHERE region='".$_GET['reg']."' order by number"; 
	}
	else
	{
		$query = "SELECT id, name FROM mag WHERE 1"; 
	}
	$res = mysql_query( $query ); 
	echo '<table border="1">'; 
	echo '<tr><th>ID</th><th>Наименование</th><th>Телефон</th><th>Удл.</th></tr>'; 
	while ( $item = mysql_fetch_array( $res ) ) 
	{ 
	   echo '<tr>'; 
	   echo '<td>'.$item['id'].'</td>'; 
	   echo '<td>'.$item['name'].'</td>';
	   echo '<td>'.$item['tel'].'</td>';	   
	   echo '<td><input type="checkbox" name="item[]" value="'.$item['id'].'" /></td>';  
	   echo '</tr>'; 
	} 
	echo '</table>';
	echo '<input type="submit" name="submitForm" value="Удалить отмеченные" />';
	echo '</form>';

	if ( isset ( $_POST['item'] ) )
	{
	   $ids = implode( ',', $_POST['item'] );
	   $query = 'DELETE FROM mag WHERE id IN ('.$ids.')';
	   mysql_query( $query );
	   echo '
	   <script language="JavaScript" type="text/javascript">
		<!-- 
		function GoNah(){ 
		location="/test.php?reg='.$reg.'"; 
		} 
		setTimeout( "GoNah()", 50 ); 
		//--> 
	   </script>';
	}
?>
