<?php
class Models_Clinic_Ksc_User_model extends Base_Model {
var $table='jos_users';
 
	public function __construct(){
		parent::__construct();
		$this->loadConnection('default');
	}
	 
	public function total(){
		$sql=sprintf("select count(id) c from %s where block=0",
		$this->table);
		$data=$this->resOne($sql);
		return (int)$data['c'];
		
	}
	
	public function detail($id,$field='username'){
		$sql=sprintf('select * from %s where %s="%s"',
		  $this->table, $field, $id);
		return $this->resOne($sql );
	}	
	
	public function checkUser($username,$password){
		$data=$this->detail($username);
		$pass=$data['password'];
		$ar=explode(":",$pass);
		$pass2=md5($password.$ar[1]).":".$ar[1] ;
		$this->logger->write('debug','pass1='.$pass.'|pass2='.$pass2);
		$sql=sprintf("select count(id) c from %s where username='%s' and password='%s' and block=0",
		$this->table, $username,$pass2);
		$data=$this->resOne($sql,1 	);
		
		return $data['c']==1?true:false;
	}
	
 
}