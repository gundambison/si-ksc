<?php 
/****
	views	: core/formmodel_view
	created	: 14-11-2015 10:28:28
	By		: Gunawan Wibisono
	Using 	: CI3 Main Model
****/
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div   class='formGenerator'>
<?php
if(isset($post['type'])){ 
	echo bsText("Detail",'detail',$detail,10); 
}else{  }

$atr=array('id'=>'frmMainMenu');
$hidden=array('type'=>'generate model');
echo form_open('', $atr, $hidden);
?>
	
<?=bsInput("Nama Model",'name', '','nama model');?>
<?=bsInput("Table id",'tableid', 'id','table untuk counter');?>
<?=bsInput("Table counter",'counter', '100','counter');?>
<?php
$tables=array();
$table = $this->db->list_tables();
foreach($table as $val){
	if(strpos($val,"id_")===false){
		$tables[$val]=$val;
	}
}
echo bsSelect("Table", "table", $tables,101);
$atr=array('onclick'=>'saveFormData()'  );	
	echo bsButton('Go',1,'btn-save',$atr );?>
	</div>
</form> 