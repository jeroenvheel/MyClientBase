<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Invoice_Groups extends Admin_Controller {

	function __construct() {

		parent::__construct();

		$this->_post_handler();

		$this->load->model('mdl_invoice_groups');

	}

	function index() {

		$this->redir->set_last_index();

		$params = array(
			'paginate'	=>	TRUE,
			'page'		=>	uri_assoc('page', 4)
		);

		$data = array(
			'invoice_groups' =>	$this->mdl_invoice_groups->get($params),
		);

		$this->load->view('invoice_group_index', $data);

	}

	function form() {

		if (!$this->mdl_invoice_groups->validate()) {

			if (!$_POST AND uri_assoc('invoice_group_id', 4)) {

				$this->mdl_invoice_groups->prep_validation(uri_assoc('invoice_group_id', 4));

			}

			$this->load->view('invoice_group_form');

		}

		else {

			$this->mdl_invoice_groups->save($this->mdl_invoice_groups->db_array(), uri_assoc('invoice_group_id', 4));

			$this->redir->redirect('invoices/invoice_groups');

		}

	}

	function delete() {

		$invoice_group_id = uri_assoc('invoice_group_id', 4);

		if ($invoice_group_id and $invoice_group_id <> 1) {

			$this->mdl_invoice_groups->delete(array('invoice_group_id'=>$invoice_group_id));

		}

		$this->redir->redirect('invoices/invoice_groups');

	}

	function _post_handler() {

		if ($this->input->post('btn_add')) {

			redirect('invoices/invoice_groups/form');

		}

		elseif ($this->input->post('btn_cancel')) {

			redirect('invoices/invoice_groups/index');

		}

	}

}

?>