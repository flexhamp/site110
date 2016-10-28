<?php 

function get_rate($currency) {
	$x = @fsockopen('www.cbr.ru', 80, $err, $ern, 1);
	if($x) {
		try{
			$date = getdate();  // получаем ассоциативный массив с данными по дате

			$day_of_the_week = $date['wday']; // день недели

			//расчет коэффициента смещения
			switch ($day_of_the_week) {
				case 0:  $k1 = 2 ;  $k2 = 1;  break;   // воскресенье
				case 1:  $k1 = 3 ;  $k2 = 2;  break;   // понедельник
				case 2:  $k1 = 3 ;  $k2 = 0;  break;  // вторник
				default: $k1 = 1 ;  $k2 = 0;  break;   // среда, четверг, пятница, суббота
			}

			$month = $date['mon'] ;    // месяц
			$day = $date['mday'] ;     // число сегодня
			$yesterday = $day - $k1 ;  // число для получения курса на предыдущий день
			$today = $day - $k2 ;      // число для получения курса на сегодня
			$year = $date['year'] ;    // год


			$date_yesterday = date("d/m/Y", mktime(0, 0, 0, $month, $yesterday, $year )); // Генерация даты для курса предыдущего дня
			$date_today = date("d/m/Y", mktime(0, 0, 0, $month, $today, $year )); // Генерация даты для курса на сегодня

			$rate = array() ;

			foreach($currency as $key => $value) {
				//$url = 'http://www.cbr.ru/scripts/XML_dynamic.asp?date_req1='.$date_yesterday.'&date_req2='.$date_today.'&VAL_NM_RQ='.$value ;
				$url = $value.'.xml';
				$xml = simplexml_load_file($url);
				$rate_today = round(str_replace(',','.',$xml->Record[1]->Value), 2);
				$rate_yesterday = round(str_replace(',','.',$xml->Record[0]->Value), 2);
				$range = round($rate_today - $rate_yesterday, 2) ;

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
		catch (E_WARNING $e) {return "false";}
	}
	else return "false";
}

