<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Users extends Admin_Controller {

    function __construct() {

        parent::__construct();

        $this->_post_handler();

        $this->load->model('mdl_users');

    }

    function index() {

        $this->redir->set_last_index();

        $params = array(
            'limit'		=>	$this->mdl_mcb_data->setting('results_per_page'),
            'paginate'	=>	TRUE,
            'page'		=>	uri_assoc('page'),
            'order_by'	=>	'last_name, first_name',
            'where'     =>  array(
                'mcb_users.client_id'   =>  0
            )
        );

        $data = array(
            'users' =>	$this->mdl_users->get($params)
        );

        $this->load->view('index', $data);

    }

    function form() {

        if (!$this->mdl_users->validate()) {

            $this->load->helper('form');

            if (!$_POST AND uri_assoc('user_id')) {

                $this->mdl_users->prep_validation(uri_assoc('user_id'));

            }

            $data = array(
                'custom_fields'	=>	$this->mdl_users->custom_fields
            );

            $this->load->view('form', $data);

        }

        else {

            $this->mdl_users->save($this->mdl_users->db_array(), uri_assoc('user_id'));

            $this->redir->redirect('users');

        }

    }

    function delete() {

        if (uri_assoc('user_id')) {

            if (uri_assoc('user_id') == $this->session->userdata('user_id') OR uri_assoc('user_id') == 1) {

                $this->session->set_flashdata('custom_error', $this->lang->line('cannot_delete_user_account') . '.');

                $this->redir->redirect('users');

            }

            else {

                $this->mdl_users->delete(array('user_id'=>uri_assoc('user_id')));

            }

        }

        $this->redir->redirect('users');

    }

    function get($params = NULL) {

        return $this->mdl_users->get($params);

    }

    function change_password() {

        if (!$this->mdl_users->validate_change_password() AND uri_assoc('user_id')) {

            $this->load->view('change_password');

        }

        else {

            $this->mdl_users->save_change_password();

            $this->redir->redirect('users');

        }

    }

    function _post_handler() {

        if ($this->input->post('btn_add')) {

            redirect('users/form');

        }

        elseif ($this->input->post('btn_cancel')) {

            redirect('users/index');

        }

    }

}

?>