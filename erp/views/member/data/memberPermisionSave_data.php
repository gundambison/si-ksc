<?php 
/****
	views	: member/memberPermisionSave_data
	created	: 09-11-2015 11:09:06
	By		: Gunawan Wibisono
	Using 	: CI3 Main Model
****/
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
$module="permision"; //change this 
$done=false;
if($post['type']=='save'){
	$data=array( 
		'permit_name'=>$post['name'], 
	);
	$id=$this->$module->saveData($data);
	echo "<div>mujur_permision Created id:$id  </div>";
	$done=true;
	$title='Save Data Successed';
}else{}

if($post['type']=='update'){
	$data=array( 
		'permit_name'=>$post['name'], 
	);
	$this->$module->updateData($data,$post['permit_id']);
	$done=true;
	echo "<div>Menu update  id:{$post['permit_id']} </div>";
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