<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');/* Created : Gunawan Wibisono*/class Core_model extends CI_Model {	private $target='http://localhost/core/clinic/';	private $API=array(); //list isinya dapat dilihat dibawah	private $app_code 	 = '132132133';	private $client_code = '132132132';	private $maxTime=20; 	public function tes($stat=1)	{		$service=$this->API['tes'];		$var=array('tes'=>'123');		if($stat==0){			$service='ksc/user/generate';		}		return $this->_request($service, $var);	}		public function _soap($url='',$service='',$param=array())	{				log_message('info','func: _soap' );		$result= $this->_runApi($url, $service, $param);		return $result;	}		public function _callApi($key, $param=array()){		$param['app_code']=$this->app_code;		$param['client_code']=$this->client_code;		$url=$this->target;		$service=$this->API[$key];		$result= $this->_runApi($url,$service,$param);		log_message('info', 'func: _callApi| result:'.json_encode($result,1)); 		$result=(array)$result;		if(isset($result['code'])&&$result['code'] == 200){			return $result['data'];		}		else{			if($result=='plugin not found'){				$servicePlugin=str_replace("/",".",strtoupper($service));								$sql="INSERT INTO  `tbl_core_plugin` ( `plugin_id` ,`plugin_group` ,`plugin_name` ,`plugin_desc` ,`plugin_status` ,`created` ,`modified`) VALUES (  '0', 'KSC', 'CLINIC.{$servicePlugin}', 'ksc/{$service}', '1', NOW( ) , NOW( ) );";				log_message('info', 'tambah plugin| '. str_replace("\n"," ", $sql ));			}			if(!is_array($result)){				$result=array( $result);			}			$result['error']=true;			return $result;		}		}		private function _runApi($url,$service,$parameter){		log_message('debug', "func:_runApi| url:{$url}| service:$service| {$url}{$service}| param:".http_build_query($parameter,'','&'));		$curl = curl_init();		 		curl_setopt($curl, CURLOPT_URL, $url . $service);		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);		if($parameter != '') {			curl_setopt($curl, CURLOPT_POST, true);			curl_setopt($curl, CURLOPT_TIMEOUT, $this->maxTime);			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($parameter,'','&'));			if( isset($_SERVER['HTTP_USER_AGENT']) ) curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);		}				$response = curl_exec($curl);		if (0 != curl_errno($curl)) {			$response = new stdclass();			$response->code = '500';			$response->message = curl_error($curl);					}		else{			$response0 = $response; 			$response = json_decode($response,1);			if(!is_array($response)){				$response=$response0;			}		}				curl_close($curl);		if(!isset($response0)) $response0='?';		log_message('info', "response :".(is_array($response)?json_encode($response,1):$response0 ) );		return $response;				}			public function _request($service='',$param=array())	{		$param['app_code']=$this->app_code;		$param['client_code']=$this->client_code;		$url=$this->target;				$result= $this->_runApi($url,$service,$param);		 		if($result['code']==200){			return $result['data'];		}		else{			return $result;		}	}		public function __construct(){		$config = new CI_Config();		$this->app_code= $config->item('app_code');		$this->client_code= $config->item('client_code');		$this->target= $config->item('target_core');		$api=array(		  'tes'=>'ksc/pasien/generate',		  'doctype'=>		'ksc/doctortypes/index',		  'doctypePasien'=>	'ksc/doctortypes/pasienlist',		  'pasienDetail'=>	'ksc/pasien/detail',		  'pasienSaveMedrec'=>'ksc/pasien/savemedrec',		  'logDaftar'=>		'ksc/daftar/logs',				);		$this->API=$api;	}		}