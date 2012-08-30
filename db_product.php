<?php

/////////////////////////////////////////////////////////////////
//云边开源轻博, Copyright (C)   2010 - 2011  qing.thinksaas.cn
//EMAIL:zhangshaomin_1990@126.com QQ:1470506882
//邀请模块数据模型
class db_product extends ybModel
{

    public $pk = 'id';
    public $table = 'product';
    var $linker = array(  
        array(  
             'type' => 'hasone',   // 关联类型，这里是一对一关联  
            'map' => 'company',    // 关联的标识  
             'mapkey' => 'company_id', // 本表与对应表关联的字段名  
             'fclass' => 'db_company', // 对应表的类名  
            'fkey' => 'id',    // 对应表中关联的字段名
			//'field'=>'',//你要限制的字段     
            'enabled' => true     // 启用关联  
        ), 
		/* array(  
             'type' => 'hasmany',   // 关联类型，这里是一对多关联  
            'map' => 'blog_product',    // 关联的标识  
             'mapkey' => 'id', // 本表与对应表关联的字段名  
             'fclass' => 'blog_product', // 对应表的类名  
            'fkey' => 'product_id',    // 对应表中关联的字段名
			//'condition'=>'`uid` = uid',
			//'field'=>'uid',//你要限制的字段     
            'enabled' => false     // 启用关联 
        ),  */
		  
    ); 
	
	var $verifier = array(
                 "rules" => array( // 规则
                        'info' => array(  // 这里是对username的验证规则
                                'notnull' => TRUE, // username不能为空
                                'maxlength' => 144, // username长度不能大于12
                        ),
                        'style' => array(   // 这里是对email的验证规则
                                'notnull' => TRUE, // email不能为空
                        ),                       
			'year' => array(   // 这里是对email的验证规则
                                'notnull' => TRUE, // email不能为空
                                'istime' => TRUE,   // 必须要是电子邮件格式
                        ),
                ),
        );
}
?>
