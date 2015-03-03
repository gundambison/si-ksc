<?php
/*
	Name	: Doctortypes
	Created : 2015-02-13 11:18:40
	By		: Gunawan Wibisono (gundambison@gmail.com)
	access	: Clinic/ksc/doctortypes
	
	list field tersedia : 
			  `spec_id`, `spec_name`, `spec_desc`, `spec_type` 
	id 		: spec_id
*/
class Controllers_Clinic_Ksc_Doctortypes extends Modules_Plugin_Base {
private $maxLimit0 = 15; //Manual
private $maxLimit = 100; //Manual
var $model; //main model
	
	public function __construct() {
		parent::__construct();
		$this->logger->write('debug', 'HTTP REQUEST: '.print_r($_REQUEST,1));
		$this->model = $this->_loadModel('doctortypes_model'); //base
// 		set language (optional)
		$lang = $this->input->post('lang');
		if($lang !== false){
			$this->_setLanguage($lang);
//			$this->logger->write('debug', 'SET LANGUAGE: '.print_r($lang,1));
		}
		
		// set token
		$token = $this->input->post('token');
		if( $token !== false || $token != '' ){
			$this->token = $token;
		}
		
		// validate input mandatory
		$this->_mandatory( array('client_code', 'app_code') );
		
		$this->clientcode = $this->input->post('client_code');
		$this->appcode    = $this->input->post('app_code');
		
	}
	 
	/**
	 * API INDEX Doctortypes
	 * @param ccode
	 * @param appid	  	 
	 */
	public function index() { 
		$this->logger->write('debug', 'HTTP REQUEST: '.print_r($_REQUEST,1));
		$this->all();
	}
	
	public function all()
	{
		$result=array(
			'total'=>$this->model->total(),
		);
/*		
	list field tersedia : `spec_id`, `spec_name`, `spec_desc`, `spec_type` 	
*/
		$doctortypes=$this->model->getAll();
		$result['show']=count($doctortypes);
		$result['doctortypes']=$doctortypes;
		
		if($doctortypes){			 
			$this->_success($result);
		}
		//failed harus ada di akhir
		$this->_failed(209);		
	}
	
	public function pasienlist( ){
	$result=array();
		$id=$this->input->post('type_id');
		$data=$this->model->pasien($id);
		 
		if(count($data)==0){
			$this->_failed(208);	
		}
		if($data){	
			$doctortypes=$this->model->getAll();
			//krsort($data);
			//$this->logger->write('info','key='.json_encode(array_keys($data)));
			$result['pasien']=$data;
			$result['doctortypes']=$doctortypes;
			$result['total']=count($data);	
			$this->_success($result);
		}
		//failed harus ada di akhir
		$this->_failed(209);
	}
	
	public function listPasien(){ $this->pasienlist(); }
	
	public function add(){
		$this->checkToken();
//============tambah data bila diperlukan
		$data= $this->input->post();
		$data['status']=1;
/*		
	list field di input : `spec_id`, `spec_name`, `spec_desc`, `spec_type` 	
*/		
		if($this->add($data))
			$this->_success();
		$this->_failed(209);
	}
	
	public function update(){
		$this->checkToken();
//============tambah data bila diperlukan
		$data= $this->input->post();
		$id= $this->input->post('id'); //atau kode bila bukan angka
		$data['status']=1;
/*		
	list field di input : `spec_id`, `spec_name`, `spec_desc`, `spec_type` 	
	id : spec_id
*/		
		$key="`spec_id`='{$id}'";
		if($this->update($data,$key))
			$this->_success();
		$this->_failed(209);
	}
	
	private function checkToken(){	
		if($this->_isTokenValid($this->clientcode, $this->input->post('token'), $this->input->post('username') ) ){
			return true; 
		}
		$this->_failed(204);
	}
/*	
	list pasien 
*/
	public function pasien()
	{
		$data= $this->input->post();
		
		if($result){			 
			$this->_success($result);
		}
		//failed harus ada di akhir
		$this->_failed(209);
	}
}