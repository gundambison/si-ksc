<?php
class Modules_Init extends Base_Module {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function run() {
		$input 	= new Modules_IO_Parser;
		$queryString = $input->get('uri');
		if( $queryString != false ) {
			$tmp = explode('/', $queryString);
		}
		else{
			$tmp = explode('/', $this->config->app('defaultController'));
		}
		
		$input->decryptRequest();
		
		$project	= isset($tmp[0]) ? $tmp[0] : die('invalid request');
		$plugin		= isset($tmp[1]) ? $tmp[1] : die('invalid request');
		$controller	= isset($tmp[2]) ? $tmp[2] : die('invalid request');
		$function	= isset($tmp[3]) ? $tmp[3] : 'index';
		$pluginNamespace = $project.'.'.$plugin.'.'.$controller.'.'.$function;
		
		// check if plugin exists
		$pluginInit = new Modules_Plugin_Init;
		$result = $pluginInit->isExists($pluginNamespace);
		
		if($result == false) die('plugin not found');
		
		$pluginInit->run($pluginNamespace);
	}
}
