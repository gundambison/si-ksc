<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
9 November 2015
Membuat Member/ Bentuk lain dari USERS

*/
class Member extends CI_Controller {
public $param; 
/***
Controller:	member
Function:	permision
***/ 
	public function permision()
	{
		$this->param['defaultMenu']='core';  
		$mainPage=$this->uri->segment(1).'Permision';
		$this->param['contents']=array( $mainPage, 'modal');
//		$this->param['title']='ERP-member permision';
/*
model: permision_model
view:memberPermision_view
js: {folder}/memberPermision.js
*/
		$this->showView(); 
/*
form : memberPermisionEditForm_view, memberPermisionAddForm_view
data: memberPermisionSave_data, memberPermision_data
*/		
		$folder=$this->param['folder'];
		$this->checkView($folder."memberPermisionEditForm_view");
		$this->checkView($folder."memberPermisionAddForm_view");
		$this->checkView($folder."data/memberPermisionSave_data");
		$this->checkView($folder."data/memberPermision_data");

	} 
	
	public function index()
	{ 
		$this->param['mainMenu']=$this->menu->generate('member');
		$this->load->view('base_view',$this->param);
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
		$this->load->model('permision_model','permision');	 
		date_default_timezone_set('Asia/Jakarta');
		$this->param['title']='ERP-admin';
		$this->param['today']=date('Y-m-d');
		$this->param['folder']='member/';
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
}