<?php
class User_model extends CI_Model {
public $table='mujur_user';
public $tablepermit='mujur_permision';
public $tableupermit='mujur_userpermit';
/*	
	If not valid, Create New
	UPDATE DATA USING ID:user_id	
*/
	function updateData($data,$id)
	{
		dbIdReport('update','update User',json_encode($data), 100);
		$this->db->where('user_id', $id);
		$this->db->update($this->table, $data);
		$str = $this->db->last_query();	
		logConfig("update User:$str",'logDB');
		
	}
/* 
	SAVE DATA 
*/
	function saveData($data)
	{
		$id=$data['user_id']=dbIdReport('user','create User',json_encode($data),100);
		$data['user_created']=date("Y-m-d H:i:s");
		$this->db->insert($this->table,$data);
		$str = $this->db->last_query();			 
		logConfig("create User:$str",'logDB');
		return $id;
	}
/*
	GET DATA if using user_id, return as 1 array 
*/	
	function getPermision($user_id,$permit_id=0){
	  if($permit_id==0){
		$sql="select permit_id id, permit_name name from 
		{$this->tablepermit},{$this->tableupermit}
		where permit_id=uper_permision and
		uper_user='$user_id'";
		$result=dbQuery($sql,0);
		foreach ($result->result_array() as $row){
			$data[]=$row;
		}
		return $data;
	  }
	  else{
		if($permit_id==-1) return true;
		$sql="select count(permit_id) c from 
		{$this->tablepermit},{$this->tableupermit}
		where permit_id=uper_permision and
		uper_user='$user_id' and
		permit_id='$permit_id'";
		$data=dbFetchOne($sql);
		return $data['c']==1?true:false;
	  }
	}

	function getData($id,$field='user_id')
	{
		$sql="select 
		 `user_id` id,  `user_code` code,  `user_name` name,  `user_detail` detail,  `user_modified` modified,  `user_created` created,  `user_status` status,  `user_password` password,  `user_fullname` fullname,  `user_position` position,  `user_expired` expired,  `user_admin` admin,  `user_field06` field06,  `user_field07` field07,  `user_field08` field08,  `user_field09` field09,  `user_field10` field10 
		from {$this->table} where {$field}='$id'";
		if($field=='user_id'){
			$data=dbFetchOne($sql);
			$data['permit']=$this->getPermision($data['id']);
		}else{ 
			$result=dbQuery($sql,1);
			$data=array();
			$i=0;
			foreach ($result->result_array() as $row){
				$row['permit']=$this->getPermision($row['id']);
				$data[]=$row;
			}
		}
		return $data;
	}
	
	
	function usertotal()
	{
		$sql="select count(id) total from ".$this->table;
		$data=dbFetchOne($sql);
		return isset($data['total'])?$data['total']:false;
		
		if (!$this->db->simple_query($sql)){
			logCreate('sql:'.$sql.'|'.$this->db->error(),'error');
			return false;
		}
		else{
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
				$row = $query->row_array();
				return $row['total'];
			}else{ return false;}			 
		}
	return false;
	}
	
	function permittotal()
	{
		$sql="select count(id) total from ".$this->tablepermit;
		$data=dbFetchOne($sql);
		return isset($data['total'])?$data['total']:false;
		
		 
	return false;
	}

    public function __construct()
    {
            $this->load->database();
			$this->load->helper('date_helper');
    }
		
}