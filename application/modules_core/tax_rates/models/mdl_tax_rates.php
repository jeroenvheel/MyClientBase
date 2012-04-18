<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_Tax_Rates extends MY_Model {

	public function __construct() {

		parent::__construct();

		$this->table_name = 'mcb_tax_rates';

		$this->primary_key = 'mcb_tax_rates.tax_rate_id';

		$this->select_fields = "
		SQL_CALC_FOUND_ROWS mcb_tax_rates.*";

		$this->order_by = 'tax_rate_percent';

		$this->limit = $this->mdl_mcb_data->setting('results_per_page');

	}

	public function validate() {

		$this->form_validation->set_rules('tax_rate_name', $this->lang->line('tax_rate_name'), 'required');
		$this->form_validation->set_rules('tax_rate_percent', $this->lang->line('tax_rate_percent'), 'required');

		return parent::validate();

	}

	public function delete($tax_rate_id) {

		/*
		 * Before deleting a tax rate, make sure no invoices are assigned
		*/

		$this->db->where('tax_rate_id', $tax_rate_id);

		$query = $this->db->get('mcb_invoice_tax_rates');

		if ($query->num_rows()) {

			$this->session->set_flashdata('custom_error', $this->lang->line('cannot_delete_tax_rate'));

			return FALSE;

		}

		elseif ($this->mdl_mcb_data->setting('default_tax_rate_id') == $tax_rate_id) {

			$this->session->set_flashdata('custom_error', $this->lang->line('cannot_delete_default_tax_rate'));

			return FALSE;

		}

		else {

			$this->db->where('tax_rate_id', $tax_rate_id);

			$this->db->delete('mcb_tax_rates');

			$this->session->set_flashdata('success_delete', TRUE);

			return TRUE;

		}

	}

	public function get_invoice_tax_rates($invoice_id) {

		$this->db->join('mcb_tax_rates', 'mcb_tax_rates.tax_rate_id = mcb_invoice_tax_rates.tax_rate_id');

		$this->db->where('invoice_id', $invoice_id);

		$this->db->order_by('mcb_invoice_tax_rates.invoice_tax_rate_id');

		return $this->db->get('mcb_invoice_tax_rates')->result();

	}

}

?>