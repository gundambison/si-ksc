<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- start: Header -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="index.html"><span>Metro</span></a>
								
				<!-- start: Header Menu -->
				<div class="nav-no-collapse header-nav">
					<ul class="nav pull-right">
<?php  
/* DITUTUP DAHULU?>
						<!-- start: Notifications Dropdown -->
<?php $this->load->view('metro/headerNotif_view');?>
<?php $this->load->view('metro/headerTask_view');?>
						<!-- end: Notifications Dropdown -->
<?php $this->load->view('metro/headerMessage_view');?>	

<? */ ?>						
						<li>
							<a class="btn" href="#">
								<i class="halflings-icon white wrench"></i>
							</a>
						</li>
<?php $this->load->view('metro/headerMember_view');?>						
					</ul>
				</div>
				<!-- end: Header Menu -->
				
			</div>
		</div>
	</div>
<!-- start: Header -->
