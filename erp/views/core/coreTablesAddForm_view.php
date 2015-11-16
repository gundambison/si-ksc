<?php 
/****
	views	: core/coreTablesAddForm_view
	created	: 13-11-2015 21:36:57
	By		: Gunawan Wibisono
	Using 	: CI3 Main Model
****/ 
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
 
$atr=array('id'=>'frmMain');
$hidden=array('type'=>'save');
echo form_open('', $atr, $hidden);
?>
<?=bsInput("prefix",'prefix','', 'Pendek');?>
<?=bsInput("Nama",'name', '','Nama Yang Jelas');?>
<?=bsInput("Module",'module', 'temp','');?>	
	<?php
$atr=array('onclick'=>'saveFormData()'  );	
	echo bsButton('Save',0,'btn-save',$atr );?>
</form>
<?php 
$content=ob_get_contents();
ob_end_clean();

$result=array(
	'body'=>$content,
	'title'=>'Menambah Data Table ',
	'footer'=>' '

);
echo json_encode($result);