<?php
	require_once 'include.list.php';
	$currentpath = str_replace(DIRECTORY_SEPARATOR,'/',dirname(__FILE__)).'/';
	foreach ($paths as $key => $value) {
		// echo $currentpath.$value."<br>";
		require_once($currentpath.$value);
		 
	}

class PC{
	private static $config;
	public static $controller;
	public static $method; 


	public static function init_DB(){
		DB::init('mysql',self::$config['dbconfig']);
	}

	public static function init_View(){
		VIEW::view_init(self::$config['viewconfig']);
	}

	public static function  init_Controller(){
		self::$controller =  isset($_GET['controller'])? $_GET['controller'] : 'index';
	}

	public static function init_Method(){
		self::$method =  (!isset($_GET['method']))? 'index' : $_GET['method']; 
	}


	public static function run($config){
		self::$config = $config;

		self::init_DB();

		self::init_View();

		self::init_Controller();

		self::init_Method();

		// echo "run";

		C(self::$controller,self::$method);
		
	}

}

 ?>