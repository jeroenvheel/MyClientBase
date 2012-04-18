<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Inventory_Types extends Admin_Controller {

	public function __construct() {

		parent::__construct();

		$this->_post_handler();

		$this->load->model('mdl_inventory_types');

	}

	public function index() {

		$this->redir->set_last_index();

		$params = array(
			'paginate'	=>	TRUE,
			'page'		=>	uri_assoc('page', 4)
		);

		$data = array(
			'inventory_types' =>	$this->mdl_inventory_types->get($params),
		);

		$this->load->view('inventory_types_index', $data);

	}

	public function form() {

		if (!$this->mdl_inventory_types->validate()) {

			if (!$_POST AND uri_assoc('inventory_type_id', 4)) {

				$this->mdl_inventory_types->prep_validation(uri_assoc('inventory_type_id', 4));

			}

			$this->load->view('inventory_types_form');

		}

		else {

			$this->mdl_inventory_types->save($this->mdl_inventory_types->db_array(), uri_assoc('inventory_type_id', 4));

			$this->redir->redirect('inventory/inventory_types');

		}

	}

	public function delete() {

		if (uri_assoc('inventory_type_id', 4)) {

			$this->mdl_inventory_types->delete(uri_assoc('inventory_type_id', 4));

		}

		$this->redir->redirect('inventory/inventory_types');

	}

	public function _post_handler() {

		if ($this->input->post('btn_add')) {

			redirect('inventory/inventory_types/form');

		}

		elseif ($this->input->post('btn_cancel')) {

			redirect('inventory/inventory_types/index');

		}

	}

}

?>