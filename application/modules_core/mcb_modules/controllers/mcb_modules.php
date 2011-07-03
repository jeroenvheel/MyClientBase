<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mcb_Modules extends Admin_Controller {

	function __construct() {

		parent::__construct();
		
	}

	function index() {

		$this->mdl_mcb_modules->refresh();

		$data = array(
			'modules'	=>	$this->mdl_mcb_modules->custom_modules
		);

		$this->load->view('index', $data);

	}

	function install() {

		$module_path = $this->uri->segment(3);

		$this->load->module($module_path . '/setup');

		$this->setup->install();

		$this->db->where('module_path', $module_path);

		$db_array = array(
			'module_enabled'	=>	1
		);

		$this->db->update('mcb_modules', $db_array);

		redirect('mcb_modules');

	}

	/*
	 * 1. Runs the setup/uninstall function of the custom module.
	 * 2. Changes the status of the module to disabled.
	*/
	function uninstall() {

		$module_path = $this->uri->segment(3);

		$this->load->module($module_path . '/setup');

		$this->setup->uninstall();

		$this->db->where('module_path', $module_path);

		$this->db->delete('mcb_modules');

		redirect('mcb_modules');

	}

	/*
	 * Runs the setup/upgrade function of the custom module.
	*/
	function upgrade() {

		$module_path = $this->uri->segment(3);

		$this->load->module($module_path . '/setup');

		$this->setup->upgrade();

		redirect('mcb_modules');

	}

}

?>