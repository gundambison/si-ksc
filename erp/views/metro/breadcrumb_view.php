<?php 
/****
	views	: metro/breadcrumb_view
	created	: 12-11-2015 19:41:45
	By		: Gunawan Wibisono
	Using 	: CI3 Main Model
****/
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<ul class="breadcrumb">
	<li>
					<i class="icon-home"></i>
					<a href="<?=site_url();?>">Home</a> 
					<i class="icon-angle-right"></i>
	</li>
	<li><a href="#"><?=implode('<i class="icon-angle-right"></i>
	</li>
	<li><a href="#">',
	$breadcrumbs);?></a></li>
 	
</ul>