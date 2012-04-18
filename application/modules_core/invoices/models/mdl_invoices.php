<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_Invoices extends MY_Model {

	public function __construct() {

		parent::__construct();

		$this->table_name = 'mcb_invoices';

		$this->primary_key = 'mcb_invoices.invoice_id';

		$this->order_by = 'mcb_invoices.invoice_date_entered DESC, mcb_invoices.invoice_id DESC';

		$this->select_fields = "
		SQL_CALC_FOUND_ROWS
		mcb_invoices.*,
		mcb_invoice_amounts.*,
        mcb_clients.*,
		mcb_invoice_groups.invoice_group_name,
		mcb_invoice_groups.invoice_group_prefix,
		mcb_users.username,
	    mcb_users.company_name AS from_company_name,
	    mcb_users.last_name AS from_last_name,
	    mcb_users.first_name AS from_first_name,
	    mcb_users.address AS from_address,
		mcb_users.address_2 AS from_address_2,
	    mcb_users.city AS from_city,
	    mcb_users.state AS from_state,
	    mcb_users.zip AS from_zip,
		mcb_users.country AS from_country,
	    mcb_users.phone_number AS from_phone_number,
		mcb_users.email_address AS from_email_address,
		mcb_users.fax_number AS from_fax_number,
		mcb_users.web_address AS from_web_address,
		mcb_users.tax_id_number AS from_tax_id_number,
		mcb_invoice_statuses.*,
		(DATEDIFF(FROM_UNIXTIME(UNIX_TIMESTAMP()),FROM_UNIXTIME(mcb_invoices.invoice_due_date))) AS invoice_days_overdue,
		IF(mcb_invoice_statuses.invoice_status_type NOT IN(3,2), IF((DATEDIFF(FROM_UNIXTIME(UNIX_TIMESTAMP()),FROM_UNIXTIME(mcb_invoices.invoice_due_date))) > 0, 1, 0), 0) AS invoice_is_overdue";

		$user_custom_fields = $this->mdl_fields->get_object_fields(6);

		if ($user_custom_fields) {

			$this->select_fields .= ',';

			$ucf = array();

			foreach ($user_custom_fields as $user_custom_field) {

				$ucf[] = 'mcb_users.' . $user_custom_field->column_name;

			}

			$this->select_fields .= implode(',', $ucf);

		}

		$this->joins = array(
			'mcb_invoice_statuses'	=>	array(
				'mcb_invoice_statuses.invoice_status_id = mcb_invoices.invoice_status_id',
				'left'
			),
			'mcb_users'				=>	array(
				'mcb_users.user_id = mcb_invoices.user_id',
				'left'
			),
			'mcb_invoice_amounts'	=>	'mcb_invoice_amounts.invoice_id = mcb_invoices.invoice_id',
			'mcb_clients'			=>	'mcb_clients.client_id = mcb_invoices.client_id',
			'mcb_invoice_groups'	=>	array(
				'mcb_invoice_groups.invoice_group_id = mcb_invoices.invoice_group_id',
				'left'
			)
		);

	}

	public function get($params = NULL) {

		if (isset($params['active_clients_only']) and $params['active_clients_only']) {

			$this->db->where('mcb_clients.client_active', 1);

		}

		$invoices = parent::get($params);

		if (is_array($invoices)) {

			foreach ($invoices as $invoice) {

				$invoice = $this->set_invoice_additional($invoice, $params);

			}

		}

		else {

			$invoices = $this->set_invoice_additional($invoices, $params);

		}

		return $invoices;

	}

	public function get_recent_open($limit = 10) {

		$params = array(
			'limit'	=>	$limit,
			'where'	=>	array(
				'invoice_status_type'	=>	1,
				'invoice_is_quote'		=>	0
			),
			'having'	=>	array(
				'invoice_is_overdue'	=>	0
			),
			'active_clients_only'	=>	1
		);

		if (!$this->session->userdata('global_admin')) {

			$params['where']['mcb_invoices.user_id'] = $this->session->userdata('user_id');

		}

		return $this->get($params);

	}

	public function get_recent_pending($limit = 10) {

		$params = array(
			'limit'	=>	$limit,
			'where'	=>	array(
				'invoice_status_type'	=>	2,
				'invoice_is_quote'		=>	0
			),
			'active_clients_only'	=>	1
		);

		if (!$this->session->userdata('global_admin')) {

			$params['where']['mcb_invoices.user_id'] = $this->session->userdata('user_id');

		}

		return $this->get($params);

	}

	public function get_recent_closed($limit = 10) {

		$params = array(
			'limit'	=>	$limit,
			'where'	=>	array(
				'invoice_status_type'	=>	3,
				'invoice_is_quote'		=>	0
			),
			'active_clients_only'	=>	1
		);

		if (!$this->session->userdata('global_admin')) {

			$params['where']['mcb_invoices.user_id'] = $this->session->userdata('user_id');

		}

		return $this->get($params);

	}

	public function get_recent_overdue($limit = 10) {

		$params = array(
			'limit'	=>	$limit,
			'where'	=>	array(
				'invoice_is_quote'	=>	0
			),
			'having'	=>	array(
				'invoice_is_overdue'	=>	1
			),
			'active_clients_only'	=>	1
		);

		if (!$this->session->userdata('global_admin')) {

			$params['where']['mcb_invoices.user_id'] = $this->session->userdata('user_id');

		}

		return $this->get($params);

	}

	public function get_open() {

		$params = array(
			'where'	=>	array(
				'invoice_status_type'	=>	1,
				'invoice_is_quote'		=>	0
			),
			'having'	=>	array(
				'invoice_is_overdue'	=>	0
			),
			'active_clients_only'	=>	1
		);

		if (!$this->session->userdata('global_admin')) {

			$params['where']['mcb_invoices.user_id'] = $this->session->userdata('user_id');

		}

		return $this->get($params);

	}

	public function get_overdue() {

		$params = array(
			'where' =>  array(
				'invoice_is_quote'  =>  0
			),
			'having'    =>  array(
				'invoice_is_overdue'    =>  1
			),
			'active_clients_only'	=>	1
		);

		if (!$this->session->userdata('global_admin')) {

			$params['where']['mcb_invoices.user_id'] = $this->session->userdata('user_id');

		}

		return $this->get($params);

	}

	public function get_quotes() {

		$params = array(
			'where'	=>	array(
				'invoice_is_quote'	=>	1
			),
			'active_clients_only'	=>	1
		);

		return $this->get($params);

	}

	public function save($client_id, $date_entered, $invoice_is_quote = 0, $strtotime = TRUE) {

		if ($strtotime) {

			$date_entered = strtotime(standardize_date($date_entered));

		}

		$db_array = array(
			'client_id'					=>	$client_id,
			'invoice_date_entered'		=>	$date_entered,
			'invoice_due_date'			=>	$this->calculate_due_date($date_entered),
			'user_id'					=>	$this->session->userdata('user_id'),
			'invoice_status_id'			=>	$this->mdl_mcb_data->setting('default_open_status_id'),
			'invoice_is_quote'			=>	$invoice_is_quote
		);

		$this->db->insert($this->table_name, $db_array);

		/**
		 * Retrieve the newly created invoice id
		 */
		$invoice_id = $this->db->insert_id();

		/**
		 * Create the invoice with the default tax value
		 */

		$default_tax_rate_id = $this->mdl_mcb_userdata->setting('default_tax_rate_id');

		if (!$default_tax_rate_id) {

			$default_tax_rate_id = $this->mdl_mcb_data->setting('default_tax_rate_id');

		}

		$db_array = array(
			'invoice_id'        =>	$invoice_id,
			'tax_rate_id'       =>	$default_tax_rate_id
		);

		$default_tax_rate_option = $this->mdl_mcb_userdata->setting('default_tax_rate_option');

		if (!$default_tax_rate_option) {

			$default_tax_rate_option = $this->mdl_mcb_data->setting('default_tax_rate_option');

		}

		if ($default_tax_rate_option) {

			$db_array['tax_rate_option'] = $default_tax_rate_option;

		}

		$this->db->insert('mcb_invoice_tax_rates', $db_array);

		/**
		 * Create a history record for the action
		 */
		$this->load->model('invoices/mdl_invoice_history');

		$this->mdl_invoice_history->save($invoice_id, $this->session->userdata('user_id'), $this->lang->line('created_invoice'));

		return $invoice_id;

	}

	public function copy($invoice_id) {

		$this->load->model('mdl_invoice_amounts');
		$this->load->model('inventory/mdl_inventory_stock');

		$this->db->where('mcb_invoices.invoice_id', $invoice_id);
		$this->db->join('mcb_invoice_amounts', 'mcb_invoice_amounts.invoice_id = mcb_invoices.invoice_id');
		$invoice = $this->db->get('mcb_invoices')->row();

		$package = array(
			'client_id'				=> $invoice->client_id,
			'invoice_date_entered'	=> standardize_date(date('m/d/Y')),
			'invoice_group_id'		=> $invoice->invoice_group_id,
			'invoice_is_quote'		=> $invoice->invoice_is_quote,
			'invoice_discount'		=> $invoice->invoice_discount,
			'invoice_shipping'		=> $invoice->invoice_shipping
		);

		$new_invoice_id = $this->create_invoice($package);

		$this->db->where('invoice_id', $invoice_id);
		$items = $this->db->get('mcb_invoice_items')->result();

		foreach ($items as $item) {

			$this->save_invoice_item(
				$new_invoice_id,
				$item->item_name,
				$item->item_description,
				$item->item_qty,
				$item->item_price,
				$item->tax_rate_id,
				NULL,
				$item->is_taxable,
				$item->item_tax_option
			);

			if ($item->inventory_id) {

				$this->mdl_inventory_stock->adjust($item->inventory_id, ($item->item_qty * -1), $item->invoice_item_id);

			}

		}

		$this->db->where('invoice_id', $new_invoice_id);
		$this->db->delete('mcb_invoice_tax_rates');

		$this->db->where('invoice_id', $invoice_id);
		$invoice_tax_rates = $this->db->get('mcb_invoice_tax_rates')->result();

		foreach ($invoice_tax_rates as $tax_rate) {

			$db_array = array(
				'invoice_id'		=>	$new_invoice_id,
				'tax_rate_id'		=>	$tax_rate->tax_rate_id,
				'tax_rate_option'	=>	$tax_rate->tax_rate_option,
				'tax_amount'		=>	$tax_rate->tax_amount
			);

			$this->db->insert('mcb_invoice_tax_rates', $db_array);

		}

		$this->mdl_invoice_amounts->adjust($new_invoice_id);

		return $new_invoice_id;

	}

	public function save_invoice_options($custom_fields = NULL) {

		$invoice_id = uri_assoc('invoice_id');

		$this->db->where('invoice_id', $invoice_id);

		$db_array = array(
			'client_id'					=>	$this->input->post('client_id'),
			'invoice_date_entered'		=>	strtotime(standardize_date($this->input->post('invoice_date_entered'))),
			'invoice_notes'				=>	$this->input->post('invoice_notes'),
			'user_id'                   =>  $this->input->post('user_id'),
			'invoice_number'            =>  $this->input->post('invoice_number')
		);

		if (!$this->input->post('invoice_date_entered')) {

			unset($db_array['invoice_date_entered']);

		}

		if (is_numeric($this->input->post('invoice_status_id'))) {

			$db_array['invoice_status_id'] = $this->input->post('invoice_status_id');

		}

		if ($this->input->post('invoice_due_date')) {

			$db_array['invoice_due_date'] = strtotime(standardize_date($this->input->post('invoice_due_date')));

		}

		if ($custom_fields) {

			foreach ($custom_fields as $custom_field) {

				$db_array[$custom_field->column_name] = $this->input->post($custom_field->column_name);

			}

		}

		$this->db->update($this->table_name, $db_array);

		$this->db->where('invoice_id', $invoice_id);

		$this->db->delete('mcb_invoice_tax_rates');

		foreach ($this->input->post('tax_rate_id') as $key=>$tax_rate_id) {

			$db_array = array(
				'invoice_id'		=>	$invoice_id,
				'tax_rate_id'		=>	$tax_rate_id,
				'tax_rate_option'	=>	$_POST['tax_rate_option'][$key]
			);

			$this->db->insert('mcb_invoice_tax_rates', $db_array);

		}

		$this->load->model('mdl_invoice_tags');

		$this->mdl_invoice_tags->save_tags($invoice_id, $this->input->post('tags'));

		$db_array = array(
			'invoice_shipping'	=>	standardize_number($this->input->post('invoice_shipping')),
			'invoice_discount'	=>	standardize_number($this->input->post('invoice_discount'))
		);

		$this->db->where('invoice_id', $invoice_id);
		$this->db->update('mcb_invoice_amounts', $db_array);

		$this->load->model('invoices/mdl_invoice_history');

		$this->mdl_invoice_history->save($invoice_id, $this->session->userdata('user_id'), $this->lang->line('saved_invoice_options'));

		$this->session->set_flashdata('custom_success', $this->lang->line('invoice_options_saved'));

	}

	public function delete($invoice_id) {

		$this->db->query('DELETE FROM mcb_inventory_stock WHERE invoice_item_id IN (SELECT invoice_item_id FROM mcb_invoice_items WHERE invoice_id = ' . $invoice_id . ')');

		parent::delete(array('invoice_id'=>$invoice_id));

		$this->delete_orphans();

	}

	public function get_logos() {

		$this->load->helper('directory');

		return directory_map('./uploads/invoice_logos');

	}

	public function save_invoice_item($invoice_id, $item_name, $item_description,
		$item_qty, $item_price, $tax_rate_id = 0, $item_date = NULL,
		$is_taxable = 0, $item_tax_option = 0) {

		$item_date = ($item_date) ? strtotime(standardize_date($item_date)) : time();

		$db_array = array(
			'invoice_id'		=>	$invoice_id,
			'item_name'			=>	$item_name,
			'item_description'	=>	$item_description,
			'item_qty'			=>	$item_qty,
			'item_price'		=>	$item_price,
			'tax_rate_id'		=>	$tax_rate_id,
			'item_date'			=>	$item_date,
			'is_taxable'		=>	$is_taxable,
			'item_tax_option'	=>	$item_tax_option
		);

		$this->db->insert('mcb_invoice_items', $db_array);

		$invoice_item_id = $this->db->insert_id();

		$this->load->model('invoices/mdl_invoice_amounts');

		$this->mdl_invoice_amounts->adjust($invoice_id);

		return $invoice_item_id;

	}

	public function set_invoice_discount($invoice_id, $invoice_discount) {

		$this->db->where('invoice_id', $invoice_id);
		$this->db->set('invoice_discount', $invoice_discount);
		$this->db->update('mcb_invoice_amounts');

		$this->mdl_invoice_amounts->adjust($invoice_id);

	}

	public function set_invoice_shipping($invoice_id, $invoice_shipping) {

		$this->db->where('invoice_id', $invoice_id);
		$this->db->set('invoice_shipping', $invoice_shipping);
		$this->db->update('mcb_invoice_amounts');

		$this->mdl_invoice_amounts->adjust($invoice_id);

	}

	public function validate() {

		$this->form_validation->set_rules('client_id', $this->lang->line('client'), 'required');
		$this->form_validation->set_rules('user_id', $this->lang->line('created_by'), 'required');
		$this->form_validation->set_rules('invoice_date_entered', $this->lang->line('date_entered'), 'required');
		$this->form_validation->set_rules('invoice_date_closed', $this->lang->line('date_closed'));
		$this->form_validation->set_rules('invoice_number', $this->lang->line('invoice_number'), 'required');
		$this->form_validation->set_rules('invoice_notes', $this->lang->line('notes'));

		return parent::validate();

	}

	public function validate_create() {

		$this->form_validation->set_rules('invoice_date_entered', $this->lang->line('invoice_date'), 'required');
		$this->form_validation->set_rules('client_id_autocomplete_label', $this->lang->line('client'), 'required');
		$this->form_validation->set_rules('invoice_group_id', $this->lang->line('invoice_group'), 'required');
		$this->form_validation->set_rules('invoice_is_quote', $this->lang->line('quote_only'));

		return parent::validate();

	}

	public function validate_quote_to_invoice() {

		$this->form_validation->set_rules('invoice_date_entered', $this->lang->line('invoice_date'), 'required');
		$this->form_validation->set_rules('invoice_group_id', $this->lang->line('invoice_group'), 'required');

		return parent::validate();

	}

	public function quote_to_invoice($invoice_id, $invoice_date_entered, $invoice_group_id) {

		$this->load->model(
			array(
			'mdl_invoice_groups',
			'inventory/mdl_inventory_stock'
			)
		);

		$db_array = array(
			'invoice_is_quote'		=>	0,
			'invoice_date_entered'	=>	strtotime(standardize_date($invoice_date_entered))
		);

		$this->db->where('invoice_id', $invoice_id);
		$this->db->update('mcb_invoices', $db_array);

		$this->mdl_invoice_groups->adjust_invoice_number($invoice_id, $invoice_group_id);

		$this->db->where('invoice_id', $invoice_id);
		$items = $this->db->get('mcb_invoice_items')->result();

		foreach ($items as $item) {

			if ($item->inventory_id) {

				$this->mdl_inventory_stock->adjust($item->inventory_id, ($item->item_qty * -1), $item->invoice_item_id);

			}

		}

	}

	public function delete_invoice_file($filename) {

		if (file_exists('uploads/temp/' . $filename)) unlink('uploads/temp/' . $filename);

	}

	private function calculate_due_date($date_entered) {

		return mktime(0, 0, 0, date("m", $date_entered), date("d", $date_entered) + $this->mdl_mcb_data->setting('invoices_due_after'), date("Y", $date_entered));

	}

	public function set_invoice_additional($invoice, $params = NULL) {

		if (isset($params['get_invoice_items'])) {

			$invoice->invoice_items = $this->get_invoice_items($invoice->invoice_id);

		}

		if (isset($params['get_invoice_payments'])) {

			$invoice->invoice_payments = $this->get_invoice_payments($invoice->invoice_id);

		}

		if (isset($params['get_invoice_tax_rates'])) {

			$invoice->invoice_tax_rates = $this->get_invoice_tax_rates($invoice->invoice_id);

		}

		if (isset($params['get_invoice_item_tax_sums'])) {

			$invoice->invoice_item_tax_sums = $this->get_invoice_item_tax_sums($invoice->invoice_id);

		}

		if (isset($params['get_invoice_tags'])) {

			$invoice->invoice_tags = $this->get_invoice_tags($invoice->invoice_id);

		}

		return $invoice;

	}

	public function get_invoice_items($invoice_id) {

		$this->db->where('invoice_id', $invoice_id);
		$this->db->join('mcb_invoice_item_amounts', 'mcb_invoice_item_amounts.invoice_item_id = mcb_invoice_items.invoice_item_id');
		$this->db->join('mcb_tax_rates', 'mcb_tax_rates.tax_rate_id = mcb_invoice_items.tax_rate_id', 'LEFT');
		$this->db->order_by('item_order');

		$items = $this->db->get('mcb_invoice_items')->result();

		return $items;

	}

	public function get_invoice_payments($invoice_id) {

		$this->load->model('payments/mdl_payments');

		$params = array(
			'where'	=>	array(
				'mcb_payments.invoice_id'	=>	$invoice_id
			)
		);

		return $this->mdl_payments->get($params);

	}

	public function get_invoice_tax_rates($invoice_id) {

		$this->load->model('tax_rates/mdl_tax_rates');

		return $this->mdl_tax_rates->get_invoice_tax_rates($invoice_id);

	}

	public function get_invoice_item_tax_sums($invoice_id) {

		$this->db->select('tax_rate_name, tax_rate_percent, SUM(item_tax) AS tax_rate_sum');
		$this->db->group_by('mcb_tax_rates.tax_rate_id');
		$this->db->join('mcb_invoice_item_amounts', 'mcb_invoice_item_amounts.invoice_item_id = mcb_invoice_items.invoice_item_id');
		$this->db->join('mcb_tax_rates', 'mcb_tax_rates.tax_rate_id = mcb_invoice_items.tax_rate_id', 'LEFT');
		$this->db->where('mcb_invoice_items.invoice_id', $invoice_id);

		return $this->db->get('mcb_invoice_items')->result();


	}

	public function get_invoice_tags($invoice_id) {

		$this->load->model('invoices/mdl_invoice_tags');

		return $this->mdl_invoice_tags->get_tags($invoice_id);
		
	}

	public function get_invoice_history($invoice_id) {

		$this->load->model('invoices/mdl_invoice_history');

		$params = array(
			'where'	=>	array(
				'mcb_invoice_history.invoice_id'	=>	$invoice_id
			)
		);

		return $this->mdl_invoice_history->get($params);

	}

	public function get_total_invoice_balance($user_id = NULL) {

		$this->db->select('SUM(invoice_balance) AS total_invoice_balance');

		$this->db->join('mcb_invoices', 'mcb_invoices.invoice_id = mcb_invoice_amounts.invoice_id');

		$this->db->where('mcb_invoices.invoice_is_quote', 0);

		if ($user_id) {

			$this->db->where('mcb_invoices.user_id', $user_id);

		}

		return $this->db->get('mcb_invoice_amounts')->row()->total_invoice_balance;

	}

	public function create_invoice($package) {

		/**
		 * $package requirements
		 * - client_id
		 * - invoice_date_entered
		 * - invoice_is_quote
		 * - invoice_group_id
		 *
		 *
		 * $package optional
		 * - invoice_discount
		 * - invoice_shipping
		 * - invoice_items (array)
		 *
		 * $package['invoice_items'] requirements
		 * - item_name
		 * - item_description
		 * - item_qty
		 * - item_price
		 */

		if (!is_array($package)) {

			return FALSE;

		}

		$required_elements = array(
			'client_id',
			'invoice_date_entered',
			'invoice_group_id'
		);

		foreach ($required_elements as $req_el) {

			if (!isset($package[$req_el])) {

				return FALSE;

			}

		}

		extract($package);

		if (!isset($invoice_is_quote)) {

			$invoice_is_quote = 0;

		}

		$invoice_id = $this->save($client_id, $invoice_date_entered, $invoice_is_quote);

		if (isset($invoice_items)) {

			foreach ($invoice_items as $invoice_item) {

				unset($item_name, $item_description, $item_qty, $item_price);

				extract($invoice_item);

				$this->save_invoice_item($invoice_id, $item_name, $item_description, $item_qty, $item_price);

			}

		}

		$this->load->model('invoices/mdl_invoice_amounts');
		$this->mdl_invoice_amounts->adjust($invoice_id);

		$this->load->model('invoices/mdl_invoice_groups');
		$this->mdl_invoice_groups->adjust_invoice_number($invoice_id, $invoice_group_id);

		if (isset($invoice_discount)) {

			$this->set_invoice_discount($invoice_id, $invoice_discount);

		}

		if (isset($invoice_shipping)) {

			$this->set_invoice_shipping($invoice_id, $invoice_shipping);

		}

		return $invoice_id;

	}

	public function add_invoice_item($package) {

		if (!is_array($package)) {

			return FALSE;

		}

		extract($package);

		$required_elements = array(
			'invoice_id',
			'item_name',
			'item_description',
			'item_qty',
			'item_price'
		);

		foreach ($required_elements as $req_el) {

			if (!isset($package[$req_el])) {

				return FALSE;

			}

		}

		$tax_rate_id = (isset($tax_rate_id) ? $tax_rate_id : 0);

		$invoice_item_id = $this->save_invoice_item($invoice_id, $item_name, $item_description, $item_qty, $item_price, $tax_rate_id);

		return $invoice_item_id;

	}

	public function lock_invoice($invoice_id) {

		$this->db->set('invoice_is_locked', 1);
		$this->db->where('invoice_id', $invoice_id);
		$this->db->update('mcb_invoices');

	}

	public function unlock_invoice($invoice_id) {

		$this->db->set('invoice_is_locked', 0);
		$this->db->where('invoice_id', $invoice_id);
		$this->db->update('mcb_invoices');

	}

	public function invoice_is_locked($invoice_id) {

		$this->db->select('invoice_is_locked');
		$this->db->where('invoice_id', $invoice_id);

		return $this->db->get('mcb_invoices')->row()->invoice_is_locked;

	}

	public function delete_orphans() {

		$this->db->query('DELETE FROM mcb_invoices WHERE client_id NOT IN (SELECT client_id FROM mcb_clients)');
		$this->db->query('DELETE FROM mcb_contacts WHERE client_id NOT IN (SELECT client_id FROM mcb_clients)');
		$this->db->query('DELETE FROM mcb_client_data WHERE client_id NOT IN (SELECT client_id FROM mcb_clients)');
		$this->db->query('DELETE FROM mcb_inventory_stock WHERE inventory_id NOT IN (SELECT inventory_id FROM mcb_inventory)');
		$this->db->query('DELETE FROM mcb_invoice_amounts WHERE invoice_id NOT IN (SELECT invoice_id FROM mcb_invoices)');
		$this->db->query('DELETE FROM mcb_invoice_history WHERE invoice_id NOT IN (SELECT invoice_id FROM mcb_invoices)');
		$this->db->query('DELETE FROM mcb_invoice_items WHERE invoice_id NOT IN (SELECT invoice_id FROM mcb_invoices)');
		$this->db->query('DELETE FROM mcb_invoice_item_amounts WHERE invoice_item_id NOT IN (SELECT invoice_item_id FROM mcb_invoice_items)');
		$this->db->query('DELETE FROM mcb_invoice_tags WHERE invoice_id NOT IN (SELECT invoice_id FROM mcb_invoices)');
		$this->db->query('DELETE FROM mcb_invoice_tax_rates WHERE invoice_id NOT IN (SELECT invoice_id FROM mcb_invoices)');
		$this->db->query('DELETE FROM mcb_payments WHERE invoice_id NOT IN (SELECT invoice_id FROM mcb_invoices)');
		$this->db->query('DELETE FROM mcb_tags WHERE tag_id NOT IN (SELECT tag_id FROM mcb_invoice_tags)');

	}

}

?>