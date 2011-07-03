<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function invoice_paid($invoice) {

	/* Amount currently paid toward invoice, formatted as currency */
	return '(' . display_currency($invoice->invoice_paid) . ')';

}

function invoice_payment($payment) {

	/* Amount of individual payment, formatted as currency */
	return display_currency($payment->payment_amount);

}

function invoice_payment_date($payment) {

	global $CI;

	/* Date of payment */
	return date($CI->mdl_mcb_data->setting('default_date_format'), $payment->payment_date);

}

function invoice_payment_note($payment) {

	return $payment->payment_note;

}

function invoice_payment_method($payment) {

	return $payment->payment_method;

}

?>