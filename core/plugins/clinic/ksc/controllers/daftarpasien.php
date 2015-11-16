<?php
/*
	Name	: Daftarpasien
	Created : 2015-02-13 11:18:40
	By		: Gunawan Wibisono (gundambison@gmail.com)
	access	: Clinic/ksc/daftarpasien
	
	list field tersedia : 
			  `dafpat_id`, `dafpat_dafid`, `dafpat_patid`, `dafpat_usrid`, `dafpat_docid`, `dafpat_date`, `dafpat_jasaadmin`, `dafpat_jasadr`, `dafpat_farno`, `dafpat_fartot`, `dafpat_other`, `dafpat_total`, `dafpat_atasNama`, `dafpat_uniqCode`, `dafpat_appBy`, `dafpat_appDate`, `dafpat_deleteBy`, `dafpat_type`, `dafpat_payId` 
	id 		: dafpat_id
	
 
2015-10-19
	Penambahan variabel Search

*/
class Controllers_Clinic_Ksc_Daftarpasien extends Modules_Plugin_Base {
private $maxLimit0 = 15; //Manual
private $maxLimit = 100; //Manual
var $model; //main model
	
	public function __construct() {
		parent::__construct();
		$this->logger->write('debug', ' daftarPasien |HTTP REQUEST: '.print_r($_REQUEST,1));
		//$this->model = $this->_loadModel('daftarpasien_model'); //base
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
	
	public function listBilling(){
		$model = $this->_loadModel('daftarpasien_model');
		$doctorModel = $this->_loadModel('doctor_model');
		$pasienModel = $this->_loadModel('pasien_model');
		$user = $this->_loadModel('user_model');
		$daftar = $this->_loadModel('daftar_model');
		$this->logger->write('info', 'add Detail');	
		//$daftar->addDetail();
			
		$limit= $this->input->post('limit');
		if($limit==0)$limit= $this->maxLimit;
		$start= $this->input->post('start');
		$seeGPOnly = $this->input->post('gp');
		$search=$this->input->post('search'); 
		
		$result=array();
		$this->logger->write('info', 'daftar pasien |gp:'.$seeGPOnly.' |start:'.$start.' |limit:'.$limit);	
		if($search==''){
			$daftarpasien=$seeGPOnly==''?$model->listV1($limit,$start):$model->listV1($limit,$start,'daf_enable=1 and daf_id = dafpat_dafid and dafpat_docid=0 and dafpat_type=0');	
		}
		else{ 
			$daftarpasien=$model->listSearch($limit,$start,$search);
		
		}
		
		$this->logger->write('info', 'total daftar :'.count($daftarpasien) );
		$pasien=array();
		$dokter=array($doctorModel->detail(1));
		$dokter[0]['name']='G.P.';
		$runDoc=$runPatient=0;
		foreach($daftarpasien as $num=>$data){
			$daftar->addDetail($data['dafid'], $data);
			if(!isset($dokter[$data['docid']] ) ) {
				$dokter[$data['docid']]=$doctorModel->detail($data['docid']);
				$runDoc++;
			}else{ }
			//$daftarpasien[$num]['doctor']=$data['docid']==0?'GP':$doctor->detail($data['docid'])['name'];
			$daftarpasien[$num]['daftar']=$daftar->detail($data['dafid']);
			
			if(!isset($pasien[$data['patid']])){
				$pasien[$data['patid']]= $pasienModel->detailSimple($data['patid']);
				$runPatient++;
				//$daftarpasien[$num]['pasien']=$pasien->detail($data['patid']);
			}else{ }
			$kwitansi=$model->kwitansi($data['dafid'],$status);
			
			$daftarpasien[$num]['kwitansi']=$kwitansi;
			$daftarpasien[$num]['status']=$status;
			$daftarpasien[$num]['user']=array(
			  'daftar'=>$user->detail($data['usrid'],'id')['name'] ,
			  'approve'=>$user->detail($data['appBy'],'id')['name'],
			
			);
			//$daftarpasien[$num]['pasien']=$pasienModel->detail($data['patid']);
			$daftarpasien[$num]['tarif']=$daftar->showTarif($data['dafid']);
			
		}	
		$this->logger->write('info', 'total input pasien:'.$runPatient.' |doctor:'.$runDoc);		
		$result['show']=count($daftarpasien);
		$result['daftarpasien']=$daftarpasien;
		$result['pasien']=$pasien;
		$result['dokter']=$dokter;
		
		if($daftarpasien){			 
			$this->_success($result);
		}
		//failed harus ada di akhir
		$this->_failed(209);
		
	}
	
	public function all()
	{
		$model = $this->_loadModel('daftarpasien_model');
		$doctor = $this->_loadModel('doctor_model');
		$result=array(
			'total'=>$model->total(),
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
		$model = $this->_loadModel('daftarpasien_model');
		$doctor = $this->_loadModel('doctor_model');
		
		$this->checkToken();
//============tambah data bila diperlukan
		$post=$this->input->post();
		$this->logger->write('debug', 'post data: '.print_r($post,1));
		$tmp= $this->input->post('pay');
		$pay=json_decode($tmp,1);
		$this->logger->write('debug', 'pay data: '.print_r($pay,1));
		$tmp= $this->input->post('add');		
		$data=json_decode($tmp,1);
		$this->logger->write('debug', 'add data: '.print_r($data,1));
		$search="dafpat_dafid=". $data['dafpat_dafid']." and dafpat_type=0";
		$result=$model->searchId($search);
		//$data['status']=1;
/*		
	list field di input : `dafpat_id`, `dafpat_dafid`, `dafpat_patid`, `dafpat_usrid`, `dafpat_docid`, `dafpat_date`, `dafpat_jasaadmin`, `dafpat_jasadr`, `dafpat_farno`, `dafpat_fartot`, `dafpat_other`, `dafpat_total`, `dafpat_atasNama`, `dafpat_uniqCode`, `dafpat_appBy`, `dafpat_appDate`, `dafpat_deleteBy`, `dafpat_type`, `dafpat_payId` 	
*/	
		if($result['c']==0){
			$model->makeMin($data['dafpat_dafid']);
		}else{ 
			//$this->_success();
		}
		if($model->add($data, $pay)){
//=============DETAIL
			if( $data['dafpat_docid']!=0){
				$docData=$doctor->detail($data['dafpat_docid']);
			}else{
				$docData=array('name'=>'GP');
			}
			$this->logger->write('debug','docData:'.json_encode($docData));
			$strDoc="doc\n{$docData['name']}[br]";
			$data2=array(
			'dd_daf'=> $data['dafpat_dafid'],
			'dd_rujuk'=> $post['rujuk'],
			'dd_pat'=>$data['dafpat_patid'],
			'dd_doc'=>$data['dafpat_docid'],
			'dd_pay'=>$pay['pay'],
			'dd_other'=>$strDoc
			);
			$model->addDetail($data2);
			$this->_success();
		}else{  }
		  
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
	
	public function listByPasien(){
		$model = $this->_loadModel('daftarpasien_model');
		$doctor = $this->_loadModel('doctor_model');
		$post=$this->input->post();
		$this->logger->write('debug', 'post data: '.print_r($post,1));
		$patid=$post['pat_id'];
		$list = $model->listByPasien($patid);
		if($list){
			$daftar=array();
			foreach($list as $id){
				$detail=$model->detail($id);
				if( $detail['docid']!=0){
					$docData[$detail['docid']]=$doctor->detail($detail['docid']);
				}else{
					$docData[0]=array('name'=>'GP');
				}
				 
				$daftar[]=$detail;
			}
		}else{}
		
		if(isset($daftar)){
			$result=array();
			$result['list']=$list;
			$result['daftarpasien']=$daftar;
			$result['doctor']=$docData;
			$this->_success($result);
		}else{
			$this->_failed(209);
		}
	}
	
	private function checkToken(){	
		if($this->_isTokenValid($this->clientcode, $this->input->post('token'), $this->input->post('username') ) ){
			return true; 
		}
		$this->_failed(204);
	}
	
}