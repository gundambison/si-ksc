<?php
class Models_Clinic_Ksc_Rawatinapbangsal_model extends Base_Model {
var $table='klinik_ribangsal'; //main table
/*
	Detail Rawatinapbangsal berdasarkan id
*/
	public function detail($id,$field='bang_id')
	{
		$sql=sprintf("select 
		`bang_id`, `bang_name`, `bang_sec`
		from 
		`{$this->table}` 
		where `%s`='%s'",$field, $id);
		$data=$this->resOne($sql,1);
		if(count($data)>1){
			$row=$this->cleanFieldName('bang_',$data);
			return $row;
		}
		else{
			return false;
		}
	}
/*
	Total Rawatinapbangsal  
*/	
	public function total()
	{
		$sql=sprintf("select count(bang_id) c from `%s`",
		$this->table);
		$data=$this->resOne($sql);
		return (int)$data['c'];
		
	}
/*
	Detail Rawatinapbangsal berdasarkan id
*/	
	public function getAll( )
	{
		$sql=sprintf("select 
		`bang_id`, `bang_name`, `bang_sec`
		from 
		`{$this->table}` 
		limit %d", 150); //max untuk hal tak di inginkan
		$query=$this->query($sql,1 ); //debug
		if($query){
			$result=array();
			foreach( $this->_fetchAll($query) as $data ){				 
				$row=$this->cleanFieldName('bang_',$data);
				$result[]=$row;				 
			}
			return $result;
		}
		else{
			return false;		
		}
	}
	  
/*
	Insert data 
	list field tersedia : `bang_id`, `bang_name`, `bang_sec` 
	id : bang_id
*/
	public function add($data){
		$id=$this->idTable('bang_',716352);
//tambahkan detail yang kurang	
		$this->logger->write('debug', 'Act:Add data:'.json_encode($data));
		$insert = $this->insertData($this->table, $data,1 ); //saran biarkan ada log 
		if($insert){
			return $id;
		}
		else{
			return false;
		}		
	}
	
/*
	Update Data table utama.
*/
	public function update($data, $key)
	{
		$sql="update {$this->table} set ";
//tambahkan detail yang kurang
		$this->logger->write('debug', 'Act:Update data:'.json_encode($data));
		$fields=array();
		foreach($data as $name=>$value)
		{
			$fields[]="$name='".$this->conn->real_escape_string($value)."' ";					
		}
		
		$sql.=implode(",", $fields); 
		$key="bang_id='$key'";
		$sql.="where $key";
	
		$query=$this->query($sql,1 ); //debug
		if($query){
			return true;
		}
		else{
			return false;		
		}
		
	}

/*
	Start 
*/
	public function __construct(){
		parent::__construct();
		$this->loadConnection('default');
		$this->logger->write('info', 'model: Rawatinapbangsal');
	}
	
}