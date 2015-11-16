ob_start();
$module="<?=$tableData['module'];?>"; //change this 
$done=false;
if($post['type']=='save'){
	$data=array( 
		'<?=$prefix;?>_name'=>isset($post['name'])?$post['name']:'', 
		'<?=$prefix;?>_code'=>isset($post['code'])?$post['code']:'', 
		'<?=$prefix;?>_detail'=>isset($post['detail'])?$post['detail']:'', 
	);
	$id=$this->$module->saveData($data);
	echo "<div><?=$tablename;?> Created id:$id  </div>";
	$done=true;
	$title='Save Data Successed';
}else{}

if($post['type']=='update'){
	$data=array( 
		'<?=$prefix;?>_name'=>isset($post['name'])?$post['name']:'', 
		'<?=$prefix;?>_code'=>isset($post['code'])?$post['code']:'', 
		'<?=$prefix;?>_detail'=>isset($post['detail'])?$post['detail']:'',
	);
	$this->$module->updateData($data,$post['<?=$prefix;?>_id']);
	$done=true;
	echo "<div>Menu update  id:{$post['<?=$prefix;?>_id']} </div>";
	$title='Update Data Successed';
}
	
if($done==false){
	$id=dbIdReport('id','error',json_encode($_REQUEST)); 
	echo 'check your parameter';
	$title='Error';
}else{}

$content=ob_get_contents();
ob_end_clean();

$result=array(
	'body'=>$content,
	'title'=>$title,
	'footer'=>' ',
	'post'=>$post
);
echo json_encode($result);