<?php 
/****
	views	: core/oth/tmp_controller
	created	: 14-11-2015 10:19:08
	By		: Gunawan Wibisono
	Using 	: CI3 Main Model
****/
defined('BASEPATH') OR exit('No direct script access allowed');
?>/***
Controller:	<?=$post['name1'];
?>

Function:	<?=$post['name2'];?>

***/ 
	public function <?=$post['name2'];?>()
	{
//		$this->load->model('<?=$post['name2'];?>_model','<?=$post['name2'];?>'); 
//		don't forget to add this
		$this->param['breadcrumbs']=array('update','this');
//		$this->param['defaultMenu']='<?=$post['default'];?>';  
		$mainPage=$this->uri->segment(1).'<?=ucfirst($post['name2']);?>';
		$this->param['contents']=array( $mainPage );
//		$this->param['title']='ERP-<?=$post['name1'];?> <?=$post['name2'];?>';
/*
model: <?=$post['name2'];?>_model
view:<?=$post['name1'];?><?=ucfirst($post['name2']);?>_view
js: {folder}/<?=$post['name1'];?><?=ucfirst($post['name2']);?>.js
*/
		$this->showView(); 
/*
form : <?=$post['name1'];?><?=ucfirst($post['name2']);?>EditForm_view, <?=$post['name1'];?><?=ucfirst($post['name2']);?>AddForm_view
data: <?=$post['name1'];?><?=ucfirst($post['name2']);?>Save_data, <?=$post['name1'];?><?=ucfirst($post['name2']);?>_data
*/		
		$folder=$this->param['folder'];
		$this->checkView($folder."<?=$post['name1'];?><?=ucfirst($post['name2']);?>EditForm_view");
		$this->checkView($folder."<?=$post['name1'];?><?=ucfirst($post['name2']);?>AddForm_view");
		$this->checkView($folder."data/<?=$post['name1'];?><?=ucfirst($post['name2']);?>Save_data");
		$this->checkView($folder."data/<?=$post['name1'];?><?=ucfirst($post['name2']);?>_data");

	}
