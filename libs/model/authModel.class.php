<?php
class authModel
{	
	private $auth = '';

	private $table = 'admin';

	public function __construct(){
		// echo "I am auth Cnstruct!";
		if (isset($_SESSION['auth'])&& !empty($_SESSION['auth'])) {
			$this->auth = $_SESSION['auth'];
		}
	}

	public function getauth(){
		return $this->auth;
	} 

   

	public function loginsubmit(){

		if (empty($_POST['username'])|| empty($_POST['password'])) {
				return false;			
		}

		$username = $_POST['username'];
		$password = md5($_POST['password']);


		$sql = 'select * from  '.$this->table.' where username = '."'".$username."'";

		$data = DB::findOne($sql);

		if (empty($data['username']) || ($data['password']!=$password )) {
			return false;
		}else{
			 $_SESSION['auth'] = $data['username'];
		   	 return true;	
		}

	}
}	 
 ?>