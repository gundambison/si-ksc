<?php
/*
	Clinic/ksc/pasien/index
*/
class Controllers_Clinic_Ksc_User extends Modules_Plugin_Base {
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
	 * API KOSONG
	 * @param ccode
	 * @param appid	  
	 * @param (optional) limit 
	 * @param (optional) lang
	 */
	public function index() { 
		$this->activityLog->write( "kosong", $this);
	
	}
	
	public function generate(){
		$model 	= $this->_loadModel('session');
		$user 	= $this->_loadModel('user_model');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$data = $this->input->post();
/*================check valid username & password ===*/
		$detail= $user->detail($username);
		$this->logger->write('debug','detail username:'.$username." data:".json_encode($data)); 
		if(!isset($detail['id'])) 
			$this->_failed(202);
		
		if($user->checkUser($username, $password)){
			$token = $model->create( $this->clientcode, $this->appcode, $username);
//=========hapus yang tidak perlu
			unset($detail['password'],$detail['params'],$detail['usertype'],$detail['activation'], $detail['registerDate']);
			$result= array('token'=>$token,'user'=>$detail);
			$this->activityLog->write( $detail, $this);
			$this->_success($result);
		}
		else{
			$this->_failed(202);
		
		}
	}
	
	
}