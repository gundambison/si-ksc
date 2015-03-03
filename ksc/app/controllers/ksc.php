<?php
//include_once ($application_folder."/core/controllers.php");
class Ksc extends CI_Controller {

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
		$this->load->model('ksc_model','ksc');
		$this->load->library('logs');
		$this->logs->write('debug',array('request'=>$_REQUEST) );
		$value = $this->input->post();
		echo 'POST :'.print_r($value,1);
	}
	
	 
}

