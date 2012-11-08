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
	
	function route($style,$info=""){
		switch ($style) {
			case 'comment':
				$this->commentMe();
				$this->commentArticle($info['bid']);
				$this->commentAt($info['repuid']);
				
				break;
			
			default:
				
				break;
		}
		$this->sumSource($_SESSION['user']['uid']);
	}
	
	//给回复发表者加分
	function commentMe(){
		$_uid = $_SESSION['user']['uid'];
		$_source = 1;
		$_type='发表留言，给自己加分';
		if(!$this->limitSrouce($_uid)){
			$this->getSource($_uid,$_source,$_type);
			$this->sourceNotice($_uid,"积分通知","获得回复积分1z");
		}
	}
	
	//是否有被@者，给@者加分
	function commentAt($_uid){
		if(empty($_uid))return;
		$_source = 1;
		$_type='和朋友互动,对方给予积分';
		if($_uid&&$_uid!=$_SESSION['user']['uid']){
			$this->getSource($_uid,$_source,$_type);
			$this->sourceNotice($_uid,"积分通知","和人互动，您获得对方给予的积分1z");
		}
		
	}
	
	//给文章发表者加分
	function commentArticle($bid){
		$rs = spClass("db_blog")->find(array("bid"=>$bid));
		//print_r($rs);exit;
		$_uid = $rs["uid"];
		$_source = 2;
		$_type = '有人评论我的文章';
		if($_uid&&$_uid!=$_SESSION['user']['uid']){
			$this->getSource($_uid,$_source,$_type);
			$this->sourceNotice($_uid,"积分通知","有人评论您的文章，您获得积分2z");
		}
	}
	
	function getSource($uid,$source,$type){
		$data = array(
			"user_id"=>$uid,
			"source"=>$source,
			//"time"=>DateTime(),
			"type"=>$type,
		);
		$this->create($data);
	}
	
	function limitSrouce($uid){
		$limitType = array("'发表留言，给自己加分'","'发表新文章'");
		$sql = "select sum(source) as sum from ".DBPRE."source where user_id=".$uid." and time>'".date("Y-m-d")." 00:00:00' and time<'".date("Y-m-d")." 23:59:59' and type in (".join($limitType,",").")";                           
		$rs = $this->findsql($sql);
		//print_r($rs);exit;
		if($rs[0]["sum"]>10){
			return false;
		}
	}
	
	function sourceNotice($foruid,$title,$info){		
		spClass("db_notice")->create(array('uid'=>0,'sys'=>2,'foruid'=>$foruid,'title'=>$title,'info'=>$info,'location'=>'','time'=>time()));
	}
	
	function sumSource($uid){
		$sql = "select sum(source) as sum from  ".DBPRE."source where user_id=".$uid."";
		$rs = $this->findSql($sql);
		if(!$rs[0]["sum"])$rs[0]["sum"]=0;
		$data = spClass("db_member")->updateField(array("uid"=>$uid),"source",$rs[0]["sum"]);
		$_SESSION["user"]['source']= $rs[0]["sum"];
		//print_r($data);exit;
	}
}
?>
