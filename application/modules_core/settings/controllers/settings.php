<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Settings extends Admin_Controller {

	function __construct() {

		parent::__construct();

		// $this->_post_handler();

	}

	function index() {

        $this->_post_handler();

		$core_modules = $this->mdl_mcb_modules->core_modules;

		$custom_modules = $this->mdl_mcb_modules->custom_modules;

		$core_tabs = array();

		$custom_tabs = array();

		foreach ($core_modules as $core_module) {

			if (isset($core_module->module_config['settings_view']) and isset($core_module->module_config['settings_save'])) {

				$core_tabs[] = array(
					'path'			=>	$core_module->module_path,
					'title'			=>	$core_module->module_name,
					'settings_view'	=>	$core_module->module_config['settings_view']
				);

			}

		}

		foreach ($custom_modules as $custom_module) {

			if ($custom_module->module_enabled and isset($custom_module->module_config['settings_view']) and isset($custom_module->module_config['settings_save'])) {

				$custom_tabs[] = array(
					'path'			=>	$custom_module->module_path,
					'title'			=>	$custom_module->module_name,
					'settings_view'	=>	$custom_module->module_config['settings_view']
				);

			}

		}

		$data = array(
			'core_tabs'		=>	$core_tabs,
			'custom_tabs'	=>	$custom_tabs,
			'tab_index'		=>	0
		);

		$this->load->view('settings', $data);

	}

	function optimize_db() {

		$this->load->dbutil();

		$this->dbutil->optimize_database();
		
		$this->session->set_flashdata('custom_success', $this->lang->line('database_optimized'));
		
		redirect('settings');

	}

	function _post_handler() {

		if ($this->input->post('btn_backup')) {

			$this->_db_backup();

		}

		elseif ($this->input->post('btn_save_settings')) {

			$this->_core_save();

			$this->_custom_save();

			$this->mdl_mcb_data->set_session_data();

			$this->session->set_flashdata('custom_success', $this->lang->line('system_settings_saved'));

			redirect('settings');

		}

	}

	function _core_save() {

		foreach ($this->mdl_mcb_modules->core_modules as $module) {

			if (isset($module->module_config['settings_save'])) {

				modules::run($module->module_config['settings_save']);

			}

		}

	}

	function _custom_save() {

		foreach ($this->mdl_mcb_modules->custom_modules as $module) {

			if ($module->module_enabled and isset($module->module_config['settings_save'])) {

				modules::run($module->module_config['settings_save']);

			}

		}

	}

	function _db_backup() {

		$prefs = array(
			'format'      => 'zip',
			'filename'    => 'mcb_' . date('Y-m-d') . '.sql'
		);

		$this->load->library('db_backup');

		$this->db_backup->backup($prefs);

	}

}

?>