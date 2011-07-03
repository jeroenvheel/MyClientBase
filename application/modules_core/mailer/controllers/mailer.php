<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mailer extends Admin_Controller {

	function display_settings() {

		$security_options = array(
			'none'	=>	$this->lang->line('none'),
			'tls'	=>	'TLS',
			'ssl'	=>	'SSL'
		);

		$data = array(
			'security_options'	=>	$security_options
		);

		$this->load->view('mailer/settings', $data);

	}

	function save_settings() {

		/*
		 * As per the config file, this function will
		 * execute when the core system settings are saved.
		*/

		foreach ($this->input->post('email_settings') as $key=>$value) {

			if ($key == 'smtp_security' and $value == 'none') {

				$this->mdl_mcb_data->delete('smtp_security');

			}

			else {

				$this->mdl_mcb_data->save($key, $value);

			}

		}

		if (!isset($_POST['email_settings']['default_email_body'])) {

			$this->mdl_mcb_data->save('default_email_body', 0);

		}

	}

}

?>