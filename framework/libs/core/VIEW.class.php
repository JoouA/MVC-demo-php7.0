<?php
class VIEW
{
	private static $view;

	public static function  view_init($config){
		self::$view = new Smarty();
		foreach ($config as $key => $value) {
			 self::$view ->$key = $value; 
		}
	}

	public static function assign($arr){
		foreach ($arr as $key => $value) {
			self::$view->assign($key,$value);
		}	
	}

	public static function display($path){
		self::$view->display($path);
	}
	
} 
 ?>