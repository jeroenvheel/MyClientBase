<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Client_Credits extends Admin_Controller {

	function __construct() {

		parent::__construct();

		$this->_post_handler();

		$this->load->model('mdl_client_credits');

	}

	function index() {

		$this->redir->set_last_index();

		$page = (uri_assoc('page', 4)) ? uri_assoc('page', 4) : 0;

		$params = array(
			'limit'		=>	$this->mdl_mcb_data->setting('results_per_page'),
			'paginate'	=>	TRUE,
			'page'		=>	$page
		);

		$data = array(
			'client_credits' =>	$this->mdl_client_credits->get($params)
		);

		$this->load->view('client_credit_index', $data);

	}

	function form() {

		if (!$this->mdl_client_credits->validate()) {

			$this->load->model('clients/mdl_clients');

			if (!$_POST AND uri_assoc('client_credit_id', 4)) {

				$this->mdl_client_credits->prep_validation(uri_assoc('client_credit_id', 4));

			}

			elseif (!$_POST) {

				$this->mdl_client_credits->set_date();

			}

			$this->load->view('client_credit_form');

		}

		else {

			$this->mdl_client_credits->save($this->mdl_client_credits->db_array(), uri_assoc('client_credit_id', 4));

			$this->redir->redirect('payments/client_credits');

		}

	}

	function delete() {

		if (uri_assoc('client_credit_id', 4)) {

			$this->mdl_client_credits->delete(array('client_credit_id'=>uri_assoc('client_credit_id', 4)));

		}

		$this->redir->redirect('payments/client_credits');

	}

	function _post_handler() {

		if ($this->input->post('btn_add')) {

			redirect('payments/client_credits/form');

		}

		elseif ($this->input->post('btn_cancel')) {

			redirect('payments/client_credits/index');

		}

	}

}

?>