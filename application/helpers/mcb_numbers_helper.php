<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function check_clean_number($num) {

	return preg_match("/^([\.,0-9])+$/i", $num);

}

function clean_number($num) {

	$num = preg_replace('#[^,\.0-9]#','', $num);

	return ($num) ? $num : 0;

}

function format_number($num = NULL, $standardize = TRUE, $decimals = 2) {

	global $CI;

	if (!$num) {

		$num = 0;

	}

	if ($standardize) {

		return number_format(standardize_number($num), $decimals, $CI->mdl_mcb_data->setting('decimal_symbol'), $CI->mdl_mcb_data->setting('thousands_separator'));
		
	}

	else {

		return number_format($num, $decimals, $CI->mdl_mcb_data->setting('decimal_symbol'), $CI->mdl_mcb_data->setting('thousands_separator'));

	}

}

function standardize_number($num) {

	global $CI;

	if (!$_POST or $CI->uri->segment(1) == 'mailer') {

		return $num;

	}

	$num_array = explode($CI->mdl_mcb_data->setting('decimal_symbol'), $num);

	$num = str_replace($CI->mdl_mcb_data->setting('thousands_separator'), '', $num_array[0]);

	if (isset($num_array[1])) {

		$num .= '.' . $num_array[1];

	}

	return $num;

}

?>