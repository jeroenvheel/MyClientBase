<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Search_Results extends Admin_Controller {

	function __construct() {

		parent::__construct();

		$this->load->model(
			array(
			'invoices/mdl_invoices',
			'templates/mdl_templates'
			)
		);

		$this->_post_handler();

	}

	function index() {

		if (!uri_assoc('search_hash', 4)) {

			redirect('invoice_search');

		}

		$this->redir->set_last_index();

		$this->load->model('invoices/mdl_invoice_table');
        $this->load->helper('text');

		$page = uri_assoc('page', 4);

		$params = array(
			'paginate'		=>	TRUE,
			'limit'			=>	$this->mdl_mcb_data->setting('results_per_page'),
			'page'			=>	$page
		);

		$invoices = $this->_get_results($params);

		$data = array(
			'invoices'		=>	$invoices,
			'table_headers'	=>	$this->mdl_invoice_table->get_table_headers(),
			'sort_links'	=>	TRUE
		);

		$this->load->view('results', $data);

	}

	function html() {

		$invoices = $this->_get_results();

		$totals = $this->_get_totals($invoices);

		$data = array(
			'invoices'	=>	$invoices,
			'totals'	=>	$totals
		);

		$this->load->view('html', $data);

	}

	function pdf() {

		$this->load->helper($this->mdl_mcb_data->setting('pdf_plugin'));

		$invoices = $this->_get_results();

		$totals = $this->_get_totals($invoices);

		$data = array(
			'invoices'	=>	$invoices,
			'totals'	=>	$totals
		);

		$html = $this->load->view('html', $data, TRUE);

		pdf_create($html, $this->lang->line('invoice_summary_report'), TRUE);


	}

	function csv() {

		$invoices = $this->_get_results();

		$lines = $this->lang->line('id') . ',' .
			$this->lang->line('date') . ',' .
			$this->lang->line('client') . ',' .
			$this->lang->line('total') . ',' .
			$this->lang->line('paid') . ',' .
			$this->lang->line('balance') . ',' .
			$this->lang->line('status') . "\r\n";

		foreach ($invoices as $invoice) {

			$lines .= $invoice->invoice_number . ',' .
				format_date($invoice->invoice_date_entered) . ',' .
				$invoice->client_name . ',' .
				$invoice->invoice_total . ',' .
				$invoice->invoice_paid . ',' .
				$invoice->invoice_balance . ',' .
				$invoice->invoice_status . "\r\n";
		}

		$this->load->helper('download');

		force_download($this->lang->line('invoice_summary_report') . '.csv', $lines);

	}

	function _get_results($params = array()) {

		$search_hash = $this->session->userdata('search_hash');

		$params = array_merge($params, $search_hash[uri_assoc('search_hash', 4)]);

		$params['set_client'] = TRUE;

		return $this->mdl_invoices->get($params);

	}

	function _get_totals($invoices) {

		$totals = array(
			'invoice_item_subtotal'	=>	0.00,
			'invoice_item_tax'		=>	0.00,
			'invoice_subtotal'		=>	0.00,
			'invoice_tax'			=>	0.00,
			'invoice_shipping'		=>	0.00,
			'invoice_discount'		=>	0.00,
			'invoice_paid'			=>	0.00,
			'invoice_total'			=>	0.00,
			'invoice_balance'		=>	0.00
		);

		foreach ($invoices as $invoice) {

			$totals['invoice_item_subtotal'] += $invoice->invoice_item_subtotal;
			$totals['invoice_item_tax'] += $invoice->invoice_item_tax;
			$totals['invoice_subtotal'] += $invoice->invoice_subtotal;
			$totals['invoice_tax'] += $invoice->invoice_tax;
			$totals['invoice_shipping'] += $invoice->invoice_shipping;
			$totals['invoice_discount'] += $invoice->invoice_discount;
			$totals['invoice_paid'] += $invoice->invoice_paid;
			$totals['invoice_total'] += $invoice->invoice_total;
			$totals['invoice_balance'] += $invoice->invoice_balance;

		}

		return $totals;

	}

	function _post_handler() {

		if ($this->input->post('btn_add_invoice')) {

			redirect('invoices/create');

		}

	}

}

?>