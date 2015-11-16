<?php
/*
	Name	: Diagnosa
	Created : 2015-02-13 11:18:40
	By		: Gunawan Wibisono (gundambison@gmail.com)
	access	: Clinic/ksc/diagnosa
	
	list field tersedia : 
			  `d_id`, `d_code1`, `d_code2`, `d_index`, `d_name`, `d_stat` 
	id 		: d_id
*/
class Controllers_Clinic_Ksc_Diagnosa extends Modules_Plugin_Base {
private $maxLimit0 = 15; //Manual
private $maxLimit = 100; //Manual
var $model; //main model
	
	public function __construct() {
		parent::__construct();
//		$this->logger->write('debug', 'HTTP REQUEST: '.print_r($_REQUEST,1));
		$this->model = $this->_loadModel('diagnosa_model'); //base
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
	 * API INDEX Diagnosa
	 * @param ccode
	 * @param appid	  	 
	 */
	public function index() { 
		$this->logger->write('debug', 'HTTP REQUEST: '.print_r($_REQUEST,1));
		
	}
	
	public function all()
	{
		$result=array(
			'total'=>$this->model->total(),
		);
/*		
	list field tersedia : `d_id`, `d_code1`, `d_code2`, `d_index`, `d_name`, `d_stat` 	
*/
		$cari=$this->input->post('search');
		if($cari!=''){
			$diagnosa=$this->model->search($cari);
		}else{
			$diagnosa=$this->model->getAll();
		}
		
		$result['show']=count($diagnosa);
		$result['diagnosa']=$diagnosa;
		if(count($diagnosa)==0)$diagnosa=array();
		if($diagnosa!==false){			 
			$this->_success($result);
		}
		$this->logger->write('debug', 'resul:'.json_encode($result));
		//failed harus ada di akhir
		$this->_failed(209);		
	}
	
	public function add(){
		$this->checkToken();
//============tambah data bila diperlukan
		$data= $this->input->post();
		$data['status']=1;
/*		
	list field di input : `d_id`, `d_code1`, `d_code2`, `d_index`, `d_name`, `d_stat` 	
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
	list field di input : `d_id`, `d_code1`, `d_code2`, `d_index`, `d_name`, `d_stat` 	
	id : d_id
*/		
		$key="`d_id`='{$id}'";
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
	
}