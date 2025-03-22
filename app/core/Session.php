<?php 
ob_start();
class Session
{

	public $secret_key;
	
	public static function init()
	{
		session_start();
	}
	public static function set($key ,$value)
	{
		$_SESSION[$key] = $value;
	}

	public static function get($key=null)
	{
		return $_SESSION[$key];
	}

	public static function destroy()
	{
		session_destroy();
	}

	public function login($admin) 
	{
		session_regenerate_id();


	}

	public function logout()
	{

		session_destroy();
	}

}