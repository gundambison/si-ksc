<?php
/*
//jalankan di autoload
$this->load->helper('form');
$this->load->helper('lang');
*/
?><!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<head>
        <title>DATABASE</title>
         
</head>
<body>
<h1><?=show('intro'); ?></h1>
 
<?php
$aUrl=array(
	"HOME"=>"",
	"INPUT DATA"=>"rumah/input",
	"HAPUS DATA"=>"rumah/hapus"
);
	$s='<p>';
foreach($aUrl as $nm=>$val)
{
	$s.="[<a href=".base_url($val).">$nm</a>] ";
}
$s.="<hr>";
$ses=$this->session->all_userdata();
 
	if(@!is_null($ses['name']))
	{
		$s.="Hallo ".$ses['name'];
		$s.=" [<a href='".base_url('rumah/logout')."'>
		logout</a>]";
	}
	
	print $s;$s='<br>';
	
//========ERROR===========
	if(@!is_null($error))
	{
		$s.="<font color=red>$error</font>";
	
	}
	print $s;$s='<br>';
?>
<?php 
foreach($modul as $v)
{
	$show=0;
	if($v!='login')
	{
		$show=1;
	}elseif( @is_null($ses['name'])){
		$show=1; 
	}
	
	if($show==1)
	{?> 
<div style='clear:both;margin:5px'>
	<?php $this->load->view('modul/'.$v.'_view');?>
</div>
<?php
	}
	
}
?> 
</body>
</html>