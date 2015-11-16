<?php 
/****
	views	: core/coreMenuAddForm_view
	created	: 09-11-2015 12:34:25
	By		: Gunawan Wibisono
	Using 	: CI3 Main Model
****/
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
 
$atr=array('id'=>'frmMainMenu');
$hidden=array('type'=>'subMenuSave');
echo form_open('email/send', $atr, $hidden);
 
$atr=array('onclick'=>'saveFormData()'  );	
	echo bsButton('Save',0,'btn-save',$atr ); 
$menu=array();
$SQL="select menu_id id,menu_title title from {$this->menu->table} where menu_parent=0";
$result=dbQuery($SQL,1);
	$i=0;
	foreach ($result->result_array() as $row){
		$menu[$row['id']]=$row['title'];
	}
echo  bsSelect("Parent", "parent", $menu,101);?>

	<?=bsInput("Menu",'name', '','pendek');
	$SQL="select name from {$this->menu->tableIcon}";//{$data['menu_parent']}";
	$result=dbQuery($SQL,1);
		$i=0;
	$icons=array();	
		foreach ($result->result_array() as $row){
			$icons[$row['name']]=$row['name'];
		}
echo  bsSelect("Icon", "icon", $icons, '');?>
	<?=bsInput("Title",'title','', 'Nama yang Jelas');?>
	<?=bsInput("Href",'href', '','');?>
	<?=bsText("Detail",'detail');?>
	<?php
$atr=array('onclick'=>'saveFormData()'  );	
	echo bsButton('Save',0,'btn-save',$atr );?>
</form>
<?php 
$content=ob_get_contents();
ob_end_clean();

$result=array(
	'body'=>$content,
	'title'=>'Menambah Sub Menu ',
	'footer'=>'-'

);
echo json_encode($result);