<?php 
class Main_model extends CI_Model {
private $params;
public $tableUser='mujur_user';
        public function __construct()
        {
            $this->load->database();
			
        }
	
	public function checkUser()
	{
		$username=$this->session->userdata('erp_username');
		$password=$this->session->userdata('erp_password');
		if($username=='') return false;
		$time0=date("Y-m-d H:i:s", strtotime("+1 hours"));
		$time1=$this->session->userdata('erp_password');
		if($time0 > $time1) return false; 
		$user=array(
			'username'=>$username,
			'password'=>$password
		);
		$sql="select count(user_id) c,user_id id from {$this->tableUser}
		where user_name='$username' and user_password='$password' and user_status=1";
		$data= $this->db->query($sql)->row_array();
		if($data['c']==0) return false;
		$user['raw'][]=$data;
		$user['id']=$data['id'];
		//$user['raw'][]=md5("password");
		$this->session->set_userdata('erp_userid',$data['id']);
		$this->session->set_userdata('erp_time',$time0);
		return $user;
	} 

	function showView($data,$base_view='base_view')
	{
		$this->params=$data;
		if(isset($this->param['contents'])){
		  foreach($this->param['contents'] as $content ){
			$folder=$this->param['folder'];
			$load_view= $folder.$content.'_view';
			$this->checkView($load_view,'body');
		  }
		}else{}
	
		$this->load->view($base_view,$this->param);
	}

	function checkView($target,$stat='view'){
		//return true;
		if(!is_file("views/".$target.".php") && ($stat=='view'||$stat=='body') ){
			$txt="<?php 
/****
	views	: $target
	created	: ".date("d-m-Y H:i:s")."
	By		: Gunawan Wibisono
	Using 	: CI3 Main Model
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
	By		: Gunawan Wibisono
	Using 	: CI3 Main Model
****/";	
			file_put_contents ("assets/js/".$target , $txt,LOCK_EX );
			logCreate('create file:'."assets/js/".$target);
		}else{}
	}
	
}