<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_Client_Account extends MY_Model {

	function __construct() {

		parent::__construct();

		$this->table_name = 'mcb_clients';

		$this->primary_key = 'mcb_clients.client_id';

		$this->select_fields = '*';

	}

	function get() {

		$params = array(
			'where'	=>	array(
				'mcb_clients.client_id'	=>	$this->session->userdata('client_id')
			)
		);

		return parent::get($params);

	}

	function validate() {

		$this->form_validation->set_rules('client_tax_id', $this->lang->line('tax_id_number'));
		$this->form_validation->set_rules('client_address', $this->lang->line('street_address'));
		$this->form_validation->set_rules('client_address_2', $this->lang->line('street_address_2'));
		$this->form_validation->set_rules('client_city', $this->lang->line('city'));
		$this->form_validation->set_rules('client_state', $this->lang->line('state'));
		$this->form_validation->set_rules('client_zip', $this->lang->line('zip'));
		$this->form_validation->set_rules('client_country', $this->lang->line('country'));
		$this->form_validation->set_rules('client_phone_number', $this->lang->line('phone_number'));
		$this->form_validation->set_rules('client_fax_number',	$this->lang->line('fax_number'));
		$this->form_validation->set_rules('client_mobile_number', $this->lang->line('mobile_number'));
		$this->form_validation->set_rules('client_email_address', $this->lang->line('email_address'), 'valid_email');
		$this->form_validation->set_rules('client_web_address', $this->lang->line('web_address'));

		return parent::validate();

	}

	function save() {

		$db_array = parent::db_array();

		parent::save($db_array, $this->session->userdata('client_id'));

	}

	function validate_change_password() {

		$this->form_validation->set_rules('password', $this->lang->line('password'), 'required');
		$this->form_validation->set_rules('passwordv', $this->lang->line('password_verify'), 'required|matches[password]');

		return parent::validate();

	}

	function save_change_password($password) {

		$this->db->set('password', md5($password));

		$this->db->where('client_id', $this->session->userdata('client_id'));

		$this->db->update('mcb_users');

		$this->session->set_flashdata('success_save', TRUE);

	}

}

?>