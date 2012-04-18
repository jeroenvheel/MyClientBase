<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function invoice_item($item) {

    /* Invoice item name and description */
    return $item->item_description ? nl2br($item->item_name) . ' - ' . nl2br($item->item_description): nl2br($item->item_name);

}

function invoice_item_name($item) {

    return nl2br($item->item_name);

}

function invoice_item_description($item) {

    return nl2br($item->item_description);

}

function invoice_item_has_tax($sum) {

    /* Returns true if invoice item has tax applied */
    if ($sum->tax_rate_sum > 0) {

        return TRUE;

    }

    return FALSE;

}

function invoice_item_qty($item) {

    global $CI;

    return format_qty($item->item_qty);

}

function invoice_item_tax($item) {

    /* Amount of item tax, formatted as currency */
    return display_currency($item->item_tax);

}

function invoice_item_tax_rate($item) {

	$CI =& get_instance();

    return format_number($item->tax_rate_percent, TRUE, $CI->mdl_mcb_data->setting('decimal_taxes_num')) . '%';

}

function invoice_item_tax_sum($sum) {

    /* Total amount of invoice item taxes, formatted as currency */
    return display_currency($sum->tax_rate_sum);

}

function invoice_item_tax_sum_name($sum) {

	$CI =& get_instance();

    /* For display purposes */
    return $sum->tax_rate_name . ' @ ' . format_number($sum->tax_rate_percent, TRUE, $CI->mdl_mcb_data->setting('decimal_taxes_num')) . '%';

}
function invoice_item_total($item) {

    /* Amount of item + item tax, formatted as currency */
    return display_currency($item->item_total);

}


function invoice_item_unit_price($item) {

    /* Item price, formatted as currency */

    if ($item->item_tax_option == 1) {

        return display_currency($item->item_subtotal / $item->item_qty);

    }

    return display_currency($item->item_price);

}

function invoice_item_date($item) {

    return format_date($item->item_date);

}

function format_qty($qty) {

    global $CI;

    /* Used internally, not for invoice templates */
    return ($CI->mdl_mcb_data->setting('display_quantity_decimals')) ? format_number($qty) : format_number($qty, TRUE, 0);

}

function invoice_itemlevel_subtotal($item) {

    /* Amount of item formatted as currency */
    return display_currency($item->item_subtotal);

}

?>
