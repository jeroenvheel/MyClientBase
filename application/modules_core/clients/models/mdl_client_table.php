<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_Client_Table extends CI_Model {

	public function get_table_headers() {

		$order_by = uri_assoc('order_by');

		$order = (uri_assoc('order')) == 'asc' ? 'desc' : 'asc';

		$headers = array(
			'client_id'		=>	anchor('clients/index/order_by/client_id/order/' . $order, $this->lang->line('id')),
			'client_name'	=>	anchor('clients/index/order_by/client_name/order/' . $order, $this->lang->line('client')),
			'client_email'	=>	anchor('clients/index/order_by/client_email/order/' . $order, $this->lang->line('email_address')),
			'client_phone'	=>	anchor('clients/index/order_by/client_phone/order/' . $order, $this->lang->line('phone_number')),
			'credit_amount'	=>	anchor('clients/index/order_by/credit_amount/order/' . $order, $this->lang->line('credit_amount')),
			'balance'		=>	anchor('clients/index/order_by/balance/order/' . $order, $this->lang->line('balance')),
			'user'			=>	anchor('clients/index/order_by/user/order/' . $order, $this->lang->line('user')),
			'client_active'	=>	anchor('clients/index/order_by/client_active/order/' . $order, $this->lang->line('active'))
		);

		return $headers;

	}

}

?>
