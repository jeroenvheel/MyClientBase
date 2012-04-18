<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Calendar extends Admin_Controller {

	function __construct() {

		parent::__construct();

		if ($this->input->post('btn_list_view')) {

			redirect('invoices');

		}

		elseif ($this->input->post('btn_add_invoice')) {

			redirect('invoices/create');

		}

		$this->load->model('invoices/mdl_invoices');

	}

	function index() {

		$this->load->view('index');

	}

	public function jquery_get_invoices($status = 'open') {

		$function = "get_" . $status;

		$invoices = $this->mdl_invoices->$function();

		$inv_array = array();

		foreach ($invoices as $invoice) {
			
			$inv_array[] = array(
				'id'    => $invoice->invoice_id,
				'title' => $invoice->client_name . ' (' . display_currency($invoice->invoice_total) . ')',
				'start' => date('Y-m-d', $invoice->invoice_due_date),
				'url'   => './invoices/edit/invoice_id/'. $invoice->invoice_id,
			);

		}

		echo json_encode($inv_array);
		
	}

}