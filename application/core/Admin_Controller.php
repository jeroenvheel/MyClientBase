<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Admin_Controller extends MX_Controller {

	public static $is_loaded;

	function __construct() {

		parent::__construct();

		$this->load->library('session');

        $this->load->helper('url');

        if (!$this->session->userdata('user_id')) {

            redirect('sessions/login');

        }

		if (!isset(self::$is_loaded)) {

			self::$is_loaded = TRUE;

            $this->load->config('mcb_menu/mcb_menu');

            modules::run('mcb_menu/check_permission', $this->uri->uri_string(), $this->session->userdata('global_admin'));

			$this->load->database();

			$this->load->helper(array('uri', 'mcb_currency', 'mcb_invoice', 'mcb_date', 'mcb_icon', 'mcb_custom', 'mcb_app'));

            $this->load->model(array('mcb_modules/mdl_mcb_modules','mcb_data/mdl_mcb_data'));

			$this->mdl_mcb_modules->set_module_data();

            $this->mdl_mcb_data->set_session_data();

			$this->mdl_mcb_modules->load_custom_languages();

			$this->load->language('mcb', $this->mdl_mcb_data->setting('default_language'));

            $this->load->model('fields/mdl_fields');

			$this->load->library(array('form_validation', 'redir'));

			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

            if ($this->mdl_mcb_data->setting('enable_profiler')) {

                $this->output->enable_profiler();

            }

		}

	}

}

?>