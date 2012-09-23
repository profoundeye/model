<?php
class db_producttags extends ybModel{
        public $table = 'producttags';
			var $pk = "id";
			var $linker = array(  
			  array(  
	             'type' => 'hasmany',   // 关联类型，这里是一对一关联 关联产品库  
	             'map' => 'productTagsUser',    // 关联的标识  
	             'mapkey' => 'id', // 本表与对应表关联的字段名  
	             'fclass' => 'db_product_tag_user', // 对应表的类名  
	            'fkey' => 'tag_id',    // 对应表中关联的字段名
				//'condition'=>'`uid` = uid',
				//'field'=>'uid',//你要限制的字段     
	            'enabled' => true     // 启用关联  
	        )
        );
}
?>