<?php 

function get_rate($currency) {
	$rate = array() ;

	foreach($currency as $key => $value) {
		$url = $value.'.xml';
		$f = fopen($url, "r");

		$rate_yesterday = round(str_replace(',','.',fgets($f)), 4);
		$rate_today = round(str_replace(',','.',fgets($f)), 4);
		$range = round($rate_today - $rate_yesterday, 4);
		
		fclose($f);
		
		if ($range > 0) {
			$range = '+' . $range;
			$img = 'up' ;
		} 
		elseif ($range == 0) {
			$range = 0 ;
			$img = 0 ;
		} 
		else {
			$img = 'down' ;
		}
		$rate[$key] = array(
		 'today' => $rate_today,
		 'change' => $range,
		 'img' => $img
		);

	}		
	return $rate ;
}

