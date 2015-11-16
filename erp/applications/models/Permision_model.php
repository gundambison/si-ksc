<?php
/****
	Model	: Permision_model
	Created	: 09-11-2015 11:22:54
	By		: Gunawan Wibisono 
	Using 	: CI3 Model Generator  
****/
defined('BASEPATH') OR exit('No direct script access allowed');
class Permision_model extends CI_Model {
	public $table='mujur_permision'; 
/*	
	If not valid, Create New
	UPDATE DATA USING ID:permit_id	
*/
	function updateData($data,$id)
	{
		dbIdReport('update','update Permision',json_encode($data), 10);
		$this->db->where('permit_id', $id);
		$this->db->update($this->table, $data);
		$str = $this->db->last_query();	
		logConfig("update Permision:$str",'logDB');
		
	}
/* 
	SAVE DATA 
*/
	function saveData($data)
	{
		$id=$data['permit_id']=dbIdReport('permit','create Permision',json_encode($data),10);
		$data['permit_created']=date("Y-m-d H:i:s");
		$this->db->insert($this->table,$data);
		$str = $this->db->last_query();			 
		logConfig("create Permision:$str",'logDB');
		return $id;
	}
/*
	GET DATA if using permit_id, return as 1 array 
*/	
	function getData($id,$field='permit_id')
	{
		$sql="select 
		 `permit_id` id,  `permit_code` code,  `permit_name` name,  `permit_created` created,  `permit_modified` modified 
		from {$this->table} where {$field}='$id'";
		if($field=='permit_id'){
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
		$sql="select 
			count(permit_id) total 
		from 
			{$this->table}";
		$data=dbFetchOne($sql);
		return isset($data['total'])?$data['total']:false;
	}
	
	    public function __construct()
        {
            $this->load->database();
        }
/*
Field List:
* permit_id (int) len:11
* permit_code (varchar) len:15
* permit_name (varchar) len:100
* permit_created (datetime) len:
* permit_modified (timestamp) len:
========
*/
}  