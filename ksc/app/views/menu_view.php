<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
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