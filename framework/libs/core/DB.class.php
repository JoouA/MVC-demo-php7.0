<?php
class DB
{
	private static $db;

	public static function init($dbtype,$config){
		self::$db = new $dbtype;

		self::$db->connect($config);
	}

	public static function query($sql){
		 return  self::$db->query($sql);
	}

	public static function findOne($sql){
		$result = self::$db->query($sql);
		return  self::$db->findOne($result);
	}

	public static function findAll($sql){
		$result = self::$db->query($sql);
		return self::$db->findAll($result);
	}

	public static function findResult($result,$row=0,$column=0){
		return self::$db->findResult($result,$row,$column);
	}

	public static function insert($table,$arr){
		return self::$db->insert($table,$arr);
	}

	public static function update($table,$arr,$where){
		self::$db->update($table,$arr,$where);
	}

	public static function del($table,$where){
		self::$db->del($table,$where);
	}

} 
 ?>