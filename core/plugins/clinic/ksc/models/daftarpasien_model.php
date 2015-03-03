<?php
class Models_Clinic_Ksc_Daftarpasien_model extends Base_Model {
var $table='klinik_daftarpasien'; //main table
/*
	Detail Daftarpasien berdasarkan id
*/
	public function detail($id,$field='dafpat_id')
	{
		$sql=sprintf("select 
		`dafpat_id`, `dafpat_dafid`, `dafpat_patid`, `dafpat_usrid`, `dafpat_docid`, `dafpat_date`, `dafpat_jasaadmin`, `dafpat_jasadr`, `dafpat_farno`, `dafpat_fartot`, `dafpat_other`, `dafpat_total`, `dafpat_atasNama`, `dafpat_uniqCode`, `dafpat_appBy`, `dafpat_appDate`, `dafpat_deleteBy`, `dafpat_type`, `dafpat_payId`
		from 
		`{$this->table}` 
		where `%s`='%s'",$field, $id);
		$data=$this->resOne($sql,1);
		if(count($data)>1){
			$row=$this->cleanFieldName('dafpat_',$data);
			return $row;
		}
		else{
			return false;
		}
	}
/*
	Total Daftarpasien  
*/	
	public function total()
	{
		$sql=sprintf("select count(dafpat_id) c from `%s`",
		$this->table);
		$data=$this->resOne($sql);
		return (int)$data['c'];
		
	}
/*
	Detail Daftarpasien berdasarkan id
*/	
	public function getAll( )
	{
		$sql=sprintf("select 
		`dafpat_id`, `dafpat_dafid`, `dafpat_patid`, `dafpat_usrid`, `dafpat_docid`, `dafpat_date`, `dafpat_jasaadmin`, `dafpat_jasadr`, `dafpat_farno`, `dafpat_fartot`, `dafpat_other`, `dafpat_total`, `dafpat_atasNama`, `dafpat_uniqCode`, `dafpat_appBy`, `dafpat_appDate`, `dafpat_deleteBy`, `dafpat_type`, `dafpat_payId`
		from 
		`{$this->table}` 
		limit %d", 150); //max untuk hal tak di inginkan
		$query=$this->query($sql,1 ); //debug
		if($query){
			$result=array();
			foreach( $this->_fetchAll($query) as $data ){				 
				$row=$this->cleanFieldName('dafpat_',$data);
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
	list field tersedia : `dafpat_id`, `dafpat_dafid`, `dafpat_patid`, `dafpat_usrid`, `dafpat_docid`, `dafpat_date`, `dafpat_jasaadmin`, `dafpat_jasadr`, `dafpat_farno`, `dafpat_fartot`, `dafpat_other`, `dafpat_total`, `dafpat_atasNama`, `dafpat_uniqCode`, `dafpat_appBy`, `dafpat_appDate`, `dafpat_deleteBy`, `dafpat_type`, `dafpat_payId` 
	id : dafpat_id
*/
	public function add($data){
		$id=$this->idTable('dafpat_',716352);
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
		$key="dafpat_id='$key'";
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
		$this->logger->write('info', 'model: Daftarpasien');
	}
	
}