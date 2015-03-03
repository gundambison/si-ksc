<?php 
//print_r($data);
/*
 Array ( [date] => 2015-02-19 [pasien] => SELVY SURATMI [mr] => 0000376881 [diagnosa] => Array ( [detail] => [gigi] => [gigiBagian] => ) [action] => testing [type] => 1 [modified] => 2015-02-19 18:54:26 ) )
*/

?><div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">
<?php echo " Tangga Pemeriksaan : ".date("d-m-Y",strtotime($date)) ; ?>
	</h3>
</div>
  <div class="panel-body">
 
<dl class='medrec'>
<dt class='head'><h4>DIAGNOSA</h4>
 
<?php if(isset($diagnosa['gigiBagian'])&&intval($diagnosa['gigiBagian'])!=0){
?>
<div class='gigiBox gigi<?php echo $diagnosa['gigiBagian'];?>'>
	<?=$diagnosa['gigi'];?>
</div>
<?php
}else{ 
$a=array('gigi'=>3,'gigiBagian'=>2);
//echo json_encode($a);
}

echo $diagnosa['detail'] ;
?>
</dt>

<dt class='head'><h4>TINDAKAN </h4>
<?php 
if(isset($action)&&trim($action)!=''){?>
 <?=nl2br($action); ?>	</dt> 
<?php 
}
?>
</dt>

<?php
if(isset($medic)&&trim($medic)!=''){?>
  <dt class='head'><h4>Obat</h4>  
   <?=nl2br($action);?>	</dt> 
<?php 
}
?>
</dl><br class='clear' />
Modified :<?php echo date("d-m-Y",strtotime($modified));?>
 </div>
</div>
<?php

?>