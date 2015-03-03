<?php
/*
	Name	: Daftar
	Created : 2015-02-13 11:18:40
	By		: Gunawan Wibisono (gundambison@gmail.com)
	access	: Clinic/ksc/daftar
	
	list field tersedia : 
			  `daf_id`, `daf_timeEnter`, `daf_timeArrive`, `daf_userInp`, `daf_comment`, `daf_enable`, `daf_deleteBy` 
	id 		: daf_id
*/
class Controllers_Clinic_Ksc_Daftar extends Modules_Plugin_Base {
private $maxLimit0 = 15; //Manual
private $maxLimit = 100; //Manual
var $model; //main model
	
	public function __construct() {
		parent::__construct();
//		$this->logger->write('debug', 'HTTP REQUEST: '.print_r($_REQUEST,1));
		$this->model = $this->_loadModel('daftar_model'); //base
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
	 * API INDEX Daftar
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
	list field tersedia : `daf_id`, `daf_timeEnter`, `daf_timeArrive`, `daf_userInp`, `daf_comment`, `daf_enable`, `daf_deleteBy` 	
*/
		$daftar=$this->model->getAll();
		$result['show']=count($daftar);
		$result['daftar']=$daftar;
		
		if($daftar){			 
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
	list field di input : `daf_id`, `daf_timeEnter`, `daf_timeArrive`, `daf_userInp`, `daf_comment`, `daf_enable`, `daf_deleteBy` 	
*/		
		if($this->model->add($data))
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
	list field di input : `daf_id`, `daf_timeEnter`, `daf_timeArrive`, `daf_userInp`, `daf_comment`, `daf_enable`, `daf_deleteBy` 	
	id : daf_id
*/		
		$key="`daf_id`='{$id}'";
		if($this->model->update($data,$key))
			$this->_success();
		$this->_failed(209);
	}
	
	function logs()
	{
		$dafpasien=$this->_loadModel('daftarpasien_model');
	//	$diag=$this->_loadModel('daftardiagnosa_model');
		
		$date=$this->input->post('date' );
		
		if($date=='')$date=date("Y-m-d", strtotime("-1 days"));
		$result=array('data'=>$_REQUEST, 'date'=>$date);
		$data=$this->model->listByDate($date);
		foreach($data as $id=>$row){
			$ar=$dafpasien->detail($row['daf_id'], 'dafpat_dafid');
	 		$data[$id]['daftarPasien']= $ar;
	//		$data[$id]['diagnosa']= $diag->detail($row['daf_id'], 'dd_daf');
 
		}
		
		$result['daftar']=$data;
		$this->_success($result);
		$this->_failed(209);
	}
	
	private function checkToken(){	
		if($this->_isTokenValid($this->clientcode, $this->input->post('token'), $this->input->post('username') ) ){
			return true; 
		}
		$this->_failed(204);
	}
	
}