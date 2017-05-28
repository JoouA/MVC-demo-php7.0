<?php
	function C($name, $method){
		require_once('libs/controller/'.$name.'Controller.class.php');

		eval('$obj = new '.$name.'Controller();'.' $obj->'.$method.'();');
	} 


	function M($name){
		require_once('libs/model/'.$name.'Model.class.php');

		eval('$obj = new '.$name.'Model();');

		return $obj;
	}


	function daddslashes($str){
		return get_magic_quotes_gpc()? $str :  addslashes($str);	
	}
 ?>