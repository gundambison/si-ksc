<?php
class Models_Clinic_Ksc_Doctor_model extends Base_Model {
var $table='klinik_doctor'; //main table
var $tableType='klinik_docspecialis';
	public function searchBasic($id, $field)
	{
		$sql=sprintf("select 
		`doc_id` id
		from 
		`{$this->table}` 
		where `%s`='%s'",$field, $id);
		$query=$this->query($sql  ); //1 for debug
		if($query){ 
			$data=array();
			foreach( $this->_fetchAll($query) as $row ){
				$row2=$this->detail($row['id']);
				$data[]=$row2;
			}
			return $data;
		}else{return false;}
	}
/*
	Detail Doctor berdasarkan id
*/
	public function detail($id,$field='doc_id')
	{
		if($id==0){
			return array( 
			  'doc_id'=>0,
			  'doc_name'=>'GP',
			  'doc_addr'=>'',
			  'doc_specId'=>'',
			  'doc_phone'=>'',
			  'doc_stat'=>1,
			  'doc_type'=>1
			);
		}
		$sql=sprintf("select 
		`doc_id`, `doc_name`, `doc_addr`, `doc_specId`, `doc_phone`, `doc_stat`, `doc_type`, spec_name `type`
		from 
		`{$this->table}` , `{$this->tableType}`
		where `%s`='%s' and spec_id=doc_specId",$field, $id);
		$data=$this->resOne($sql,1 );
		if(count($data)>1){
			$row=$this->cleanFieldName('doc_',$data);
			$row['post']=$id;
			return $row;
		}
		else{
			return array('sql'=>$sql);
		}
	}
/*
	Total Doctor  
*/	
	public function total()
	{
		$sql=sprintf("select count(doc_id) c from `%s`",
		$this->table);
		$data=$this->resOne($sql);
		return (int)$data['c'];
		
	}
/*
	Detail Doctor berdasarkan id
*/	
	public function getAll( )
	{
		$sql=sprintf("select 
		`doc_id`, `doc_name`, `doc_addr`, `doc_specId`, `doc_phone`, `doc_stat`, `doc_type`
		from 
		`{$this->table}` 
		limit %d", 150); //max untuk hal tak di inginkan
		$query=$this->query($sql,1 ); //debug
		if($query){
			$result=array();
			foreach( $this->_fetchAll($query) as $data ){				 
				$row=$this->cleanFieldName('doc_',$data);
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
	list field tersedia : `doc_id`, `doc_name`, `doc_addr`, `doc_specId`, `doc_phone`, `doc_stat`, `doc_type` 
	id : doc_id
*/
	public function add($data){
		$id=$this->idTable('doc_',716352);
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
		$key="doc_id='$key'";
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
		$this->logger->write('info', 'model: Doctor');
	}
	
}