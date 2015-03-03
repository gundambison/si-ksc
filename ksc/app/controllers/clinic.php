<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Clinic extends CI_Controller {
var $data;
	public function index()
	{
		$this->load->model('doctor_model','doctor');
		$this->load->model('pasien_model','pasien');
		$data = $this->pasien->byDocType(2 );
		//echo '<pre>'.print_r($data,1);
		if(!isset($data['doctortypes'])){
			die('data error :'.print_r($data,1));
		}
		$list=array('Pilih salah Satu');
		foreach($data['doctortypes'] as $dt){
			 
			$list[ $dt['id'] ]= strtoupper($dt['name']);
		}
		$this->data['doctypes']=$list;
		
		$this->data['body']='clinic/gigi';
		
		//PASIEN
		$txt='';
		foreach($data['pasien'] as $row){
				$act="<button type='button' class='detail' patid='{$row['pasien_id']}' onclick='detailPat(this)'>detail</button> 
				<button type='button' class='detailMR' patid='{$row['pasien_id']}' onclick='detailPat2(this)'>detail MR</button>
				<button type='button' patid='{$row['pasien_id']}' class='mr' onclick='mrAdd(this)'>tambah MR</button>";
				$txt.=sprintf("\n<tr>\t<td>%s</td>\t<td>%s (%07s)</td>
				<td>%08s</td><td>%s</td>
				<td>%s<!-- %s --></td>
				</tr>",$row['dokter'],$row['name'],$row['mr'],
				$row['daftar_pasien'], $row['daftarDate'], 
				$act,json_encode($row));
			}
		$this->data['pasien']=$txt;
		$this->load->view('base_view',$this->data);
	}

	public function index0()
	{
		$this->load->model('doctor_model','doctor');
		//$API = $this->core_model;
		//TYPE DOKTER
		$type=$this->doctor->allType( );
		 
		$list=array('Pilih salah Satu');
		foreach($type['doctortypes'] as $dt){
			 
			$list[ $dt['id'] ]= strtoupper($dt['name']);
		}
		$this->data['doctypes']=$list;
		
		$this->data['body']='home';
		$this->data['pasien']=$this->pasienlist(2);
		$this->load->view('demo2',$this->data);
	}
	
	public function pasienlist($id=0){
		$this->load->model('pasien_model','pasien');
		if(isset($_POST['stat'])&&$_POST['stat']=='byType'){
			$data = $this->pasien->byDocType($_POST['id']);
		}else{
			$data = $this->pasien->byDocType($id );
		}
		
		 $result= $data  ;
		 if($result==false){
			$txt="<tr><td colspan=4>Tidak ada data </td></tr>";
		 }else{
			 $txt='';
			 
			foreach($result['pasien'] as $row){
				$act="<button type='button' class='detail' patid='{$row['pasien_id']}' onclick='detailPat(this)'>detail</button> 
				<button type='button' class='detailMR' patid='{$row['pasien_id']}' onclick='detailPat2(this)'>detail MR</button>
				<button type='button' patid='{$row['pasien_id']}' class='mr' onclick='mrAdd(this)'>tambah MR</button>";
				/*
				$txt.=sprintf("\n<tr>\t<td>%s</td>\t<td>%s</td><td>%s<!-- %s --></td>
				</tr>",$row['dokter'],$row['name'],$act,json_encode($row));
				*/
				$txt.=sprintf("\n<tr>\t<td>%s</td>\t<td>%s (%07s)</td>
				<td>%08s</td><td>%s</td>
				<td>%s<!-- %s --></td>
				</tr>",$row['dokter'],$row['name'],$row['mr'],
				$row['daftar_pasien'], $row['daftarDate'], 
				$act,json_encode($row));
				
			}
		
		}
		
		if(isset($_POST['id'])){
			echo json_encode(array('message'=>$txt));
		}
		else{
			return $txt;
		}
	}
	
	public function tes()
	{
		$this->load->model('homemodels','',true);
		$d['example']=$this->homemodels->tes();;
		$d['title']='contoh aja';
		$d['desc']='Penjelasan';
		$d['keyword']='blab;ab;a';
		$this->load->view('basic',$d);
		
	}
	
	function __construct(){
		$this->data['title']='Klinik Sejahtera Ciracas';
		$this->data['js_scripts']=array('jquery-ui.min', 'page/clinic_js');
		$this->data['css_scripts']=array('jquery-ui.min');
		parent::__construct();
	}
}

