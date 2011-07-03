<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_Users extends MY_Model {

	public function __construct() {

		parent::__construct();

		$this->table_name = 'mcb_users';

		$this->primary_key = 'mcb_users.user_id';

		$this->select_fields = "
		SQL_CALC_FOUND_ROWS *";

		$this->order_by = 'last_name, first_name';

        $this->custom_fields = $this->mdl_fields->get_object_fields(6);

	}

	public function validate() {

		$this->form_validation->set_rules('global_admin', $this->lang->line('global_administrator'));
		$this->form_validation->set_rules('username', $this->lang->line('username'), 'required');

		if (!uri_assoc('user_id')) {

			$this->form_validation->set_rules('password', $this->lang->line('password'), 'required');
			$this->form_validation->set_rules('passwordv', $this->lang->line('password_verify'), 'required|matches[password]');

		}

		$this->form_validation->set_rules('company_name', $this->lang->line('company_name'));
		$this->form_validation->set_rules('first_name', $this->lang->line('first_name'), 'required');
		$this->form_validation->set_rules('last_name', $this->lang->line('last_name'), 'required');
		$this->form_validation->set_rules('address', $this->lang->line('street_address'));
		$this->form_validation->set_rules('address_2', $this->lang->line('street_address_2'));
		$this->form_validation->set_rules('city', $this->lang->line('city'));
		$this->form_validation->set_rules('state', $this->lang->line('state'));
		$this->form_validation->set_rules('zip', $this->lang->line('zip'));
		$this->form_validation->set_rules('country', $this->lang->line('country'));
		$this->form_validation->set_rules('phone_number', $this->lang->line('phone_number'));
		$this->form_validation->set_rules('fax_number',	$this->lang->line('fax_number'));
		$this->form_validation->set_rules('mobile_number', $this->lang->line('mobile_number'));
		$this->form_validation->set_rules('email_address', $this->lang->line('email_address'));
		$this->form_validation->set_rules('web_address', $this->lang->line('web_address'));
		$this->form_validation->set_rules('tax_id_number', $this->lang->line('tax_id_number'));

		foreach ($this->custom_fields as $custom_field) {

			$this->form_validation->set_rules($custom_field->column_name, $custom_field->field_name);

		}
		
		return parent::validate();

	}

	public function db_array() {

		$db_array = parent::db_array();

		if (isset($db_array['password'])) {

			$db_array['password'] = md5($db_array['password']);

		}

		if (!$this->input->post('global_admin')) {

			$db_array['global_admin'] = 0;

		}

		unset($db_array['passwordv']);

		return $db_array;

	}

	public function validate_change_password() {

		$this->form_validation->set_rules('new_password', $this->lang->line('new_password'), 'required');
		$this->form_validation->set_rules('new_passwordv', $this->lang->line('new_password_verify'), 'required|matches[new_password]');

		return parent::validate();

	}

	public function save_change_password() {

		if (uri_assoc('user_id')) {

			$this->db->where('user_id', uri_assoc('user_id'));

			$db_array = array(
				'password'	=>	md5($this->input->post('new_password'))
			);

			$this->db->update('mcb_users', $db_array);

		}

	}

	public function get_email_address($user_id) {

		$this->db->select('email_address');

		$this->db->where('user_id', $user_id);

		return $this->db->get('mcb_users')->row()->email_address;

	}

}

?>