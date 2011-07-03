<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_Invoices extends MY_Model {

    public $date_formats;

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
		mcb_users.web_address AS from_web_address,
		mcb_invoice_statuses.*,
        IF(mcb_invoice_statuses.invoice_status_type <> 3, IF(mcb_invoices.invoice_due_date < UNIX_TIMESTAMP(), 1, 0), 0) AS invoice_is_overdue,
		(DATEDIFF(FROM_UNIXTIME(UNIX_TIMESTAMP()),FROM_UNIXTIME(mcb_invoices.invoice_due_date))) AS invoice_days_overdue";

        $user_custom_fields = $this->mdl_fields->get_object_fields(6);

        if ($user_custom_fields) {

            $this->select_fields .= ',';

            $ucf = array();

            foreach ($user_custom_fields as $user_custom_field) {

                $ucf[] = 'mcb_users.' . $user_custom_field->column_name;

            }

            $this->select_fields .= implode(',', $ucf);

        }

        if ($this->mdl_mcb_data->setting('version') >= '0.8.9') {

            $this->select_fields .= ', mcb_users.tax_id_number AS from_tax_id_number';

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
            'mcb_clients'			=>	'mcb_clients.client_id = mcb_invoices.client_id'
        );

        $this->date_formats = array(
            'm/d/Y'		=>	array(
                'key'		=>	'm/d/Y',
                'picker'	=>	'mm/dd/yy',
                'mask'		=>	'99/99/9999',
                'dropdown'	=>	'mm/dd/yyyy'),
            'm/d/y'		=>	array(
                'key'		=>	'm/d/y',
                'picker'	=>	'mm/dd/y',
                'mask'		=>	'99/99/99',
                'dropdown'	=>	'mm/dd/yy'),
            'Y/m/d'		=>	array(
                'key'		=>	'Y/m/d',
                'picker'	=>	'yy/mm/dd',
                'mask'		=>	'9999/99/99',
                'dropdown'	=>	'yyyy/mm/dd'),
            'd/m/Y'		=>	array(
                'key'		=>	'd/m/Y',
                'picker'	=>	'dd/mm/yy',
                'mask'		=>	'99/99/9999',
                'dropdown'	=>	'dd/mm/yyyy'),
            'd/m/y'		=>	array(
                'key'		=>	'd/m/y',
                'picker'	=>	'dd/mm/y',
                'mask'		=>	'99/99/99',
                'dropdown'	=>	'dd/mm/yy'),
            'm-d-Y'		=>	array(
                'key'		=>	'm-d-Y',
                'picker'	=>	'mm-dd-yy',
                'mask'		=>	'99-99-9999',
                'dropdown'	=>	'mm-dd-yyyy'),
            'm-d-y'		=>	array(
                'key'		=>	'm-d-y',
                'picker'	=>	'mm-dd-y',
                'mask'		=>	'99-99-99',
                'dropdown'	=>	'mm-dd-yy'),
            'Y-m-d'		=>	array(
                'key'		=>	'Y-m-d',
                'picker'	=>	'yy-mm-dd',
                'mask'		=>	'9999-99-99',
                'dropdown'	=>	'yyyy-mm-dd'),
            'y-m-d'		=>	array(
                'key'		=>	'y-m-d',
                'picker'	=>	'y-mm-dd',
                'mask'		=>	'99-99-99',
                'dropdown'	=>	'yy-mm-dd'),
            'd.m.Y'		=>	array(
                'key'		=>	'd.m.Y',
                'picker'	=>	'dd.mm.yy',
                'mask'		=>	'99.99.9999',
                'dropdown'	=>	'dd.mm.yyyy'),
            'd.m.y'		=>	array(
                'key'		=>	'd.m.y',
                'picker'	=>	'dd.mm.y',
                'mask'		=>	'99.99.99',
                'dropdown'	=>	'dd.mm.yy')
        );

    }

    public function get($params = NULL) {

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
            )
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
            )
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
            )
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
            )
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
            )
        );

        if (!$this->session->userdata('global_admin')) {

            $params['where']['mcb_invoices.user_id'] = $this->session->userdata('user_id');

        }

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

        $invoice_id = $this->db->insert_id();

        $db_array = array(
            'invoice_id'        =>	$invoice_id,
            'tax_rate_id'       =>	$this->mdl_mcb_data->setting('default_tax_rate_id')
        );

        $default_tax_rate_option = $this->mdl_mcb_data->setting('default_tax_rate_option');

        if ($default_tax_rate_option) {

            $db_array['tax_rate_option'] = $default_tax_rate_option;

        }

        $this->db->insert('mcb_invoice_tax_rates', $db_array);

        $this->save_invoice_history($invoice_id, $this->session->userdata('user_id'), $this->lang->line('created_invoice'));

        return $invoice_id;

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

        $this->save_invoice_history($invoice_id, $this->session->userdata('user_id'), $this->lang->line('saved_invoice_options'));

        $this->session->set_flashdata('custom_success', $this->lang->line('invoice_options_saved'));

    }

    public function delete($invoice_id) {

        $this->db->query('DELETE FROM mcb_inventory_stock WHERE invoice_item_id IN (SELECT invoice_item_id FROM mcb_invoice_items WHERE invoice_id = ' . $invoice_id . ')');

        parent::delete(array('invoice_id'=>$invoice_id));

        $this->db->where('invoice_id', $invoice_id);

        $this->db->delete(
            array(
            'mcb_invoice_items',
            'mcb_payments',
            'mcb_invoice_amounts',
            'mcb_invoice_tax_rates',
            'mcb_invoice_history',
            'mcb_invoice_tax_rates'
            )
        );

        $this->db->query('DELETE FROM mcb_invoice_item_amounts WHERE invoice_item_id NOT IN (SELECT invoice_item_id FROM mcb_invoice_items)');

        $this->save_invoice_history($invoice_id, $this->session->userdata('user_id'), $this->lang->line('deleted_invoice'));

    }

    public function get_logos() {

        $this->load->helper('directory');

        return directory_map('./uploads/invoice_logos');

    }

    public function add_invoice_item($invoice_id, $item_name, $item_description, $item_qty, $item_price, $tax_rate_id = 0, $item_date = NULL) {

        $item_date = ($item_date) ? strtotime(standardize_date($item_date)) : time();

        $db_array = array(
            'invoice_id'		=>	$invoice_id,
            'item_name'			=>	$item_name,
            'item_description'	=>	$item_description,
            'item_qty'			=>	$item_qty,
            'item_price'		=>	$item_price,
            'tax_rate_id'		=>	$tax_rate_id,
            'item_date'			=>	$item_date
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
        $this->form_validation->set_rules('client_id', $this->lang->line('client'), 'required');
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

        $db_array = array(
            'invoice_is_quote'		=>	0,
            'invoice_date_entered'	=>	strtotime(standardize_date($invoice_date_entered))
        );

        $this->db->where('invoice_id', $invoice_id);

        $this->db->update('mcb_invoices', $db_array);

        $this->load->model('mdl_invoice_groups');

        $this->mdl_invoice_groups->adjust_invoice_number($invoice_id, $invoice_group_id);

    }

    public function delete_invoice_file($filename) {

        if (file_exists('uploads/temp/' . $filename)) unlink('uploads/temp/' . $filename);

    }

    public function save_invoice_history($invoice_id, $user_id, $invoice_history_data) {

        if (!$this->mdl_mcb_data->setting('disable_invoice_audit_history')) {

            $db_array = array(
                'invoice_id'			=>	$invoice_id,
                'user_id'				=>	$user_id,
                'invoice_history_date'	=>	time(),
                'invoice_history_data'	=>	$invoice_history_data
            );

            $this->db->insert('mcb_invoice_history', $db_array);

        }

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

        if ($this->mdl_mcb_data->setting('version') >= '0.8') {

            $this->load->model('invoices/mdl_invoice_tags');

            return $this->mdl_invoice_tags->get_tags($invoice_id);

        }

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

}

?>