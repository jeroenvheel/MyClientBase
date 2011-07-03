<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_Client_Sessions extends MY_Model {

	function validate() {

		$this->load->library('form_validation');

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		$this->form_validation->set_rules('username', $this->lang->line('username'), 'required');

		$this->form_validation->set_rules('password', $this->lang->line('password'), 'required|md5');

		return parent::validate();

	}

}

?>