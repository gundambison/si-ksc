<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
9 November 
* Generator

8 November 2015
* Status
* Table (on progress)
* Table Status 

saat membuat Table akan membuat table baru

*/
class Admin extends CI_Controller {
public $param; 
	/***
Controller:	admin
Function:	tables
***/ 
	public function tables()
	{
		$this->param['defaultMenu']='temp'; 
		$mainPage=$this->uri->segment(1).'Tables';
		$this->param['contents']=array( $mainPage, 'modal');
/*
model: tables_model
view: tables_view
js: {folder}/admin_tables.js
*/
		$this->showView(); 
/*
mainmenu_add : formtablesedit_view, formtablesadd_view
data: tablessave_data, admin_tables_data
*/		
		$folder=$this->param['folder'];
		$this->checkView($folder."adminTablesEditForm_view");
		$this->checkView($folder."adminTablesAddForm_view");
		$this->checkView($folder."adminTablesSave_data");
		$this->checkView($folder."adminTables_data");

	} 
	
	public function status()
	{
		$this->param['defaultMenu']='admin'; 
		$this->param['contents']=array( 'status', 'modal');
/*
model: status_model
view:status_view
js: admin/admin_status.js
*/
		$this->showView(); 
/*
mainmenu_add : formStatusedit_view, formStatusadd_view
data: statussave_data, admin_status_data
*/		

	}
	
	public function index()
	{
		//unset($this->param['footerJS']);
		$this->param['mainMenu']=$this->menu->generate( );
		$this->load->view('base_view',$this->param);
	}
/* ========================================	
TRY NOT TO EDIT THIS
*/
	function data($module){	
		$folder=$this->param['folder'];
		$load_view= $folder.$module.'_data';
		$this->checkView($load_view,'body');
		$this->param['get']=$this->input->get(NULL,true);
		$this->param['post']=$this->input->post(NULL,true); 
		$data=$this->load->view($load_view,$this->param,true); 
		$respon=json_decode($data,true);
		$respon['load']=$load_view;
		echo json_encode( $respon );
		
	}
	
	function form($module){	
		$folder=$this->param['folder'];
		//$module=ucfirst(strtolower($module));
		if(strtolower($module)=='admintablesother'){
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
		$respon['param']=$_REQUEST;
		
		
		echo json_encode( $respon ); 
		
	}
	
	private function showView(){
		$done=true;
		$name=$this->uri->segment(2,'');
		$jsScript=$this->param['folder'].$this->uri->segment(1).ucfirst($name).".js";
		$this->checkView($jsScript,'js');
		$this->param['mainMenu']=$this->menu->generate($this->param['defaultMenu']);
		$this->maincore->showView($this->param);
	}
	
	private function checkView($target,$stat='view'){
		$this->maincore->checkView($target,$stat);
	}
	
	function __CONSTRUCT(){
		parent::__construct();
		
		$this->load->model('user_model','user');			
		$this->load->model('menu_model','menu'); 
		$this->load->model('main_model','maincore');
		$this->load->model('status_model','status');		
		$this->load->model('tables_model','table');	 
		$this->load->library('session');
		date_default_timezone_set('Asia/Jakarta');
		$this->param['title']='ERP-admin';
		$this->param['today']=date('Y-m-d');
		$this->param['folder']='admin/';
		$this->param['footerJS']=array();
		
		log_message('info','post:'.json_encode($_POST));
		log_message('info','get:'.json_encode($_GET));
		 
		$this->param['defaultMenu']='Core';
		$this->param['thisUrl']= $this->uri->segment(1).'/'.$this->uri->segment(2);
		$this->param['css']=array(			
			'cupertino/jquery-ui-1.10.3.custom.min.css',
			'jqgrid3.8/ui.jqgrid.css'
		);
		$this->param['js']=array(
			'jquery-1.9.min.js',	
			'bootstrap.js',
		);
		
		$this->param['footerJS']=array(			
			'jquery-ui-1.9.2.min.js',			
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
		
	}	
	
	public function test()
	{
		$this->param['baseFolder']='demo/';
		$this->param['folder']='demo/';
		$this->param['content']='table';
		//$this->config->load('logConfig', TRUE);
		 //$logConfig = $this->config->item( 'logConfig');
		 //var_dump( $logConfig ); die('--');
		 logCreate('hello');
		 logConfig('hello core','logCore');
		 logConfig('hello error','logError');
		 
		$this->load->view('demo/baseAdmin_view', $this->param);
	}
	
	public function controllerku()
	{
		$this->load->helper('form');
		$this->load->helper('formbootstrap');
		$this->param['defaultMenu']='admin';
		$this->param['post']=$post=$this->input->post();
		$this->param['mainMenu']=$this->menu->generate('core' );
		$this->param['contents']=array( 'formcontroller' );
		
		if($this->input->post('type')){
			$folder=$this->param['folder'];
			$this->checkView($folder.'tmp_controller','view');
			$tmp=$this->load->view($folder.'tmp_controller',$this->param,true);
			$detail="\n$tmp ";
			$detail=str_replace("< ?","<?",$detail);
		}else{ $detail=''; }
		$this->param['detail']=$detail;
		$this->showView(); 
	}
	
	public function modelku()
	{
		$this->load->helper('form');
		$this->load->helper('formbootstrap');
		$this->param['defaultMenu']='admin';
		$this->param['post']=$post=$this->input->post();
		$this->param['mainMenu']=$this->menu->generate('core' );
		$this->param['contents']=array( 'formmodel', 'modal');
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
					$fields1[]="`$val` ".str_replace($prefix,"", $val);
				}
			}
			$this->param['fields']=$fields1;
			$detail.="<ol>";
			foreach ($fields as $field){
				$detail.="<li>{$field}</li>";				
			}
			$detail.="</ol>";
			$tmp=$this->load->view($folder.'tmp_model',$this->param,true);
			$detail="<?php\n$tmp ";
		}else{}
			$this->param['detail']=$detail;
		$this->showView(); 
	}
}