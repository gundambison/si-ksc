<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 
*/
class Pasien_model extends CI_Model 
{
var $API;
	public function byDocType($id=0)
	{
		$param=array('type_id'=>$id);
		$result=$this->API->_callApi('doctypePasien', $param);
		if(!isset($result['error'])){
			return $result;
		}else{
			return false;
		}
	}
	
	public function detail($id)
	{
		$param=array('id'=>$id);
		$result=$this->API->_callApi('pasienDetail', $param);
		//log_message('info', "response :".json_encode($result));
		if(!isset($result['error'])){
			return $result;
		}else{
			return false;
		}
	
	}
	
	public function detailMR($id)
	{
		$param=array('id'=>$id,'show'=>'mr');
		$result=$this->API->_callApi('pasienDetail', $param);
		//log_message('info', "response :".json_encode($result));
		if(!isset($result['error'])){
			return $result;
		}else{
			return false;
		}
	
	}
	
	public function saveMedrec($post){
		if(!isset($post['date']))
			$post['date']=date("Y-m-d H:i:s");
		$result=$this->API->_callApi('pasienSaveMedrec', $post);
		if(!is_array($result)){ $result=array('message'=>$result); }
		log_message('info', "response (save):".json_encode($result));
		if(!isset($result['error'])){
			$result['success']=1;
		}
		return $result;
		 
	
	}

	public function __construct(){
		$this->API= $this->core_model;
	
	}

}