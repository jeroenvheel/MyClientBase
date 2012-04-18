<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_Client_Center extends MY_Model {

	public function __construct() {

		parent::__construct();

		$this->table_name = 'mcb_users';

		$this->primary_key = 'mcb_users.user_id';

		$this->select_fields = 'SQL_CALC_FOUND_ROWS
			mcb_users.*,
			mcb_clients.*';

		$this->joins = array(
			'mcb_clients'	=> 'mcb_clients.client_id = mcb_users.client_id'
		);

	}

	public function validate() {

		$this->form_validation->set_rules('client_id_autocomplete_label');
		$this->form_validation->set_rules('client_id', $this->lang->line('client'), 'required');
		$this->form_validation->set_rules('username', $this->lang->line('username'), 'required|callback_username_check');
		$this->form_validation->set_rules('password', $this->lang->line('password'), 'required');
		$this->form_validation->set_rules('passwordv', $this->lang->line('passwordv'), 'required|matches[password]');
		$this->form_validation->set_rules('email_address', $this->lang->line('email_address'), 'required');

		return parent::validate($this);

	}

	public function username_check($username) {

		$this->db->where('username', $username);

		if (uri_assoc('user_id', 4)) {

			$this->db->where('user_id <>', uri_assoc('user_id', 4));

		}

		$query = $this->db->get('mcb_users');

		if ($query->num_rows()) {

			$this->form_validation->set_message('username_check', $this->lang->line('username_already_exists'));

			return FALSE;

		}

		return TRUE;

	}

	public function save($db_array, $user_id = NULL) {

		unset($db_array['passwordv']);
		unset($db_array['client_id_autocomplete_label']);

		$db_array['password'] = md5($db_array['password']);

		parent::save($db_array, $user_id);

	}

	public function prep_validation($client_id) {

		parent::prep_validation($client_id);

		$this->form_values['client_id_autocomplete_label'] = $this->form_values['client_name'];

	}

	public function invoice_belongs_to_client($invoice_id, $client_id) {

		$this->db->where('invoice_id', $invoice_id);

		$this->db->where('client_id', $client_id);

		$query = $this->db->get('mcb_invoices');

		if ($query->num_rows()) {

			return TRUE;

		}

		return FALSE;

	}

}

?>
