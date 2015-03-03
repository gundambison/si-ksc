<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pasien extends CI_Controller {
var $data;
	public function detailMr($id=0)
	{ 
		 $this->data['body']='pasien/medrec';
			$data = $this->pasien->detailMR( $id );
			
			 $this->data['pasien']= $data['pasien'] ;
			 $this->data['medrec']= count($data['medrec'])==0?false:$data['medrec'];
			$this->load->view('base_view',$this->data);
		 
	}
	
	public function saveMedrec()
	{ 
		$post= $this->input->post();
		//print_r($post);
		$save = $this->pasien->saveMedrec($post);
		log_message('info', "response (save):".json_encode($save));
		if($save===false){
			$save=array('error'=>$save['message']);
		}
		echo json_encode($save);
		
	}
	
	public function addMr($id=0)
	{ 
		 $this->data['body']='pasien/addmedrec';
		 $this->data['types']=array(1=>'Dokter Gigi');
		 $this->data['gigiBagian']=array('Pilih salah satu', 'Kiri Atas','Kanan Atas','Kiri Bawah','Kanan Bawah');
		$this->data['pasien_id']=$id;
		$data = $this->pasien->detailMR( $id );
			
			 $this->data['pasien']=  $data['pasien'] ;
			 $this->data['medrec']=  count($data['medrec'])==0?false:$data['medrec'];
			$this->load->view('base_view',$this->data);
		 
	}
	
	public function detail()
	{		
		if(isset($_POST['id'])){
			$txt="open id:".$_POST['id'];$txt='';
			$data=$this->pasien->detail( $_POST['id'] );
			//$txt.="<pre>".print_r($data['pasien'],1)."</pre>";	
			$pasien=$data['pasien'];
			$txt.='<table class="table table-condensed">';
			
			$txt.="<tbody><tr><td>NAMA</td><td>&nbsp; :&nbsp; </td><td>".$pasien['name']."</td></tr>";
			$txt.="<tr><td>TANGGAL LAHIR	</td><td>&nbsp; :&nbsp; </td><td>".$pasien['birth']."</td></tr>";
			$txt.="<tr><td>MR</td><td>&nbsp; :&nbsp; </td><td>".$pasien['mr']."</td></tr>";
			$txt.="<tr><td>ALAMAT</td><td>&nbsp; :&nbsp; </td><td>".$pasien['address']."</td></tr>";
			
			$txt.="</tbody></table>";
			echo json_encode(array('message'=>$txt));
		}
		else{
			return $txt;
		}
	
	}
	
	function __construct(){
		
		$this->data['title']='Klinik Sejahtera Ciracas';
		$this->data['css_scripts']=array('page/pasien_css','font-awesome.min', ); 
		$this->data['js_scripts']=array('jquery-ui.min', 'tinymce.min','page/pasien_js',	);
		parent::__construct();
		$this->load->model('pasien_model','pasien');	
	}
	
}	