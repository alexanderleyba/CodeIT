<?php

/**

 */
class Config
{
	// this function grants easy access into config array example Config::get('mysql/host');
	public static function get($path = null) {
		if($path){
			// getting config array from superglobal
			$config_array = $GLOBALS['config'];
			// explode provided path to requested value to obtain an array
			$path  = explode('/', $path);
			// looping through an array
			foreach ($path as $part) {
				// if in config array isset part of the path we setting config to that part.
				if(isset($config_array[$part])){
					$config_array=$config_array[$part];
				}
			}

			return $config_array;
		}
		return false;
	}
}