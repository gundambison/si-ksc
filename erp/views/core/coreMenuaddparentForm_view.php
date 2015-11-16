<?php 
/****
	views	: core/coreMenuaddparentForm_view
	created	: 14-11-2015 11:25:02
	By		: Gunawan Wibisono
	Using 	: CI3 Main Model
****/
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
 
$atr=array('id'=>'frmMainMenu');
$hidden=array('type'=>'mainMenuSave');
echo form_open('email/send', $atr, $hidden);
$atr=array('onclick'=>'saveFormData()'  );	
	echo bsButton('Save',0,'btn-save',$atr ); 
?> 
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
	<!--?=bsInput("Href",$name, $value='',$info='');?-->
	<?php
$atr=array('onclick'=>'saveFormData()'  );	
	echo bsButton('Save',0,'btn-save',$atr );?>
</form>
<?php 
$content=ob_get_contents();
ob_end_clean();

$result=array(
	'body'=>$content,
	'title'=>'Menambah Menu Utama',
	'footer'=>'-'

);
echo json_encode($result);