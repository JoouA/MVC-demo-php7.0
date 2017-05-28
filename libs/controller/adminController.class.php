<?php
class adminController{

	private $auth = '';

	public function __construct(){
		// echo "I am admin construct!";
		$authobj = M('auth');
		$this->auth = $authobj->getauth();
		if (empty($this->auth) && PC::$method!='login') {
			$this->showmessage('请登录后才进行操作','index.php?controller=admin&method=login');
		}
	}

	//idnex是显示有多少条信息
	public function index(){
		$newsobj = M('news');
		$data = $newsobj->get_news_count();	
		// print_r($data);	
		VIEW::assign(array('newsnum' => $data['count']));
		VIEW::display('admin/index.html');
	}


	public function login(){
		if ($_POST) {
		   $this->checklogin();
		}else{
		VIEW::display('admin/login.html');
		}	
	}


	// 注销登录
	public function logout(){
		unset($_SESSION['auth']);
		$this->showmessage("注销成功",'index.php?controller=admin&method=login');
	}

	//添加新闻
	public function newsadd(){
		$newsobj = M('news');
		if (empty($_POST)) {

			//没有数据就是显示添加修改的界面
			//读取信息 get the news
			if ($_GET['id']) {
			  $data = $newsobj->get_news_info($_GET['id']);
			 } 

			// print_r($data);	

			VIEW::assign(array('data' =>$data ));

			VIEW::display('admin/newsadd.html');	
		}else{
			// 进行添加
			$this->newssubmit();
		}
	}


	public function newssubmit(){
		$onews = M('news');
		$res = $onews->newssubmit($_POST);

		switch ($res) {
			case 0:
				$this->showmessage('插入失败','index.php?controller=admin&method=newsadd&id='.$_POST['id']);
				break;
			case 1:
				$this->showmessage('插入成功','index.php?controller=admin&method=newslist');
				break;

			case 2:
				$this->showmessage('更新成功','index.php?controller=admin&method=newslist');
				break;	
			default:
				break;
		}


	}


	public function newslist(){
		$newsobj = M('news');

		$data = $newsobj->get_news_list();

		VIEW::assign(array('data' => $data ));
		VIEW::display('admin/newslist.html');
	}



	public function newsdel(){
		$newsobj = M('news');
		if(intval($_GET['id'])){
			 $newsobj->newdel();
			 $this->showmessage('删除成功','index.php?controller=admin&method=newslist');
		}else{
			 $this->showmessage('删除失败','index.php?controller=admin&method=newslist');
		}
       
	}


	public function checklogin(){
		$authobj = M('auth');
		if ($authobj->loginsubmit()) {
			header('Location:index.php?controller=admin&method=index');
		}else{
			$this->showmessage('登录失败','index.php?controller=admin&method=login');
		}
	}


	public function showmessage($text,$url){
		echo "<meta charset='utf-8'>";
		echo "<script type='text/javascript'>alert('$text'); window.location.href='$url';</script>";
	}


} 
 ?>