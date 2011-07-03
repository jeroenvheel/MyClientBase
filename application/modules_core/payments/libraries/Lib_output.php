<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Lib_output {

	public $CI;

	function __construct() {

		$this->CI =& get_instance();

		$this->CI->load->model('invoices/mdl_invoices');

	}

	function html($invoice_id, $payment_id, $template) {

		$params = array(
			'where'	=>	array(
				'mcb_invoices.invoice_id'	=>	$invoice_id
			)
		);

        $invoice = $this->CI->mdl_invoices->get($params);

        $invoice_payments = $this->CI->mdl_invoices->get_invoice_payments($invoice->invoice_id);

		$data = array(
			'invoice'           =>	$invoice,
            'invoice_payments'  =>  $invoice_payments
		);

		$this->CI->load->view('payments/receipt_templates/' . $template, $data);

	}

	function pdf($invoice_id, $payment_id, $template) {

		$this->CI->load->helper($this->CI->mdl_mcb_data->setting('pdf_plugin'));

		$params = array(
			'where'	=>	array(
				'mcb_invoices.invoice_id'	=>	$invoice_id
			)
		);

        $invoice = $this->CI->mdl_invoices->get($params);

        $invoice_payments = $this->CI->mdl_invoices->get_invoice_payments($invoice->invoice_id);

		$data = array(
			'invoice'           =>	$invoice,
            'invoice_payments'  =>  $invoice_payments
		);

		$html = $this->CI->load->view('payments/receipt_templates/' . $template, $data, TRUE);

		pdf_create($html, 'receipt_' . $invoice->invoice_number, TRUE);
		
	}

}

?>