<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Clients extends Admin_Controller {

	public function __construct() {

		parent::__construct();

		$this->_post_handler();

		$this->load->model('mdl_clients');

	}

	public function index() {

		$this->load->helper('text');
		$this->load->model('mdl_client_table');

		$this->redir->set_last_index();

		$params = array(
			'paginate'	=>	TRUE,
			'limit'		=>	$this->mdl_mcb_data->setting('results_per_page'),
			'page'		=>	uri_assoc('page')
		);

		$order_by = uri_assoc('order_by');
		$order = uri_assoc('order');
		$show = uri_assoc('show');

		switch ($order_by) {
			case 'client_id':
				$params['order_by'] = 'mcb_clients.client_id ' . $order;
				break;
			case 'client_name':
				$params['order_by'] = 'mcb_clients.client_name ' . $order;
				break;
			case 'credit_amount':
				$params['order_by'] = 'client_credit_amount ' . $order;
				break;
			case 'balance':
				$params['order_by'] = 'client_total_balance ' . $order;
				break;
			case 'client_email':
				$params['order_by'] = 'mcb_clients.client_email_address ' . $order;
				break;
			case 'client_phone':
				$params['order_by'] = 'mcb_clients.client_phone_number ' . $order;
				break;
			case 'client_active':
				$params['order_by'] = 'mcb_clients.client_active ' . $order;
				break;
			default:
				$params['order_by'] = 'mcb_clients.client_name';
		}
		
		if ($show == 'active') {
			
			$params['where']['client_active'] = 1;
			
		}
		
		elseif ($show == 'inactive') {
			
			$params['where']['client_active'] = 0;
			
		}

		$data = array(
			'clients'		=>	$this->mdl_clients->get($params),
			'table_headers'	=>	$this->mdl_client_table->get_table_headers()
		);

		$this->load->view('index', $data);

	}

	public function form() {

		$this->load->model(
			array(
			'invoices/mdl_invoices',
			'mdl_contacts',
			'templates/mdl_templates',
			'mcb_data/mdl_mcb_client_data',
			'invoices/mdl_invoice_groups'
			)
		);

		$client_id = uri_assoc('client_id');

		if ($this->mdl_clients->validate()) {

			$this->mdl_clients->save();

			$client_id = ($client_id) ? $client_id : $this->db->insert_id();

			foreach ($this->input->post('client_settings') as $key=>$value) {

				if ($value) {

					$this->mdl_mcb_client_data->save($client_id, $key, $value);

				}

				else {

					$this->mdl_mcb_client_data->delete($client_id, $key);

				}

			}

			redirect('clients/form/client_id/' . $client_id);

		}

		else {

			if (!$_POST AND $client_id) {

				$this->mdl_clients->prep_validation($client_id);

			}

			$this->load->helper('text');

			$client_id = uri_assoc('client_id');

			if ($client_id) {

				$this->mdl_mcb_client_data->set_session_data($client_id);

			}

			$client_params = array(
				'where'	=>	array(
					'mcb_clients.client_id'	=>	$client_id
				)
			);

			$contact_params = array(
				'where'	=>	array(
					'mcb_contacts.client_id'    =>  $client_id
				)
			);

			$invoice_params = array(
				'where'	=>	array(
					'mcb_invoices.client_id'        =>	$client_id,
					'mcb_invoices.invoice_is_quote' =>  0
				)
			);

			$quote_params = array(
				'where'	=>	array(
					'mcb_invoices.client_id'		=>	$client_id,
					'mcb_invoices.invoice_is_quote'	=>	1
				)
			);

			if (!$this->session->userdata('global_admin')) {

				$invoice_params['where']['mcb_invoices.user_id'] = $this->session->userdata('user_id');

			}

			$client = $this->mdl_clients->get($client_params);
			$contacts = $this->mdl_contacts->get($contact_params);
			$invoices = $this->mdl_invoices->get($invoice_params);
			$quotes = $this->mdl_invoices->get($quote_params);
			$custom_fields = $this->mdl_clients->custom_fields;
			$invoice_templates = $this->mdl_templates->get('invoices');
			$invoice_groups = $this->mdl_invoice_groups->get();

			if ($this->session->flashdata('tab_index')) {

				$tab_index = $this->session->flashdata('tab_index');

			}

			else {

				$tab_index = 0;

			}

			$data = array(
				'client'			=>	$client,
				'contacts'			=>	$contacts,
				'invoices'			=>	$invoices,
				'quotes'			=>	$quotes,
				'tab_index'			=>	$tab_index,
				'custom_fields'		=>	$custom_fields,
				'invoice_templates'	=>	$invoice_templates,
				'invoice_groups'	=>	$invoice_groups
			);

			$this->load->view('form', $data);

		}

	}

	public function delete() {

		$client_id = uri_assoc('client_id');

		if ($client_id) {

			$this->mdl_clients->delete($client_id);

		}

		$this->redir->redirect('clients');

	}

	public function get($params = NULL) {

		return $this->mdl_clients->get($params);

	}

	public function jquery_lookup() {

		$q = $this->input->get('term');

		$this->db->select('client_id, client_name, client_email_address');
		$this->db->where("client_name LIKE '%" . $q . "%'");
		$this->db->where("client_active", 1);
		$clients = $this->db->get('mcb_clients')->result();

		$return = array();

		foreach ($clients as $client) {

			$return[] = array(
				'label'	=>	$client->client_name,
				'value'	=>	$client->client_id,
				'email'	=>	$client->client_email_address
			);

		}

		echo json_encode($return);

	}

	function _post_handler() {

		if ($this->input->post('btn_add_client')) {

			redirect('clients/form');

		}

		elseif ($this->input->post('btn_cancel')) {

			redirect($this->session->userdata('last_index'));

		}

		elseif ($this->input->post('btn_add_contact')) {

			redirect('clients/contacts/form/client_id/' . uri_assoc('client_id'));

		}

		elseif ($this->input->post('btn_add_invoice')) {

			redirect('invoices/create/client_id/' . uri_assoc('client_id'));

		}

		elseif ($this->input->post('btn_add_quote')) {

			redirect('invoices/create/quote/client_id/' . uri_assoc('client_id'));

		}

	}

}

?>