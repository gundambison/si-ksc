<?php 
/****
	views	: core/coreMenu_view
	created	: 09-11-2015 12:34:25
	By		: Gunawan Wibisono
	Using 	: CI3 Main Model
****/
defined('BASEPATH') OR exit('No direct script access allowed');?>
<div style='width:600px;margin:10px auto;'>
<div class="btn-group">
	<button type='button' class='btn btn-default' onclick='btnAddMainMenu()' >Tambah Menu Utama</button>
	<button type='button' class='btn btn-default' onclick='btnAdd()' >Tambah Submenu</button>
	<button type='button' class='btn btn-primary' onclick='btnEdit()'>Edit Menu</button>
</div>
<hr/>
	<table id="list"></table>
	<div id="pager"></div>
	<hr/>
	<table id="list2"></table>
	<div id="pager2"></div>
	<hr/>
	<div class="btn-group">
	<button type='button' class='btn btn-default' onclick='btnAddMainMenu()' >Tambah Menu Utama</button>
	<button type='button' class='btn btn-default' onclick='btnAdd()' >Tambah Submenu</button>
	<button type='button' class='btn btn-primary' onclick='btnEdit()'>Edit Menu</button>
	</div>
</div>
<script>
controller='core'; 
dataUrl1='<?=base_url();?>'+controller+'/data/<?=$myUrl;?>';
dataUrl2='<?=base_url();?>'+controller+'/data/<?=$myUrl;?>sub'; 
urlFormAddParent=	'<?=base_url();?>'+controller+'/form/<?=$myUrl;?>addparent';
urlFormAdd=			'<?=base_url();?>'+controller+'/form/<?=$myUrl;?>add';
urlFormEdit='<?=base_url();?>'+controller+'/form/<?=$myUrl;?>edit';
urlFormSave='<?=base_url();?>'+controller+'/data/<?=$myUrl;?>save';
urlother='<?=base_url();?>'+controller+'/data/<?=$myUrl;?>other';
</script>