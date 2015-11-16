<ul id="menu-top" class="nav navbar-nav navbar-right">
<?php 
$str='';
foreach($mainMenu as $menu){
	$menuActive = isset($menu['active'])?'menu-top-active':'';
		
	$link=$menu['href']!=='#'?base_url().$menu['href']:current_url();
	if(isset($menu['subMenu'])){
		$str.="\n<li class='dropdown'>";
		$str.="<a class='{$menuActive} dropdown-toggle' data-toggle='dropdown' href='".$link."'>";
		$str.=$menu['title'];
        $str.=" <span class='caret'></span></a>";
	}
	else{ 
		$str.="\n<li class='dropdown'>";
		$str.="<a class='{$menuActive}' href='".$link."' >";
		$str.=$menu['title'] ." </a>";
	}
 
	if(isset($menu['subMenu'])){
		$str.="\n\t<ul class='dropdown-menu'>";
		foreach($menu['subMenu'] as $submenu){
		  $link=$submenu['href']!=='#'?base_url().$submenu['href']:current_url();
		  $str.="\n\t\t<li><a href='".$link."'>";
		  $str.=$submenu['title'];
		  $str.='</a></li>';
		}
		
		$str.="\n\t</ul>";
	}
	$str.="</li>";
}

echo $str;$str='';	
?> 
</ul>