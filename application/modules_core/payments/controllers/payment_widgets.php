<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Payment_Widgets extends Admin_Controller {

	function generate_dialog() {

		$this->load->model('templates/mdl_templates');

		$data = array(
			'templates'					=>	$this->mdl_templates->get('payment_receipts'),
			'default_payment_receipt'	=>	$this->mdl_mcb_data->setting('default_payment_receipt')
		);

		$this->load->view('payments/jquery_receipt_generate', $data);

	}

}

?>