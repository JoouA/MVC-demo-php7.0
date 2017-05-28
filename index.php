<?php
	session_start();
	header('Content-type:text/html;charset = utf-8');
	
	date_default_timezone_set('Asia/Shanghai');

	error_reporting(E_ALL^E_NOTICE^E_WARNING^E_DEPRECATED);

	require_once 'config.php';

	require_once 'framework/PC.php';

	PC::run($config);

 ?>