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

function date_formats($format = NULL, $element = NULL) {

	$date_formats = array(
		'm/d/Y' => array(
			'key' => 'm/d/Y',
			'picker' => 'mm/dd/yy',
			'mask' => '99/99/9999',
			'dropdown' => 'mm/dd/yyyy'),
		'm/d/y' => array(
			'key' => 'm/d/y',
			'picker' => 'mm/dd/y',
			'mask' => '99/99/99',
			'dropdown' => 'mm/dd/yy'),
		'Y/m/d' => array(
			'key' => 'Y/m/d',
			'picker' => 'yy/mm/dd',
			'mask' => '9999/99/99',
			'dropdown' => 'yyyy/mm/dd'),
		'd/m/Y' => array(
			'key' => 'd/m/Y',
			'picker' => 'dd/mm/yy',
			'mask' => '99/99/9999',
			'dropdown' => 'dd/mm/yyyy'),
		'd/m/y' => array(
			'key' => 'd/m/y',
			'picker' => 'dd/mm/y',
			'mask' => '99/99/99',
			'dropdown' => 'dd/mm/yy'),
		'm-d-Y' => array(
			'key' => 'm-d-Y',
			'picker' => 'mm-dd-yy',
			'mask' => '99-99-9999',
			'dropdown' => 'mm-dd-yyyy'),
		'm-d-y' => array(
			'key' => 'm-d-y',
			'picker' => 'mm-dd-y',
			'mask' => '99-99-99',
			'dropdown' => 'mm-dd-yy'),
		'Y-m-d' => array(
			'key' => 'Y-m-d',
			'picker' => 'yy-mm-dd',
			'mask' => '9999-99-99',
			'dropdown' => 'yyyy-mm-dd'),
		'y-m-d' => array(
			'key' => 'y-m-d',
			'picker' => 'y-mm-dd',
			'mask' => '99-99-99',
			'dropdown' => 'yy-mm-dd'),
		'd.m.Y' => array(
			'key' => 'd.m.Y',
			'picker' => 'dd.mm.yy',
			'mask' => '99.99.9999',
			'dropdown' => 'dd.mm.yyyy'),
		'd.m.y' => array(
			'key' => 'd.m.y',
			'picker' => 'dd.mm.y',
			'mask' => '99.99.99',
			'dropdown' => 'dd.mm.yy')
	);
	
	if ($format and $element) {
		
		return $date_formats[$format][$element];
		
	}
	
	elseif ($format) {
		
		return $date_formats[$format];
		
	}
	
	else {
		
		return $date_formats;
		
	}

}

?>