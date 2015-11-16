<?php
defined('BASEPATH') OR exit('No direct script access allowed');?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php 
$load_view=isset($baseFolder)?$baseFolder.'head_view':'head_view';
$this->load->view($load_view);
?>
<body>
 
<!-- CONTENT-WRAPPER SECTION START-->
    <div class="content-wrapper">
<?php 
$load_view= $folder.$content.'_view';
$this->load->view($load_view);
?>
	</div>
<!-- CONTENT-WRAPPER SECTION END-->
 
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="<?=base_url();?>assets/js/jquery-2.1.1.min.js"></script>
     
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
