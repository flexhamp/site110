<?php  

require_once 'get_rate.php' ;

$currency = array(
'dollar' => 'R01235',
'euro' => 'R01239'
);

if(get_rate($currency) != "false")
{

$rate = get_rate($currency);

foreach ($rate as $key => $value) { ?>

<img src="<?php echo "kursrate/".$key; ?>.png" alt="" />

<strong><?php echo $value['today']; ?></strong>


<?php if($value['change']) { ?>

<img src="<?php echo "kursrate/".$value['img']; ?>.png" alt="" /> <?php echo $value['change']; ?>

<?php } ?>

<div style="clear: both"></div>

<?php }
}
else 
{
	echo "<b>Нет связи с www.cbr.ru</b><br>";
	echo "<img src='kursrate/dollar.png' alt='' /><b> 0</b><br>";
	echo "<img src='kursrate/euro.png' alt='' /><b> 0</b>";	
}
?>