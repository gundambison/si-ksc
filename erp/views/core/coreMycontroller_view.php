<?php 
/****
	views	: core/coreMycontroller_view
	created	: 14-11-2015 10:09:00
	By		: Gunawan Wibisono
	Using 	: CI3 Main Model
****/
defined('BASEPATH') OR exit('No direct script access allowed');?>
<div style='' class='formGenerator'>
<?php
if(isset($post['type'])){ 
	echo bsText("Detail",'detail',$detail,10); 
}else{  }

$atr=array('id'=>'frmMainMenu');
$hidden=array('type'=>'generate model');
echo form_open('', $atr, $hidden);
 
?>
<?=bsInput("Nama Controller",'name1', '','nama controller');?>
<?=bsInput("Nama Fungsi",'name2', '','nama Function');?>
<?=bsInput("Default Menu",'default', 'temp','table untuk counter');?>

<?php 
$atr=array('onclick'=>'saveFormData()'  );	
	echo bsButton('Go',1,'btn-save',$atr );?>
	</div>
</form> 