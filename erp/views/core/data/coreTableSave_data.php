<?php 
/****
	views	: core/data/coreTableSave_data
	created	: 10-11-2015 23:59:11
	By		: Gunawan Wibisono
	Using 	: CI3 Main Model
****/
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
$module="table"; //change this 
$done=false;
if($post['type']=='save'){
	$data=array( 
		'table_name'=>$post['name'], 
		'table_prefix'=>$post['prefix'],
		'table_module'=>$post['model']
	);
	$id=$this->$module->saveData($data);
	echo "<div>mujur_table Created id:$id  </div>";
	$done=true;
	$title='Save Data Successed';
}else{}

if($post['type']=='update'){
	$data=array( 
		'table_name'=>$post['name'], 
	);
	$this->$module->updateData($data,$post['table_id']);
	$done=true;
	echo "<div>Menu update  id:{$post['table_id']} </div>";
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