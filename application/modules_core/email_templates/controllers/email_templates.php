<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Email_Templates extends Admin_Controller {

	function __construct() {

		parent::__construct();

		$this->_post_handler();

		$this->load->model('mdl_email_templates');

	}

	function index() {

		$this->redir->set_last_index();

		$params = array(
			'paginate'	=>	TRUE,
			'page'		=>	uri_assoc('page')
		);

		$data = array(
			'email_templates' =>	$this->mdl_email_templates->get($params),
		);

		$this->load->view('index', $data);

	}

	function form() {

		if (!$this->mdl_email_templates->validate()) {

			if (!$_POST AND uri_assoc('email_template_id')) {

				$this->mdl_email_templates->prep_validation(uri_assoc('email_template_id'));

			}

			$this->load->view('form');

		}

		else {

			$this->mdl_email_templates->save($this->mdl_email_templates->db_array(), uri_assoc('email_template_id'));

			$this->redir->redirect('email_templates');

		}

	}

	function delete() {

		$this->mdl_email_templates->delete_by_id(uri_assoc('email_template_id'));

		$this->redir->redirect('email_templates');

	}

	function _post_handler() {

		if ($this->input->post('btn_add')) {

			redirect('email_templates/form');

		}

		elseif ($this->input->post('btn_cancel')) {

			redirect('email_templates/index');

		}

	}

}

?>