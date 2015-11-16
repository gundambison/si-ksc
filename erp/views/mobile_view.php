<?php
defined('BASEPATH') OR exit('No direct script access allowed');?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php 
	$load_view=isset($baseFolder)?$baseFolder.'head_view':'head_view';
	$this->load->view($load_view);
?>
<body>
	<div data-role="page">   
		<div data-role="header">
<!-- HEADER START-->	
<?php 
	$load_view=isset($baseFolder)?$baseFolder.'header_view':'header_view';
	$this->load->view($load_view);
?>
		</div><!-- data-role="header" -->
<!-- HEADER END-->
<!-- CONTENT START-->
		<div data-role="content">
<?php 
	if(isset($content)){
		$load_view= $folder.$content.'_view';
		$this->load->view($load_view);
	}else{}
?>
		</div><!-- data-role="content" -->
<!-- CONTENT END-->
	</div>
</body>
</html>