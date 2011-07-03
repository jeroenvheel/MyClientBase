<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Contacts extends Admin_Controller {

	function __construct() {

		parent::__construct();

		$this->_post_handler();

		$this->load->model('mdl_contacts');

	}


	function form() {

		if (!$this->mdl_contacts->validate()) {

			$this->load->helper('form');

			if (!$_POST AND uri_assoc('contact_id', 4)) {

				$this->mdl_contacts->prep_validation(uri_assoc('contact_id', 4));

			}

			$data = array(
				'custom_fields'	=>	$this->mdl_contacts->custom_fields
			);

			$this->load->view('contact_form', $data);

		}

		else {

			$this->mdl_contacts->save($this->mdl_contacts->db_array(), uri_assoc('contact_id', 4));

			$this->session->set_flashdata('tab_index', 1);

			$this->redir->redirect('clients/details/client_id/' . uri_assoc('client_id', 4));

		}

	}

	function details() {

		$this->redir->set_last_index();

		$this->load->model('mdl_contacts');

		$contact = $this->mdl_contacts->get(array('where'=>array('mcb_contacts.contact_id'=>uri_assoc('contact_id', 4))));

		$data = array(
			'contact'		=>	$contact);

		$this->load->view('contact_details', $data);

	}

	function delete() {

		if (uri_assoc('contact_id', 4) and uri_assoc('client_id', 4)) {

			$this->mdl_contacts->delete(uri_assoc('client_id', 4), uri_assoc('contact_id', 4));

		}

		$this->session->set_flashdata('tab_index', 1);

		$this->redir->redirect('clients/details/client_id/' . uri_assoc('client_id', 4));

	}

	function _post_handler() {

		if ($this->input->post('btn_add')) {

			redirect('contacts/form');

		}

		elseif ($this->input->post('btn_cancel')) {

			$this->session->set_flashdata('tab_index', 1);

			$this->redir->redirect('clients/details/client_id/' . uri_assoc('client_id', 4));

		}

	}

}

?>