<?php
/*
	Clinic/ksc/pasien/index
*/
class Controllers_Clinic_Ksc_Pasien extends Modules_Plugin_Base {
private $maxLimit0 = 15; //Manual
private $maxLimit = 100; //Manual
	
	public function __construct() {
		parent::__construct();
		$this->logger->write('debug', 'HTTP REQUEST: '.print_r($_REQUEST,1));
		
		// set language (optional)
		$lang = $this->input->post('lang');
		if($lang !== false){
			$this->_setLanguage($lang);
			$this->logger->write('debug', 'SET LANGUAGE: '.print_r($lang,1));
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
	 * API REQUEST PASIEN
	 * @param ccode
	 * @param appid	  
	 * @param (optional) limit 
	 * @param (optional) lang
	 */
	public function index() {  
		$result=array('message'=>'success');
		$limit= $this->input->post('limit');
		$pasien= $this->_loadModel('pasien_model'); #harus memakai _model
		$limit= $limit < $this->maxLimit0?$limit:$this->maxLimit0;
		$list=$pasien->showNew($limit,$tmp); //terbatas data field yang dishare
		//$list = $pasien->showNum(0,$limit);
		if($list){
			$result=array('total'=>count($list),'totalData'=>$pasien->total(),'pasien'=>$list );
			$this->_success($result);
		}
		//failed harus ada di akhir
		$this->_failed(209);
	}
	
	public function listPasien(){
		$result=array('message'=>'success');
		$data = $this->input->post();
		$limit= $this->input->post('limit');
		$this->checkToken();
		$pasien= $this->_loadModel('pasien_model'); #harus memakai _model
		$limit= $limit < $this->maxLimit?$limit:$this->maxLimit;
		$list = $pasien->showNum(0,$limit);
		if($list){
			
			$result=$result2=array('total'=>count($list),'totalData'=>$pasien->total(),'pasien'=>$list,);
			unset($result2['pasien']);
			$result2['post']=$data;
			$this->activityLog->write($result2, $this);
			$this->_success($result);
		}
		//failed harus ada di akhir
		$this->_failed(209);
	}
	
	public function detail( ){
		//$this->checkToken();
		$id=$this->input->post('id');
		$pasien= $this->_loadModel('pasien_model');
		$data = $pasien->detail($id);
		if(!isset($data['name'])) $this->_failed(208);
		if(  $this->input->post('show')=='mr'){
			$showMR=1;
		}
//========update result ========
		$data['name']=trim($data['name1'])." ".trim($data['name2']);
		$data['address']=trim($data['addr'])." ". trim($data['addr2'])." ";
		if(strtolower($data['addr2'])!=='lain-lain')
			$data['address'].= trim($data['addr3']);
			
		$result=array('pasien'=>$data);
		if($result['pasien']!=false){
			 $result['asuransi']=$pasien->detailAsuransi($id); #bila kosong maka array
			 $result['perusahaan']=$pasien->detailPerusahaan($id); #bila kosong maka array
			if(isset($showMR)){
				$result['medrec']=$pasien->detailMR($id);
			}
			$this->_success($result);
		}
		
		$this->_failed(209);
		
	}
	
	public function savemedrec()
	{
		$model 	= $this->_loadModel('session');
		$user 	= $this->_loadModel('user_model');
		$pasien= $this->_loadModel('pasien_model');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$data = $this->input->post();
/*		
//=====TIDAK PERLU USER
		$data['user']=63; //	
		$status = $pasien->savemedrec($data);
			if($status===false) 
					$this->_failed(209);
		$result=array('message'=>'save ok'); 
			$this->_success($result);
*/ 
			
/*================check valid username & password ===*/
		$detail= $user->detail($username);
		//$this->logger->write('debug','user detail='.json_encode($detail) );
		if(!isset($detail['id'])) 
			$this->_failed(202);
			
		if($user->checkUser($username, $password)){
			$data['user']=$detail['id'];		
			$status = $pasien->savemedrec($data);
			if($status===false) 
					$this->_failed(209);
			$result=array('message'=>'save ok'); 
			$this->_success($result);
		}
		else{
			$this->_failed(202);
		
		}
			
		$this->_failed(209);
	}
	
	public function generate(){
		$model 	= $this->_loadModel('session');
		$token = $model->create( $this->clientcode, $this->appcode, 'guest');
		$result= array('token'=>$token,'warning'=>'this only a test');
		$this->_success($result);
	}
	
	private function checkToken(){	
		if($this->_isTokenValid($this->clientcode, $this->input->post('token'), $this->input->post('username') ) ){
			return true; 
		}
		
		$this->_failed(204);
	}
	
}
