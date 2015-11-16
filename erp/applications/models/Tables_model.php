<?php
/****
	Model	: Tables_model
	Created	: 08-11-2015 22:26:14
	By		: Gunawan Wibisono 
	Using 	: CI3 Model Generator  
****/
defined('BASEPATH') OR exit('No direct script access allowed');
class Tables_model extends CI_Model {
	public $table='mujur_tables'; 
	public $tableStatus='mujur_status';
	public $tableRel='mujur_tablestatus';
/*	
	If not valid, Create New
	UPDATE DATA USING ID:table_id	
*/
	function updateData($data,$id)
	{
		dbIdReport('update','update Tables',json_encode($data), 120);
		$this->db->where('table_id', $id);
		$this->db->update($this->table, $data);
		$str = $this->db->last_query();	
		logConfig("update Tables:$str",'logDB');
		
	}
/* 
	SAVE DATA 
*/
	function saveData($data)
	{
		$id=$data['table_id']=dbIdReport('table','create Tables',json_encode($data),120);
		$data['table_created']=date("Y-m-d H:i:s");
		$this->db->insert($this->table,$data);
		$str = $this->db->last_query();			 
		logConfig("create Tables:$str",'logDB');
		//==========TAMBAHKAN STATUS
		$data2=array('tabstat_tables'=>$id,'tabstat_status'=>1);
		$this->db->insert($this->tableRel,$data2);
		$str = $this->db->last_query();			 
		logConfig("create Relation:$str",'logDB');
		$data2=array('tabstat_tables'=>$id,'tabstat_status'=>2);
		$this->db->insert($this->tableRel,$data2);
		$str = $this->db->last_query();			 
		logConfig("create Relation:$str",'logDB');
		
		//==========CREATE TABLE==========
		$prefix=$data['table_prefix']."_";
		$fields = array(
			$prefix.'id'=>array( 
				'type' => 'BIGINT','auto_increment' => TRUE), 		   
			$prefix.'code'=>array( 
			    'type' => 'VARCHAR',  
			    'constraint' => '100'),
			$prefix.'name'=>array( 
			    'type' => 'VARCHAR',  
			    'constraint' => '100'),
			$prefix.'detail'=>array( 
				'type' => 'text'),
			 $prefix.'modified'=>array( 
				'type' => 'timestamp'), 
			 $prefix.'created'=>array( 
				'type' => 'datetime'),
			 $prefix.'status'=>array( 
				'type' => 'int'),
		);
		for($i=1;$i<=10;$i++){
			$name1=sprintf("%sfield%02s",$prefix,$i);
			$fields[$name1]=array( 
			    'type' => 'VARCHAR',  
			    'constraint' => '100');
		}
			$this->dbforge->add_field($fields);
			$this->dbforge->add_key($prefix.'id', TRUE);
			$this->dbforge->create_table($data['table_name'],TRUE);
			$str = $this->db->last_query();			 
		logConfig("create table:$str",'logDB');
		$this->db->reset_query();	
		return $id;
	}
/*
	GET DATA if using table_id, return as 1 array 
*/	
	function getData($id,$field='table_id')
	{
		$sql="select 
		 `table_id` id,  `table_prefix` prefix,  `table_name` name,  `table_module` module,  `table_modified` modified 
		from {$this->table} where {$field}='$id'";
		if($field=='table_id'){
			$data=dbFetchOne($sql);
		}else{ 
			$result=dbQuery($sql,1);
			$data=array();
			$i=0;
			foreach ($result->result_array() as $row){
				$data[]=$row;
			}
		}
		return $data;
	}
/*
	TOTAL ALL DATA IN TABLE
	If not valid, create New
*/	
	function totalAll()
	{
		$sql="select count(table_id) total from {$this->table}";
		$data=dbFetchOne($sql);
		return isset($data['total'])?$data['total']:false;
	}
	
	        public function __construct()
        {
            $this->load->database();
        }
/*
Field List:
* table_id (int) len:11
* table_prefix (varchar) len:15
* table_name (varchar) len:50
* table_created (datetime) len:
* table_modified (timestamp) len:
========
*/
}  