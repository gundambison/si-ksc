<?php
class Base_Controller extends Base_Master {

	public $input;
	public $view;
	public $lang = 'en';
	public $dicti;

	public $sso;
	public $msisdn;

	public function __construct($option='') {
		parent::__construct();

		// initialize base input class
		$this->input = new Base_Input;
		$axisnet = Libs_Registry::get('axisnet');

		if( isset($option['api']) && $option['api']==true ){
			/**
			 * important!
			 * accomodate json input
			 * then convert to http post
			 */
			if(isset($_POST['jsondata']) && $_POST['jsondata']!=''){
				$arrData = json_decode($_POST['jsondata'], 1);
				$_POST 	 = array_merge($_POST,$arrData);
				$_REQUEST= array_merge($_REQUEST,$arrData);
				unset($_POST['jsondata']); unset($_REQUEST['jsondata']);
			}

			/**
			 * important!
			 * modified postdata
			 */
			if(isset($_REQUEST['msg']) && $_REQUEST['msg']!=''){
				// secret key
				$secretKey	= $_REQUEST['secret_key'];

				// get application sharekey
				$channel 		= new Models_Channel;
				$channelDetail	= $channel->getDetailFromSecretKey($secretKey);

				if($channelDetail === false) {
					$this->apiResponseFailed('202');
				}

				if( $channelDetail['status'] == 0 ) {
					$this->apiResponseFailed('210');
				}

				// store application data to registry
				// share information to whole system in runtime
				Libs_Registry::set('channel', $channelDetail);

				$decrypted  	= $this->input->decrypt($channelDetail['share_key'], $_REQUEST['msg']);
				$decoded    	= json_decode($decrypted,1);
				$this->logger->write('debug', 'DECODED PARAM: ' . print_r($decoded,1));

				if( is_array($decoded) ) {
					$_POST 		= array_merge($_POST, $decoded);
					$_REQUEST 	= array_merge($_REQUEST, $decoded);
				}

				unset($_POST['msg']); unset($_REQUEST['msg']);
			}
		}

		// wurfl
		$capabilities = $axisnet->getDeviceCapability($_SERVER['HTTP_USER_AGENT']);
		Libs_Registry::set('wurfl', $capabilities);

		// initialize base view class
		$this->view  = new Base_View('smarty', array(
			'forceCompile'	=> $this->config->app('smartyForceCompile'),
			'debug'			=> $this->config->app('smartyDebug'),
			'cache'			=> $this->config->app('smartyCache'),
			'lifetime'		=> $this->config->app('smartyCacheLifetime')
		));

		// get template type
		if( $capabilities['xhtml_support_level'] == 4 && $capabilities['resolution_width'] > 480 ) {
			$template = 'html5';
		}
		else if ( $capabilities['xhtml_support_level'] == 3 ) {
			//$template = 'mobileweb';
			$template = 'html5'; //-----> sementara :)
		}
		else {
			//$template = 'wap';
			$template = 'html5'; //-----> sementara :)
		}

		$this->view->setTheme( $this->config->app('theme') . '/' . $template );


		//
		// set response language
		//
		$_SESSION['fb_language'] = $axisnet->getLanguage();
		if( isset($_REQUEST['lang']) ) {
			$oldLanguage = $_SESSION['fb_language'];
			$this->_setLanguage( $_REQUEST['lang'] );

			// change language api
			if( $axisnet->getToken() !== false ) $axisnet->changeLanguage($this->lang, $oldLanguage);
			$axisnet->menuReset();
			$this->clearSpecialSession(); /*14Dec2012*/
		}
		else{
			if( isset($_SESSION['fb_language']) && $_SESSION['fb_language']!='' ) {
				$language = $_SESSION['fb_language'];
			}
			else {
				$language = $this->config->app('language');
			}
			$this->_setLanguage( $language );
		}
		// set default vars
		$this->view->assign('domain', 		 $this->config->get('domain'));
		$this->view->assign('theme', 		 $this->config->app('theme'));
		$this->view->assign('template', 	 $template);
		$this->view->assign('language', 	 $this->lang);
		$this->view->assign('label_language',$this->dicti['label_language']);
		$this->view->assign('label_welcome', $this->dicti['label_welcome']);
		$this->view->assign('label_logout',	 $this->dicti['label_logout']);

		$fb_user_id = Libs_Registry::get('fb_user_id');
		$this->view->assign('fb_user_id', he($fb_user_id));

		// build url change language
		$_SERVER['REQUEST_URI'] = str_replace(array('&lang=id','&lang=en'),'',$_SERVER['REQUEST_URI']);
		if(	strpos($_SERVER['REQUEST_URI'],'?')!==false ){
			$urlLang = $_SERVER['REQUEST_URI'] . '&lang=';
		}
		else{
			$urlLang = $_SERVER['REQUEST_URI'] . '?lang=';
		}
		$this->view->assign('url4lang',	 $urlLang);
	}

	protected function _setLanguage($language){
		Libs_Session::set('AXIS-LANG', $language);/*14Dec2012*/
		$_SESSION['fb_language'] = $this->lang = $language;

		$file = dirname(__FILE__) . '/../language/' . $this->lang . '.php';

		if( !file_exists($file) ) {
			die( $this->_response(209,'internal error') );
		}

		require_once $file;

		$this->dicti = $lang;
		$this->logger->write('debug','Set language: ' . $language);
	}

	public function respCode($code, $data='') {
		$this->_response($code, isset($this->dicti[$code])?$this->dicti[$code]:$this->dicti[0], $data);
		exit;
	}

	private function _response($code, $message, $data='') {
		$this->view->assign('code', "$code");
		$this->view->assign('message', $message);
		if($data != '') $this->view->assign('data', $data);
		$this->view->display();
	}

	protected function checkMandatory($vars, $return=false) {
		if(is_array($vars)){
			foreach($vars as $var){
				$result = $this->checkMandatory($var, $return);
				if($result === false && $return == true){
					return false;
				}
			}
		}
		else{
			if( !isset($_REQUEST[$vars]) ){
				$this->logger->write('debug', 'Missing required parameter: ' . $vars);
				if($return == false) {
					$this->respCode('201');
					exit;
				}
				else{
					return false;
				}
			}
			else{
				if($_REQUEST[$vars] == ''){
					$this->logger->write('debug', 'Required parameter is empty: ' . $vars);
					if($return == false) {
						$this->respCode('201');
						exit;
					}
					else{
						return false;
					}
				}
			}
		}

		if($return == true) return true;
	}

	protected function auth() {
		$axisnet = Libs_Registry::get('axisnet');
		if( !$axisnet || !$axisnet->isAuth() ){
			header('location: '.$this->config->get('domain').'login/'); exit;
		}
		
		$token = Libs_Session::get('sso_token');
		if( $token === false ) Libs_Session::set('sso_token', $axisnet->getToken());

		$msisdn = Libs_Session::get('msisdn');
		if($msisdn === false){
			$msisdn = $axisnet->getMsisdn();
			if($msisdn !== false){
				Libs_Session::set('msisdn', array(
					'enc' => isset($msisdn['enc']) ? $msisdn['enc'] : '',
					'dec' => isset($msisdn['dec']) ? $msisdn['dec'] : ''
				));
			}
		}

		if($msisdn !== false) {
			$this->msisdn = $msisdn;
		}
		
		$subscriber_lang = $axisnet->getLanguage();
		
		if($subscriber_lang != $_SESSION['fb_language']){
			$_SESSION['fb_language'] = $subscriber_lang;
			if( isset($_SESSION['fb_language']) && $_SESSION['fb_language']!='' ) {
				$language = $_SESSION['fb_language'];
			}
			else {
				$language = $this->config->app('language');
			}
			$this->_setLanguage( $language );
			
			$this->view->assign('language', $this->lang);
		}
		
		//is onnet properties
		if( $axisnet->isOnnet() === true ) {
			$this->view->assign('isOnnet', '1');
		}
		else{
			$this->view->assign('isOnnet', '0');
		}
	}

	protected function assignLanguage($language){
		if( is_array($language) ){
			foreach($language as $row){
				$this->view->assign($row, $this->dicti[$row]);
			}
		}
		else{
			$this->view->assign($language, $this->dicti[$language]);
		}
	}

	protected function redirect($url){
		header('location:' . $url); exit;
	}

	private function clearSpecialSession() { //after change language /*14Dec2012*/
		Libs_Session::set('survey_data',false);
        Libs_Session::set('data_survey_package',false);
    }
}

