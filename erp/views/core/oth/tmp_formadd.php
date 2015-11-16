ob_start();
 
$atr=array('id'=>'frmMain');
$hidden=array('type'=>'save');
echo form_open('', $atr, $hidden);
?>
< ?=bsInput("Kode",'code', '','Code yang singkat');?>
< ?=bsInput("Nama",'name', '','Nama Yang Jelas');?>
< ?=bsText("Detail",'detail','');?>	
	< ?php
$atr=array('onclick'=>'saveFormData()'  );	
	echo bsButton('Save',0,'btn-save',$atr );?>
</form>
< ?php 
$content=ob_get_contents();
ob_end_clean();

$result=array(
	'body'=>$content,
	'title'=>'Menambah <?=$tableData['name'];;?> ',
	'footer'=>' '

);
echo json_encode($result);