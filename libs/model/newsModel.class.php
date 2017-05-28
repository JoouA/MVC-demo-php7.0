<?php
class newsModel
{	
	private $table = 'news';

	public function get_news_list(){

		$sql = 'select * from '.$this->table.' order by dateline desc';

		$data = DB::findAll($sql);  // 返回的是数组，数组里面有包含数组
		
		foreach ($data as $key => $value) {
			$data[$key]['content'] = substr($value['content'],0,200);
			$data[$key]['dateline'] = date('Y-m-d',$value['dateline']);
		}

		return $data;
	}


	public function get_one_news(){
		$sql = 'select * from '.$this->table.' where id = '.$_GET['id'];

		$data = DB::findOne($sql);  // 返回就是一条新闻的数组信息

		$data['content'] = substr($data['content'],0,200);
		$data['dateline'] = date('Y-m-d',$data['dateline']);
		
		return $data;
	}

   public function get_news_count(){
   		$sql = 'select count(*) as count from '.$this->table;
   		return DB::findOne($sql);
   }


   public function get_news_info($id){

   		$sql = 'select * from '.$this->table.' where id = '.$id;

   		$data = DB::findOne($sql);

   		return $data;
   }


   public function newssubmit($data){
   		$arr['title'] = $data['title'];
   		$arr['content'] = $data['content'];
   		$arr['author'] = $data['author'];
   		$arr['fromip'] = $data['fromip'];
   		$arr['dateline'] = time();
   	     
   	    // 当插入失败
   	    if(empty($data['title'])||empty($data['content'])){
			return 0;
		}	

		// 插入成功
		if (empty($data['id'])) {
			DB::insert($this->table,$arr);
			return 1;
		}

		// 更新成功
		if (!empty($data['id'])) {
			DB::update($this->table,$arr,"id = ".$data['id']);
			return 2;
		}  			

   }

   public function newdel(){
   		DB::del($this->table,'id = '.$_GET['id']);
   }    


} 

?>