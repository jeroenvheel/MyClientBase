<?php

class Mdl_Sales_by_Customer extends CI_Model {

	public function get($from_date = 0, $to_date = 0) {

		$this->db->select('
			mcb_clients.client_name,
			SUM(mcb_invoice_amounts.invoice_item_subtotal) AS amt_sales,
			SUM(mcb_invoice_amounts.invoice_total) AS amt_sales_inc_tax,
			COUNT(mcb_invoices.invoice_id) AS num_invoices');

		$this->db->join('mcb_clients', 'mcb_clients.client_id = mcb_invoices.client_id');
		$this->db->join('mcb_invoice_amounts', 'mcb_invoice_amounts.invoice_id = mcb_invoices.invoice_id');

		if ($from_date) {
			$this->db->where('invoice_date_entered >=', $from_date);
		}

		if ($to_date) {
			$this->db->where('invoice_date_entered <=', $to_date);
		}

		$this->db->where('invoice_is_quote', 0);

		if (!$this->session->userdata('global_admin')) {

			$this->db->where('mcb_invoices.user_id', $this->session->userdata('user_id'));

		}

		$this->db->group_by('mcb_clients.client_id');

		$this->db->order_by('mcb_clients.client_name');

		return $this->db->get('mcb_invoices')->result();

	}

}

?>