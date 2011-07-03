<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_Payment_Methods extends MY_Model {

	public function __construct() {

		parent::__construct();

		$this->table_name = 'mcb_payment_methods';

		$this->primary_key = 'mcb_payment_methods.payment_method_id';

		$this->select_fields = "
		SQL_CALC_FOUND_ROWS *";

		$this->order_by = 'mcb_payment_methods.payment_method';

		$this->limit = $this->mdl_mcb_data->setting('results_per_page');

	}

	public function validate() {

		$this->form_validation->set_rules('payment_method', $this->lang->line('payment_method'), 'required');

		return parent::validate($this);

	}

}

?>