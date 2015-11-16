<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
9 November 2015
Membuat Other 
fungsi yang sudah jalan dibuat pindah ke Other.. 

*/
class Temp extends CI_Controller {
public $param; 
private $folder='temp'; 
		
	public function test1()
	{
		$this->load->helper('form');
		$this->load->helper('formbootstrap');
		$this->param['breadcrumbs']=array('Home');
		$mainPage='icon'; //$this->uri->segment(1).'Status';
		$this->param['contents']=array( 'welcome');
		$this->param['title']='Ciracas::dashboard'; 
		$this->showView(); 
		//$this->load->view('temp/example_view');
	}	
/***
Controller:	temp
Function:	gundam
***/ 
	public function gundam()
	{ 
//		don't forget to add this
		$this->param['breadcrumbs']=array('update','this');
//		$this->param['defaultMenu']='temp';  
		$mainPage=$this->uri->segment(1).'Gundam';
		$this->param['contents']=array( $mainPage );
 		$this->param['title']='ERP::temp::gundam';
/*
model: gundam_model
view:tempGundam_view
js: {folder}/tempGundam.js
*/
		$this->showView(); 
/*
form : tempGundamEditForm_view, tempGundamAddForm_view
data: tempGundamSave_data, tempGundam_data
*/		
		$folder=$this->param['folder'];
		$this->checkView($folder."tempGundamEditForm_view");
		$this->checkView($folder."tempGundamAddForm_view");
		$this->checkView($folder."data/tempGundamSave_data");
		$this->checkView($folder."data/tempGundam_data");

	}
  
	public function index()
	{
		$this->param['defaultMenu']='core';  
		$mainPage='icon'; //$this->uri->segment(1).'Status';
		$this->param['contents']=array( 'listjs' , 'icon');
		$this->param['title']='Temp::dashboard'; 
		$this->showView(); 
		//$this->load->view('temp/example_view');
	}
/* ========================================	
TRY NOT TO EDIT THIS
*/
	function data($module){	
		$folder=$this->param['folder'];
		$load_view= $folder.'data/'.$module.'_data'; 
		$this->checkView($load_view,'body');
		$this->param['get']=$this->input->get(NULL,true);
		$this->param['post']=$this->input->post(NULL,true); 
		$data=$this->load->view($load_view,$this->param,true); 
		$respon=json_decode($data,true);
		//$respon['raw']=$data;
		//$respon['load']=$load_view;
		echo json_encode( $respon );
		
	}
	
	function form($module){	
		$folder=$this->param['folder']; 
		if(strtolower($module)=='coretableother'){
			$row2=$this->table->getData($_POST['table_id']); 
			$this->param['tablename']=$row2['name'];
			$this->param['prefix']=$row2['prefix'];
			
		}
		$load_view= $folder.$module.'Form_view';
		$this->checkView($load_view,'body');
		$this->param['get']=$this->input->get(NULL,true);
		$this->param['post']=$this->input->post(NULL,true);
		$this->load->helper('form');
		$this->load->helper('formbootstrap');
	//============== 
		$data=$this->load->view($load_view,$this->param,true); 
		$respon=json_decode($data,true);
		$respon['param']=$_REQUEST;
		
		
		echo json_encode( $respon ); 
		
	}
	
	private function showView(){
		$done=true;
		$name=$this->uri->segment(2,'');
		$jsScript=$this->param['folder'].$this->uri->segment(1).ucfirst($name).".js";
		$this->checkView($jsScript,'js');
		$this->param['mainMenu']=$this->menu->generate($this->param['defaultMenu']);
		$this->maincore->showView($this->param,'baseMetro_view');
		
	}
	
	private function checkView($target,$stat='view'){
		$this->maincore->checkView($target,$stat);
	}
	
	function __CONSTRUCT(){
		parent::__construct();
		
 		$this->load->model('menu_model','menu'); 
		$this->load->model('main_model','maincore');
		$this->load->model('user_model','user');
		$this->load->model('gundam_model','gundam');
 		$this->load->library('session');
		$login=(isset($_POST['act'])&&$_POST['act']=='login')?true:false;
		if($login==false){
			$login=($this->uri->segment(2,'')=='logout')?true:false;	
		}
		
		if($this->uri->segment(2,'')!=='login'&&$login!==true){
			$this->param['user']=$user=$this->maincore->checkUser();
			if($user==false){
				$pos=$this->uri->segment(1,'')."/".$this->uri->segment(2,'');
				$url=base_url().$pos;
				$this->session->set_userdata('target_url',$url); 
				redirect(base_url('member/login'),'refresh');
			}else{}
		}
		
		date_default_timezone_set('Asia/Jakarta');
		$this->param['title']='ERP-admin';
		$this->param['today']=date('Y-m-d');
		$this->param['folder']=$this->folder.'/';
		$this->param['baseFolder']='metro/';
		$this->param['footerJS']=array();
		
		log_message('info','post:'.json_encode($_POST));
		log_message('info','get:'.json_encode($_GET));
		 
		$this->param['defaultMenu']='Core';
		$this->param['thisUrl']= $this->uri->segment(1).'/'.$this->uri->segment(2);
		$this->param['css']=array(			
			'jqgrid3.8/ui.jqgrid.css'
		);
		$this->param['js']=array(			
			'metro/jquery-1.9.1.min.js',
			
		);
		
		$this->param['footerJS']=array(			
			'metro/jquery-migrate-1.0.0.min.js',
			'metro/jquery-ui-1.10.0.custom.min.js',
			'metro/jquery.chosen.min.js',
			'metro/jquery.cleditor.min.js',
			'metro/jquery.cookie.js',
			'metro/jquery.dataTables.min.js',
			'metro/jquery.elfinder.min.js',
			'metro/jquery.flot.js',
			'metro/jquery.flot.pie.js',
			'metro/jquery.flot.resize.min.js',
			'metro/jquery.flot.stack.js',
			'metro/jquery.gritter.min.js',
			'metro/jquery.imagesloaded.js',
			'metro/jquery.iphone.toggle.js',
			'metro/jquery.knob.modified.js',
			'metro/jquery.masonry.min.js',
			'metro/jquery.noty.js',
			'metro/jquery.raty.min.js',
			'metro/jquery.sparkline.min.js',
			'metro/jquery.ui.touch-punch.js',
			'metro/jquery.uniform.min.js',
			'metro/jquery.uploadify-3.1.min.js',
			'metro/modernizr.js',
			'metro/retina.js',
			'metro/bootstrap.min.js',
			'metro/counter.js',
			'metro/custom.js',
			'metro/excanvas.js',
			'metro/fullcalendar.min.js',
			//=============
			'jqgrid3.8/i18n/grid.locale-en.js',
			'jqgrid3.8/jquery.jqGrid.js', 
		);
//=============MAIN JS		
		$jsScript='main.js';
		$this->checkView($jsScript,'js');
		$this->param['footerJS'][]=$jsScript;
//=============sub JS 			
		$name=$this->uri->segment(2,'');
		$jsScript=$this->param['folder'].$this->uri->segment(1).ucfirst($name).".js";
		if($name!=''){
			$this->param['footerJS'][]=$jsScript;			
		}else{}
		$this->param['dataUrl']=  $this->uri->segment(1). "_".$name;
		$this->param['myUrl']=  $this->uri->segment(1).ucfirst($name);
		$id=dbIdReport('id','activity',json_encode($_REQUEST)); 
		$this->param['breadcrumbs']=array('unknown');
	}	
}