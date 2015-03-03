<?php
$this->load->helper('captcha');
?><!DOCTYPE html>
<html lang="es">
	
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<head>
		<!--<script type="text/javascript" src="http://www.levelup.com/no-cache/fullPageAd/0/0/0/?366"></script>-->
		
	<title><?php echo $title;?></title>
	<meta name="title" content="<?php echo $title;?>">
	<meta name="description" content="<?php echo $desc;?>">
	<meta name="keywords" content="<?php echo $keyword;?>"> 
	<link rel="stylesheet" type="text/css" href="/kerjaan4/CI_22/css/base1.css" />
	<link rel="icon" href="/kerjaan4/CI_22/images/levelup0.gif" type="image/gif" />

</head>
<body>
	<?php
 
$vals = array(
    'img_path'	 => "../../test/",
    'img_url'	 => 'http://localhost/test/'
    );
//kerjaan6/ci_22/
$cap = create_captcha($vals);

 
 

echo 'Submit the word you see below:';
echo $cap['image'];
echo '<input type="text" name="captcha" value="" />';
	
	?>
	<div class="fullpage"><div class="contentMain">
		<div class="contentWrap">	
			<div class="contentWide">	
			<div class="left1">
			<?=$example;?>
			</div>
			<div class="right1">
			NEWS
			</div>
			</div>
		</div>
		<?php
		for($i=0;$i<23;$i++)echo'<br>'; ?>
	</div></div>	
</body>
</html>