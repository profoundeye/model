<?php

/////////////////////////////////////////////////////////////////
//云边开源轻博, Copyright (C)   2010 - 2011  qing.thinksaas.cn
//EMAIL:zhangshaomin_1990@126.com QQ:1470506882
//邀请模块数据模型
class db_product_tag_user extends ybModel
{
    public $table = 'product_tag_user';
    	var $linker = array(  
			  array(  
	             'type' => 'hasmany',   // 关联类型，这里是一对一关联 关联产品库  
	             'map' => 'producttags',    // 关联的标识  
	             'mapkey' => 'tag_id', // 本表与对应表关联的字段名  
	             'fclass' => 'db_producttags', // 对应表的类名  
	            'fkey' => 'id',    // 对应表中关联的字段名
				//'condition'=>'`uid` = uid',
				//'field'=>'uid',//你要限制的字段     
	            'enabled' => true     // 启用关联  
	        )
        );
}
?>
