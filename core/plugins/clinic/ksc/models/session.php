<?php
class Models_Clinic_Ksc_Session extends Base_Model {
	
	private $tablename = 'tbl_core_session_';
	private $tableTemplate = 'tbl_core_session_template';
	
	public function __construct(){
		parent::__construct();
		$this->loadConnection('default');
	}
	
	private function _checkTable($tablename){
		$sql = sprintf("CREATE TABLE IF NOT EXISTS %s LIKE %s", $this->conn->real_escape_string($tablename), $this->tableTemplate);
		$this->query($sql ); //conn->query($sql);
	}
	
	private function _genToken() {
		/*
		hindari angka random yang bermasalah
		return substr(microtime(),-10) . rand(1000,9999999).date('m');
		*/
		$gen=date("i").(date("s")%10);
		$counter=date("h")%6 + 1;
		return $this->idTable('tbl_token',1000000,$counter).$gen;
	}
	
	private function _getTablename($clientcode, $token){
		return $this->tablename . $clientcode . '_' . substr($token,-1);
	}
	
	public function create($clientcode, $appcode, $username){
		$sql="select count(client_code) c from tbl_core_client where client_status=0 and client_code='$clientcode' ";
		$data=$this->resOne($sql);
		if($data['c']==0){
			$this->logger->write('error','client code tidak valid');
			return false;
		}
		$token 		= $this->_genToken();
		$tablename  = $this->_getTablename($clientcode, $token);
		
		// check user table
		$this->_checkTable($tablename);
//===========clear table=========== 
		if($this->clearToken($tablename) === false){
			return false;
		}
		
		$expired=date("Y-m-d H:i:s",strtotime('+1 Hour'));		
		$sql = sprintf("INSERT INTO %s 
			(session_token,application_id,application_name,user_name,created,expired)
			SELECT
				'%s',
				application_id,
				application_name,
				'%s',
				now(),
				'%s'
			FROM
				tbl_core_application
			WHERE
				application_code='%s'",
			$tablename,
			$token,
			$username,
			$expired,
			$appcode
		);
		
		$result = $this->conn->query($sql);
		
		if( $result ){
			$this->logger->write('debug', 'SQL: '.$sql.' Result:' . $token);
			return $token;
		}
		else{
			$this->logger->write('debug', 'SQL: '.$sql.' Result:false');
			return false;
		}
	}
	
	public function delete($clientcode, $username, $token){
		
		$tablename  = $this->_getTablename($clientcode, $token);
		
		// check user table
		$this->_checkTable($tablename);
		
		/*
		 * TODO:
		 * tambahkan appcode pada table session, supaya yang berhak menghapus session adalah applikasi yang membuat session
		 */
		$sql = sprintf("DELETE FROM %s WHERE session_token='%s' AND user_name='%s'",
			$tablename,
			$token,
			$username
		);
		
		$result = $this->conn->query($sql);
		
		if( $result ){
			$this->logger->write('debug', 'SQL: '.$sql.' Result:true');
			return true;
		}
		else{
			$this->logger->write('debug', 'SQL: '.$sql.' Result:false');
			return false;
		}
		
	}
	
	public function isValidToken($clientcode, $token, $username=''){		
		$tablename  = $this->_getTablename($clientcode, $token);
		$this->logger->write('info','tablename:'.$tablename);
		$sql = sprintf("SELECT session_id FROM %s WHERE session_token='%s'",
			$this->conn->real_escape_string($tablename),
			$this->conn->real_escape_string($token)
		);
		
		if($username != ''){
			$sql .= sprintf(" AND user_name='%s'", $this->conn->real_escape_string($username));
		}
		
		$query = $this->conn->query($sql);
		
		if( $query ){
			if( $this->conn->affected_rows != 0 ){
				$this->logger->write('debug', 'SQL: '.$sql.' Result:true');
				return true;
			}
			else{
				$this->logger->write('debug', 'SQL: '.$sql.' Result:false');
				return false;
			}
		}
		else{
			$this->logger->write('debug', 'SQL: '.$sql.' Result:false');
			return false;
		}
	}
	
	function clearToken($tablename){
		$expired = date("Y-m-d H:i");
		$sql = sprintf("DELETE FROM %s WHERE expired<'%s'",
			$tablename,
			$expired
		);
		
		return $this->query($sql );  
	}
}
