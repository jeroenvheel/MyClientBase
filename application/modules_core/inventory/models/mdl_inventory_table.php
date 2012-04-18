<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_Inventory_Table extends CI_Model {

	public function get_table_headers() {

		$order_by = uri_assoc('order_by');

		$order = (uri_assoc('order')) == 'asc' ? 'desc' : 'asc';

		$headers = array(
			'inventory_id'		=>	anchor('inventory/index/order_by/inventory_id/order/' . $order, $this->lang->line('id')),
			'inventory_type'	=>	anchor('inventory/index/order_by/inventory_type/order/' . $order, $this->lang->line('type')),
			'inventory_item'	=>	anchor('inventory/index/order_by/inventory_item/order/' . $order, $this->lang->line('item')),
			'inventory_stock'	=>	anchor('inventory/index/order_by/inventory_stock/order/' . $order, $this->lang->line('stock')),
			'inventory_price'	=>	anchor('inventory/index/order_by/inventory_price/order/' . $order, $this->lang->line('price'))
		);

		return $headers;

	}

}

?>