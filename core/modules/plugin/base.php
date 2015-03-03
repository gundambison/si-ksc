<?php
class Modules_Plugin_Base extends Base_Module {
	
	protected $input;
	protected $response;
	protected $config;
	protected $controller;
	protected $lang;
	protected $email;
	
	protected $pluginPath = ''; // running plugin path
	protected $model;
	protected $project;
	protected $pluginName;
	
	// for activity logging perpose
	protected $clientcode 	= 0; 
	protected $appcode		= 0;
	protected $token		= false;
	protected $function 	= '';
	protected $logResult;
	protected $activityLog;
	
	public function __construct() {
		parent::__construct();
		$this->input 	= new Modules_IO_Parser;
		$this->response = new Modules_IO_Response;
		$this->config 	= Config_Loader::getInstance();
		$this->setController( get_class($this) );
		
		$this->activityLog = $this->_loadModel('activity');
//==============LOG RESULT
		$config = Config_Loader::getInstance();
		$driver = 'Libs_Logging_Driver_' . $config->get('logDriver');
		$this->logResult  = new $driver(array(
			'logLevel' 		=> $config->get('logLevel'),
			'logPath' 		=> $config->get('logPath'),
			'logPrefix'		=> 'result',
			'logTimeFormat' => $config->get('logTimeFormat'),
			'logLineFormat' => $config->get('logLineFormat')
		));
		
		$this->logResult->enable = $config->get('logActive');
		
		/*$this->email	= new Modules_IO_Email(
			$this->config->app('emailHost'), 
			$this->config->app('emailPort'), 
			$this->config->app('emailAuth'), 
			$this->config->app('emailUsername'), 
			$this->config->app('emailPassword')
		);*/
                
                //$this->email->setSender($this->config->app('emailGlobalSender'));
/*                
                $this->email	= new Modules_IO_Email('ssl://unicorn.vodien.com','465',true,'isa.anshori@linkit360.com','l1nk1t360');
                $this->email->setSender('isa.anshori@linkit360.com');
*/               	
		// load language
		$this->lang		= New Modules_Language_Parser;
		$this->_loadLanguage($this->lang->getLanguage()); // load plugin language
	}
	
	protected function _success($data='', $return=0) {
		$message = $this->lang->get('c200');
		$this->activity->log(
			$this->clientcode, 
			$this->appcode, 
			get_class($this), 
			$this->function, 
			count($_REQUEST)==0 ? '':json_encode($_REQUEST), 
			'200', 
			$message
		);
		
		$response = $this->response->success($data);
		// logging
		$this->logResult->write('success', 'CONTROLLER:'.(isset($this->getController)?$this->getController:'?'). '|FUNCTION:'.$this->function. '|CLASS:'.get_class($this). '|RESULT: '.$response);
		//$this->logger->write('debug', 'RESPONSE: '.$response);
		$this->activityLog->write($response,$this);
		if( $return === 0 ){
			echo $response; exit;
		}
		else{
			return $response;
		}
	}
	
	protected function _failed($code, $return=0) {
		$message = $this->lang->get('c'.$code);	
		$this->activity->log(
			$this->clientcode,
			$this->appcode,
			get_class($this),
			$this->function,
			count($_REQUEST)==0 ? '':json_encode($_REQUEST),
			$code,
			$message
		);
		
		$response = $this->response->failed($code, $message);
		// logging
		$this->logger->write('debug', 'RESPONSE: '.$response);
		$this->logResult->write('failed', 'CONTROLLER:'.(isset($this->getController)?$this->getController:'?'). '|FUNCTION:'.$this->function. '|CLASS:'.get_class($this). '|REQUEST:'.print_r($_REQUEST,1). '|RESPONSE: '.$response);
		$this->activityLog->write($response,$this);
		if( $return === 0 ){
			echo $response; exit;
		}
		else{
			return $response;
		}
	}
	
	public function setController($controller) {
		$this->controller = $controller;
	}
	
	public function getController() {
		return $this->controller;
	}
	
	protected function _mandatory($vars, $method='request'){
		if( is_array($vars) ) {
			foreach($vars as $var){
				$this->_mandatory($var, $method);
			}
		}
		else{
			if($method == 'request') {
				if( !isset($_REQUEST[$vars]) || $_REQUEST[$vars]=='' ){
					$this->_failed(203);
				}
			}
			if($method == 'post') {
				if( !isset($_POST[$vars]) || $_POST[$vars]=='' ){
					$this->_failed(203);
				}
			}
			if($method == 'get') {
				if( !isset($_GET[$vars]) || $_GET[$vars]=='' ){
					$this->_failed(203);
				}
			}
		}
	}
	
	private function _parseLocation(){
		if( $this->pluginPath == '' ){
			$controller = $this->getController();
			$o = explode('_', $controller);
			$this->project 		= strtolower($o[1]);
			$this->pluginName	= strtolower($o[2]);
			return APP_PATH . 'plugins/' . $this->project . '/' . $this->pluginName . '/' ;
		}
		else{
			return $this->pluginPath;
		}
	}
	
	private function _getModelLocation(){
		return $this->_parseLocation() . 'models/';
	}
	
	private function _getConfigLocation(){
		return $this->_parseLocation() . 'config/';
	}
	
	private function _getLanguageLocation(){
		//return $this->_parseLocation() . 'language/';
                
                return APP_PATH . 'language/';
                
                
	}
	
	protected function _loadModel($model) {
		$model = strtolower($model);
		$file = $this->_getModelLocation() . $model . '.php';
		if( file_exists($file) ){
			if( isset($this->model[$model]) ){
				return $this->model[$model];
			}
			else{
				require_once $file;
				$classname = 'Models_'.$this->project.'_'.$this->pluginName.'_'.$model;
				return $this->model[$model] = new $classname;
			}
		}
		else{
			$this->activity->write('model not found');
			die('model not found');
		}
	}
	
	protected function _loadLanguage($lang) {
		$lang = strtolower($lang);
		$file = $this->_getLanguageLocation() . $lang . '.php';
                
		if( file_exists($file) ){
			require_once $file;
			//$classname = 'Language_'.$this->project.'_'.$this->pluginName.'_'.$lang;
                        
                        $classname = 'Language_'.$lang;
                        
			$this->lang->loadExternal(new $classname);
		}
		else{
			die('language not found');
		}
	}
	
	protected function _setLanguage($lang){
		$this->lang->setLanguage($lang);
		$this->_loadLanguage($lang);
	}
	
	protected function _isTokenValid($clientcode, $token, $username='') {
		$model 	= $this->_loadModel('session');
		return $model->isValidToken($clientcode, $token, $username);
	}
	
	public function exec($function){
		$this->function = $function;
		$this->$function();
	}
}
