<?php
class Config_Basic {
	
	// config driver
	public $configDriver 	= 'basic';
	public $domain			= 'http://{domain}/core/';

	public $secretKey	 	= 'c6e8375d168d14e0';
	public $shareKey	 	= '952a2cd77d69c755';
	
	
	// database connection
	public $dsn = array(
		'default' => array(
			'hostname'	=> 'localhost',
			'username'	=> 'root',
			'password'	=> '',
			'database'	=> 'work_sejahtera',
			'port'		=> 3306
		),
		'activity' => array(
			'hostname'	=> 'localhost',
			'username'	=> 'root',
			'password'	=> '',
			'database'	=> 'work_kscactivity',
			'port'		=> 3306
		),
		'wurfl' => array(
			'hostname'	=> '10.1.1.156',
			'username'	=> 'pasusr',
			'password'	=> 'paskr34t!f',
			'database'	=> 'pas_tw',
			'port'		=> 3306
		)
	);
	
	// logging driver
	public $logDriver 		= 'basic';
	public $logActive		= true;
	public $logWhitelist	= false;
	public $logLevel		= 'debug';
	public $logPrefix 		= 'core'; // default log prefix filename
	public $logPath			= 'D:/logs/core/' ;
	public $logTimeFormat	= 'Y-m-d H:i:s';
	public $logLineFormat	= '{datetime} {exectime} {threadId} {level} {message}';
	
	
	// logging activity driver
	public $logActivityDriver 		= 'basic';
	public $logActivityActive		= true;
	public $logActivityWhitelist	= false;
	public $logActivityPrefix 		= 'activity'; // default log prefix filename
	public $logActivityPath			= 'D:\\logs\\core\\';
	public $logActivityTimeFormat	= 'Y-m-d H:i:s';
	public $logActivityLineFormat	= '{datetime}|{message}';
}
