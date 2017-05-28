<?php
class mysql
{	
	private $con;
	function err($error){
		die('对不起你的操作错误'.$error);
	}

	function connect($config){
		 extract($config);
		 $this->con = mysqli_connect($dbhost,$dbuser,$dbpassword);
		// $con = mysqli_connect($dbhost,$dbuser,$dbpassword);
		if (!$this->con) {
			$this->err(mysqli_error());
		}

		if(!mysqli_select_db($this->con,$dbname)) {
			$this->err(mysqli_error());
		}

		mysqli_query('set names '.$dbcharset);
	}


	function query($sql){
		if (!($res = mysqli_query($this->con,$sql))) {
			$this->err(mysqli_error());
		}else{	
			return $res;
		}
	}

	function findAll($result){
		while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
			$list[] = $row; 
		}
		return isset($list)?$list : NULL;
	}


	function findOne($result){
		return mysqli_fetch_array($result,MYSQLI_ASSOC);
	}

	function findResult($result,$row = 0,$column = 0){

		return mysqli_result($result,$row,$column);
	}

	function insert($table,$arr){
		// insert into $table()  values();
		foreach ($arr as $key => $value) {
			$value = mysqli_real_escape_string($this->con,$value);  
			$arrkey[]  = '`'.$key.'`' ;
			$arrval[] = "'".$value."'"; 
		}

		$keystr = implode(',',$arrkey);
		$valstr = implode(',',$arrval);

		$sql = 'insert into '.$table.'('.$keystr.')'.' values('.$valstr.')';

		$this->query($sql); 

		return mysqli_insert_id();

	}


	function update($table,$arr,$where){
		// update $table set xxx=xxx,xxx=xxx
		foreach ($arr as $key => $value) {
			$value = mysqli_real_escape_string($this->con,$value);
			$arrkey[] =  '`'.$key.'`'.'='."'".$value."'";
		}
		$keystr = implode(',',$arrkey);
		$sql = 'update '.$table.' set '.$keystr.' where '.$where;
		$this->query($sql);
	}

	function del($table,$where){
		$sql = 'delete from '.$table.' where '.$where;
		$this->query($sql);
	}

}


?>