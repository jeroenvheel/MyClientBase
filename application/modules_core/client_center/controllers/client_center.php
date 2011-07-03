<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Client_Center extends Client_Center_Controller {

	function __construct() {

		parent::__construct('client_id');

		$this->load->model('invoices/mdl_invoices');

		$this->load->model('mdl_client_center');

		$this->load->helper('text');

	}

	function index() {

		$params = array(
			'open'		=> array(
				'limit'	=>	10,
				'where'	=>	array(
					'mcb_invoice_statuses.invoice_status_type'		=>	1,
					'mcb_invoices.client_id'						=>	$this->session->userdata('client_id'),
					'mcb_invoices.invoice_is_quote'					=>	0
				),
				'set_client'	=>	TRUE
			),
			'pending'	=>	array(
				'limit'	=>	10,
				'where'	=>	array(
					'mcb_invoice_statuses.invoice_status_type'		=>	2,
					'mcb_invoices.client_id'						=>	$this->session->userdata('client_id'),
					'mcb_invoices.invoice_is_quote'					=>	0
				),
				'set_client'	=>	TRUE
			),

			'closed'	=>	array(
				'limit'	=>	10,
				'where'	=>	array(
					'mcb_invoice_statuses.invoice_status_type'		=>	3,
					'mcb_invoices.client_id'						=>	$this->session->userdata('client_id'),
					'mcb_invoices.invoice_is_quote'					=>	0
				),
				'set_client'	=>	TRUE
			)
		);

		$data = array(
			'open_invoices'		=>	$this->mdl_invoices->get($params['open']),
			'pending_invoices'	=>	$this->mdl_invoices->get($params['pending']),
			'closed_invoices'	=>	$this->mdl_invoices->get($params['closed'])
		);

		$this->load->view('index', $data);

	}

	function invoices() {

		$params = array(
			'limit'		=>	25,
			'paginate'	=>	TRUE,
			'page'		=>	uri_assoc('page', 4),
			'where'		=>	array(
				'mcb_invoices.client_id'		=>	$this->session->userdata('client_id'),
				'mcb_invoices.invoice_is_quote'	=>	0
			),
			'set_client'	=>	TRUE
		);

		$data = array(
			'invoices'	=>	$this->mdl_invoices->get($params)
		);

		$this->load->view('invoices', $data);

	}

	function view_invoice() {

		$params = array(
			'where'	=>	array(
				'mcb_invoices.invoice_id'		=>	uri_assoc('invoice_id'),
				'mcb_invoices.client_id'		=>	$this->session->userdata('client_id'),
				'mcb_invoices.invoice_is_quote'	=>	0
			)
		);

        $invoice = $this->mdl_invoices->get($params);

        $invoice_items = $this->mdl_invoices->get_invoice_items($invoice->invoice_id);

        $invoice_tax_rates = $this->mdl_invoices->get_invoice_tax_rates($invoice->invoice_id);

        $invoice_payments = $this->mdl_invoices->get_invoice_payments($invoice->invoice_id);

		$data = array(
			'invoice'           =>	$invoice,
            'invoice_items'     =>  $invoice_items,
            'invoice_tax_rates' =>  $invoice_tax_rates,
            'invoice_payments'  =>  $invoice_payments
		);

		if (!$data['invoice']) {

			redirect('client_center');

		}

		$this->load->view('invoice_view', $data);

	}

	function generate_pdf() {

		$invoice_id = uri_assoc('invoice_id');

		if (!$this->mdl_client_center->invoice_belongs_to_client($invoice_id, $this->session->userdata('client_id'))) {

			redirect('client_center');

		}

		$this->load->library('invoices/lib_output');

        $this->mdl_invoices->save_invoice_history($invoice_id, $this->session->userdata('user_id'), $this->lang->line('client_generated_invoice_pdf'));

		$this->lib_output->pdf($invoice_id, $this->_get_invoice_template());

	}

	function generate_html() {

		$invoice_id = uri_assoc('invoice_id');

		if (!$this->mdl_client_center->invoice_belongs_to_client($invoice_id, $this->session->userdata('client_id'))) {

			redirect('client_center');

		}

		$this->load->library('invoices/lib_output');

		$this->mdl_invoices->save_invoice_history($invoice_id, $this->session->userdata('user_id'), $this->lang->line('client_generated_invoice_html'));

		$this->lib_output->html($invoice_id, $this->_get_invoice_template());

	}

    function _get_invoice_template() {

        $this->load->model('mcb_data/mdl_mcb_client_data');

        $invoice_template = $this->mdl_mcb_client_data->get($this->session->userdata('client_id'), 'default_invoice_template');

        if (!$invoice_template) {

            $invoice_template = $this->mdl_mcb_data->setting('default_invoice_template');

        }

        return $invoice_template;

    }

}

?>