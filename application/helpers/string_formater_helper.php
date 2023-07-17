<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('format_matricule'))
{
	function format_matricule($matricule)
	{
		$length = 4;
		$matricule_string = (string) ($matricule + 1);
		while(strlen($matricule_string) < $length){
			$matricule_string = "0" . $matricule_string;
		}
		return $matricule_string;
	}
}
