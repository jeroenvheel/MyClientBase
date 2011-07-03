<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Payment_Settings extends Admin_Controller {

	function __construct() {

		parent::__construct();

		$this->load->model('mdl_payments');

	}

	function display() {

		$data = array(
			'receipt_templates'	=>	$this->mdl_templates->get('payment_receipts')
		);

		$this->load->view('settings', $data);

	}

	function save() {

		foreach ($this->input->post('payment_settings') as $key=>$value) {

			$this->mdl_mcb_data->save($key, $value);

		}

	}

}

?>