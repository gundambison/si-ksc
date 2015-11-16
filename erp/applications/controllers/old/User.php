<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
public $param;

function index(){
	redirect(base_url()."user/member","refresh");
}
	public function menu()
	{	
		$this->param['defaultMenu']='temp'; 
		$this->param['contents']=array( 'menu', 'modal');
/*
view:menu_view
js: user/user_menu.js
*/
		$this->showView(); 
/*
mainmenu_add : formMenuadd_view, formMenuedit, formMenuaddparent
data: user_menu_data, user_menusub_data, menusave_data,
*/		
	}
	
	public function permision()
	{
		//unset($this->param['footerJS']);	
		$this->param['defaultMenu']='admin';		
		//$this->param['mainMenu']=$this->menu->generate('user' );
		$this->param['contents']=array( 'permit', 'modal');
		$this->showView();
	}

	public function member()
	{
		$this->param['defaultMenu']='admin';	
		//$this->param['mainMenu']=$this->menu->generate('user' );
		$this->param['contents']=array( 'member', 'modal');
		$this->showView();
	}

	function data($module){	
		$folder=$this->param['folder'];
		$load_view= $folder.$module.'_data';
		$this->checkView($load_view,'body');
		$this->param['get']=$this->input->get(NULL,true);
		$this->param['post']=$this->input->post(NULL,true);
	//==============
		if($module=='user_member_1'){
			//{"_search":"false","nd":"1446510443965","rows":"10","page":"1","sidx":"id","sord":"desc"}
			//$users=$this->users->list( );
		}else{}
		
		$data=$this->load->view($load_view,$this->param,true);
		
		$respon=json_decode($data,true);
		$respon['load']=$load_view;
		echo json_encode( $respon );
		
	}
	
	function form($module){	
		$folder=$this->param['folder'];
		$module=ucfirst(strtolower($module));
		$load_view= $folder.'form'.$module.'_view';
		$this->checkView($load_view,'body');
		$this->param['get']=$this->input->get(NULL,true);
		$this->param['post']=$this->input->post(NULL,true);
		$this->load->helper('form');
		$this->load->helper('formbootstrap');
	//==============
		if($module=='user_member_1'){
			//{"_search":"false","nd":"1446510443965","rows":"10","page":"1","sidx":"id","sord":"desc"}
			//$users=$this->users->list( );
		}else{}
		
		$data=$this->load->view($load_view,$this->param,true); 
		$respon=json_decode($data,true);
		$respon['param']=$_REQUEST;
		echo json_encode( $respon ); 
	}


private function showView(){
	$done=true;
	$this->param['mainMenu']=$this->menu->generate($this->param['defaultMenu']);
	$this->maincore->showView($this->param);
	// die('1');
	if(!isset($done)){
	if(isset($this->param['contents'])){
		foreach($this->param['contents'] as $content ){
			$folder=$this->param['folder'];
			$load_view= $folder.$content.'_view';
			$this->checkView($load_view,'body');
		}
	}
	$this->checkView($folder."{$this->uri->segment(1)}_{$this->uri->segment(2)}.js",'js');
	$this->load->view('base_view',$this->param);
	};
}

private function checkView($target,$stat='view'){
	$this->maincore->checkView($target,$stat);$done=true;
	
	if(!isset($done)){
		//return true;
		if(!is_file("views/".$target.".php") && ($stat=='view'||$stat=='body') ){
			$txt="<?php 
/****
	views	: $target
	created	: ".date("d-m-Y H:i:s")."
	By		: CI3 Stock Controllers
****/
defined('BASEPATH') OR exit('No direct script access allowed');";
			if($stat=='view')
			  $txt.="\n?>\n
<div class='container'><div class='row'>\n
<!-- content Start-->\n\n<!-- content End-->\n
</div></div>ERASE AFTER YOU CREATED THIS VIEW";
			file_put_contents ("views/".$target.".php", $txt,LOCK_EX );
			logCreate('create file:'."views/".$target.".php");
		}else{}
		
		if(!is_file("assets/js/".$target ) && $stat=='js'  ){
			$txt="/****
	Javascript	: $target
	created	: ".date("d-m-Y H:i:s")."
	By		: CI3 Stock Controllers
****/";	
			file_put_contents ("assets/js/".$target , $txt,LOCK_EX );
			logCreate('create file:'."assets/js/".$target);
		}else{}
	}
}
	
	function __CONSTRUCT(){
		parent::__construct();
		
		$this->load->model('user_model','user');			
		$this->load->model('menu_model','menu');
		$this->load->model('invoice_model','invoice');
		$this->load->model('main_model','maincore');	
		 
		date_default_timezone_set('Asia/Jakarta');
		$this->param['title']='ERP-User';
		$this->param['today']=date('Y-m-d');
		$this->param['folder']='user/';
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
		$jsScript=$this->param['folder'].$this->uri->segment(1)."_".$name.".js";
		if($name!=''){
			$this->param['footerJS'][]=$jsScript;
			$this->checkView($jsScript,'js');
		}else{}
		$this->param['dataUrl']=  $this->uri->segment(1). "_".$name;
		$this->param['myUrl']=  $name;
		$id=dbIdReport('id','activity',json_encode($_REQUEST)); 
		
	}	
	
}