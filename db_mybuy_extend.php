<?php
/////////////////////////////////////////////////////////////////
//云边开源轻博, Copyright (C)   2010 - 2011  qing.thinksaas.cn 
//EMAIL:nxfte@qq.com QQ:234027573                              
//$Id: db_mytag.php 730 2012-06-06 13:29:57Z anythink $ 

//该表是存放了用户保存的tagid 和真正的tag表对应数据，不能删除
class db_mybuy_extend extends ybModel  
{  
	var $table = "mybuy_extend"; // 数据表的名称 
 
	
	//添加数据
	function addPics($mybuyId,$data){
		//data中增加mybuyid
		foreach($data as $k=>$d){
			$preData[$k]["mybuy_id"]=$mybuyId;
			$str =str_replace('/thumbnail/','/large/',$d->thumbnail_pic);
			$preData[$k]["url"]=$str;
			if(!$this->find(array("url"=>$str))){
				$rs = $this->create($preData[$k]);
			}
			
		}
		
		
		
		
	}
	
	
}
?>