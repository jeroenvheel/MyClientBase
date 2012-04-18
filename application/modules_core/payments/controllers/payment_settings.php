<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Payment_Settings extends Admin_Controller {

	function __construct() {

		parent::__construct();

		$this->load->model(array('mdl_payments', 'mdl_payment_methods'));

	}

	function display() {

		$this->load->helper('directory');

		$merchant_drivers = directory_map('application/libraries/Merchant/drivers', FALSE);

		foreach ($merchant_drivers as $key=>$value) {

			$value = strtolower($value);

			$merchant_drivers[$key] = ucfirst(str_replace('.php', '', str_replace('merchant_', '', $value)));

		}

		$data = array(
			'receipt_templates'	=>	$this->mdl_templates->get('payment_receipts'),
			'merchant_drivers'	=>	$merchant_drivers,
			'payment_methods'	=>	$this->mdl_payment_methods->get()
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