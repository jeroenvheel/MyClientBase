<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TABLE: mcb_invoice_amounts
 * invoice_amount_id
 * invoice_id
 * invoice_item_subtotal	Sum of mcb_invoice_item_amounts.item_total
 * invoice_item_taxable		Sum of mcb_invoice_item_amounts.item_total where is_taxable = 1
 * invoice_item_tax			Sum of mcb_invoice_item_amounts.item_tax
 * invoice_subtotal			(invoice_item_subtotal + invoice_item_tax)
 * invoice_tax				Sum of global invoice tax amounts
 * invoice_shipping			invoice_shipping
 * invoice_discount			invoice_discount
 * invoice_paid				Sum of mcb_payments.payment_amount
 * invoice_total			invoice_subtotal + invoice_tax + invoice_shipping - invoice_discount
 * invoice_balance			invoice_total - invoice_paid
 */

function invoice_discount($invoice) {

    /* Discount amount, formatted as currency */
    return '(' . display_currency($invoice->invoice_discount) . ')';

}

function invoice_balance($invoice) {

    /* Remaining balance on invoice, formatted as currency */
    return display_currency($invoice->invoice_balance);

}

function invoice_total($invoice) {

    /* Grand total amount of invoices (items + item tax - invoice discount + invoice tax + invoice shipping) */
    return display_currency($invoice->invoice_total);

}

function invoice_shipping($invoice) {

    /* Invoice shipping amount, formatted as currency */
    return display_currency($invoice->invoice_shipping);

}

function invoice_subtotal($invoice) {

    /* Returns the original subtotal of invoice items without discount being applied */
    return display_currency($invoice->invoice_subtotal);

}

function invoice_tax_rate_amount($invoice_tax_rate) {

    /* Invoice tax amount */
    return display_currency($invoice_tax_rate->tax_amount);

}

function invoice_tax_rate_name($invoice_tax_rate) {

	$CI =& get_instance();

    /* Invoice tax rate */
    return $invoice_tax_rate->tax_rate_name . ' @ ' . format_number($invoice_tax_rate->tax_rate_percent, TRUE, $CI->mdl_mcb_data->setting('decimal_taxes_num')) . '%';

}

function invoice_tax_total($invoice) {

    return display_currency($invoice->invoice_item_tax + $invoice->invoice_tax);

}

function invoice_item_subtotal($invoice) {

    return display_currency($invoice->invoice_item_subtotal);

}

function invoice_itemtax($invoice) {

    return display_currency($invoice->invoice_item_tax);

}

?>