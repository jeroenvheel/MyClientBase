<?php

class Mdl_Invoice_History extends MY_Model {

	public function __construct() {

		parent::__construct();

		$this->table_name = 'mcb_invoice_history';

		$this->primary_key = 'mcb_invoice_history.invoice_history_id';

		$this->order_by = 'invoice_history_date DESC';

		$this->select = 'mcb_invoice_history.*, mcb_users.username, mcb_invoices.invoice_number';

		$this->joins = array(
			'mcb_users'		=>	'mcb_users.user_id = mcb_invoice_history.user_id',
			'mcb_invoices'	=>	'mcb_invoices.invoice_id = mcb_invoice_history.invoice_id'
		);

	}

	function clear_history($invoice_id = NULL) {

		if ($invoice_id) {

			$this->db->where('invoice_id', $invoice_id);

		}

		else {

			$this->db->where('invoice_id >', 0);

		}

		$this->db->delete($this->table_name);

	}

}

?>