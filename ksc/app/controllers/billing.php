<?php
//include_once ($application_folder."/core/controllers.php");
class Billing extends CI_Controller {

var $API;
private $target='http://localhost/core/clinic/';
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->API= $this->core_model;
		$post=array('date'=>'2015-02-11');
		$result=$this->API->_callApi('logDaftar', $post);
		echo '<pre>'.print_r($result,1);
		
	}
	 
}

