<?php

class Mdl_Client_Statement extends CI_Model {

    function get_invoices($client_id, $include_closed_invoices, $include_quotes) {

        $params = array();

		if (!$this->session->userdata('global_admin')) {

			$params['where']['mcb_invoices.user_id'] = $this->session->userdata('user_id');

		}

        if (!$include_closed_invoices) {

            $params['where']['invoice_status_type'] = 1;
        }

        if (!$include_quotes) {

            $params['where']['invoice_is_quote'] = 0;
        }

        if ($client_id) {

            $params['where']['mcb_invoices.client_id'] = $client_id;
        }

        return $this->mdl_invoices->get($params);

    }

    function get_totals($invoices) {
        
        $totals = array(
            'total_invoice'     =>  '0',
            'total_paid'        =>  '0',
            'total_discount'    =>  '0',
            'total_shipping'    =>  '0',
            'total_tax'         =>  '0',
            'total_balance'     =>  '0'
        );
        
        foreach ($invoices as $invoice) {
            
            $totals['total_invoice'] += $invoice->invoice_total;
            $totals['total_paid'] += $invoice->invoice_paid;
            $totals['total_discount'] += $invoice->invoice_discount;
            $totals['total_shipping'] += $invoice->invoice_shipping;
            $totals['total_tax'] += $invoice->invoice_tax + $invoice->invoice_item_tax;
            $totals['total_balance'] += $invoice->invoice_balance;
            
        }
        
        return $totals;

    }

}

?>