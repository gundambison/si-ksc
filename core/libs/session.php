<?php
if(session_id() === '') session_start();
class Libs_Session {
	
	public static function clear($key='') {
		if($key == ''){
			unset($_SESSION['fb_axisnet']);
		}
		else{
			unset($_SESSION['fb_axisnet'][$key]);
		}
	}

	public static function set($key, $value) {		
		$_SESSION['fb_axisnet'][$key] = serialize($value);
	}
	
	public static function get($key){
		return isset($_SESSION['fb_axisnet'][$key]) ? unserialize($_SESSION['fb_axisnet'][$key]) : false;
	}
}
