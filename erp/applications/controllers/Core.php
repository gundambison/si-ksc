<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
9 November 2015
Membuat Other 
fungsi yang sudah jalan dibuat pindah ke Other.. 

*/
class Core extends CI_Controller {
public $param; 
private $folder='core'; 
/***
Controller:	core
Function:	status
***/ 
	public function status()
	{  
		$this->param['breadcrumbs']=array('Status');
//		$this->param['defaultMenu']='status';  
		$mainPage=$this->uri->segment(1).'Status';
		$this->param['contents']=array( $mainPage );
//		$this->param['title']='ERP-core status';
/*
model: status_model
view:coreStatus_view
js: {folder}/coreStatus.js
*/
		$this->showView(); 
/*
form : coreStatusEditForm_view, coreStatusAddForm_view
data: coreStatusSave_data, coreStatus_data
*/		
		$folder=$this->param['folder'];
		$this->checkView($folder."coreStatusEditForm_view");
		$this->checkView($folder."coreStatusAddForm_view");
		$this->checkView($folder."data/coreStatusSave_data");
		$this->checkView($folder."data/coreStatus_data");

	}
 
 
/***
Controller:	core
Function:	menu
***/ 
	public function menu()
	{
//		$this->load->('menu_model','menu'); 
//		don't forget to add this
		$this->param['breadcrumbs']=array('menu');
//		$this->param['defaultMenu']='core';  
		$mainPage=$this->uri->segment(1).'Menu';
		$this->param['contents']=array( $mainPage );
//		$this->param['title']='ERP-core menu';
/*
model: menu_model
view:coreMenu_view
js: {folder}/coreMenu.js
*/
		$this->showView(); 
/*
form : coreMenuEditForm_view, coreMenuAddForm_view
data: coreMenuSave_data, coreMenu_data
*/		
		$folder=$this->param['folder'];
		$this->checkView($folder."coreMenuEditForm_view");
		$this->checkView($folder."coreMenuAddForm_view");
		$this->checkView($folder."data/coreMenuSave_data");
		$this->checkView($folder."data/coreMenu_data");

	} 

	public function mymodel()
	{
		$this->load->helper('form');
		$this->load->helper('formbootstrap');
		$this->param['breadcrumbs']=array('Generator','Controller');
		$this->param['post']=$post=$this->input->post();
		$this->param['mainMenu']=$this->menu->generate('core' );
		$this->param['contents']=array( 'coreMymodel');
		$detail='';
		if($this->input->post('type')){
			$folder=$this->param['folder'];
			$this->checkView($folder.'tmp_model','view');
			$detail=print_r($this->param['post'],1);
			$fields = $this->db->list_fields($post['table']);
			$fieldsdata = $this->db->field_data($post['table']);
			
			$this->param['fieldsdata']=$fieldsdata;
			$this->param['fieldId']=$fields[0];
 //-------------------clean fieldname
			$pos=strpos($fields[0],"_");
			if($pos===false){
				$fields1=$fields;
			}else{ 
				$prefix=substr($fields[0],0,$pos+1);
				$this->param['prefix']=$prefix;
				$fields1=array();
				foreach($fields as $val){
					$fields1[]="`$val` `".str_replace($prefix,"", $val)."`";
				}
			}
			$this->param['fields']=$fields1;
			$detail.="<ol>";
			foreach ($fields as $field){
				$detail.="<li>{$field}</li>";				
			}
			$detail.="</ol>";
			$tmp=$this->load->view($folder.'oth/tmp_model',$this->param,true);
			$detail="<?php\n$tmp ";
		}else{}
			$this->param['detail']=$detail;
		$this->showView(); 
	}
	
	public function mycontroller()
	{
		$this->load->helper('form');
		$this->load->helper('formbootstrap');
		$this->param['breadcrumbs']=array('Generator','Controller');
		$mainPage=$this->uri->segment(1).'Mycontroller';
		$this->param['contents']=array( $mainPage);
		$this->param['title']='ERP::Controller Generator';
		$this->param['post']=$post=$this->input->post();
		if($this->input->post('type')){
			$folder=$this->param['folder'];
			$this->checkView($folder.'oth/tmp_controller','view');
			$tmp=$this->load->view($folder.'oth/tmp_controller',$this->param,true);
			$detail="\n$tmp ";
			$detail=str_replace("< ?","<?",$detail);
		}else{ $detail=''; }
		$this->param['detail']=$detail;
/*
model: mycontroller_model
view:coreMycontroller_view
js: {folder}/coreMycontroller.js
*/
		$this->showView(); 
	}
/***
Controller:	core
Function:	tables
***/ 
	public function tables()
	{
//		$this->load->('tables_model','tables'); 
//		don't forget to add this
		
		$this->param['defaultMenu']='core';  
		$mainPage=$this->uri->segment(1).'Tables';
		$this->param['contents']=array( $mainPage );
		$this->param['breadcrumbs']=array('System','Tables Management');
		$this->param['title']='ERP::System::Tables';
/*
model: tables_model
view:coreTables_view
js: {folder}/coreTables.js
*/
		$this->showView(); 
/*
form : coreTablesEditForm_view, coreTablesAddForm_view
data: coreTablesSave_data, coreTables_data
*/		
		$folder=$this->param['folder'];
		$this->checkView($folder."coreTablesEditForm_view");
		$this->checkView($folder."coreTablesAddForm_view");
		$this->checkView($folder."data/coreTablesSave_data");
		$this->checkView($folder."data/coreTables_data");

	}
 
	public function index()
	{
		$this->param['defaultMenu']='core';  
		$mainPage='icon'; //$this->uri->segment(1).'Status';
		$this->param['contents']=array( 'icon' );
		$this->param['title']='ERP'; 
		$this->param['breadcrumbs']=array('icon' );
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
		$respon['raw']=$data;
		$respon['load']=$load_view;
		echo json_encode( $respon );
		
	}
	
	function form($module){	
		$folder=$this->param['folder'];
		//$module=ucfirst(strtolower($module));
		if(strtolower($module)=='coretablesother'){
			$row2=$this->table->getData($_POST['table_id']);
//			$fields = $this->db->list_fields($row2['name']);
//			$fieldsdata = $this->db->field_data($row2['name']);
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
		if(is_array($respon)){
			$respon['param']=$_REQUEST;
		}else{
			$respon['raw']=$data;
			$respon['view']=$load_view;
		}
		
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
		$this->load->model('tables_model','table');
		$this->load->model('status_model','status'); 
		$this->load->model('permision_model','permision'); 
		$this->load->model('user_model','user');
 		$this->load->library('session');
		
		$this->param['user']=$user=$this->maincore->checkUser();
		if($user==false){
			$pos=$this->uri->segment(1,'')."/".$this->uri->segment(2,'');
			$url=base_url().$pos;
			$this->session->set_userdata('target_url',$url);
			//$this->session->set_userdata($data);
			redirect(base_url('member/login'),'refresh');
		}else{}
		
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