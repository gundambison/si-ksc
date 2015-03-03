<?php
class Config_Application {

	public $defaultController 	= 'home';
	public $contentImagesUrl	= 'http://localhost/PhpProject_Pas_Prod/admin/assets/images/uploads/';
	public $localImagesUrl		= 'C:/xampp/htdocs/PhpProject_Pas_Prod/admin/assets/images/uploads/';
	
	public $smartyDebug			= false;
	public $smartyForceCompile	= true;
	public $smartyCache			= false;
	public $smartyCacheLifetime	= 300; //in second
	
	public $saltCookies			= 'iTjuStRanDomWoRd';
	
	// email
	public $emailHost			= 'ssl://unicorn.vodien.com';
	public $emailPort			= '465';
	public $emailAuth			= true;
	public $emailUsername		= 'isa.anshori@linkit360.com';
	public $emailPassword		= 'l1nk1t360';
	public $emailGlobalSender	= 'isa.anshori@linkit360.com';
}
