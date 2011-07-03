<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Widgets extends Admin_Controller {

	function generate_dialog() {

		$this->load->model('templates/mdl_templates');

		$data = array(
			'templates'					=>	$this->mdl_templates->get('invoices'),
			'default_invoice_template'	=>	$this->mdl_mcb_data->setting('default_invoice_template'),
			'default_quote_template'	=>	$this->mdl_mcb_data->setting('default_quote_template')
		);

		$this->load->view('invoices/jquery_invoice_generate', $data);

	}

}

?>