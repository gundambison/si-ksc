<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Crud extends CI_Controller {
var $data;
	function index()
	{
		$this->load->model('crud_model','model');
		$this->data['body']='crud/main';
		$this->load->view('base_view',$this->data);
		
	}



function __construct(){
		$this->data['title']='CRUD';
		$this->data['js_scripts']=array('jquery-ui.min', 'page/clinic_js');
		$this->data['css_scripts']=array('jquery-ui.min');
		$this->data['noMenu']=1;
		parent::__construct();
	}

}