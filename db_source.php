<?php

class db_source extends ybModel
{

    public $pk = 'id';
    public $table = 'source';
    var $linker = array(  
        array(  
             'type' => 'hasone',   // 关联类型，这里是一对一关联  
            'map' => 'user',    // 关联的标识  
             'mapkey' => 'user_id', // 本表与对应表关联的字段名  
             'fclass' => 'db_member', // 对应表的类名  
            'fkey' => 'uid',    // 对应表中关联的字段名
			//'field'=>'',//你要限制的字段     
            'enabled' => true     // 启用关联  
        ), 		  
    ); 
	
	function getSource($uid){
		
	}
}
?>
