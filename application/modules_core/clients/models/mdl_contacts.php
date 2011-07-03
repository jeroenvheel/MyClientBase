<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_Contacts extends MY_Model {

	public function __construct() {

		parent::__construct();

		$this->table_name = 'mcb_contacts';

		$this->select_fields = "SQL_CALC_FOUND_ROWS *";

		$this->primary_key = 'mcb_contacts.contact_id';

		$this->order_by = 'last_name, first_name';

		$this->custom_fields = $this->mdl_fields->get_object_fields(4);

	}

	public function validate() {

		$this->form_validation->set_rules('last_name', $this->lang->line('last_name'), 'required');
		$this->form_validation->set_rules('first_name', $this->lang->line('first_name'), 'required');
		$this->form_validation->set_rules('address', $this->lang->line('street_address'));
		$this->form_validation->set_rules('address_2', $this->lang->line('street_address_2'));
		$this->form_validation->set_rules('city', $this->lang->line('city'));
		$this->form_validation->set_rules('state', $this->lang->line('state'));
		$this->form_validation->set_rules('zip', $this->lang->line('zip'));
		$this->form_validation->set_rules('country', $this->lang->line('country'));
		$this->form_validation->set_rules('phone_number', $this->lang->line('phone_number'));
		$this->form_validation->set_rules('fax_number', $this->lang->line('fax_number'));
		$this->form_validation->set_rules('mobile_number', $this->lang->line('mobile_number'));
		$this->form_validation->set_rules('email_address', $this->lang->line('email_address'));
		$this->form_validation->set_rules('web_address', $this->lang->line('web_address'));
		$this->form_validation->set_rules('notes', $this->lang->line('notes'));

		foreach ($this->custom_fields as $custom_field) {

			$this->form_validation->set_rules($custom_field->column_name, $custom_field->field_name);

		}

		return parent::validate();

	}

	public function db_array() {

		$db_array = parent::db_array();

		$db_array['client_id'] = uri_assoc('client_id', 4);

		return $db_array;

	}


	public function delete($client_id, $contact_id) {

		$this->db->where('client_id', $client_id);

		$this->db->where('contact_id', $contact_id);

		$this->db->delete('mcb_contacts');

		$this->session->set_flashdata('success_delete', TRUE);

	}

}

?>