<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_Fields extends MY_Model {

	public function __construct() {

		parent::__construct();

		$this->table_name = 'mcb_fields';

		$this->primary_key = 'mcb_fields.field_id';

		$this->select_fields = "
		SQL_CALC_FOUND_ROWS *";

		$this->limit = $this->mdl_mcb_data->setting('results_per_page');

		$this->order_by = 'object_id, field_name';

		$this->objects = array(
			1	=>	$this->lang->line('invoices'),
			2	=>	$this->lang->line('invoice_items'),
			3	=>	$this->lang->line('clients'),
			4	=>	$this->lang->line('contacts'),
			5	=>	$this->lang->line('payments'),
            6   =>  $this->lang->line('user_accounts')
		);

		$this->object_tables = array(
			1	=>	'mcb_invoices',
			2	=>	'mcb_invoice_items',
			3	=>	'mcb_clients',
			4	=>	'mcb_contacts',
			5	=>	'mcb_payments',
            6   =>  'mcb_users'
		);

		$this->column_prefixes = array(
			1	=>	'invoice_',
			2	=>	'invoice_item_',
			3	=>	'client_',
			4	=>	'contact_',
			5	=>	'payment_',
            6   =>  'user_'
		);

	}

	public function validate() {

		$this->form_validation->set_rules('object_id', $this->lang->line('object'), 'required');
		$this->form_validation->set_rules('field_name', $this->lang->line('field_name'), 'required');

		return parent::validate();

	}

	public function delete($field_id) {

		$this->db->where('field_id', $field_id);

		$field = $this->db->get('mcb_fields')->row();

		$this->drop_column($field->object_id, 'custom_' . $field->field_index);

		parent::delete(array('field_id'=>$field_id));

	}

	public function save() {

		$db_array = parent::db_array();

		$field_id = uri_assoc('field_id');

		if (!$field_id) {

			$field_index = $this->get_next_field_index($db_array['object_id']);

			$column_name = $this->column_prefixes[$db_array['object_id']] . 'custom_' . $field_index;

			$this->add_column($db_array['object_id'], $column_name);



		}

		else {

			$field_index = $this->get_current_field_index($field_id);

			$column_name = $this->column_prefixes[$db_array['object_id']] . 'custom_' . $field_index;

		}

		$db_array['field_index'] = $field_index;

		$db_array['column_name'] = $column_name;

		parent::save($db_array, $field_id);

	}

	function add_column($object_id, $column_name) {

		$this->load->dbforge();

		$table = $this->object_tables[$object_id];

		$fields = array(
			$column_name	=>	array('type'=>'VARCHAR','constraint'=>255)
		);

		$this->dbforge->add_column($table, $fields);

	}

	function drop_column($object_id, $column_name) {

		$this->load->dbforge();

		$table = $this->object_tables[$object_id];

		$column_name = $this->column_prefixes[$object_id] . $column_name;

		if ($this->db->field_exists($column_name, $table)) {

			$this->dbforge->drop_column($table, $column_name);

		}

	}

	function get_next_field_index($object_id) {

		$this->db->select('IFNULL(MAX(field_index) + 1, 1) AS max_field_index', FALSE);

		$this->db->where('object_id', $object_id);

		return $this->db->get('mcb_fields')->row()->max_field_index;

	}

	function get_current_field_index($field_id) {

		$this->db->select('field_index');

		$this->db->where('field_id', $field_id);

		$query = $this->db->get('mcb_fields');

		return $query->row()->field_index;

	}

	function get_object_fields($object_id) {

		$params = array(
			'where'	=>	array(
				'mcb_fields.object_id'	=>	$object_id
			)
		);

		return parent::get($params);

	}

}

?>