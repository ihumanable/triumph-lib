<?php
  define('PROSPER_PATH', '../../prosper-lib/lib/');
  define('TRIUMPH_PATH', '../lib/');
  define('APP_PATH', 'lib/');
  
	require_once PROSPER_PATH . 'adapters/_common_.php';
	require_once PROSPER_PATH . 'Query.php';
	require_once TRIUMPH_PATH . 'Base.php';
  require_once APP_PATH . 'utility.php';
	require_once APP_PATH . 'todo.php';

	Prosper\Query::configure(Prosper\Query::MYSQL_MODE, 'root', 'xamppdevpwd', 'localhost', 'test');

?>