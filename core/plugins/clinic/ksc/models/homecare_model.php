<?php
class Models_Clinic_Ksc_Homecare_model extends Base_Model {
var $table='hc_daftar'; //main table
/*
	Detail Homecare berdasarkan id
*/
	public function detail($id,$field='daf_id')
	{
		$sql=sprintf("select 
		`daf_id`, `daf_daf`, `daf_pat`, `daf_doc`, `daf_pay`, `daf_date`, `daf_user`, `daf_stat`
		from 
		`{$this->table}` 
		where `%s`='%s'",$field, $id);
		$data=$this->resOne($sql,1);
		if(count($data)>1){
			$row=$this->cleanFieldName('daf_',$data);
			return $row;
		}
		else{
			return false;
		}
	}
/*
	Total Homecare  
*/	
	public function total()
	{
		$sql=sprintf("select count(daf_id) c from `%s`",
		$this->table);
		$data=$this->resOne($sql);
		return (int)$data['c'];
		
	}
/*
	Detail Homecare berdasarkan id
*/	
	public function getAll( )
	{
		$sql=sprintf("select 
		`daf_id`, `daf_daf`, `daf_pat`, `daf_doc`, `daf_pay`, `daf_date`, `daf_user`, `daf_stat`
		from 
		`{$this->table}` 
		limit %d", 150); //max untuk hal tak di inginkan
		$query=$this->query($sql,1 ); //debug
		if($query){
			$result=array();
			foreach( $this->_fetchAll($query) as $data ){				 
				$row=$this->cleanFieldName('daf_',$data);
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
	list field tersedia : `daf_id`, `daf_daf`, `daf_pat`, `daf_doc`, `daf_pay`, `daf_date`, `daf_user`, `daf_stat` 
	id : daf_id
*/
	public function add($data){
		$id=$this->idTable('daf_',716352);
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
		$key="daf_id='$key'";
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
		$this->logger->write('info', 'model: Homecare');
	}
	
}