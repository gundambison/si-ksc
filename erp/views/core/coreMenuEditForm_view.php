<?php 
/****
	views	: core/coreMenuEditForm_view
	created	: 09-11-2015 12:34:25
	By		: Gunawan Wibisono
	Using 	: CI3 Main Model
****/
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
 
$atr=array('id'=>'frmMainMenu');
$hidden=array('type'=>'menuUpdate','menu_id'=>$post['menu_id']);
$data=$this->menu->getData($post['menu_id'],'menu_id');
$id=dbIdReport('id','edit menu  ',$post['menu_id']); 
//print_r($data);
//echo "`".implode("`, `",array_keys($data))."`";
echo form_open('email/send', $atr, $hidden);
$atr=array('onclick'=>'saveFormData()'  );	
	echo bsButton('Save',0,'btn-save',$atr ); 
$menu=array();
if($data['parent']==0){
	$menu[]='Parent';
}else{
	$SQL="select menu_id id,menu_title title from {$this->menu->table} 
	where menu_parent=0";//{$data['menu_parent']}";
	$result=dbQuery($SQL,1);
		$i=0;
		
		foreach ($result->result_array() as $row){
			$menu[$row['id']]=$row['title'];
		}
}	
echo  bsSelect("Parent", "parent", $menu, $data['parent']);
?> 

	<?=bsInput("Menu",'name', $data['name'],'pendek');?>
	<?php 
	$SQL="select menu_id id,menu_title title from {$this->menu->table} 
	where menu_parent=0";//{$data['menu_parent']}";
	$result=dbQuery($SQL,1);
		$i=0;
		
		foreach ($result->result_array() as $row){
			$menu[$row['id']]=$row['title'];
		}
	$SQL="select name from {$this->menu->tableIcon}";//{$data['menu_parent']}";
	$result=dbQuery($SQL,1);
		$i=0;
	$icons=array();	
		foreach ($result->result_array() as $row){
			$name=$row['name']; 
			$icons[$name]=$name;
		}
echo  bsSelect("Icon", "icon", $icons, $data['icon']);?>	
	<?=bsInput("Title",'title',$data['title'], 'Nama yang Jelas');?>
	<?=bsInput("Position",'pos', $data['position'],'');?>
	<?=bsInput("Href",'href', $data['href'],'');
	$SQL="select permit_id id, permit_name name 
	from {$this->permision->table} order by permit_name";//{$data['menu_parent']}";
	$result=dbQuery($SQL,1);
		$i=0;
	$shows=array();	
		foreach ($result->result_array() as $row){
			$name=$row['name']; 
			$shows[$row['id']]=$name;
		}
		
	echo  bsSelect("Show Permision", "show", $shows, $data['show']);
	?>
	
	<?=bsText("Detail",'detail',$data['detail']);?>
	<?php
$atr=array('onclick'=>'saveFormData()'  );	
	echo bsButton('Update',0,'btn-save',$atr );?>
</form>
<?php 
$content=ob_get_contents();
ob_end_clean();

$result=array(
	'body'=>$content,
	'title'=>'Update Menu ',
	'footer'=>'-'

);
echo json_encode($result);