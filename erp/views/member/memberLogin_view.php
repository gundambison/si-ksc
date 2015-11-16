<?php 
/****
	views	: member/memberLogin_view
	created	: 14-11-2015 00:38:03
	By		: Gunawan Wibisono
	Using 	: CI3 Main Model
****/
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">
	body { background: url(<?=base_url();?>assets/img/bg-login.jpg) !important; }
</style>
<div class="row-fluid">
				<div class="login-box">
					<div class="icons">
						<a href="index.html"><i class="halflings-icon home"></i></a>
						<a href="#"><i class="halflings-icon cog"></i></a>
					</div>
					<h2>Login to your account</h2>
					<form id="frmMain" class="form-horizontal" action="index.html" method="post">
						<fieldset>
							<input type='hidden' name='act' value='login' />
							<div class="input-prepend" title="Username">
								<span class="add-on"><i class="halflings-icon user"></i></span>
								<input class="input-large span10" name="username" id="username" type="text" placeholder="type username"/>
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend" title="Password">
								<span class="add-on"><i class="halflings-icon lock"></i></span>
								<input class="input-large span10" name="password" id="password" type="password" placeholder="type password"/>
							</div>
							<div class="clearfix"></div>
							
							<!--label class="remember" for="remember"><input type="checkbox" id="remember" />Remember me</label-->
<div>user : admin; password: password</div>
							<div class="button-login">	
								<button type="button" onclick='checklogin()' class="btn btn-primary">Login</button>
							</div>
							<div class="clearfix"></div>
						</fieldset>
					</form>
					<hr>
					<h3>Forgot Password?</h3>
					<p>
						No problem, <a href="#">click here</a> to get a new password.
					</p>	
				</div><!--/span-->
</div><!--/row-->
<script>
controller='member'; 
urlLogin="<?=base_url();?>"+controller+'/data/<?=$myUrl;?>';
</script>