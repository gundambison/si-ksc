ob_start();
$module="<?=$tableData['module'];?>"; //change this
$data=$this->$module->getData($post['<?=$prefix;?>_id'],'<?=$prefix;?>_id');
$id=dbIdReport('id','edit <?=$tablename;?>',$post['<?=$prefix;?>_id']);  
$atr=array('id'=>'frmMain');
$hidden=array('type'=>'update','<?=$prefix;?>_id'=>$post['<?=$prefix;?>_id']);
echo form_open('', $atr, $hidden);
?>
< ?=bsInput("Code",'code', $data['code'],'Nama Yang Jelas');?>
< ?=bsInput("Nama",'name', $data['name'],'Nama Yang Jelas');?>
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
	'title'=>'Update <?=$tableData['name'];?>',
	'footer'=>' '

);
echo json_encode($result);