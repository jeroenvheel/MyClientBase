<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Tax_Rates extends Admin_Controller {

	function __construct() {

		parent::__construct();

		$this->_post_handler();

		$this->load->model('mdl_tax_rates');

	}

	function index() {

		$this->redir->set_last_index();

		$params = array(
			'paginate'	=>	TRUE,
			'page'		=>	uri_assoc('page')
		);

		$data = array(
			'tax_rates' =>	$this->mdl_tax_rates->get($params),
		);

		$this->load->view('index', $data);

	}

	function form() {

		if (!$this->mdl_tax_rates->validate()) {

			if (!$_POST AND uri_assoc('tax_rate_id')) {

				$this->mdl_tax_rates->prep_validation(uri_assoc('tax_rate_id'));

			}

			$this->load->view('form');

		}

		else {

			$this->mdl_tax_rates->save($this->mdl_tax_rates->db_array(), uri_assoc('tax_rate_id'));

			$this->redir->redirect('tax_rates');

		}

	}

	function delete() {

		if (uri_assoc('tax_rate_id')) {

			$this->mdl_tax_rates->delete(uri_assoc('tax_rate_id'));

		}

		$this->redir->redirect('tax_rates');

	}

	function _post_handler() {

		if ($this->input->post('btn_add')) {

			redirect('tax_rates/form');

		}

		elseif ($this->input->post('btn_cancel')) {

			redirect('tax_rates/index');

		}

	}

}

?>