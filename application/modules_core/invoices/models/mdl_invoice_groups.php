<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_Invoice_Groups extends MY_Model {

	public function __construct() {

		parent::__construct();

		$this->table_name = 'mcb_invoice_groups';

		$this->primary_key = 'mcb_invoice_groups.invoice_group_id';

		$this->select_fields = "
		SQL_CALC_FOUND_ROWS mcb_invoice_groups.*";

		$this->order_by = 'mcb_invoice_groups.invoice_group_prefix';

		$this->limit = $this->mdl_mcb_data->setting('results_per_page');

	}

	public function validate() {

		$this->form_validation->set_rules('invoice_group_name', $this->lang->line('group_name'), 'required|max_length[50]');
		$this->form_validation->set_rules('invoice_group_prefix', $this->lang->line('group_prefix'), 'max_length[10]');
		$this->form_validation->set_rules('invoice_group_prefix_year', $this->lang->line('group_prefix_year'));
		$this->form_validation->set_rules('invoice_group_prefix_month', $this->lang->line('group_prefix_month'));
		$this->form_validation->set_rules('invoice_group_next_id', $this->lang->line('group_next_id'), 'required|numeric');
		$this->form_validation->set_rules('invoice_group_left_pad', $this->lang->line('group_left_pad'), 'required');

		return parent::validate();

	}

	function save($db_array, $invoice_group_id) {

		if (!isset($db_array['invoice_group_prefix_year'])) {

			$db_array['invoice_group_prefix_year'] = 0;

		}

		if (!isset($db_array['invoice_group_prefix_month'])) {

			$db_array['invoice_group_prefix_month'] = 0;

		}

		parent::save($db_array, $invoice_group_id);

	}

	public function adjust_invoice_number($invoice_id, $invoice_group_id) {

		$invoice = $this->mdl_invoices->get_by_id($invoice_id);

		if ($invoice->invoice_group_id <> $invoice_group_id) {

			$group = parent::get_by_id($invoice_group_id);

			$invoice_number = '';

			$date_prefix = FALSE;

			if ($group->invoice_group_prefix_year) {

				$invoice_number .= date('Y');
				$date_prefix = TRUE;

			}

			if ($group->invoice_group_prefix_month) {

				$invoice_number .= date('m');
				$date_prefix = TRUE;

			}

			if ($date_prefix) {

				$invoice_number .= '-';

			}

			$invoice_number .= $group->invoice_group_prefix . str_pad($group->invoice_group_next_id, $group->invoice_group_left_pad, '0', STR_PAD_LEFT);

			/* Update the invoice group record with the incremented next invoice id */
			$this->db->set('invoice_group_next_id', $group->invoice_group_next_id + 1);
			$this->db->where('invoice_group_id', $group->invoice_group_id);
			$this->db->update('mcb_invoice_groups');

			/* Assign the invoice number to the invoice */
			$this->db->set('invoice_number', $invoice_number);
			$this->db->set('invoice_group_id', $invoice_group_id);
			$this->db->where('invoice_id', $invoice_id);
			$this->db->update('mcb_invoices');

		}

	}

}

?>