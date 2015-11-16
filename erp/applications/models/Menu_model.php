<?php
/****
	Model	: Menu_model
	Created	: 14-11-2015 09:29:20
	By		: Gunawan Wibisono 
	Using 	: CI3 Model Generator  
****/
defined('BASEPATH') OR exit('No direct script access allowed');
class Menu_model extends CI_Model {
	public $table='mujur_menu'; 
	public $tableIcon='mujur_icon'; 
	function totalAllParent( )
	{
		$sql="select count(menu_id) total from {$this->table} where menu_parent=0";
		$data=dbFetchOne($sql);
		return isset($data['total'])?$data['total']:false;
	}
	
	function totalAllSub($id )
	{
		$sql="select count(menu_id) total from {$this->table} where menu_parent=$id";
		$data=dbFetchOne($sql);
		return isset($data['total'])?$data['total']:false;
	}
		
	function generate($target='home'){
		$menus=array();
		$userid=$this->session->userdata('erp_userid');
		$data=array('name'=>'Home', 'href'=>'dashboard', 'title'=>'Dasboard','icon'=>'icon-bar-chart','show'=>-1);
		$menus[]=$data;
		$parents=$this->getData(0,'menu_parent');
		foreach($parents as $parent){
			$icon=$parent['icon'];
			$icon=str_replace("fa-","",$icon);
			$data=array(
			  'icon'=>$icon,
			  'show'=>$parent['show'],
			  'name'=>$parent['name'], 
			  'href'=>$parent['href'], 
			  'title'=>$parent['title']);
			$pos=sprintf("%05s_%s",$parent['position'], $parent['name']);
			$submenu= $this->getData($parent['id'],'menu_parent'); 
			if(count($submenu)!=0){
				foreach($submenu as $menu){
					if($this->user->getPermision($userid,$menu['show'])){
						$icon=$menu['icon'];
						$pos1=sprintf("%05s_%s",$menu['position'], $menu['name']);
						$icon=str_replace("fa-","",$icon);
						$data['subMenu'][$pos1]=array(
						  'name'=>$menu['name'], 
						  'href'=>$menu['href'], 
						  'title'=>$menu['title'],
						  'icon'=>$icon,
						  'show'=>$menu['show']
						);
					}
				}
				$menus[$pos]=$data;
			}
			ksort($menus);
			unset($data);
		}
		
		ksort($menus);
		
		foreach($menus	 as $id=>$menu){
			if(strtolower($menu['name'])==strtolower($target)){
				$menus[$id]['active']=true;
				$active=true;
			}else{}
			if(!isset($idFirst))$idFirst=$id;
		}
		
		if(!isset($active)){
			$menus[$idFirst]['active']=true;
		}
		return $menus;
	}
		
/*	
	If not valid, Create New
	UPDATE DATA USING ID:menu_id	
*/
	function updateData($data,$id)
	{
		dbIdReport('update','update Menu',json_encode($data), 100);
		$this->db->where('menu_id', $id);
		$this->db->update($this->table, $data);
		$str = $this->db->last_query();	
		logConfig("update Menu:$str",'logDB');
		
	}
/* 
	SAVE DATA 
*/
	function saveData($data)
	{
		$id=$data['menu_id']=dbIdReport('id','create Menu',json_encode($data),100);
		$data['menu_created']=date("Y-m-d H:i:s");
		$this->db->insert($this->table,$data);
		$str = $this->db->last_query();			 
		logConfig("create Menu:$str",'logDB');
		return $id;
	}
/*
	GET DATA if using menu_id, return as 1 array 
*/	
	function getData($id,$field='menu_id')
	{
		$sql="select 
		 `menu_id` id,  `menu_name` name,  `menu_icon` icon,  `menu_title` title,  `menu_href` href,  `menu_detail` detail,  `menu_created` created,  `menu_modified` modified,  `menu_parent` parent,  `menu_position` position,  `menu_show` `show` 
		from {$this->table} where {$field}='$id'";
		if($field=='menu_id'){
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
		$sql="select count(menu_id) total from {$this->table}";
		$data=dbFetchOne($sql);
		return isset($data['total'])?$data['total']:false;
	}
	
	    public function __construct()
        {
            $this->load->database();
        }
/*
Field List:
* menu_id (bigint) len:11
* menu_name (varchar) len:30
* menu_icon (varchar) len:150
* menu_title (varchar) len:50
* menu_href (text) len:
* menu_detail (text) len:
* menu_created (datetime) len:
* menu_modified (timestamp) len:
* menu_parent (int) len:11
* menu_position (int) len:11
* menu_show (int) len:11
========
*/
}  