<?php
/*
	Clinic/ksc/pasien/index
*/
class Controllers_Clinic_Ksc_Pasien extends Modules_Plugin_Base {
private $maxLimit0 = 25; //Manual
private $maxLimit = 100; //Manual
	
	public function __construct() {
		parent::__construct();
		//$this->logger->write('debug', 'HTTP REQUEST: '.print_r($_REQUEST,1));
		
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
		$fields= $this->input->post('fields');
		$start= $this->input->post('start');
		//$this->checkToken();
		$pasien= $this->_loadModel('pasien_model'); #harus memakai _model
		$limit= $limit < $this->maxLimit?$limit:$this->maxLimit;
		$list = $pasien->showNum($start,$limit,$fields);
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
	
	public function search(){
		$result=array('message'=>'success');
		$data = $this->input->post();
		$limit= $this->input->post('limit');
		$fields= $this->input->post('fields');
		$search= $this->input->post('search');
		$pasien= $this->_loadModel('pasien_model'); #harus memakai _model
		$limit= $limit < $this->maxLimit?$limit:$this->maxLimit;
		if($search!=''){
			$list = $pasien->searchData($search,$limit,$fields);
		}else{}
			$params= $this->input->post('params');
		$list=array();
		if(isset($params)&&isset($params['no'])){
				$search="pat_id like '%{$params['no']}%' or pat_mr like '%{$params['no']}%' ";
				$list = $pasien->searchData($search,$limit,$fields);
		}
		
		if(isset($params)&&isset($params['birth'])){
				$lahir=$params['birth'];
				$sDate=substr($lahir,0,2);
				$sMonth=substr($lahir,2,2);///$lahir[2].$lahir[3];
				$sYear=substr($lahir,4,2);//$lahir[4].$lahir[5];
				$cari='';
				if(intval($sYear)==0){
					$cari.='%-';
				}else{
					$cari.="%$sYear-";
				}
				
				if(intval($sMonth)==0){
					$cari='%-';
				}else{
					$cari.="$sMonth-";
				}
				
				if(intval($sDate)==0){
					$cari=false;
				}else{
					$cari.="$sDate";
				}
				$search="pat_birth like '{$cari}'";
				$list2 = $pasien->searchData($search,$limit,$fields);
				$list=array_merge($list,$list2);
		}
		
		if(isset($params)&&isset($params['name'])){
			$cari=$params['name'];	
				$search="(pat_name1 like '%{$cari}%' or pat_name2 like '%{$cari}%' )";
				$list2 = $pasien->searchData($search,$limit,$fields);
				$this->logger->write('debug', 'search param:'.$search.' |total:'.count($list2) );
				$list=array_merge($list,$list2);
		}
		
		if($list){			
			$this->logger->write('debug', 'result total:'.count($list) );
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
		$data['address']=trim($data['addr'])."\n". trim($data['village'])."\n";
		if(strtolower($data['addr2'])!=='lain-lain')
			$data['address'].= trim($data['addr3']);
			
		$result=array('pasien'=>$data);
		if($result['pasien']!=false){
			 
			 $result['asuransi']=$pasien->detailAsuransi($id); #bila kosong maka array
			 $result['perusahaan']=$pasien->detailPerusahaan($id); #bila kosong maka array
			if(isset($showMR)){
				$result['medrec']=$pasien->detailMR($id);
			}
			$result['degeneratif']=$pasien->detailDegeneratif($id);
			$this->_success($result);
		}
		
		$this->_failed(209);
		
	}
	
	public function savemedrec()
	{
		$model 	= $this->_loadModel('session');
		$user 	= $this->_loadModel('user_model');
		$pasien= $this->_loadModel('pasien_model');
		$diagnosa= $this->_loadModel('diagnosa_model');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$data = $this->input->post();
		$this->logger->write('debug', 'post:'.json_encode($data));
/*================check valid username & password ===*/
		$detail= $user->detail($username);
		//$this->logger->write('debug','user detail='.json_encode($detail) );
		if(!isset($detail['id'])) 
			$this->_failed(202);
			
		if($user->checkUser($username, $password)){
			$data['user']=$detail['id'];	
			$daf=0;
			$status = $pasien->savemedrec($data,$daf);
			if($status===false) 
					$this->_failed(209);
//=======tambah diagnosa 
			$pasien->removeDaftarDiagnosa($daf);
		//$id=$this->idTable('medrec',726352);
		//klinik_diagnosa {d_id, d_code1,d_code2}
			$ar=explode("\n",trim($data['diagnosa']['detail']));
			foreach($ar as $s1){
				$ar2=explode(" ",trim($s1));
				$s2=trim(strtoupper($ar2[0]));
				$diag=$diagnosa->search($s2);
				foreach($diag as $row){
					if(trim(strtoupper($row['code1']))== $s2 ){
						$pasien->addDaftarDiagnosa($daf,$row['id']);
					}else{}
				}
				
			}
	 		 
			$result=array('message'=>'save ok'); 
			$this->_success($result);
		}
		else{
			$this->_failed(202);
		
		}
			
		$this->_failed(209);
	}
	
	public function update()
	{
		$model 	= $this->_loadModel('session');
		$user 	= $this->_loadModel('user_model');
		$pasien= $this->_loadModel('pasien_model');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$post = $this->input->post();
		
		$detail= $user->detail($username);
		if(!isset($detail['id'])) 
			$this->_failed(202);
			
		if($user->checkUser($username, $password)){
			
			$data=json_decode($post['update'],1);		
			$key='pat_id='.$post['id'];

			//===MR
			if(isset($data['mr'])){
				$mr=$data['mr'];unset($data['mr']);
				$pasien->updateMR($mr, $post['id']);
			}
			unset($data['id']);
			//======wni
			if(isset($data['wni'])){
				$data['pat_wni']=$data['wni'];unset($data['wni']);
			}
			
			$this->logger->write('debug', 'Act:Update Patient |username:'.$username.' |data:'.json_encode($data));
			$status = $pasien->update($data, $key);			
			if($status===false) 
					$this->_failed(209);
			
			if($post['deg']){
				$this->logger->write('debug', 'Act:Update Patient Degeneratif |username:'.$username.' |data:'.json_encode($post['deg']));
				$deg=implode("\n",array_keys($post['deg']));
				$status = $pasien->updateDegeneratif($deg, $post['id']);			
				if($status===false) 
					$this->_failed(209);
				//pd_det, pd_pat
			}
			
			$result=array('message'=>'save ok' ); 
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
