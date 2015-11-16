<?php
/****
	Model	: Gundam_model
	Created	: 14-11-2015 13:06:34
	By		: Gunawan Wibisono 
	Using 	: CI3 Model Generator  
****/
defined('BASEPATH') OR exit('No direct script access allowed');
class Gundam_model extends CI_Model {
	public $table='mujur_gundam'; 
/*	
	If not valid, Create New
	UPDATE DATA USING ID:gun_id	
*/
	function updateData($data,$id)
	{
		dbIdReport('update','update Gundam',json_encode($data), 100);
		$this->db->where('gun_id', $id);
		$this->db->update($this->table, $data);
		$str = $this->db->last_query();	
		logConfig("update Gundam:$str",'logDB');
		
	}
/* 
	SAVE DATA 
*/
	function saveData($data)
	{
		$id=$data['gun_id']=dbIdReport('id','create Gundam',json_encode($data),100);
		$data['gun_created']=date("Y-m-d H:i:s");
		$this->db->insert($this->table,$data);
		$str = $this->db->last_query();			 
		logConfig("create Gundam:$str",'logDB');
		return $id;
	}
/*
	GET DATA if using gun_id, return as 1 array 
*/	
	function getData($id,$field='gun_id')
	{
		$sql="select 
		 `gun_id` `id`,  `gun_code` `code`,  `gun_name` `name`,  `gun_detail` `detail`,  `gun_modified` `modified`,  `gun_created` `created`,  `gun_status` `status`,  `gun_field01` `field01`,  `gun_field02` `field02`,  `gun_field03` `field03`,  `gun_field04` `field04`,  `gun_field05` `field05`,  `gun_field06` `field06`,  `gun_field07` `field07`,  `gun_field08` `field08`,  `gun_field09` `field09`,  `gun_field10` `field10` 
		from {$this->table} where {$field}='$id'";
		if($field=='gun_id'){
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
		$sql="select count(gun_id) total from {$this->table}";
		$data=dbFetchOne($sql);
		return isset($data['total'])?$data['total']:false;
	}
	
	        public function __construct()
        {
            $this->load->database();
        }
/*
Field List:
* gun_id (bigint) len:20
* gun_code (varchar) len:100
* gun_name (varchar) len:100
* gun_detail (text) len:
* gun_modified (timestamp) len:
* gun_created (datetime) len:
* gun_status (int) len:11
* gun_field01 (varchar) len:100
* gun_field02 (varchar) len:100
* gun_field03 (varchar) len:100
* gun_field04 (varchar) len:100
* gun_field05 (varchar) len:100
* gun_field06 (varchar) len:100
* gun_field07 (varchar) len:100
* gun_field08 (varchar) len:100
* gun_field09 (varchar) len:100
* gun_field10 (varchar) len:100
========
*/
}  