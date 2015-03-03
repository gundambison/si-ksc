<?php
class Models_Clinic_Ksc_Activity extends Base_Model {
var $table='activity_';
var $tableTmp='activity_template';
	public function __construct(){
		parent::__construct();
		$this->loadConnection('activity');
		$this->_checkTable();
	}
	
	private function _checkTable(){
		$tablename=$this->table.date("Ymd");
		$sql = sprintf("CREATE TABLE IF NOT EXISTS %s LIKE %s", $this->conn->real_escape_string($tablename), $this->tableTmp);
		$this->query($sql); //conn->query($sql);
	}
	 
	public function write($message,$class='' ){
		$tablename=$this->table.date("Ymd");
		$data=array('id'=>$this->idTable('activity',100,3)); 
		if($class!='') 
			$data['class']=get_class($class);
		
		$data['uri']=$_REQUEST['uri'];
		$data['app']=isset($_REQUEST['app_code'])?$_REQUEST['app_code']:'unknown';
		$data['client']=isset($_REQUEST['client_code'])?$_REQUEST['client_code']:'unknown';
		 
		if(is_array($message)||is_object($message)){
			$data['result']=print_r($message,1);
		}
		else{
			$data['result']= $message ;
		}
		
		$this->insertData($tablename,$data);
		
	}
 
}