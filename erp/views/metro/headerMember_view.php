<?php defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- start: User Dropdown -->
						<li class="dropdown">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="halflings-icon white user"></i> 
								<?=$user['username'];?>
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li class="dropdown-menu-title">
 									<span>Account Settings</span>
								</li>
								<li>
								<a href="<?=base_url();?>member/settings"><i class="halflings-icon user"></i> Profile</a></li>
								<li><a href="<?=base_url('member/logout');?>"><i class="halflings-icon off"></i> Logout</a></li>
							</ul>
						</li>
<!-- end: User Dropdown -->