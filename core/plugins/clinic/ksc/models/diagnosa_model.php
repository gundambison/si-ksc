<?php
class Models_Clinic_Ksc_Diagnosa_model extends Base_Model {
var $table='klinik_diagnosa'; //main table
/*
	Detail Diagnosa berdasarkan id
*/
	public function detail($id,$field='d_id')
	{
		$sql=sprintf("select 
		`d_id`, `d_code1`, `d_code2`, `d_index`, `d_name`, `d_stat`
		from 
		`{$this->table}` 
		where `%s`='%s'",$field, $id);
		$data=$this->resOne($sql,1);
		if(count($data)>1){
			$row=$this->cleanFieldName('d_',$data);
			return $row;
		}
		else{
			return false;
		}
	}
/*
	Total Diagnosa  
*/	
	public function total()
	{
		$sql=sprintf("select count(d_id) c from `%s`",
		$this->table);
		$data=$this->resOne($sql);
		return (int)$data['c'];
		
	}
/*
	Detail Diagnosa berdasarkan id
*/	
	public function getAll( )
	{
		$sql=sprintf("select 
		`d_id`, `d_code1`, `d_code2`, `d_index`, `d_name`, `d_stat`
		from 
		`{$this->table}` 
		limit %d", 150); //max untuk hal tak di inginkan
		$query=$this->query($sql,1 ); //debug
		if($query){
			$result=array();
			foreach( $this->_fetchAll($query) as $data ){				 
				$row=$this->cleanFieldName('d_',$data);
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
	list field tersedia : `d_id`, `d_code1`, `d_code2`, `d_index`, `d_name`, `d_stat` 
	id : d_id
*/
	public function add($data){
		$id=$this->idTable('d_',716352);
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
		$key="d_id='$key'";
		$sql.="where $key";
	
		$query=$this->query($sql,1 ); //debug
		if($query){
			return $result;
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
		$this->logger->write('info', 'model: Diagnosa');
	}
	
}