<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_Invoice_Reports extends MY_Model {

	public function validate() {

		$this->form_validation->set_rules('from_date', $this->lang->line('from_date'), 'required');
		$this->form_validation->set_rules('to_date', $this->lang->line('to_date'), 'required');

		return parent::validate();

	}

	public function invoices($results) {

		$invoice_amount = 0;

		$invoice_tax = 0;

		$invoice_total = 0;

		$invoice_payment = 0;

		$invoice_balance = 0;

		foreach ($results as $result) {

			$invoice_amount += $result->invoice_item_total;

			$invoice_tax += $result->invoice_tax_total_amount;

			$invoice_total += $result->invoice_total;

			$invoice_payment += $result->invoice_paid_amount;

			$invoice_balance += $result->invoice_balance;

		}

		return array(
			'invoices'			=>	$results,
			'group_totals'		=>	array(
				'invoice_amount'	=>	$invoice_amount,
				'invoice_tax'		=>	$invoice_tax,
				'invoice_total'		=>	$invoice_total,
				'invoice_payment'	=>	$invoice_payment,
				'invoice_balance'	=>	$invoice_balance
			)
		);
		
	}

	public function invoice_params() {

		$params = array(
			'where'	=> array(
				'mcb_invoices.invoice_date_entered >='	=>	strtotime(standardize_date($this->input->post('from_date'))),
				'mcb_invoices.invoice_date_entered <='	=>	strtotime(standardize_date($this->input->post('to_date')))
			)
		);

		if ($this->input->post('client_id') <> 'all') {

			$params['where']['mcb_invoices.client_id'] = $this->input->post('client_id');

		}

		if ($this->input->post('status_select') == 'open') {

			$params['where']['mcb_invoices.invoice_status_id'] = 1;

		}

		elseif ($this->input->post('status_select') == 'pending') {

			$params['where']['mcb_invoices.invoice_status_id'] = 2;

		}

		elseif ($this->input->post('status_select') == 'closed') {

			$params['where']['mcb_invoices.invoice_status_id'] = 3;

		}

		return $params;

	}

}

?>