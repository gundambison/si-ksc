<?php
/**
 * 
 * @author tala.narestha[at]linkit360.com
 * @version 0.3
 * 
 */ 
class Base_Model extends Base_Master {
	
	protected $dsn;
	protected $conn;
	protected $config;
	
	/**
	public function __construct(){		
		//load config
		$this->config = Libs_Registry::get('config');
		if($this->config===false){
			$this->config = Config_Loader::getInstance();
		}
	}
	*/
	
	public function setDSN($dsn){
		$config = $this->config->get('dsn');
		$this->dsn = $config[$dsn];
	}
	
	public function loadConnection($dsn){
		$this->setDSN($dsn);
		$this->conn = new mysqli(
			$this->dsn['hostname'],
			$this->dsn['username'],
			$this->dsn['password'],
			$this->dsn['database'],
			$this->dsn['port']
		);
		
		if ($this->conn->connect_error) {
			die('Connect Error (' . $this->conn->connect_errno . ') ' . $this->conn->connect_error);
		}
		$this->conn->set_charset("utf8");
	}
	
	protected function _fetchAll($result) {
		$data = array();
		while( $row = $result->fetch_assoc() ){
			$data[] = $row;
		}
		return $data;
	}
	
	protected function query($sql, $debug=0){
		$start = microtime(1);
		$query = $this->conn->query($sql);
		$end   = substr(microtime(1) - $start, 0, 8);
		if($query===false){
			$this->logger->write('ERROR', 'QUERY:'.$sql.' TIME:'.$end.' error:'.$this->conn->error);
			return false;
		}
		elseif($debug==1){
			$this->logger->write('debug', 'QUERY:'.$sql.' TIME:'.$end.' AFFECTED:'.$this->conn->affected_rows);			
		}
		return $query;
	}
	
	protected function resOne($sql, $debug=0){
		$result=$this->query($sql,$debug);
		if($result===false){
			return false;
		}
		$row = $result->fetch_assoc();
		if($debug==1){
			$this->logger->write('debug','data:'.json_encode($row));
		}
		return $row;
	}
	
	protected function cleanFieldName($eraseName, $data=array()){
		$return=array();
		foreach($data as $name=>$val){
			$name=str_replace($eraseName,'',$name);
			$return[$name]=$val;
		}
		
		return $return;
	}
	
	protected function _query($sql){
		$start = microtime(1);
		$query = $this->conn->query($sql);
		$end   = substr(microtime(1) - $start, 0, 8);
		$this->logger->write('debug', 'QUERY:'.$sql.' TIME:'.$end.' AFFECTED:'.$this->conn->affected_rows);
		return $query;
	}
	
	protected function idTable($table='',$start=100000,$step=1){
		if($table=='')$table='my';
		$table.="_id";
		$sql=sprintf("CREATE TABLE IF NOT EXISTS `%s` (
		  `id` bigint(20) NOT NULL default '111',
		  PRIMARY KEY  (`id`)
		)",$table);
		$this->query($sql);
		
		$sql="select id from `$table`";
		$data=$this->resOne($sql);
		if(isset($data['id'])){
			$id=$data['id']+$step;
		}
		else{
			$sql="insert into %s(id)values(%d)";
			$sql=sprintf($sql,$table,$start);
			$this->query($sql,1);
			$id=$start;
		}
	
		$sql=sprintf("update %s set id=%d",
		$table, $id);
		$this->query($sql);
		return $id;
	}
	
	protected function insertData($table, $data,$status=0){
		$sql="insert into %s(%s)values(%s)";
		$fields=$values=array();
		foreach($data as $name=>$value){
			$fields[]="`".$this->conn->real_escape_string($name)."`";
			$values[]="'".$this->conn->real_escape_string($value )."'";
		}
		$sql=sprintf($sql, 
		$table, implode(", ",$fields), implode(", ",$values));
		if( $this->query($sql,$status)){
			return isset($this->conn->insertId)?$this->conn->insertId:true;
		}
		else{ 
			return false;
		}
		
	
	}
	
	public function close(){
		$this->conn->close();
	}
}
