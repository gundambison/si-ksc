<?php 
/****
	views	: core/data/coreStatusSave_data
	created	: 11-11-2015 19:15:35
	By		: Gunawan Wibisono
	Using 	: CI3 Main Model
****/
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
$module="status"; //change this 
$done=false;
if($post['type']=='save'){
	$data=array( 
		'stat_name'=>isset($post['name'])?$post['name']:'', 
		'stat_code'=>isset($post['code'])?$post['code']:'', 
		'stat_detail'=>isset($post['detail'])?$post['detail']:'', 
	);
	$id=$this->$module->saveData($data);
	echo "<div>mujur_status Created id:$id  </div>";
	$done=true;
	$title='Save Data Successed';
}else{}

if($post['type']=='update'){
	$data=array( 
		'stat_name'=>isset($post['name'])?$post['name']:'', 
		'stat_code'=>isset($post['code'])?$post['code']:'', 
		'stat_detail'=>isset($post['detail'])?$post['detail']:'',
	);
	$this->$module->updateData($data,$post['stat_id']);
	$done=true;
	echo "<div>Menu update  id:{$post['stat_id']} </div>";
	$title='Update Data Successed';
}
	
if($done==false){
	$id=dbIdReport('id','error',json_encode($_REQUEST)); 
	echo 'check your parameter';
	$title='Error';
}else{}

$content=ob_get_contents();
ob_end_clean();

$result=array(
	'body'=>$content,
	'title'=>$title,
	'footer'=>' ',
	'post'=>$post
);
echo json_encode($result);