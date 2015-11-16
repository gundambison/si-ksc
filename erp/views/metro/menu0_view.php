<?php 
/****
	views	: metro/menu_view
	created	: 12-11-2015 19:41:45
	By		: Gunawan Wibisono
	Using 	: CI3 Main Model
****/
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- start: Main Menu -->
			<div id="sidebar-left" class="span2">
				<div class="nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
<?php 
foreach($mainMenu as $menus){
	if(!isset($menus['subMenu'])){
		$active=!isset($menus['active'])?'':'class="active"';
?>
		<li <?=$active;?>><a 
		href="<?=base_url($menus['href']);?>"><i 
		class="<?=$menus['icon'];?>"></i><span class="hidden-tablet"> 
		<?=$menus['title'];?></span></a></li>
<?php
	}
	else{
?>
		<li>
			<a class="dropmenu" href="<?=base_url($menus['href']);?>"><i 
		class="<?=$menus['icon'];?>"></i><span class="hidden-tablet"> 
		<?=$menus['title'];?></span>&nbsp; <span class="label label-important">
		<?=count($menus['subMenu']);?> </span></a>
			<ul>
<?php 
		foreach($menus['subMenu'] as $menu){?>
			   <li><a class="submenu" href="<?=base_url($menu['href']);?>"><i 
		class="<?=$menu['icon'];?>"></i><span class="hidden-tablet"> 
		<?=$menu['title'];?></span></a></li>	
<?php 
		}
?>			
			</ul>
		</li>
<?php 							
	}
}
?>
							
						<li><a href="messages.html"><i class="icon-envelope"></i><span class="hidden-tablet"> Messages</span></a></li>
						<li><a href="tasks.html"><i class="icon-tasks"></i><span class="hidden-tablet"> Tasks</span></a></li>
						<li><a href="ui.html"><i class="icon-eye-open"></i><span class="hidden-tablet"> UI Features</span></a></li>
						<li><a href="widgets.html"><i class="icon-dashboard"></i><span class="hidden-tablet"> Widgets</span></a></li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Dropdown</span><span class="label label-important"> 3 </span></a>
							<ul>
								<li><a class="submenu" href="submenu.html"><i class="icon-file-alt"></i><span class="hidden-tablet"> Sub Menu 1</span></a></li>
								<li><a class="submenu" href="submenu2.html"><i class="icon-file-alt"></i><span class="hidden-tablet"> Sub Menu 2</span></a></li>
								<li><a class="submenu" href="submenu3.html"><i class="icon-file-alt"></i><span class="hidden-tablet"> Sub Menu 3</span></a></li>
							</ul>	
						</li>
						<li><a href="form.html"><i class="icon-edit"></i><span class="hidden-tablet"> Forms</span></a></li>
						<li><a href="chart.html"><i class="icon-list-alt"></i><span class="hidden-tablet"> Charts</span></a></li>
						<li><a href="typography.html"><i class="icon-font"></i><span class="hidden-tablet"> Typography</span></a></li>
						<li><a href="gallery.html"><i class="icon-picture"></i><span class="hidden-tablet"> Gallery</span></a></li>
						<li><a href="table.html"><i class="icon-align-justify"></i><span class="hidden-tablet"> Tables</span></a></li>
						<li><a href="calendar.html"><i class="icon-calendar"></i><span class="hidden-tablet"> Calendar</span></a></li>
						<li><a href="file-manager.html"><i class="icon-folder-open"></i><span class="hidden-tablet"> File Manager</span></a></li>
						<li><a href="icon.html"><i class="icon-star"></i><span class="hidden-tablet"> Icons</span></a></li>
						<li><a href="login.html"><i class="icon-lock"></i><span class="hidden-tablet"> Login Page</span></a></li>
					</ul>
				</div>
			</div>
			<!-- end: Main Menu -->
