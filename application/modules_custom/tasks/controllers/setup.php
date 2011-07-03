<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Setup extends Admin_Controller {

	function __construct() {

		parent::__construct(TRUE);

	}

	function index() {

	}

	function install() {

		$queries = array(
			"CREATE TABLE IF NOT EXISTS `mcb_tasks` (
			`task_id` int(11) NOT NULL AUTO_INCREMENT,
			`user_id` int(11) NOT NULL,
			`client_id` int(11) NOT NULL,
			`start_date` varchar(25) NOT NULL DEFAULT '',
			`due_date` varchar(25) NOT NULL DEFAULT '',
			`complete_date` varchar(25) NOT NULL DEFAULT '',
			`title` varchar(255) NOT NULL DEFAULT '',
			`description` longtext NOT NULL,
			PRIMARY KEY (`task_id`),
			KEY `user_id` (`user_id`,`client_id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8;",

			"CREATE TABLE IF NOT EXISTS `mcb_tasks_invoices` (
			`task_invoice_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
			`task_id` INT NOT NULL ,
			`invoice_id` INT NOT NULL ,
			INDEX ( `task_id` , `invoice_id` )
			) ENGINE = MYISAM DEFAULT CHARSET=utf8;"
		);

		foreach ($queries as $query) {

			$this->db->query($query);

		}

	}

	function uninstall() {

		$queries = array(
			"DROP TABLE IF EXISTS `mcb_tasks`",
			"DROP TABLE IF EXISTS `mcb_tasks_invoices`"
		);

		foreach ($queries as $query) {

			$this->db->query($query);

		}

	}

	function upgrade() {

		$installed_version = $this->mdl_mcb_modules->custom_modules['tasks']->module_version;

		if ($installed_version < '0.2.6') {
			$this->u026();
			$this->u087();
			$this->u088();
			$this->u089();
            $this->u093();
		}

		elseif ($installed_version == '0.2.6') {
			$this->u087();
			$this->u088();
			$this->u089();
		}
		elseif ($installed_version == '0.8.7') {
			$this->u088();
			$this->u089();
            $this->u093();
		}
		elseif ($installed_version == '0.8.8') {
			$this->u089();
            $this->u093();
		}
        elseif ($installed_version == '0.8.9') {
            $this->u092();
            $this->u093();
        }
        elseif ($installed_version == '0.9.2') {
            $this->u093();
        }

	}

	function u026() {

		$this->db->set('complete_date', '');
		$this->db->where('complete_date', 0);
		$this->db->update('mcb_tasks');

		$this->db->set('due_date', '');
		$this->db->where('due_date', 0);
		$this->db->update('mcb_tasks');

		$this->db->set('module_version', '0.2.6');
		$this->db->where('module_path', 'tasks');
		$this->db->update('mcb_modules');

	}

	function u087() {

		$this->db->where('module_path', 'tasks');
		$this->db->set('module_version', '0.8.7');
		$this->db->update('mcb_modules');

	}

	function u088() {

		$this->db->where('module_path', 'tasks');
		$this->db->set('module_version', '0.8.8');
		$this->db->update('mcb_modules');

	}

	function u089() {

		$this->db->where('module_path', 'tasks');
		$this->db->set('module_version', '0.8.9');
		$this->db->update('mcb_modules');

	}

	function u092() {

		$this->db->where('module_path', 'tasks');
		$this->db->set('module_version', '0.9.2');
		$this->db->update('mcb_modules');

	}

	function u093() {

		$this->db->where('module_path', 'tasks');
		$this->db->set('module_version', '0.9.3');
		$this->db->update('mcb_modules');

	}

}

?>