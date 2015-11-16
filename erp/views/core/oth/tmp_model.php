<?php 
/****
	views	: admin/tmp_model
	created	: 08-11-2015 19:31:32
	By		: CI3 Stock Controllers
****/
defined('BASEPATH') OR exit('No direct script access allowed');
?>
/****
	Model	: <?=ucfirst($post['name']);?>_model
	Created	: <?=date("d-m-Y H:i:s\n");?>
	By		: Gunawan Wibisono 
	Using 	: CI3 Model Generator  
****/
defined('BASEPATH') OR exit('No direct script access allowed');
class <?=ucfirst($post['name']);?>_model extends CI_Model {
	public $table='<?=$post['table'];?>'; 
/*	
	If not valid, Create New
	UPDATE DATA USING ID:<?=$fieldId;?>
	
*/
	function updateData($data,$id)
	{
		dbIdReport('update','update <?=ucfirst($post['name']);?>',json_encode($data), <?=$post['counter'];?>);
		$this->db->where('<?=$fieldId;?>', $id);
		$this->db->update($this->table, $data);
		$str = $this->db->last_query();	
		logConfig("update <?=ucfirst($post['name']);?>:$str",'logDB');
		
	}
/* 
	SAVE DATA 
*/
	function saveData($data)
	{
		$id=$data['<?=$fieldId;?>']=dbIdReport('<?=$post['tableid'];?>','create <?=ucfirst($post['name']);?>',json_encode($data),<?=$post['counter'];?>);
		$data['<?=$prefix;?>created']=date("Y-m-d H:i:s");
		$this->db->insert($this->table,$data);
		$str = $this->db->last_query();			 
		logConfig("create <?=ucfirst($post['name']);?>:$str",'logDB');
		return $id;
	}
/*
	GET DATA if using <?=$fieldId;?>, return as 1 array 
*/	
	function getData($id,$field='<?=$fieldId;?>')
	{
		$sql="select 
		 <?=implode(",  ",$fields); ?> 
		from {$this->table} where {$field}='$id'";
		if($field=='<?=$fieldId;?>'){
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
		$sql="select count(<?=$fieldId;?>) total from {$this->table}";
		$data=dbFetchOne($sql);
		return isset($data['total'])?$data['total']:false;
	}
	
	        public function __construct()
        {
            $this->load->database();
        }
/*
Field List:
<?php foreach($fieldsdata as $field){
	$s="* {$field->name} ({$field->type}) len:{$field->max_length}\n";
	echo $s;
}?>
========
*/
} 