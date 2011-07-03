<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function uri_assoc($var, $segment = 3) {

	$CI =& get_instance();

	$uri_assoc = $CI->uri->uri_to_assoc($segment);

	if (isset($uri_assoc[$var])) {

		return $uri_assoc[$var];

	}

	else {

		return NULL;

	}

}

?>