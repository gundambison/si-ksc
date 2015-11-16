<?php
defined('BASEPATH') OR exit('No direct script access allowed');?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php 
	$load_view=isset($baseFolder)?$baseFolder.'head_view':'head_view';
	$this->load->view($load_view);
?>
<body>
<?php
if(!isset($contentOnly)){ ?><!-- start: Header--><?php 
	$load_view=isset($baseFolder)?$baseFolder.'header_view':'header_view';
	$this->maincore->checkView($load_view);
	$this->load->view($load_view);
?><!-- start: Header--><?php
}else{}
?>
	<div class="container-fluid-full">
	<div class="row-fluid">
<?php 
if(!isset($contentOnly)){ ?><!-- start: Main Menu --><?php 
	$load_view=isset($baseFolder)?$baseFolder.'menu_view':'menu_view';
	$this->maincore->checkView($load_view);
	$this->load->view($load_view);
?><!-- end: Main Menu -->
		
<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
</noscript>
<?php 
}

if(!isset($contentOnly)){ ?>
?>			
		<div id="content" class="span10">
<?php 
	$load_view=isset($baseFolder)?$baseFolder.'breadcrumb_view':'breadcrumb_view';
	$this->maincore->checkView($load_view);
	$this->load->view($load_view);
}
else{ 
?><div><?php 
}
  
if(isset($contents)){
  foreach($contents as $content){
	$this->maincore->checkView($load_view);  
	$load_view= $folder.$content.'_view';
	$this->maincore->checkView($load_view);
	?><!-- Start : <?=$load_view;?> --><?php
	$this->load->view($load_view);
	?><!-- End : <?=$load_view;?> --><?php
  }
  
}else{ 
	?><!-- no contents --><?php
}
?>
		
		</div><!-- content end -->
		
	</div>
	</div>

<!-- start: Modal-->
<?php 
	$load_view=isset($baseFolder)?$baseFolder.'modal_view':'modal_view';
	$this->maincore->checkView($load_view);
	$this->load->view($load_view);
?><!-- end: Modal--> 
 
<div class="clearfix"></div>	
<?php 
if(!isset($contentOnly)){ ?><!-- start: Footer--><?php 
	$load_view=isset($baseFolder)?$baseFolder.'footer_view':'footer_view';
	$this->maincore->checkView($load_view);
	$this->load->view($load_view);
?><!-- end: Footer--><?php 	
}else{}	
?>
<!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
<?php 
if(isset($footerJS)){ 
	if(!is_array($footerJS)){ 
		$footerJS=array($footerJS); 
	}else{}
	
	foreach($footerJS as $jsFile ){?>
	  <script src="<?=base_url();?>assets/js/<?=$jsFile;?>"></script>
<?php 
	}
}else{ echo '<!--no footer js -->'; } ?>
</body>
</html>