<?php
/****
	Model	: Status_model
	Created	: 08-11-2015 20:16:00
	By		: Gunawan Wibisono 
	Using 	: CI3 Model Generator  
****/
defined('BASEPATH') OR exit('No direct script access allowed');
class Status_model extends CI_Model {
	public $table='mujur_status'; 
/*
	UPDATE DATA USING ID:stat_id	If not valid, Create New
*/
	function updateData($data,$id)
	{
		dbIdReport('update','update Status',json_encode($data), 2000);
		$this->db->where('stat_id', $id);
		$this->db->update($this->table, $data);
		$str = $this->db->last_query();	
		logConfig("update Status:$str",'logDB');
		
	}
/* 
	SAVE DATA 
*/
	function saveData($data)
	{
		$id=$data['stat_id']=dbIdReport('status','create Status',json_encode($data), 2000);
		$data['stat_created']=date("Y-m-d H:i:s");
		$this->db->insert($this->table,$data);
		$str = $this->db->last_query();			 
		logConfig("create Status:$str",'logDB');
		return $id;
	}
/*
	GET DATA if using stat_id, return as 1 array 
*/	
	function getData($id,$field='stat_id')
	{
		$sql="select 
		 `stat_id` id,  `stat_name` name,  `stat_code` code,  `stat_created` created,
		 `stat_modified` modified
		from {$this->table} where {$field}='$id'";
		if($field=='stat_id'){
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
		$sql="select count(stat_id) total from {$this->table}";
		$data=dbFetchOne($sql);
		return isset($data['total'])?$data['total']:false;
	}
	
	        public function __construct()
        {
            $this->load->database();
        }
/*
Field List:
* stat_id (int) len:11
* stat_name (varchar) len:50
* stat_code (varchar) len:15
* created (timestamp) len:
========
*/
}  