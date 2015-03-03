<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?=base_url().'assets/';?>ico/favicon.png">

    <title>Justified Nav Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=base_url().'assets/';?>css/bootstrap.css" rel="stylesheet">
	<link href="<?=base_url().'assets/';?>css/style.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="justified-nav.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?=base_url().'assets/';?>js/html5shiv.js"></script>
      <script src="<?=base_url().'assets/';?>js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
	<div class="container">
		<div class="row">
			<h1><?=$title;?></h1>
			<hr>
			<div class="dropdown">
				<a id="dLabel" role="button" data-toggle="dropdown" class="btn btn-primary" data-target="#" href="/page.html">
					Dropdown <span class="caret"></span>
				</a>
				<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
				  <li><a href="#">Some action</a></li>
				  <li><a href="#">Some other action</a></li>
				  <li class="divider"></li>
				  <li class="dropdown-submenu">
					<a tabindex="-1" href="#">Hover me for more options</a>
					<ul class="dropdown-menu">
					  <li><a tabindex="-1" href="#">Second level</a></li>
					  <li class="dropdown-submenu">
						<a href="#">Even More..</a>
						<ul class="dropdown-menu">
							<li><a href="#">3rd level</a></li>
							<li><a href="#">3rd level</a></li>
						</ul>
					  </li>
					  <li><a href="#">Second level</a></li>
					  <li><a href="#">Second level</a></li>
					</ul>
				  </li>
				</ul>
			</div>
		</div>
	</div>
	<div class='container' style='margin-top:20px'>
	<div class="row">
        <div class="col-lg-4 col-md-8 col-xs-12" style='margin:auto'>
			<div class="docType">
				<label>Spesialis</label>
				<?php $js='class="form-control" id="docType"';
				echo form_dropdown('doc_types', $doctypes, 0, $js); ?>
			</div>
		</div>
		<div class="col-lg-4 col-md-8 col-xs-12" style='margin:auto'>
		howto
		</div>
	</div>
	<div class="row">
        <div class="col-lg-10 col-md-10 col-xs-12" style='margin:auto'>
		<table class="table table-striped">
			<thead><tr>
				<th>Dokter</th>
				<th>Nama</th>
				<th>Action</th>
			</tr></thead>
			<tbody>
				<tr><td>xxx</td><td>xxxx</td><td>xxx</td></tr>
				<tr><td>xxx</td><td>xxxx</td><td>xxx</td></tr>
				<tr><td>xxx</td><td>xxxx</td><td>xxx</td></tr>
				<tr><td>xxx</td><td>xxxx</td><td>xxx</td></tr>
			</tbody>
		</table>
		</div>
	</div>
	<div class="footer">
        <p>&copy; Company 2015</p>
     </div>
	</div>  
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?=base_url().'assets/';?>js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?=base_url().'assets/';?>js/bootstrap.min.js"></script>
	<script>
	$("#docType").change(function(){
		var selectorform = 'form#myForm'; 
		var datax = $(selectorform).serialize();
		var param = "id="+$(this).val()+'&stat=byType';  
		$(".table tbody").empty();
		var request = $.ajax({
			url: "<?=base_url();?>clinic/pasienlist",
			type: "POST",
			data: param,
			dataType: "json"
		});
		request.success(function(res) {
			console.log('data sudah terkirim');
			$(".table tbody").empty().append(res.message);
			 
			//$("#hasil").html(msg.post);
		});
		request.error( function(jqXHR,  textStatus  ){
			alert(textStatus);
			console.log(jqXHR);
		});
		
	});
	</script>
  </body>
</html>