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

	public function detail(){
		$model = $this->_loadModel('daftar_model');
		$doctormodel = $this->_loadModel('doctor_model');
		$dafpatmodel = $this->_loadModel('daftarpasien_model');
		$pasienmodel = $this->_loadModel('pasien_model');
		$data= $this->input->post();
		
		$result=array();//'post'=>$data);
		$detail=$model->detail($data['daf_id']);
		$result['daftar']=$detail;
		
		$dt= $dafpatmodel->detail($data['daf_id'],'dafpat_dafid');		 
			$result['daftarpasien']=$dt['num']==1?array($dt):$dt ;
		$result['total']=$result['daftarpasien'][0]['total'];
		$result['doc_id']=$detail['doc_id'];
		$result['pasien']=$pasienmodel->detailSimple($detail['pat_id']);
		$result['doctor']=$doctormodel->detail($detail['doc_id']);
		$result['tarif']=$model->showTarif($data['daf_id']);
/*		
	list field di input : `daf_id`, `daf_timeEnter`, `daf_timeArrive`, `daf_userInp`, `daf_comment`, `daf_enable`, `daf_deleteBy` 	
*/		 
		$this->_success($result);
		$this->_failed(209);
		
	}
	
	public function __construct() {
		parent::__construct();
//		$this->logger->write('debug', 'HTTP REQUEST: '.print_r($_REQUEST,1));
		//$this->model = $this->_loadModel('daftar_model'); //base
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
		$model = $this->_loadModel('daftar_model');
		//$this->checkToken();
//============tambah data bila diperlukan
		$data= array();//$this->input->post();
		$data['daf_enable']=0;
/*		
	list field di input : `daf_id`, `daf_timeEnter`, `daf_timeArrive`, `daf_userInp`, `daf_comment`, `daf_enable`, `daf_deleteBy` 	
*/		
		$id=$model->add($data);
		if($id)
			$this->_success(array('id'=>$id));
		$this->_failed(209);
	}
	
	public function update(){
		$model= $this->_loadModel('daftar_model');
		$this->checkToken();
//============tambah data bila diperlukan
		$tmp= $this->input->post('update');
		$data=json_decode($tmp,TRUE);
		$id= $this->input->post('id'); //atau kode bila bukan angka
		$data['daf_enable']=1;
/*		
	list field di input : `daf_id`, `daf_timeEnter`, `daf_timeArrive`, `daf_userInp`, `daf_comment`, `daf_enable`, `daf_deleteBy` 	
	id : daf_id
*/		
		$key= $id ;
		
		if($model->update($data,$key))
			$this->_success();
		$this->_failed(209);
	}
	
	function logs(){
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