<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Admin extends Admin_Controller {

	function __construct() {

		parent::__construct();

		$this->load->model('mdl_client_center');

		$this->_post_handler();

	}

	function index() {

		$params = array(
			'paginate'	=>	TRUE,
			'limit'		=>	20,
			'page'		=>	uri_assoc('page', 4)
		);

		$data = array(
			'client_accounts'	=>	$this->mdl_client_center->get($params)
		);

		$this->load->view('admin_index', $data);

	}
	
	function form() {

		if (!$this->mdl_client_center->validate()) {

			if (!$_POST AND uri_assoc('user_id', 4)) {

				$this->mdl_client_center->prep_validation(uri_assoc('user_id', 4));

			}

			$this->load->model('clients/mdl_clients');

			$this->load->view('admin_form');

		}

		else {

			$this->mdl_client_center->save($this->mdl_client_center->db_array(), uri_assoc('user_id', 4));

			$this->redir->redirect('client_center/admin');

		}

	}

	function delete() {

		$this->mdl_client_center->delete(array('user_id'=>uri_assoc('user_id', 4)));

		redirect('client_center/admin');

	}

	function _post_handler() {

		if ($this->input->post('btn_add_account')) {

			redirect('client_center/admin/form');

		}

		elseif ($this->input->post('btn_cancel')) {

			redirect('client_center/admin');

		}

	}

}

?>