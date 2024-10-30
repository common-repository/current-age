<?php

function getcalanguage() {
	$calanguage = unserialize(
					get_option('calanguage',
						serialize(
							array( 
									'year'=>'year',
									'years'=>'years',
									'month'=>'month',
									'months'=>'months',
									'week'=>'week',
									'weeks'=>'weeks',
									'day'=>'day',
									'days'=>'days',
									'and'=>'and',
								 )
						)
					)
				);
	return $calanguage;
}

if (!function_exists('date_diff')) {
	function date_diff($date1, $date2) { 
		$current = $date1; 
		$datetime2 = date_create($date2); 
		$count = 0; 
		while(date_create($current) < $datetime2){ 
			$current = gmdate("Y-m-d", strtotime("+1 day", strtotime($current))); 
			$count++; 
		} 
		return $count; 
	}	
}
