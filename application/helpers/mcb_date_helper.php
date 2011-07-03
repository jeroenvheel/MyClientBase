<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function format_date($unix_timestamp_date = NULL) {

	if ($unix_timestamp_date) {

		global $CI;

		return date($CI->mdl_mcb_data->setting('default_date_format'), $unix_timestamp_date);

	}

	return '';

}

function standardize_date($date) {

	global $CI;

	if (strstr($date, '/')) {

		$delimiter = '/';

	}

	elseif (strstr($date, '-')) {

		$delimiter = '-';

	}

	elseif (strstr($date, '.')) {

		$delimiter = '.';

	}

	else {

		// do not standardize
		return $date;

	}

	$date_format = explode($delimiter, $CI->mdl_mcb_data->setting('default_date_format'));

	$date = explode($delimiter, $date);

	foreach ($date_format as $key=>$value) {

		$standard_date[strtolower($value)] = $date[$key];

	}

	return $standard_date['m'] . '/' . $standard_date['d'] . '/' . $standard_date['y'];

}

?>