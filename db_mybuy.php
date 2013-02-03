<?php
/////////////////////////////////////////////////////////////////
//云边开源轻博, Copyright (C)   2010 - 2011  qing.thinksaas.cn 
//EMAIL:nxfte@qq.com QQ:234027573                              
//$Id: db_mytag.php 730 2012-06-06 13:29:57Z anythink $ 

//该表是存放了用户保存的tagid 和真正的tag表对应数据，不能删除
class db_mybuy extends ybModel  
{  
	var $pk = "id"; //主键  
	var $table = "mybuy"; // 数据表的名称 
	
	var $linker = array(  
        array(  
             'type' => 'hasone',   // 关联类型，这里是一对一关联  
            'map' => 'product',    // 关联的标识  
             'mapkey' => 'pid', // 本表与对应表关联的字段名  
             'fclass' => 'db_product', // 对应表的类名  
            'fkey' => 'id',    // 对应表中关联的字段名
            'enabled' => true     // 启用关联  
        ), 
		  
    );  
	
	//根据昵称返回标签列表
	function returnUserTags($n){
		$db = spClass("db_memberex");
		$rs = $db->find(array('name'=>$n));
		$uid = $rs['uid'];
		$db = spClass("db_product_tag_user");
			$rs = $db->spLinker()->findAll(array("user_id"=>$uid),"tag_id desc","");
			$temp = array();
			foreach($rs as $r){				
				if($r['product_id']<0){
					$temp[$r['tag_id']] = array("tag"=>$r['producttags'][0][tag],"tagId"=>$r['tag_id']);
				}
			}

			return $temp;
	}
	//根据标签id返回全部商品
	function returnTagGoods($id){
		$db = spClass("db_product_tag_user");
		$rs = $db->findAll(array('tag_id'=>$id),"","product_id");

		foreach($rs as $r){
			$t[] = $r['product_id'];
		}
		$ids = join(",",array_map("showReal",$t));
		$rs = $this->findAll("id in ($ids)","time desc");		
		return $rs;
	}
	
	function detail($id){
		$rs = $this->find(array("id"=>$id));
		$pid = $rs['pid'];
		if($pid){
			$db = spClass("db_product");
			$rs['product'] = $db->spLinker()->find(array("id"=>$pid));
		}

		return $rs;
	}
	
	function inputUrl($id,$url,$weiboId){
		$rs = $this->find(array("id"=>$id));
		if(!$rs['pid']){
			//create new product
			$db = spClass("db_product");
			$data=array("company"=>"","year"=>'',"style"=>'',"info"=>"","buy_url"=>$url);
			$pid = $db->create($data);
			//update url,pid
			$this->update(array("id"=>$id), array("pid"=>$pid));
		}else{
			$db = spClass("db_product");
			$data=array("buy_url"=>$url);
			$db->update(array("id"=>$rs['pid']),$data);
		}
		$db = spClass("db_alertBuy");
		$db->done($weiboId);
		

	}

}
?>