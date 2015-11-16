<?php 
/****
	views	: core/coreTables_view
	created	: 13-11-2015 21:36:57
	By		: Gunawan Wibisono
	Using 	: CI3 Main Model
****/
defined('BASEPATH') OR exit('No direct script access allowed');
 
$name="Table";
?>
<div style='width:600px;margin:10px auto;'>
<div class="btn-group"> 
	<button type='button' class='btn btn-default' onclick='btnAdd()' >
	Tambah  <?=$name;?></button>
	<button type='button' class='btn btn-primary' onclick='btnEdit()'>Edit <?=$name;?></button>		
	<button type='button' class='btn btn-default' onclick='btnGenerate()' >Generate Table </button>
</div>
<hr/>
	<table id="list"></table>
	<div id="pager"></div>
	<hr/> 
	<div class="btn-group"> 
	<button type='button' class='btn btn-default' onclick='btnAdd()' >
	Tambah  <?=$name;?></button>
	<button type='button' class='btn btn-primary' onclick='btnEdit()'>Edit <?=$name;?></button>	
	<button type='button' class='btn btn-default' onclick='btnGenerate()' >Generate Table </button>
	</div>
</div> 
<script> 
controller='core'; 
dataUrl1	='<?=base_url();?>'+controller+'/data/<?=$myUrl;?>';
dataUrl2	='<?=base_url();?>'+controller+'/data/<?=$myUrl;?>sub'; 

urlFormAdd	='<?=base_url();?>'+controller+'/form/<?=$myUrl;?>add';
urlFormEdit	='<?=base_url();?>'+controller+'/form/<?=$myUrl;?>edit';
urlFormSave	='<?=base_url();?>'+controller+'/data/<?=$myUrl;?>save';
urlother	='<?=base_url();?>'+controller+'/form/<?=$myUrl;?>other';

</script>