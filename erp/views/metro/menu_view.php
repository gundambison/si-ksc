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
ksort($mainMenu);
$userDetail=$this->user->getData($user['id']);
//echo '<!--'.print_r($mainMenu,1).'-->';
foreach($mainMenu as $menuId=>$menus){
	if($this->user->getPermision($user['id'],$menus['show'])){
		if(!isset($menus['subMenu'])){
			$active=!isset($menus['active'])?'':'class="active"';
	?>
			<li <?=$active;?> id="menu_<?=$menuId;?>" 
			
			><a 
			href="<?=base_url($menus['href']);?>"><i 
			class="<?=$menus['icon'];?>"></i><span class="hidden-tablet"> 
			<?=$menus['title'];?></span></a></li>
	<?php
		}
		else{
	?>
			<li id="menu_<?=$menuId;?>" 
			show="<?=$menus['show'];?>"
			userid="<?=$user['id'];?>">
				<a class="dropmenu" href="<?=base_url($menus['href']);?>"><i 
			class="<?=$menus['icon'];?>"></i><span class="hidden-tablet"> 
			<?=$menus['title'];?></span>&nbsp; <span class="label label-important">
			<?=count($menus['subMenu']);?> </span></a>
				<ul>
	<?php 
			ksort($menus['subMenu']);
			foreach($menus['subMenu'] as $menu){
				if($this->user->getPermision($user['id'],$menu['show'])){?>
				   <li><a class="submenu" href="<?=base_url($menu['href']);?>"><i 
			class="<?=$menu['icon'];?>"  ></i><span class="hidden-tablet"> 
			<?=$menu['title'];?></span></a></li>	
	<?php 
				}else{}
				
			} 
	?>			
				</ul>
			</li>
	<?php 							
		}
	}else{}
}
?>
 
				</div>
			</div>
			<!-- end: Main Menu -->
