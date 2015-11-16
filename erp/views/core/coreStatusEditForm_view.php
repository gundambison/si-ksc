<?php 
/****
	views	: core/coreStatusEditForm_view
	created	: 11-11-2015 19:15:35
	By		: Gunawan Wibisono
	Using 	: CI3 Main Model
****/
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
$module="status"; //change this
$data=$this->$module->getData($post['stat_id'],'stat_id');
$id=dbIdReport('id','edit mujur_status',$post['stat_id']);  
$atr=array('id'=>'frmMain');
$hidden=array('type'=>'update','stat_id'=>$post['stat_id']);
echo form_open('', $atr, $hidden);
?>
<?=bsInput("Code",'code', $data['code'],'Nama Yang Jelas');?>
<?=bsInput("Nama",'name', $data['name'],'Nama Yang Jelas');?>
<?=bsText("Detail",'detail','');?>	
	<?php
$atr=array('onclick'=>'saveFormData()'  );	
	echo bsButton('Save',0,'btn-save',$atr );?>
</form>
<?php 
$content=ob_get_contents();
ob_end_clean();

$result=array(
	'body'=>$content,
	'title'=>'Update mujur_status',
	'footer'=>' '

);
echo json_encode($result);