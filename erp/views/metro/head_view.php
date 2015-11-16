<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title><?php 
if(isset($title)){ 
	echo $title;
}
else{
?>Bootstrap Metro Dashboard by Dennis Ji for ARM demo<?php 
} ?></title>
     
	<link id="bootstrap-style" href="<?=base_url();?>assets/css/metro/bootstrap.min.css" rel="stylesheet">
	<link href="<?=base_url();?>assets/css/metro/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="<?=base_url();?>assets/css/metro/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="<?=base_url();?>assets/css/metro/style-responsive.css" rel="stylesheet">
	
<?php 
if(isset($css)){
	foreach($css as $url){?>
	<link href="<?=base_url();?>assets/css/<?=$url;?>" rel="stylesheet" />
<?php 
	}
}else{}
?>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
	
<?php
if(isset($js)){
	foreach($js as $url){?>
	 <script src="<?=base_url();?>assets/js/<?=$url;?>"></script>
<?php 
	}
}else{}
?> 
	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
	<![endif]-->
	
	<!--[if IE 9]>
		<link id="ie9style" href="<?=base_url();?>assets/css/metro/ie9.css" rel="stylesheet">
	<![endif]-->
		
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->
	
</head>