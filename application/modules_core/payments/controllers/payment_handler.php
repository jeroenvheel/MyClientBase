<?php

class Payment_Handler extends MX_Controller {

	public function __construct() {

		parent::__construct();

	}

	public function merchant_response() {

		if (isset($_POST)) {

			$this->load->database();

			$this->load->model('mcb_data/mdl_mcb_data');

			$this->mdl_mcb_data->set_session_data();

			$this->load->driver('merchant');

			$this->merchant->driver = strtolower($this->mdl_mcb_data->get('merchant_driver'));

			if ($this->merchant->notify()) {

				/** Get the merchant response key */
				$merchant_response_id = $this->db->insert_id();

				/** Get the payment amount */
				$this->db->select('merchant_response_amount');
				$this->db->where('merchant_response_id', $merchant_response_id);
				$payment_amount = $this->db->get('mcb_merchant_responses')->row()->merchant_response_amount;

				/** Get the invoice id */
				$invoice_id = $this->input->post('custom');

				/** Create the payment db array */
				$db_array = array(
					'invoice_id'		=>	$invoice_id,
					'payment_date'		=>	time(),
					'payment_amount'	=>	$payment_amount,
					'payment_note'		=>	$this->lang->line('merchant_online_payment')
				);

				/** Insert the payment record */
				$this->db->insert('mcb_payments', $db_array);
				
				/** Get the payment id */
				$payment_id = $this->db->insert_id();

				/** Adjust the invoice amount */
				$this->load->model('invoices/mdl_invoice_amounts');
				$this->load->model('fields/mdl_fields');
				$this->mdl_invoice_amounts->adjust($invoice_id);

				/** Get the client id */
				$this->db->select('client_id');
				$this->db->where('invoice_id', $invoice_id);
				$client_id = $this->db->get('mcb_invoices')->row()->client_id;

				/** Update the merchant response record */
				$db_array = array(
					'merchant_response_payment_id'	=>	$payment_id,
					'merchant_response_client_id'	=>	$client_id,
					'merchant_response_invoice_id'	=>	$invoice_id
				);

				$this->db->where('merchant_response_id', $merchant_response_id);
				$this->db->update('mcb_merchant_responses', $db_array);

			}

		}

	}

}

?>