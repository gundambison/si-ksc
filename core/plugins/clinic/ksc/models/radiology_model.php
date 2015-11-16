<?php
class Models_Clinic_Ksc_Radiology_model extends Base_Model {
var $table='klinik_radio'; //main table
/*
	Detail Radiology berdasarkan id
*/
	public function detail($id,$field='rad_id')
	{
		$sql=sprintf("select 
		`rad_id`, `rad_daf`, `rad_user`, `rad_doc`, `rad_doc2`, `rad_time`
		from 
		`{$this->table}` 
		where `%s`='%s'",$field, $id);
		$data=$this->resOne($sql,1);
		if(count($data)>1){
			$row=$this->cleanFieldName('rad_',$data);
			return $row;
		}
		else{
			return false;
		}
	}
/*
	Total Radiology  
*/	
	public function total()
	{
		$sql=sprintf("select count(rad_id) c from `%s`",
		$this->table);
		$data=$this->resOne($sql);
		return (int)$data['c'];
		
	}
/*
	Detail Radiology berdasarkan id
*/	
	public function getAll( )
	{
		$sql=sprintf("select 
		`rad_id`, `rad_daf`, `rad_user`, `rad_doc`, `rad_doc2`, `rad_time`
		from 
		`{$this->table}` 
		limit %d", 150); //max untuk hal tak di inginkan
		$query=$this->query($sql,1 ); //debug
		if($query){
			$result=array();
			foreach( $this->_fetchAll($query) as $data ){				 
				$row=$this->cleanFieldName('rad_',$data);
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
	list field tersedia : `rad_id`, `rad_daf`, `rad_user`, `rad_doc`, `rad_doc2`, `rad_time` 
	id : rad_id
*/
	public function add($data){
		$id=$this->idTable('rad_',716352);
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
		$key="rad_id='$key'";
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
		$this->logger->write('info', 'model: Radiology');
	}
	
}