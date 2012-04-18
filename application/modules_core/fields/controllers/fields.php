<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Fields extends Admin_Controller {

	function __construct() {

		parent::__construct();

		$this->_post_handler();

	}

	function index() {

		$this->redir->set_last_index();

		$data = array(
			'fields'	=>	$this->mdl_fields->get(),
			'objects'	=>	$this->mdl_fields->objects
		);

		$this->load->view('index', $data);

	}

	function form() {

		$field_id = uri_assoc('field_id');

		if (!$this->mdl_fields->validate()) {

			if (!$_POST AND $field_id) {

				$this->mdl_fields->prep_validation($field_id);

			}

			$data = array(
				'objects'	=>	$this->mdl_fields->objects,
				'field_id'	=>	$field_id
			);

			$this->load->view('form', $data);

		}

		else {

			$this->mdl_fields->save();

			$this->redir->redirect('fields');

		}

	}

	function delete() {

		if (uri_assoc('field_id')) {

			$this->mdl_fields->delete(uri_assoc('field_id'));

		}

		$this->redir->redirect('fields');

	}

	function _post_handler() {

		if ($this->input->post('btn_add')) {

			redirect('fields/form');

		}

		elseif ($this->input->post('btn_cancel')) {

			redirect('fields/index');

		}

	}

}

?>