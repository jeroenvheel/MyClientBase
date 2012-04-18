<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_Email_Templates extends MY_Model {

	public function __construct() {

		parent::__construct();

		$this->table_name = 'mcb_email_templates';

		$this->primary_key = 'mcb_email_templates.email_template_id';

		$this->select_fields = "
		SQL_CALC_FOUND_ROWS mcb_email_templates.*";

		$this->order_by = 'email_template_title';

		$this->limit = $this->mdl_mcb_data->setting('results_per_page');

	}

	public function get_list() {

		$this->db->select('email_template_id, email_template_title');
		$this->db->order_by('email_template_title');

		return $this->db->get('mcb_email_templates')->result();

	}

	public function validate() {

		$this->form_validation->set_rules('email_template_title', $this->lang->line('email_template_title'), 'required');
		$this->form_validation->set_rules('email_template_body', $this->lang->line('email_body'));
		$this->form_validation->set_rules('email_template_footer', $this->lang->line('email_footer'));

		return parent::validate();

	}

}

?>