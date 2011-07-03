<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_Client_Center extends MY_Model {

	function __construct() {

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

	function validate() {

		$this->form_validation->set_rules('client_id', $this->lang->line('client'), 'required');
		$this->form_validation->set_rules('username', $this->lang->line('username'), 'required');
		$this->form_validation->set_rules('password', $this->lang->line('password'), 'required');
		$this->form_validation->set_rules('passwordv', $this->lang->line('passwordv'), 'required|matches[password]');

		return parent::validate($this);

	}

	function save($db_array, $user_id = NULL) {

		unset($db_array['passwordv']);

		$db_array['password'] = md5($db_array['password']);

		parent::save($db_array, $user_id);

	}

	function invoice_belongs_to_client($invoice_id, $client_id) {

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
