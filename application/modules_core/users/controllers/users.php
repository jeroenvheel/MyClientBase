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

		$user_id = uri_assoc('user_id');

        if (!$this->mdl_users->validate()) {

			$this->load->model('tax_rates/mdl_tax_rates');

            if (!$_POST AND $user_id) {

                $this->mdl_users->prep_validation($user_id);

				$this->mdl_users->set_form_value('default_tax_rate_id', $this->mdl_mcb_userdata->get($user_id, 'default_tax_rate_id'));
				$this->mdl_users->set_form_value('default_tax_rate_option', $this->mdl_mcb_userdata->get($user_id, 'default_tax_rate_option'));
				$this->mdl_users->set_form_value('default_item_tax_rate_id', $this->mdl_mcb_userdata->get($user_id, 'default_item_tax_rate_id'));

            }

            $data = array(
                'custom_fields'	=>	$this->mdl_users->custom_fields,
				'tax_rates'		=>	$this->mdl_tax_rates->get()
            );

            $this->load->view('form', $data);

        }

        else {

            $user_id = $this->mdl_users->save($this->mdl_users->db_array(), $user_id);

			$this->mdl_mcb_userdata->save_settings($user_id, $this->input->post('user_settings'));

            $this->redir->redirect('users');

        }

    }

    function delete() {

		$this->mdl_users->delete(uri_assoc('user_id'));

        $this->redir->redirect('users');

    }

    function get($params = NULL) {

        return $this->mdl_users->get($params);

    }

    function change_password() {

		$user_id = uri_assoc('user_id');

        if (!$this->mdl_users->validate_change_password() and $user_id) {

            $this->load->view('change_password');

        }

        else {

            $this->mdl_users->save_change_password($user_id);

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