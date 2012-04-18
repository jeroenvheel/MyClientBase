<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * BEGIN COMPANY (FROM) SPECIFIC HELPERS
 */

function invoice_from_address($invoice) {

	/* Address invoice is from */
	return $invoice->from_address;

}

function invoice_from_address_2($invoice) {

	/* Address 2 invoice is from */
	return $invoice->from_address_2;

}

function invoice_from_city($invoice) {

	/* City invoice is from */
	return $invoice->from_city;

}

function invoice_from_city_state_zip($invoice) {

	/* City, state, zip invoice is from */
	return $invoice->from_city . ', ' . $invoice->from_state . ' ' . $invoice->from_zip;

}

function invoice_from_company_name($invoice) {

	/* Company name invoice is from */
	return $invoice->from_company_name;

}

function invoice_from_country($invoice) {

	/* Country invoice is from */
	return $invoice->from_country;

}

function invoice_from_email($invoice) {

	/* Email address invoice is from */
	return $invoice->from_email_address;

}

function invoice_from_fax_number($invoice) {

	return $invoice->from_fax_number;

}

function invoice_from_name($invoice) {

	/* First + Last name invoice is from */
	return $invoice->from_first_name . ' ' . $invoice->from_last_name;

}

function invoice_from_phone_number($invoice) {

	/* Phone number invvoice is from */
	return $invoice->from_phone_number;

}

function invoice_from_state($invoice) {

	/* State invoice is from */
	return $invoice->from_state;

}

function invoice_from_web_address($invoice) {

	/* URL invoice is from */
	return $invoice->from_web_address;

}

function invoice_from_zip($invoice) {

	/* Zip code invoice is from */
	return $invoice->from_zip;

}

function invoice_from_zip_city($invoice) {

	/* Zip + City invoice is from */
	return $invoice->from_zip . ' ' . $invoice->from_city;

}

function invoice_payment_link($invoice) {

	global $CI;

	if ($CI->mdl_mcb_data->setting('merchant_enabled')) {

		$link = $CI->lib_output->payment_link($invoice);

		/** Unless I'm just stupid (highly likely), the PDF seems to want the
		 * entire GET string urlencoded...
		 */
		if ($CI->uri->segment(2) == 'generate_pdf') {

			$replace = substr($link, strpos($link, '?') + 1);
			$replace = substr($replace, 0, strpos($replace, '">') - 2);

			$link = str_replace($replace, urlencode($replace), $link);

		}

		return $link;

	}

	return '';

}

function invoice_tax_id($invoice) {

	global $CI;

	return ($invoice->from_tax_id_number) ? $invoice->from_tax_id_number : NULL;

}

/**
 * BEGIN CLIENT (TO) SPECIFIC HELPERS
 */

function invoice_to_address($invoice) {

	/* Client address */
	return $invoice->client_address;

}

function invoice_to_address_2($invoice) {

	/* Client address 2 */
	return $invoice->client_address_2;

}

function invoice_to_city($invoice) {

	/* Client city */
	return $invoice->client_city;

}

function invoice_to_city_state_zip($invoice) {

	/* Client city, state, zip */
	if ($invoice->client_city and $invoice->client_state) {

		return $invoice->client_city . ', ' . $invoice->client_state . ' ' . $invoice->client_zip;

	}

	else {

		return '';

	}

}

function invoice_to_client_name($invoice) {

	/* Client name */
	return $invoice->client_name;

}

function invoice_to_country($invoice) {

	/* Client country */
	return $invoice->client_country;

}

function invoice_to_email_address($invoice) {

	return $invoice->client_email_address;

}

function invoice_to_fax_number($invoice) {

	return $invoice->client_fax_number;

}

function invoice_to_full_address($invoice) {

	global $CI;

	/* Client address, fully formatted */
	$address = $CI->lang->line('bill_to') . '<br />';

	$address .= invoice_to_client_name($invoice) . '<br />';

	if ($invoice->client_address) {

		$address .= $invoice->client_address . '<br />';

		if ($invoice->client_address_2) {

			$address .= $invoice->client_address_2 . '<br />';

		}

	}

	$address .= invoice_to_city_state_zip($invoice);

	return $address;

}

function invoice_to_mobile_number($invoice) {

	return $invoice->client_mobile_number;

}

function invoice_to_phone_number($invoice) {

	/* Client phone number */
	return $invoice->client_phone_number;

}

function invoice_to_state($invoice) {

	/* Client state */
	return $invoice->client_state;

}

function invoice_to_zip($invoice) {

	/* Client zip code */
	return $invoice->client_zip;

}

function invoice_client_tax_id($invoice) {

	/* Tax ID of the client */
	return $invoice->client_tax_id;

}

/**
 * BEGIN INVOICE NON-AMOUNT HELPERS
 */

function invoice_id($invoice) {

	return $invoice->invoice_number;

}

function invoice_date_entered($invoice) {

	global $CI;

	/* Date the invoice was entered */
	return date($CI->mdl_mcb_data->setting('default_date_format'), $invoice->invoice_date_entered);

}

function invoice_due_date($invoice) {

	global $CI;

	/* Date the invoice is due */
	return date($CI->mdl_mcb_data->setting('default_date_format'), $invoice->invoice_due_date);

}

function invoice_has_tax($invoice_tax_rate) {

	/* Returns TRUE if the invoice has tax applied */
	if (abs($invoice_tax_rate->tax_amount) > 0) {

		return TRUE;

	}

	return FALSE;

}

function invoice_logo($output_type = 'pdf') {

	global $CI;

	if ($CI->mdl_mcb_data->setting('include_logo_on_invoice') == 'TRUE' AND $CI->mdl_mcb_data->setting('invoice_logo')) {

		if ($output_type == 'pdf') {

			/** Use a system path to include the image in the PDF **/
			return '<img src="' . getcwd() . '/uploads/invoice_logos/' . $CI->mdl_mcb_data->setting('invoice_logo') . '" />';

		}

		elseif ($output_type == 'html') {

			/** Use a URL to include the image in the HTML **/
			return '<img src="' . base_url() . 'uploads/invoice_logos/' . $CI->mdl_mcb_data->setting('invoice_logo') . '" />';

		}

	}

}

function invoice_notes($invoice) {

	return $invoice->invoice_notes;

}

?>