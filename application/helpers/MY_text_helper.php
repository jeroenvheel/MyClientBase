<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function character_limiter($str, $n = 500, $end_char = '&#8230;') {

	if (strlen($str) <= $n) {

		return $str;

	}

	return substr($str, 0, $n) . '...';

}

?>