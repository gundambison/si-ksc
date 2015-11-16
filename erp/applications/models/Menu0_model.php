<?php
class Menu_model extends CI_Model {
	public $table='mujur_menu';
        public function __construct()
        {
            $this->load->database();
        }
	
	function updateData($data,$id)
	{
		$sql="select count(menu_id) total from {$this->table} where menu_name like '$data[menu_name]%'";
		$row=dbFetchOne($sql);
		if($row['total']>1){
			$data['menu_name'].="_".($row['total']+1);
		}
		
		$this->db->where('menu_id', $id);
		$this->db->update($this->table, $data); 
	}
	
	function saveData($data){
		$data['menu_created']=date("Y-m-d H:i:s");
		if(!isset($data['menu_parent']))$data['menu_parent']=0;
		if(!isset($data['menu_href']))$data['menu_href']='#';
		if(!isset($data['menu_position']))$data['menu_position']=100;
		$sql="select count(menu_id) total from {$this->table} where menu_name like '$data[menu_name]%'";
		$row=dbFetchOne($sql);
		if($row['total']>0){
			$data['menu_name'].="_".($row['total']+1);
		}
		$this->db->insert($this->table,$data);
		
	}
	
	function getData($id,$field='menu_id')
	{
		$sql="select 
		`menu_id`,`menu_name`, `menu_title`, `menu_href`, `menu_created`, `menu_modified`, `menu_parent`,menu_detail, menu_position, menu_show
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
	
	function totalAll()
	{
		$sql="select count(menu_id) total from {$this->table}";
		$data=dbFetchOne($sql);
		return isset($data['total'])?$data['total']:false;
	}
	
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
		$data=array('name'=>'Home', 'href'=>'admin', 'title'=>'Dasboard');
		$menus[]=$data;
		$parents=$this->getData(0,'menu_parent');
		foreach($parents as $parent){
			$data=array(
			  'name'=>$parent['menu_name'], 
			  'href'=>$parent['menu_href'], 
			  'title'=>$parent['menu_title']);
			$pos=sprintf("%05s_%s",$parent['menu_position'], $parent['menu_name']);
			$submenu= $this->getData($parent['menu_id'],'menu_parent'); 
			if(count($submenu)!=0){
				foreach($submenu as $menu){
					$data['subMenu'][]=array(
					  'name'=>$menu['menu_name'], 
					  'href'=>$menu['menu_href'], 
					  'title'=>$menu['menu_title']);
				}
				$menus[$pos]=$data;
			}
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
	
	function generateV0($target='home'){
		$menus=array();
		$data=array('name'=>'Home', 'href'=>'admin', 'title'=>'Dasboard');
		$menus[]=$data;
		
		$data=array('name'=>'user', 'href'=>'#', 'title'=>'User');
		$data['subMenu'][]=array('name'=>'members', 'href'=>'user/member','title'=>'Atur User');
		$data['subMenu'][]=array('name'=>'Permision', 'href'=>'user/permision','title'=>'Mengatur Hak dan Kewajiban');
		$data['subMenu'][]=array('name'=>'Menu', 'href'=>'user/menu','title'=>'Main Menu');
		 	$menus[]=$data;
			
		$data=array('name'=>'core', 'href'=>'#', 'title'=>'Core');
		$data['subMenu'][]=array('name'=>'Menu', 'href'=>'user/menu','title'=>'Main Menu');
		 	$menus[]=$data;
 
		//============
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
}