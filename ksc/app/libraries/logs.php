<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class logs {
	 protected $path;
	 protected $date_format;
	 protected $time;
	 protected $logLineFormat = '{datetime} {exectime}  {level}  {message}';
	
	public function __construct()
	{
		$config =& get_config();
		$this->date_format = 'Y-m-d H:i:s';
		$this->path = $config['log_path']!=''?$config['log_path']:APPPATH.'logs';
		$this->time =  microtime();
		$this->filename=date("Ymd");
	}

	private function getRunTime(){
		return   ( microtime() - $this->time ) ;
	}
	
	 function path($path){
		$this->path = $path;
	}
	
	 function filename($filename){
		$this->filename = $filename.date("Ymd");
	}
	
	
	 function write($level, $message){
		// die( $this->path."/".$this->filename);
		$level=strtoupper($level);
		if(is_array($message)){
			$str='';
			foreach($message as $nm=>$val){
				$str.="$nm:";
				$str.=is_array($val)?json_encode($val):$val."| ";
			}
			$message=$str;
		}
		if($level != 'SUMMARY'){
			$message = preg_replace(array('(\s+)','(\t+)'), ' ', $message);
		}
		
		$changeTo= array( date($this->date_format),  $this->getRunTime() ,   $level,   $message . "\n");
		
		$content = str_replace(
			array('{datetime}', '{exectime}',   '{level}', '{message}'),
			$changeTo,
			$this->logLineFormat			
		);
		
		error_log($content,3,$this->path."/".$this->filename);
		
		
	}
}