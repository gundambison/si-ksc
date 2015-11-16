<?php 
/****
	views	: member/data/memberLogin_data
	created	: 14-11-2015 01:50:52
	By		: Gunawan Wibisono
	Using 	: CI3 Main Model
****/
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
$module="user"; //change this
$data0=$this->$module->getData($post['username'],'user_name');
$password=md5($post['password']);
$data1=$this->$module->getData($password,'user_password');
if($data0==$data1){
	echo 'OK';
	$status=true;
	$message='Please Wait';
	$data=array( 
		'erp_username'=>$post['username'],
		'erp_password'=>$password
	);
	
	$this->session->set_userdata($data);
	$time=date("Y-m-d H:i:s", strtotime("+1 hours"));
	$this->session->set_userdata('erp_time',$time);
}
else{ 
	echo 'FAILED ';
	$status=false;
	$message='Check your username or password';
}
$content=ob_get_contents();
ob_end_clean();

$result=array(
	'body'=>$content,
	'status'=>$status,
	'message'=>$message,
	'url'=>$this->session->userdata('target_url')  
);
echo json_encode($result);