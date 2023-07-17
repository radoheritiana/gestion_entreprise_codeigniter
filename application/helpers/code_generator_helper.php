<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('generate_code'))
{
	function generate_code($length)
	{
		$bytes = random_bytes(($length + 1) / 2);
		$code = bin2hex($bytes);
		return substr($code, 0, $length);
	}
}
