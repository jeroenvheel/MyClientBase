<?php

class Mdl_Sales extends CI_Model {

	public function get($from_date = NULL, $to_date = NULL, $client_id = NULL) {

		$from_date = ($from_date) ? strtotime(standardize_date($from_date)) : NULL;
		$to_date = ($from_date) ? strtotime(standardize_date($to_date)) : NULL;

		$this->db->select('
			mcb_invoice_items.item_name,
			mcb_invoice_items.item_price,
			SUM(mcb_invoice_items.item_qty) AS sum_item_qty,
			SUM(mcb_invoice_item_amounts.item_subtotal) AS sum_item_subtotal,
			SUM(mcb_invoice_item_amounts.item_total) AS sum_item_total');

		$this->db->join('mcb_invoice_items', 'mcb_invoice_items.invoice_id = mcb_invoices.invoice_id');
		$this->db->join('mcb_invoice_item_amounts', 'mcb_invoice_item_amounts.invoice_item_id = mcb_invoice_items.invoice_item_id');

		$this->db->group_by('mcb_invoice_items.item_name, mcb_invoice_items.item_price');

		$this->db->order_by('item_name');

		if ($from_date) {

			$this->db->where('item_date >=', $from_date);

		}

		if ($to_date) {

			$this->db->where('item_date <=', $to_date);

		}

		if ($client_id) {

			$this->db->where('client_id', $client_id);

		}

		$this->db->where('invoice_is_quote', 0);

		if (!$this->session->userdata('global_admin')) {

			$this->db->where('mcb_invoices.user_id', $this->session->userdata('user_id'));

		}

		return $this->db->get('mcb_invoices')->result();

	}

}

?>