<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Payment_Methods extends Admin_Controller {

	function __construct() {

		parent::__construct();

		$this->_post_handler();

		$this->load->model('mdl_payment_methods');

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
			'payment_methods' =>	$this->mdl_payment_methods->get($params)
		);

		$this->load->view('payment_method_index', $data);

	}

	function form() {

		if (!$this->mdl_payment_methods->validate()) {

			if (!$_POST AND uri_assoc('payment_method_id', 4)) {

				$this->mdl_payment_methods->prep_validation(uri_assoc('payment_method_id', 4));

			}

			$this->load->view('payment_method_form');

		}

		else {

			$this->mdl_payment_methods->save($this->mdl_payment_methods->db_array(), uri_assoc('payment_method_id', 4));

			$this->redir->redirect('payments/payment_methods');

		}

	}

	function delete() {

		if (uri_assoc('payment_method_id', 4)) {

			$this->mdl_payment_methods->delete(array('payment_method_id'=>uri_assoc('payment_method_id', 4)));

		}

		$this->redir->redirect('payments/payment_methods');

	}

	function _post_handler() {

		if ($this->input->post('btn_add')) {

			redirect('payments/payment_methods/form');

		}

		elseif ($this->input->post('btn_cancel')) {

			redirect('payments/payment_methods/index');

		}

	}

}

?>