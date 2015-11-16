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
?>Free Responsive Admin Theme - ZONTAL<?php 
} ?></title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="<?=base_url();?>assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME ICONS  -->
    <link href="<?=base_url();?>assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="<?=base_url();?>assets/css/style.css" rel="stylesheet" />
<?php 
if(isset($css)){
	foreach($css as $url){?>
	<link href="<?=base_url();?>assets/css/<?=$url;?>" rel="stylesheet" />
<?php 
	}
}else{}

if(isset($js)){
	foreach($js as $url){?>
	 <script src="<?=base_url();?>assets/js/<?=$url;?>"></script>
<?php 
	}
}else{}

if(!isset($footerJS)){
?>
	<!-- CORE JQUERY SCRIPTS -->
    <script src="<?=base_url();?>assets/js/jquery-2.1.1.min.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="<?=base_url();?>assets/js/bootstrap.js"></script>
     <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<?php 
}
?>
</head>