<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Account extends Client_Center_Controller {

	function __construct() {

		parent::__construct('client_id');

		$this->load->model('mdl_client_account');

		$this->_post_handler();

	}

	function index() {

		if ($this->mdl_client_account->validate()) {

			$this->mdl_client_account->save();

			redirect('client_center/account');

		}

		else {

			if (!$_POST) {

				$this->mdl_client_account->prep_validation($this->session->userdata('client_id'));

			}

			$data = array(
				'client_name'	=>	$this->session->userdata('client_name')
			);

			$this->load->view('account_form', $data);

		}

	}

	function change_password() {

		if (!$this->mdl_client_account->validate_change_password()) {

			$this->load->view('account_change_pw');

		}

		else {

			$this->mdl_client_account->save_change_password($this->input->post('password'));

			redirect('client_center/account');

		}

	}

	function _post_handler() {

		if ($this->input->post('btn_cancel')) {

			redirect('client_center');

		}

	}

}

?>