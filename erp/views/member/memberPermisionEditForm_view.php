<?php 
/****
	views	: member/memberPermisionEditForm_view
	created	: 09-11-2015 11:09:06
	By		: Gunawan Wibisono
	Using 	: CI3 Main Model
****/
defined('BASEPATH') OR exit('No direct script access allowed');
 ob_start();
$module="permision"; //change this
$data=$this->$module->getData($post['permit_id'],'permit_id');
$id=dbIdReport('id','edit mujur_permision',$post['permit_id']);  
$atr=array('id'=>'frmMain');
$hidden=array('type'=>'update','permit_id'=>$post['permit_id']);
echo form_open('', $atr, $hidden);
?>
<?=bsInput("Nama",'name', $data['name'],'Nama Yang Jelas');?>
 
	<?php
$atr=array('onclick'=>'saveFormData()'  );	
	echo bsButton('Save',0,'btn-save',$atr );?>
</form>
<?php 
$content=ob_get_contents();
ob_end_clean();

$result=array(
	'body'=>$content,
	'title'=>'Update mujur_permision',
	'footer'=>' '

);
echo json_encode($result);