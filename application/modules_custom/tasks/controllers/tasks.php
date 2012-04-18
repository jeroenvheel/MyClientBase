<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Tasks extends Admin_Controller {

	function __construct() {

		parent::__construct();

		if (!$this->mdl_mcb_modules->check_enable('tasks')) {

			redirect('dashboard');

		}

		$this->load->model('mdl_tasks');

	}

	function index() {

		$this->_post_handler();

		$this->redir->set_last_index();

		$params = array(
			'limit'		=>	20,
			'paginate'	=>	TRUE,
			'page'		=>	uri_assoc('page', 3)
		);

		$data = array(
			'tasks'					=>	$this->mdl_tasks->get($params),
			'show_task_selector'	=>	TRUE
		);

		$this->load->view('index', $data);

	}

	function form() {

		$this->_post_handler();

		$task_id = uri_assoc('task_id', 3);

		if (!$this->mdl_tasks->validate()) {

			$this->load->helper('form');

			$this->load->helper('text');

			$this->load->model('clients/mdl_clients');

			if (!$_POST AND $task_id) {

				$this->mdl_tasks->prep_validation($task_id);

			}

			elseif (!$_POST AND !$task_id) {

				$this->mdl_tasks->set_form_value('start_date', format_date(time()));

			}

			$data = array(
				'clients'	=>	$this->mdl_clients->get()
			);

			$this->load->view('form', $data);

		}

		else {

			$this->mdl_tasks->save();

			if (!$task_id) {

				$task_id = $this->db->insert_id();

			}

			if ($this->input->post('btn_submit_and_create_invoice')) {

				redirect('tasks/create_invoice/task_id/' . $task_id . '/client_id/' . $this->input->post('client_id'));

			}

			else {

				$this->redir->redirect('tasks');

			}

		}

	}

	function create_invoice() {

		$this->load->model('invoices/mdl_invoices');

		if (!$this->mdl_invoices->validate_create()) {

			if (!$_POST) {

				$this->mdl_invoices->client_id = uri_assoc('client_id', 3);

			}

			$this->load->module('invoices');

			$this->invoices->display_create_invoice();

		}

		else {

			$task_id = uri_assoc('task_id', 3);

			$task_ids = uri_assoc('task_ids', 3);

			$invoice_items = array();

			if ($task_id) {

				$task = $this->mdl_tasks->get(array('where'=>array('mcb_tasks.task_id'=>$task_id)));

				$invoice_items[] = array(
					'item_name'			=>	$task->title,
					'item_description'	=>	$task->description,
					'item_qty'			=>	1,
					'item_price'		=>	0
				);

			}

			elseif ($task_ids) {

				$task_ids = explode('-', $task_ids);

				foreach ($task_ids as $task_id) {

					$task = $this->mdl_tasks->get(array('where'=>array('mcb_tasks.task_id'=>$task_id)));

					$invoice_items[] = array(
						'item_name'			=>	$task->title,
						'item_description'	=>	$task->description,
						'item_qty'			=>	1,
						'item_price'		=>	0
					);

				}

			}

			$package = array(
				'client_id'				=>	$task->client_id,
				'invoice_date_entered'	=>	$this->input->post('invoice_date_entered'),
				'invoice_is_quote'		=>	($this->input->post('invoice_is_quote') ? 1 : 0),
				'invoice_group_id'		=>	$this->input->post('invoice_group_id'),
				'invoice_items'			=>	$invoice_items
			);

			$invoice_id = $this->mdl_invoices->create_invoice($package);

			$this->mdl_tasks->save_invoice_relation($invoice_id, $task_id);

			redirect('invoices/edit/invoice_id/' . $invoice_id);

		}

	}

	function delete() {

		if (uri_assoc('task_id', 3)) {

			$this->mdl_tasks->delete(array('task_id'=>uri_assoc('task_id', 3)));

		}

		$this->redir->redirect('tasks');

	}

	function save_settings() {

		if ($this->input->post('dashboard_show_open_tasks')) {

			$this->mdl_mcb_data->save('dashboard_show_open_tasks', "TRUE");

		}

		else {

			$this->mdl_mcb_data->save('dashboard_show_open_tasks', "FALSE");

		}

	}

	function dashboard_widget() {

		if ($this->mdl_mcb_data->setting('dashboard_show_open_tasks') == "TRUE") {

			$params = array(
				'limit'	=>	10,
				'where'	=>	array(
					'complete_date'=>''
				)
			);

			$data = array(
				'tasks'	=>	$this->mdl_tasks->get($params)
			);

			$this->load->view('dashboard_widget', $data);

		}

	}

	function _post_handler() {

		if ($this->input->post('btn_add')) {

			redirect('tasks/form');

		}

		elseif ($this->input->post('btn_cancel')) {

			redirect('tasks/index');

		}

		elseif ($this->input->post('btn_create_mti')) {

			$task_id = $this->input->post('task_id');

			$task_ids = implode('-', $task_id);

			$params = array(
				'where'	=>	array(
					'mcb_tasks.task_id'	=>	$task_id[0]
				)
			);

			$task = $this->mdl_tasks->get($params);

			$client_id = $task->client_id;

			redirect('tasks/create_invoice/task_ids/' . $task_ids . '/client_id/' . $client_id);

		}

	}

}

?>