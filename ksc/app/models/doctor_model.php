<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 
*/
class Doctor_model extends CI_Model 
{
var $API;
	public function allType()
	{
		$result=$this->API->_callApi('doctype');
		if(!isset($result['error'])){
			return $result;
		}else{
			return false;
		}
	}


	public function __construct(){
		$this->API= $this->core_model;
	
	}

}