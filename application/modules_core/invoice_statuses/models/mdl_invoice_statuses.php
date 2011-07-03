<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_Invoice_Statuses extends MY_Model {

	public $status_types;

	public function __construct() {

		parent::__construct();

		$this->table_name = 'mcb_invoice_statuses';

		$this->primary_key = 'mcb_invoice_statuses.invoice_status_id';

		$this->select_fields = "
		SQL_CALC_FOUND_ROWS *";

		$this->order_by = 'invoice_status_type, invoice_status';

		$this->status_types = array(
			'1'	=>	$this->lang->line('open'),
			'2'	=>	$this->lang->line('pending'),
			'3'	=>	$this->lang->line('closed')
		);

	}

	public function validate() {

		$this->form_validation->set_rules('invoice_status', $this->lang->line('invoice_status'), 'required');
		$this->form_validation->set_rules('invoice_status_type', $this->lang->line('invoice_status_type'), 'required');

		return parent::validate();

	}

}

?>