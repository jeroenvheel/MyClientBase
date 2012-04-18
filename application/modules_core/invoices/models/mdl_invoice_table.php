<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_Invoice_Table extends CI_Model {

	public function get_table_headers() {

		$is_quote = uri_assoc('is_quote');

		if (!$is_quote) {

			$quote_str = '';

		}

		else {

			$quote_str = '/is_quote/1';

		}

		$order_by = uri_assoc('order_by');

		$order = (uri_assoc('order')) == 'asc' ? 'desc' : 'asc';

		$headers = array(
			'invoice_number'	=>	anchor('invoices/index' . $quote_str . '/order_by/invoice_id/order/' . $order, (!$is_quote) ? $this->lang->line('invoice_number') : $this->lang->line('quote_number')),
			'date'				=>	anchor('invoices/index' . $quote_str . '/order_by/date/order/' . $order, $this->lang->line('date')),
			'due_date'			=>	anchor('invoices/index' . $quote_str . '/order_by/duedate/order/' . $order, $this->lang->line('due_date')),
			'client'			=>	anchor('invoices/index' . $quote_str . '/order_by/client/order/' . $order, $this->lang->line('client')),
			'amount'			=>	anchor('invoices/index' . $quote_str . '/order_by/amount/order/' . $order, $this->lang->line('amount'))
		);

		return $headers;

	}

}

?>
