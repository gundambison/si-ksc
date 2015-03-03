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
    <link href="<?=base_url().'assets/';?>css/bootstrapBlue.css" rel="stylesheet">
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
<!--menu--> 
			<div class="bs-component">
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span>
		 <span class="icon-bar"></span>
		 <span class="icon-bar"></span>
		 <span class="icon-bar"></span>

						</button> <a class="navbar-brand" href="#">SI KSC</a>

					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li class="active"><a href="#">Home  <span class="sr-only">(current)</span></a>
							</li>							
							<li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Pasien<span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
									<li><a href="#">Pasien Baru</a>
									</li>
									<li><a href="#">List Pasien Baru</a>
									</li>
								<li><a href="#">Cari Pasien</a>
								</li>
							</ul>		
							</li>
							<li><a href="#">Billing Rawat Jalan</a> 
							</li>
							<li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Rawat Jalan<span class="caret"></span></a>

								<ul class="dropdown-menu" role="menu">
									<li><a href="#">Pendaftaran</a>
									</li>
									<li><a href="#">Jadwal Dokter (GP)</a>
									</li>
									<li><a href="#">Jadwal Dokter (non GP)</a>
									</li>									 
									<li class="divider"></li>
									
									<li><a href="#">Specialis and Doctor </a>
									</li>
									<li class="divider"></li>
									<li><a href="#">Tarif</a>
									</li>
								</ul>
							</li>
						</ul>
						 
						<ul class="nav navbar-nav navbar-right">
							<li>
							<a href="#">Contact Me</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
			</div>
		</div>
	</div>
	<div class='container' style='margin-top:20px'>
	<div class="row">
        <div class="col-lg-4 col-md-8 col-xs-12" style='margin:auto'>
			<div class="docType">
				<label>Spesialis</label>
				<?php $js='class="form-control" id="docType"';
				echo form_dropdown('doc_types', $doctypes, 2, $js); ?>
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
				<?php echo $pasien; ?>
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