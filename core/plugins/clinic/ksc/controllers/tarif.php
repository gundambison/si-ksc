<?php
/*
	Name	: Tarif
	Created : 2015-02-13 11:18:40
	By		: Gunawan Wibisono (gundambison@gmail.com)
	access	: Clinic/ksc/tarif
	
	list field tersedia : 
			  `tarif_id`, `tarif_name`, `tarif_price`, `tarif_tariftypeid`, `tarif_persen` 
	id 		: tarif_id
*/
class Controllers_Clinic_Ksc_Tarif extends Modules_Plugin_Base {
private $maxLimit0 = 15; //Manual
private $maxLimit = 100; //Manual
var $model; //main model
	
	public function __construct() {
		parent::__construct();
		//$this->logger->write('debug', 'HTTP REQUEST: '.print_r($_REQUEST,1));
		$this->model = $this->_loadModel('tarif_model'); //base
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
	 * API INDEX Tarif
	 * @param ccode
	 * @param appid	  	 
	 */
	public function index() { 
		$this->logger->write('debug', 'HTTP REQUEST: '.print_r($_REQUEST,1));
		
	}
	
	public function search()
	{
		$data= $this->input->post();
		$tarif=$this->model->search($data);
		$result['show']=count($tarif);
		$result['tarif']=$tarif;
		
		if($tarif){			 
			$this->_success($result);
		}
		//failed harus ada di akhir
		$this->_failed(208);
	}
	
	public function all()
	{
		$result=array(
			'total'=>$this->model->total(),
		);
/*		
	list field tersedia : `tarif_id`, `tarif_name`, `tarif_price`, `tarif_tariftypeid`, `tarif_persen` 	
*/
		$tarif=$this->model->getAll();
		$result['show']=count($tarif);
		$result['tarif']=$tarif;
		
		if($tarif){			 
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
	list field di input : `tarif_id`, `tarif_name`, `tarif_price`, `tarif_tariftypeid`, `tarif_persen` 	
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
	list field di input : `tarif_id`, `tarif_name`, `tarif_price`, `tarif_tariftypeid`, `tarif_persen` 	
	id : tarif_id
*/		
		$key="`tarif_id`='{$id}'";
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