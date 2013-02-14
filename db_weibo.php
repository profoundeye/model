<?php
/////////////////////////////////////////////////////////////////
//云边开源轻博, Copyright (C)   2010 - 2011  qing.thinksaas.cn 
//EMAIL:nxfte@qq.com QQ:234027573                              
//$Id: db_mytag.php 730 2012-06-06 13:29:57Z anythink $ 

//该表是存放了用户保存的tagid 和真正的tag表对应数据，不能删除
class db_weibo extends ybModel  
{  
	var $pk = "id"; //主键  
	var $table = "weibo"; // 数据表的名称 
	
	var $linker = array(  
        array(  
             'type' => 'hasone',   // 关联类型，这里是一对一关联  
            'map' => 'memberex',    // 关联的标识  
             'mapkey' => 'uid', // 本表与对应表关联的字段名  
             'fclass' => 'db_memberex', // 对应表的类名  
            'fkey' => 'uid',    // 对应表中关联的字段名
            'enabled' => true     // 启用关联  
        ), 
        array(  
             'type' => 'hasone',   // 关联类型，这里是一对一关联  
            'map' => 'weibo',    // 关联的标识  
             'mapkey' => 'bid', // 本表与对应表关联的字段名  
             'fclass' => 'db_mybuy', // 对应表的类名  
            'fkey' => 'id',    // 对应表中关联的字段名
            'enabled' => true     // 启用关联  
        ), 
		  
    );  
	
	function done($bid){
		$rs = $this->update(array("bid"=>$bid),array("done"=>1));
		if($rs)return TRUE;
	}

}
?>