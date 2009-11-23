<?php
  define('PROSPER_PATH', '../../prosper-lib/lib/');
  define('TRIUMPH_PATH', '../lib/');
  define('APP_PATH', 'lib/');
  
	require_once PROSPER_PATH . 'adapters/_common_.php';
	require_once PROSPER_PATH . 'Query.php';
	require_once TRIUMPH_PATH . 'Base.php';
	require_once APP_PATH . 'todo.php';

	Prosper\Query::configure(Prosper\Query::MYSQL_MODE, 'root', 'xamppdevpwd', 'localhost', 'test');
	
	/**
	 * Simple function that translates a timestamp from the past into a friendlier
	 * number of somethings ago (ex: 15 minutes ago, 1 hour ago)
	 * @param int timestamp unix timestamp to convert
	 * @return string nicely formatted label	 	 
	 */	 	  	
	function time_ago($timestamp) {
		$spans = array ( "year"   => 31536000,
		                 "month"  =>  2592000,
										 "week"   =>   604000,
										 "day"    =>    86400,
										 "hour"   =>     3600,
										 "minute" =>       60,
										 "second" =>        1	 );
					
		$diff = mktime() - $timestamp - 24;
		$label = "second";
		$span = 1;
		foreach($spans as $key => $value) {
			if($diff > $value) {
				$label = $key;
				$span = $value;
				break;
			}
		}
		
		$amt = floor($diff / $span);	
		
		return $amt . " " . $label . ($amt != 1 ? "s" : "") . " ago";
	}

?>