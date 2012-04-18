<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function display_currency($amount, $standardize_number = TRUE) {

	global $CI;

	$amount = format_number($amount, $standardize_number);

	if ($CI->mdl_mcb_data->setting('currency_symbol_placement') == 'before') {

		$amount = $CI->mdl_mcb_data->setting('currency_symbol') . $amount;

	}

	else {
		
		$amount = $amount . $CI->mdl_mcb_data->setting('currency_symbol');

	}

	return $amount;

}

function currency_symbol() {

	global $CI;

	return $CI->mdl_mcb_data->setting('currency_symbol');

}

?>