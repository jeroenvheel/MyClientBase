<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Profile extends Admin_Controller {

	public function __construct() {

		parent::__construct();

		$this->load->model('mdl_users');

	}

	public function index() {

		$user_id = $this->session->userdata('user_id');

        if (!$this->mdl_users->validate()) {

			$this->load->model('tax_rates/mdl_tax_rates');

            if (!$_POST) {

                $this->mdl_users->prep_validation($user_id);

				$this->mdl_users->set_form_value('default_tax_rate_id', $this->mdl_mcb_userdata->setting('default_tax_rate_id'));
				$this->mdl_users->set_form_value('default_tax_rate_option', $this->mdl_mcb_userdata->setting('default_tax_rate_option'));
				$this->mdl_users->set_form_value('default_item_tax_rate_id', $this->mdl_mcb_userdata->setting('default_item_tax_rate_id'));
				$this->mdl_users->set_form_value('default_item_tax_option', $this->mdl_mcb_userdata->setting('default_item_tax_option'));

            }

            $data = array(
                'custom_fields'	=>	$this->mdl_users->custom_fields,
				'tax_rates'		=>	$this->mdl_tax_rates->get()
            );

            $this->load->view('form', $data);

        }

        else {
			
            $this->mdl_users->save($this->mdl_users->db_array(), $user_id);

			$this->mdl_mcb_userdata->save_settings($this->session->userdata('user_id'), $this->input->post('user_settings'));

			$this->mdl_mcb_userdata->set_session_data($user_id);

            $this->redir->redirect('users/profile');

        }
		
	}

    public function change_password() {

        if (!$this->mdl_users->validate_change_password()) {

            $this->load->view('change_password');

        }

        else {

            $this->mdl_users->save_change_password($this->session->userdata('user_id'));

            $this->redir->redirect('users/profile');

        }

    }

}

?>