<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Clients extends Admin_Controller {

    function __construct() {

        parent::__construct();

        $this->_post_handler();

        $this->load->model('mdl_clients');

    }

    function index() {

        $this->load->helper('text');

        $this->redir->set_last_index();

        $params = array(
            'paginate'	=>	TRUE,
            'limit'		=>	$this->mdl_mcb_data->setting('results_per_page'),
            'page'		=>	uri_assoc('page')
        );

        $order_by = uri_assoc('order_by');

        if ($order_by == 'client_id_desc') {

            $params['order_by'] = 'client_id DESC';

        }

        elseif ($order_by == 'client_id_asc') {

            $params['order_by'] = 'client_id ASC';

        }

        elseif ($order_by == 'balance_desc') {

            $params['order_by'] = 'client_total_balance DESC';

        }

        elseif ($order_by == 'balance_asc') {

            $params['order_by'] = 'client_total_balance ASC';

        }

        elseif ($order_by == 'client_name_asc') {

            $params['order_by'] = 'client_name ASC';

        }

        elseif ($order_by == 'client_name_desc') {

            $params['order_by'] = 'client_name DESC';

        }

        else {

            $params['order_by'] = 'client_name';

        }

        $data = array(
            'clients'	=>	$this->mdl_clients->get($params)
        );

        $this->load->view('index', $data);

    }

    function form() {

        $client_id = uri_assoc('client_id');

        $this->load->model(
            array(
            'mcb_data/mdl_mcb_client_data',
            'invoices/mdl_invoice_groups'
            )
        );

        if ($client_id) {

            $this->mdl_mcb_client_data->set_session_data($client_id);

        }

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

            redirect($this->session->userdata('last_index'));

        }

        else {

            $this->load->model('templates/mdl_templates');

            $this->load->helper('form');

            if (!$_POST AND $client_id) {

                $this->mdl_clients->prep_validation($client_id);

            }

            $data = array(
                'custom_fields'     =>	$this->mdl_clients->custom_fields,
                'invoice_templates' =>  $this->mdl_templates->get('invoices'),
                'invoice_groups'    =>  $this->mdl_invoice_groups->get()
            );

            $this->load->view('form', $data);

        }

    }

    function details() {

        $this->redir->set_last_index();

        $this->load->helper('text');

        $this->load->model(
            array(
            'invoices/mdl_invoices',
            'mdl_contacts',
            'templates/mdl_templates'
            )
        );

        $client_id = uri_assoc('client_id');

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

        if (!$this->session->userdata('global_admin')) {

            $invoice_params['where']['mcb_invoices.user_id'] = $this->session->userdata('user_id');

        }

        $client = $this->mdl_clients->get($client_params);

        $contacts = $this->mdl_contacts->get($contact_params);

        $invoices = $this->mdl_invoices->get($invoice_params);

        if ($this->session->flashdata('tab_index')) {

            $tab_index = $this->session->flashdata('tab_index');

        }

        else {

            $tab_index = 0;

        }

        $data = array(
            'client'	=>	$client,
            'contacts'	=>	$contacts,
            'invoices'	=>	$invoices,
            'tab_index'	=>	$tab_index
        );

        $this->load->view('details', $data);

    }

    function delete() {

        $client_id = uri_assoc('client_id');

        if ($client_id) {

            $this->mdl_clients->delete($client_id);

        }

        $this->redir->redirect('clients');

    }

    function get($params = NULL) {

        return $this->mdl_clients->get($params);

    }

    function _post_handler() {

        if ($this->input->post('btn_add_client')) {

            redirect('clients/form');

        }

        elseif ($this->input->post('btn_edit_client')) {

            redirect('clients/form/client_id/' . uri_assoc('client_id'));

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