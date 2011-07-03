<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Setup extends CI_Controller {

	function __construct() {

		parent::__construct();

		$this->load->language('mcb');

		$this->load->helper(array('url'));

		$this->load->model('mdl_setup');

		$this->load->model('mcb_data/mdl_mcb_data');

		$this->load->library(array('session', 'form_validation'));

	}

	function adjust() {

		$this->load->database();

		$this->load->model('invoices/mdl_invoice_amounts');

		$this->mdl_invoice_amounts->adjust();

	}

	function index() {

		if ($this->input->post('btn_agree')) {

			redirect('setup/mcb_setup');

		}

		$this->load->view('index');

	}

	function mcb_setup() {

		$this->load->library('Lib_mysql');

		/* Is database.php already configured? */

		include(APPPATH . 'config/database.php');

		$db = $db['default'];

		if ($db['hostname'] and $db['username'] and $db['database'] and $db['password']) {

			/* database.php is configured, let's check the connection */

			if ($this->lib_mysql->connect($db['hostname'], $db['username'], $db['password'])) {

				/* Connection successful, does the database exist? */

				if ($this->lib_mysql->select_db($db['database'])) {

					/* The database exists, are there MCB tables? */

					if ($this->lib_mysql->query("SHOW TABLES LIKE 'mcb_users'")) {

						/* This appears to be an upgrade. */

						redirect('setup/upgrade');

					}

					else {

						/* Looks like an install */

						redirect('setup/install');

					}

				}

			}

		}

		redirect('setup/db_config');

	}

	function db_config() {

		$database_config_file_error = FALSE;

		if ($this->input->post('btn_continue_setup')) {

			/* Check to make sure the file was written */

			include(APPPATH . 'config/database.php');

			$db = $db['default'];

			if ($this->input->post('hostname') == $db['hostname'] and
				$this->input->post('username') == $db['username'] and
				$this->input->post('database') == $db['database'] and
				$this->input->post('password') == $db['password']) {

				/* The file was successfully written */

				redirect('setup/' . $this->input->post('setup_type'));

			}

			else {

				/* Something is wrong with the file */

				$database_config_file_error = TRUE;

			}


		}

		if (!$this->mdl_setup->validate_database()) {

			/* Display the database config form */

			$this->load->view('db_config');

		}

		else {

			/* User provided database config vars */

			$this->load->library('Lib_mysql');

			/* Can a connection to the server be made? */

			if ($this->lib_mysql->connect($this->input->post('hostname'), $this->input->post('username'), $this->input->post('password'))) {

				/* Yes, can the database be selected? */

				if ($this->lib_mysql->select_db($this->input->post('database'))) {

					/* Database selected, does MCB already exist here? */

					if ($this->lib_mysql->query("SHOW TABLES LIKE 'mcb_users'")) {

						/* Provide the file and redirect to upgrade */

						$data = array(
							'setup_type'	=>	'upgrade'
						);

					}

					else {

						/* Provide the file and redirect to install */

						$data = array(
							'setup_type'	=>	'install'
						);

					}

					$data['database_config_file_error'] = $database_config_file_error;
					$data['hostname'] = $this->input->post('hostname');
					$data['username'] = $this->input->post('username');
					$data['password'] = $this->input->post('password');
					$data['database'] = $this->input->post('database');

					$this->load->view('db_show_config', $data);

				}

				else {

					$data = array(
						'database_error'	=>	$this->lang->line('database_select_error')
					);

					$this->load->view('db_config', $data);

				}

			}

			else {

				$data = array(
					'database_error'	=>	$this->lang->line('database_connect_error')
				);

				$this->load->view('db_config', $data);

			}

		}

	}

	function install() {

		if ($this->mdl_setup->validate()) {

			$data = array(
				'install_messages'	=>	$this->mdl_setup->db_install()
			);

			$this->load->view('install_status', $data);

		}

		else {

			$this->load->view('install');

		}

	}

	function upgrade() {

		if ($this->input->post('btn_db_backup')) {

			$prefs = array(
				'format'      => 'zip',
				'filename'    => 'mcb_' . date('Y-m-d') . '.sql'
			);

			$this->load->library('db_backup');

			$this->db_backup->backup($prefs);

		}

		elseif ($this->input->post('btn_upgrade')) {

			$data = array(
				'upgrade_messages'	=>	$this->mdl_setup->db_upgrade());

			$this->load->view('upgrade_status', $data);

		}

		else {

			$this->load->view('upgrade');

		}

	}

}

?>