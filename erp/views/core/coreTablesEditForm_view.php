<?php 
/****
	views	: core/coreTablesEditForm_view
	created	: 13-11-2015 21:36:57
	By		: Gunawan Wibisono
	Using 	: CI3 Main Model
****/
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
  ON PROGRESS
<?php 
$content=ob_get_contents();
ob_end_clean();

$result=array(
	'body'=>$content,
	'title'=>'Mengedit Data Table ',
	'footer'=>' '

);
echo json_encode($result);