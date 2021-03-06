<?php
/////////////////////////////////////////////////////////////////
//云边开源轻博, Copyright (C)   2010 - 2011  qing.thinksaas.cn 
//EMAIL:nxfte@qq.com QQ:234027573                              
//$Id: db_mytag.php 730 2012-06-06 13:29:57Z anythink $ 

//该表是存放了用户保存的tagid 和真正的tag表对应数据，不能删除
class db_alertBuy extends ybModel  
{
	var $pk = "id"; //主键  
	var $table = "alertbuy"; // 数据表的名称 
	
	function newAlert($buyId,$detailId){
		//用户身份
		$uid = $_SESSION['uid']?$_SESSION['uid']:"0";
		$rs = $this->find(array("weiboId"=>$buyId,"uid"=>$uid));
		if($rs){
			$row = array("times"=>$rs['times']+1,"detailId"=>$detailId);
			$this->update(array("weiboId"=>$buyId,"uid"=>$uid), $row);
		}else{
			$row = array("times"=>1,"weiboId"=>$buyId,"detailId"=>$detailId,"uid"=>$uid);
			$this->create($row);
		}		
	}
	
	function done($buyId){
		$rs = $this->update(array("weiboId"=>$buyId),array("done"=>1));
		if($rs)return TRUE;
	}
}
?>