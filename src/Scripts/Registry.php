<?php

/*
	@Class: Registry
	@Description: является общим реестром для всех модулей
*/

namespace Sync\Bot\Scripts;

class Registry
{

	public $data;
	
	private static $_storage = array();


	public static function set($key, $value)
	{
		return self::$_storage[$key] = $value;
	}

	public static function get($key, $default=null)
	{
		return (isset(self::$_storage[$key])) ? self::$_storage[$key] : $default;
	}



	public static function remove($key)
	{
		unset(self::$_storage[$key]); 
		return true;
	}

	public static function clean()
	{
		self::$_storage = array(); 
		return true;
	}

}	



?>