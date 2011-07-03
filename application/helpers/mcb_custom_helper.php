<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function invoice_custom_field($invoice, $index) {

	$col = 'invoice_custom_' . $index;

	return (isset($invoice->$col) ? $invoice->$col : '');

}

function client_custom_field($invoice, $index) {

	$col = 'client_custom_' . $index;

	return (isset($invoice->$col) ? $invoice->$col : '');

}

function payment_custom_field($payment, $index) {

	$col = 'payment_custom_' . $index;

	return (isset($payment->$col) ? $payment->$col : '');

}

function invoice_item_custom_field($invoice_item, $index) {

	$col = 'invoice_item_custom_' . $index;

	return (isset($invoice_item->$col) ? $invoice_item->$col : '');

}

function user_custom_field($invoice, $index) {

	$col = 'user_custom_' . $index;

	return (isset($invoice->$col) ? $invoice->$col : '');

}

?>