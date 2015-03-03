<?php
/*
	Name	: Daftarpasien
	Created : 2015-02-13 11:18:40
	By		: Gunawan Wibisono (gundambison@gmail.com)
	access	: Clinic/ksc/daftarpasien
	
	list field tersedia : 
			  `dafpat_id`, `dafpat_dafid`, `dafpat_patid`, `dafpat_usrid`, `dafpat_docid`, `dafpat_date`, `dafpat_jasaadmin`, `dafpat_jasadr`, `dafpat_farno`, `dafpat_fartot`, `dafpat_other`, `dafpat_total`, `dafpat_atasNama`, `dafpat_uniqCode`, `dafpat_appBy`, `dafpat_appDate`, `dafpat_deleteBy`, `dafpat_type`, `dafpat_payId` 
	id 		: dafpat_id
*/
class Controllers_Clinic_Ksc_Daftarpasien extends Modules_Plugin_Base {
private $maxLimit0 = 15; //Manual
private $maxLimit = 100; //Manual
var $model; //main model
	
	public function __construct() {
		parent::__construct();
//		$this->logger->write('debug', 'HTTP REQUEST: '.print_r($_REQUEST,1));
		$this->model = $this->_loadModel('daftarpasien_model'); //base
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
	 * API INDEX Daftarpasien
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
	list field tersedia : `dafpat_id`, `dafpat_dafid`, `dafpat_patid`, `dafpat_usrid`, `dafpat_docid`, `dafpat_date`, `dafpat_jasaadmin`, `dafpat_jasadr`, `dafpat_farno`, `dafpat_fartot`, `dafpat_other`, `dafpat_total`, `dafpat_atasNama`, `dafpat_uniqCode`, `dafpat_appBy`, `dafpat_appDate`, `dafpat_deleteBy`, `dafpat_type`, `dafpat_payId` 	
*/
		$daftarpasien=$this->model->getAll();
		$result['show']=count($daftarpasien);
		$result['daftarpasien']=$daftarpasien;
		
		if($daftarpasien){			 
			$this->_success($result);
		}
		//failed harus ada di akhir
		$this->_failed(209);		
	}
	
	public function add(){
		$this->checkToken();
//============tambah data bila diperlukan
		$data= $this->input->post();
		$data['status']=1;
/*		
	list field di input : `dafpat_id`, `dafpat_dafid`, `dafpat_patid`, `dafpat_usrid`, `dafpat_docid`, `dafpat_date`, `dafpat_jasaadmin`, `dafpat_jasadr`, `dafpat_farno`, `dafpat_fartot`, `dafpat_other`, `dafpat_total`, `dafpat_atasNama`, `dafpat_uniqCode`, `dafpat_appBy`, `dafpat_appDate`, `dafpat_deleteBy`, `dafpat_type`, `dafpat_payId` 	
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
	list field di input : `dafpat_id`, `dafpat_dafid`, `dafpat_patid`, `dafpat_usrid`, `dafpat_docid`, `dafpat_date`, `dafpat_jasaadmin`, `dafpat_jasadr`, `dafpat_farno`, `dafpat_fartot`, `dafpat_other`, `dafpat_total`, `dafpat_atasNama`, `dafpat_uniqCode`, `dafpat_appBy`, `dafpat_appDate`, `dafpat_deleteBy`, `dafpat_type`, `dafpat_payId` 	
	id : dafpat_id
*/		
		$key="`dafpat_id`='{$id}'";
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