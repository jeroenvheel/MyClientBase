<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_Export extends CI_Model {

    function get_invoices_query() {

        $this->db->select(
            'mcb_invoices.invoice_id, ' .
            'mcb_invoices.invoice_number, ' .
            "FROM_UNIXTIME(mcb_invoices.invoice_date_entered, '%Y/%m/%d') AS invoice_date_entered, " .
            "FROM_UNIXTIME(mcb_invoices.invoice_due_date, '%Y/%m/%d') AS invoice_due_date, " .
            'mcb_invoices.invoice_notes, ' .
            'mcb_invoice_amounts.invoice_item_subtotal, ' .
            'mcb_invoice_amounts.invoice_item_tax, ' .
            'mcb_invoice_amounts.invoice_subtotal, ' .
            'mcb_invoice_amounts.invoice_tax, ' .
            'mcb_invoice_amounts.invoice_shipping, ' .
            'mcb_invoice_amounts.invoice_discount, ' .
            'mcb_invoice_amounts.invoice_total, ' .
            'mcb_invoice_amounts.invoice_paid, ' .
            'mcb_invoice_amounts.invoice_balance',
            FALSE);

        $this->db->join('mcb_clients', 'mcb_clients.client_id = mcb_invoices.client_id');
        $this->db->join('mcb_invoice_amounts', 'mcb_invoice_amounts.invoice_id = mcb_invoices.invoice_id');
        $this->db->where('invoice_is_quote', 0);
        $this->db->order_by('invoice_date_entered');

        return $this->db->get('mcb_invoices');

    }

    function get_clients_query() {

        $this->db->select('mcb_clients.*');

        $this->db->order_by('mcb_clients.client_name');

        return $this->db->get('mcb_clients');

    }

    function get_payments_query() {

        $this->db->select(
            'mcb_payments.payment_id, ' .
            'mcb_payments.invoice_id, ' .
            'mcb_invoices.invoice_number, ' .
            'mcb_clients.client_id, ' .
            'mcb_clients.client_name, ' .
            "FROM_UNIXTIME(mcb_payments.payment_date, '%Y/%m/%d') AS payment_date, " .
            'mcb_payments.payment_amount, ' .
            'mcb_payment_methods.payment_method, ' .
            'mcb_payments.payment_note',
            FALSE
        );

        $this->db->join('mcb_invoices', 'mcb_invoices.invoice_id = mcb_payments.invoice_id');
        $this->db->join('mcb_clients', 'mcb_clients.client_id = mcb_invoices.client_id');
        $this->db->join('mcb_payment_methods', 'mcb_payment_methods.payment_method_id = mcb_payments.payment_method_id', 'LEFT');
        $this->db->order_by('mcb_payments.payment_date');

        return $this->db->get('mcb_payments');

    }

}

?>