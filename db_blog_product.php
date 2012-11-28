<?php
class db_blog_product extends spModel
{
        public $table = 'blog_product';
			var $pk = "blog_id";
			var $linker = array(  
			  array(  
	             'type' => 'hasmany',   // 关联类型，这里是一对一关联 关联产品库  
	            'map' => 'attachments',    // 关联的标识  
	             'mapkey' => 'blog_id', // 本表与对应表关联的字段名  
	             'fclass' => 'db_attach', // 对应表的类名  
	            'fkey' => 'bid',    // 对应表中关联的字段名
				//'condition'=>'`uid` = uid',
				//'field'=>'uid',//你要限制的字段     
	            'enabled' => true     // 启用关联  
	        )
        );
		
		function save($blog_id="",$pid=""){
			if(empty($blog_id)){$this->spArgs('blog_id');}
			if(empty($pid)){$this->spArgs('pid');}
			//删除原始关联
			$this->delete(array("blog_id"=>$blog_id));
			//保存新关联数据
			$newData = array();
	
			$newData=array("blog_id"=>$blog_id,"product_id"=>$pid);
			$this->create($newData);
		}
}
?>