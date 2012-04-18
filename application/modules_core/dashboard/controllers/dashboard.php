<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

	public $widgets = array();

	function __construct() {

		parent::__construct();

		if ($this->mdl_mcb_data->setting('dashboard_override')) {

			redirect($this->mdl_mcb_data->setting('dashboard_override'));

		}

	}

	function index() {

		$this->_post_handler();

        $this->redir->set_last_index();

        $this->load->helper('text');

		$this->load->model(
			array(
			'invoices/mdl_invoices',
			'templates/mdl_templates'
			)
		);

		$module_upgrade_notice = $this->mdl_mcb_modules->module_upgrade_notice();

		$data = array(
			'static_error'			=>	$module_upgrade_notice
		);

		if ($this->mdl_mcb_data->setting('dashboard_show_open_invoices') == 'TRUE') {

			$data['open_invoices'] = $this->mdl_invoices->get_recent_open();

		}

		if ($this->mdl_mcb_data->setting('dashboard_show_pending_invoices') == 'TRUE') {

			$data['pending_invoices'] = $this->mdl_invoices->get_recent_pending();

		}

		if ($this->mdl_mcb_data->setting('dashboard_show_closed_invoices') == 'TRUE') {

			$data['closed_invoices'] = $this->mdl_invoices->get_recent_closed();

		}

		if ($this->mdl_mcb_data->setting('dashboard_show_overdue_invoices') == 'TRUE') {

			$data['overdue_invoices'] = $this->mdl_invoices->get_recent_overdue();

		}

		if ($this->mdl_mcb_data->setting('dashboard_show_quotes') == 'TRUE') {

			$data['quotes'] = $this->mdl_invoices->get_quotes();

		}

		$this->load->view('dashboard', $data);

	}

	function show_custom_menu() {

		foreach ($this->mdl_mcb_modules->custom_modules as $module) {

			if ($module->module_enabled and isset($module->module_config['dashboard_menu'])) {

				$this->load->view($module->module_config['dashboard_menu'], NULL, FALSE);

			}

		}

	}

	function show_widgets() {

		foreach ($this->mdl_mcb_modules->custom_modules as $module) {

			if ($module->module_enabled and isset($module->module_config['dashboard_widget'])) {

				echo modules::run($module->module_config['dashboard_widget']);

			}

		}

	}

	function record_not_found() {

		$this->load->view('record_not_found');

	}

	function _post_handler() {

		if ($this->input->post('btn_add_invoice')) {

			redirect('invoices/create');

		}

        elseif ($this->input->post('btn_email_reminders')) {

            redirect('mailer/invoice_mailer/overdue');

        }

	}

}

?>