<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_Tasks extends MY_Model {

	function __construct() {

		parent::__construct();

		$this->table_name = 'mcb_tasks';

		$this->primary_key = 'mcb_tasks.task_id';

		$this->select_fields = "
		SQL_CALC_FOUND_ROWS mcb_tasks.*,
		mcb_clients.client_name,
		mcb_users.last_name AS user_last_name,
		mcb_users.first_name AS user_first_name";

		$this->order_by = 'mcb_tasks.due_date, mcb_tasks.task_id DESC';

		$this->joins = array(
			'mcb_clients'	=>	'mcb_clients.client_id = mcb_tasks.client_id',
			'mcb_users'		=>	'mcb_users.user_id = mcb_tasks.user_id'
		);

	}

	function validate() {

		$this->form_validation->set_rules('client_id', $this->lang->line('client'), 'required');
		$this->form_validation->set_rules('start_date', $this->lang->line('start_date'), 'required');
		$this->form_validation->set_rules('due_date', $this->lang->line('due_date'));
		$this->form_validation->set_rules('complete_date', $this->lang->line('complete_date'));
		$this->form_validation->set_rules('title', $this->lang->line('title'), 'required');
		$this->form_validation->set_rules('description', $this->lang->line('description'), 'required');

		return parent::validate();

	}

	function save() {

		$db_array = parent::db_array();

		if (!uri_assoc('task_id', 3)) {

			$db_array['user_id'] = $this->session->userdata('user_id');

		}

		if (isset($db_array['due_date']) and $db_array['due_date']) {

			$db_array['due_date'] = strtotime(standardize_date($db_array['due_date']));

		}

		if (isset($db_array['complete_date']) and $db_array['complete_date']) {

			$db_array['complete_date'] = strtotime(standardize_date($db_array['complete_date']));

		}

		$db_array['start_date'] = strtotime(standardize_date($db_array['start_date']));

		parent::save($db_array, uri_assoc('task_id', 3));

	}

	function save_invoice_relation($invoice_id, $task_id) {

		$db_array = array(
			'task_id'			=>	$task_id,
			'invoice_id'		=>	$invoice_id
		);

		$this->db->insert('mcb_tasks_invoices', $db_array);
		
	}

	function create_invoice_from_tasks($task_ids) {

		$this->load->model('invoices/mdl_invoices');

		$params = array(
			'where_in'	=>	array('mcb_tasks.task_id'=>$task_ids)
		);

		$tasks = parent::get($params);

		foreach ($tasks as $task) {

			if (!isset($invoice_id)) {

				$invoice_id = $this->mdl_invoices->save($task->client_id, $task->start_date, FALSE);

			}

			$this->mdl_invoices->save_invoice_item($invoice_id, $task->title, $task->description, 1, 0);

			$db_array = array(
				'task_id'		=>	$task->task_id,
				'invoice_id'	=>	$invoice_id
			);

			$this->db->insert('mcb_tasks_invoices', $db_array);

		}

		return $invoice_id;

	}

	function prep_validation($key) {

		parent::prep_validation($key);

		if (!$_POST) {

			if ($this->form_value('due_date')) {

				$this->set_form_value('due_date', format_date($this->form_value('due_date')));

			}

			if ($this->form_value('complete_date')) {

				$this->set_form_value('complete_date', format_date($this->form_value('complete_date')));

			}

			if ($this->form_value('start_date')) {

				$this->set_form_value('start_date', format_date($this->form_value('start_date')));

			}

		}

	}

	function delete($params) {

		parent::delete($params);

		$this->db->where('task_id', $params['task_id']);

		$this->db->delete('mcb_tasks_invoices');

	}

}

?>