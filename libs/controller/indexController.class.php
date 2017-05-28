<?php
class indexController
{
	public function index(){
		$onews = M('news');

		$data = $onews->get_news_list();
		View::assign(array('data'=>$data));

		$this->showabout();
		
		VIEW::display('index/index.html');
	}

	public function newsshow(){
		$onews = M('news');

		$data = $onews->get_one_news();

		$this->showabout();

		VIEW::assign(array('data' => $data ));

		VIEW::display('index/show.html');

	}

	public function showabout(){
		$data = M('about')->aboutinfo();
			
		VIEW::assign(array('about'=>$data));
	}

} 
 ?>