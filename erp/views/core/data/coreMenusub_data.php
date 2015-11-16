<?php 
/****
	views	: core/data/coreMenusub_data
	created	: 14-11-2015 11:21:49
	By		: Gunawan Wibisono
	Using 	: CI3 Main Model
****/ 
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();

$responce = (object)array();
 
$page = $get['page']; // get the requested page
$limit = $get['rows']; // get how many rows we want to have into the grid
$sidx = $get['sidx']; // get index row - i.e. user click to sort
$sord = $get['sord']; // get the direction
if(!$sidx) $sidx =1;
$id=dbIdReport('id','list menu ',json_encode($get)); 
if(isset($get['parent'])){	
  if($get['_search']==='false'){	
	$count = $this->menu->totalAllSub($get['parent']); 
	if( intval($count) >0 ) {
		$total_pages = ceil($count/$limit);
	} else {
		$total_pages = 0;
	}	

	if ($page > $total_pages) $page=$total_pages;
	$start = $limit*$page - $limit; // do not put $limit*($page - 1)
	if($start<0)$start=0;
	
	$SQL = "SELECT menu_id id  FROM ".$this->menu->table." a 
	where menu_parent=$get[parent]
	ORDER BY $sidx $sord 
	LIMIT $start , $limit"; 
	$result=dbQuery($SQL,1);

	$i=0;
	foreach ($result->result_array() as $row){
		$responce->rows[$i]['id']=$row['id'];
		$row2=$this->menu->getData($row['id']);
		$status=  $this->permision->getData($row2['show'])['name'] ;
		$responce->rows[$i]['cell']=array($row['id'],$row2['name'],$status,$row2['title'], $row2['position']);
		$i++;
		//$responce->raw[]=$row2;
	 
		
	}
	
  }else{}
}else{
	$total_pages=0;	$responce->rows=array();
}
$responce->page = $page;
$responce->total = $total_pages;
$responce->records = $count;

$error = ob_get_contents();
ob_end_clean();
if($error!='')
	$responce->error=$error;
        
echo json_encode($responce);