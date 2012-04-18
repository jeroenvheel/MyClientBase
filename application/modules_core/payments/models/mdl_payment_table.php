<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_Payment_Table extends CI_Model {

	public function get_table_headers() {

		$order_by = uri_assoc('order_by');

		$order = (uri_assoc('order')) == 'asc' ? 'desc' : 'asc';

		$headers = array(
			'payment_id'	=>	anchor('payments/index/order_by/payment_id/order/' . $order, $this->lang->line('id')),
			'date'			=>	anchor('payments/index/order_by/date/order/' . $order, $this->lang->line('date')),
			'invoice_id'	=>	anchor('payments/index/order_by/invoice_id/order/' . $order, $this->lang->line('invoice_number')),
			'client'		=>	anchor('payments/index/order_by/client/order/' . $order, $this->lang->line('client')),
			'amount'		=>	anchor('payments/index/order_by/amount/order/' . $order, $this->lang->line('amount'))
		);

		return $headers;

	}

}

?>
