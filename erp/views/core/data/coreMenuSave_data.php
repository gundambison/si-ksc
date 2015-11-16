<?php 
/****
	views	: core/data/coreMenuSave_data
	created	: 09-11-2015 12:37:08
	By		: Gunawan Wibisono
	Using 	: CI3 Main Model
****/
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
//print_r($post);
//$id=dbId('menu',1000);

$done=false;
if($post['type']=='mainMenuSave'){	
	$id=dbIdReport('menu','create main menu',json_encode($post), 2000); 
	$data=array(
		'menu_id'=>$id,
		'menu_name'=>$post['name'],
		'menu_title'=>$post['title'],
		'menu_href'=>'#'
	);
	$this->menu->saveData($data);
	echo "<div>Menu Created id:$id ($post[title])</div>";
	$done=true;
	$title='Save Data';
}else{}
 
if($post['type']=='subMenuSave'){
	$id=dbIdReport('menu','create sub menu',json_encode($post),2000); 
	$data=array(
		'menu_id'=>$id,
		'menu_name'=>$post['name'],
		'menu_title'=>$post['title'],
		'menu_parent'=>$post['parent'],
		'menu_href'=>$post['href'],
		'menu_detail'=>$post['detail']
	);
	$this->menu->saveData($data);
	$done=true;
	echo "<div>Sub Menu Created id:$id ($post[title])</div>";
	$title='Save Data';
}else{}

if($post['type']=='menuUpdate'){
	$id=dbIdReport('menu','update menu',json_encode($post),2000); 
	$data=array( 
		'menu_name'=>$post['name'],
		'menu_title'=>$post['title'],
		'menu_parent'=>$post['parent'],
		'menu_href'=>$post['href'],
		'menu_detail'=>$post['detail'],
		'menu_position'=>$post['pos'],
		'menu_icon'=>$post['icon'],
		'menu_show'=>$post['show']
	);
	$this->menu->updateData($data,$post['menu_id']);
	$done=true;
	echo "<div>Menu update  id:{$post['menu_id']} ($post[title])</div>";
	$title='Update Data';
}else{}

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
	'footer'=>'-',
	'post'=>$post
);
echo json_encode($result);