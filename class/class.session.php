<?php

class Session {

	public function __construct()
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
	}

	public function _set($name, $value)
	{
		if ( ! isset($_SESSION[$name])) {
			$_SESSION[$name] = $value;
			return true;
		} else {
			$_SESSION[$name] = $value;
			return false;
		}
	}

	public function _get($name)
	{
		if (isset($_SESSION[$name])) {
			$value = $_SESSION[$name];
			return $value;
		} else
		return false;
	}

	public function _unset($name)
	{
		if (isset($_SESSION[$name]))
			unset($_SESSION[$name]);
		else
			return false;	
	}
}