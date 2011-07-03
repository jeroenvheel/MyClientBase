<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Admin_settings extends Admin_Controller {

	function __construct() {

		parent::__construct();

	}

	function display() {

		$this->load->view('settings');

	}

	function save() {

		$checkbox_settings = array(
			'cc_enable_client_tax_id',
			'cc_enable_client_address',
			'cc_enable_client_address_2',
			'cc_enable_client_city',
			'cc_enable_client_state',
			'cc_enable_client_zip',
			'cc_enable_client_country',
			'cc_enable_client_phone_number',
			'cc_enable_client_fax_number',
			'cc_enable_client_mobile_number',
			'cc_enable_client_email_address',
			'cc_enable_client_web_address'
		);

		$cc_edit_enabled = 0;

		foreach ($checkbox_settings as $setting) {

			if (isset($_POST['cc_settings'][$setting])) {

				$cc_edit_enabled = 1;

				$this->mdl_mcb_data->save($setting, 1);

			}

			else {

				$this->mdl_mcb_data->save($setting, 0);

			}

		}

		$this->mdl_mcb_data->save('cc_edit_enabled', $cc_edit_enabled);

	}

}

?>