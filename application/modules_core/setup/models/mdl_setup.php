<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_Setup extends MY_Model {

	public $install_version = '0.12';

	public $upgrade_path;

	function __construct() {

		parent::__construct();

		$this->table_name = 'mcb_users';

		$this->primary_key = 'mcb_users.user_id';

		$this->upgrade_path = array(
			array(
				'from'		=> '0.9.0',
				'to'		=> '0.9.2',
				'function'	=> 'u092'
			),
			array(
				'from'		=> '0.9.2',
				'to'		=> '0.9.2.1',
				'function'	=> 'u0921'
			),
			array(
				'from'		=> '0.9.2.1',
				'to'		=> '0.9.3',
				'function'	=> 'u093'
			),
			array(
				'from'		=> '0.9.3',
				'to'		=> '0.9.3.1',
				'function'	=> 'u0931'
			),
			array(
				'from'		=> '0.9.3.1',
				'to'		=> '0.9.3.2',
				'function'	=> 'u0932'
			),
			array(
				'from'		=> '0.9.3.2',
				'to'		=> '0.9.3.3',
				'function'	=> 'u0933'
			),
			array(
				'from'		=> '0.9.3.3',
				'to'		=> '0.9.4',
				'function'	=> 'u094'
			),
			array(
				'from'		=> '0.9.4',
				'to'		=> '0.9.4.1',
				'function'	=> 'u0941'
			),
			array(
				'from'		=> '0.9.4.1',
				'to'		=> '0.9.4.2',
				'function'	=> 'u0942'
			),
			array(
				'from'		=> '0.9.4.2',
				'to'		=> '0.9.4.3',
				'function'	=> 'u0943'
			),
			array(
				'from'		=> '0.9.4.3',
				'to'		=> '0.9.4.4',
				'function'	=> 'u0944'
			),
			array(
				'from'		=> '0.9.4.4',
				'to'		=> '0.9.4.5',
				'function'	=> 'u0945'
			),
			array(
				'from'		=> '0.9.4.5',
				'to'		=> '0.9.4.6',
				'function'	=> 'u0946'
			),
			array(
				'from'		=> '0.9.4.6',
				'to'		=> '0.9.5',
				'function'	=> 'u095'
			),
			array(
				'from'		=> '0.9.5',
				'to'		=> '0.9.5.1',
				'function'	=> 'u0951'
			),
			array(
				'from'		=> '0.9.5.1',
				'to'		=> '0.9.5.2',
				'function'	=> 'u0952'
			),
			array(
				'from'		=>	'0.9.5.2',
				'to'		=>	'0.9.5.3',
				'function'	=>	'u0953'
			),
			array(
				'from'		=>	'0.9.5.3',
				'to'		=>	'0.9.5.4',
				'function'	=>	'u0954'
			),
			array(
				'from'		=>	'0.9.5.4',
				'to'		=>	'0.9.5.5',
				'function'	=>	'u0955'
			),
			array(
				'from'		=>	'0.9.5.5',
				'to'		=>	'0.9.5.6',
				'function'	=>	'u0956'
			),
			array(
				'from'		=>	'0.9.5.6',
				'to'		=>	'0.9.5.7',
				'function'	=>	'u0957'
			),
			array(
				'from'		=>	'0.9.5.7',
				'to'		=>	'0.9.5.8',
				'function'	=>	'u0958'
			),
			array(
				'from'		=>	'0.9.5.8',
				'to'		=>	'0.9.5.9',
				'function'	=>	'u0959'
			),
			array(
				'from'		=>	'0.9.5.9',
				'to'		=>	'0.10',
				'function'	=>	'u010'
			),
			array(
				'from'		=>	'0.10',
				'to'		=>	'0.10.1',
				'function'	=>	'u0101'
			),
			array(
				'from'		=>	'0.10.1',
				'to'		=>	'0.10.2',
				'function'	=>	'u0102'
			),
			array(
				'from'		=>	'0.10.2',
				'to'		=>	'0.10.3',
				'function'	=>	'u0103'
			),
			array(
				'from'		=>	'0.10.3',
				'to'		=>	'0.11',
				'function'	=>	'u011'
			),
			array(
				'from'		=>	'0.11',
				'to'		=>	'0.12',
				'function'	=>	'u012'
			)
		);

		$this->load->model('mcb_data/mdl_mcb_data');
		$this->load->model('mcb_modules/mdl_mcb_modules');
		$this->load->model('invoices/mdl_invoice_amounts');
		$this->load->model('fields/mdl_fields');

	}

	function validate_database() {

		$this->load->library('form_validation');

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		$this->form_validation->set_rules('hostname', $this->lang->line('database_server'), 'required');
		$this->form_validation->set_rules('database', $this->lang->line('database_name'), 'required');
		$this->form_validation->set_rules('username', $this->lang->line('database_username'), 'required');
		$this->form_validation->set_rules('password', $this->lang->line('database_password'), 'required');

		return parent::validate();

	}

	function validate() {

		$this->load->library('form_validation');

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		$this->form_validation->set_rules('first_name', $this->lang->line('first_name'), 'required');
		$this->form_validation->set_rules('last_name', $this->lang->line('last_name'), 'required');
		$this->form_validation->set_rules('username', $this->lang->line('username'), 'required');
		$this->form_validation->set_rules('password', $this->lang->line('password'), 'required');
		$this->form_validation->set_rules('passwordv', $this->lang->line('password_verify'), 'required|matches[password]');
		$this->form_validation->set_rules('address', $this->lang->line('street_address'));
		$this->form_validation->set_rules('address', $this->lang->line('street_address_2'));
		$this->form_validation->set_rules('city', $this->lang->line('city'));
		$this->form_validation->set_rules('state', $this->lang->line('state'));
		$this->form_validation->set_rules('zip', $this->lang->line('zip'));
		$this->form_validation->set_rules('country', $this->lang->line('country'));
		$this->form_validation->set_rules('phone_number', $this->lang->line('phone_number'));
		$this->form_validation->set_rules('fax_number', $this->lang->line('fax_number'));
		$this->form_validation->set_rules('mobile_number', $this->lang->line('mobile_number'));
		$this->form_validation->set_rules('email_address', $this->lang->line('email_address'));
		$this->form_validation->set_rules('web_address', $this->lang->line('web_address'));
		$this->form_validation->set_rules('company_name', $this->lang->line('company_name'));

		return parent::validate();

	}

	function db_install() {

		$return = array();

		$this->load->database();

		// $this->db->db_debug = 0;

		if ($this->db_install_tables()) {

			$return[] = $this->lang->line('install_database_success');

		}

		else {

			$return[] = $this->lang->line('install_database_problem');

			return $return;

		}

		$db_array = parent::db_array();

		$db_array['password'] = md5($db_array['password']);
		$db_array['global_admin'] = 1;

		unset($db_array['passwordv']);

		if (parent::save($db_array, NULL, FALSE)) {

			$return[] = $this->lang->line('install_admin_account_success');

		}

		else {

			$return[] = $this->lang->line('install_admin_account_problem');

			return $return;

		}

		$return[] = $this->lang->line('installation_complete');

		$return[] = $this->lang->line('install_delete_folder');

		$return[] = APPPATH . 'modules_core/setup';

		$return[] = anchor('sessions/login', $this->lang->line('log_in'));

		$this->mdl_mcb_modules->refresh();

		return $return;

	}

	function db_install_tables() {

		foreach ($this->db_tables() as $query) {

			if (!$this->db->query($query)) {

				return FALSE;

			}

		}

		$this->install_table_data();

		$this->install_mcb_data();

		$this->mdl_mcb_data->save('version', $this->install_version);

		return TRUE;

	}

	function db_tables() {

		return array(

			"CREATE TABLE `mcb_clients` (
            `client_id` int(11) NOT NULL AUTO_INCREMENT,
            `client_name` varchar(255) NOT NULL DEFAULT '',
            `client_address` varchar(100) NOT NULL DEFAULT '',
            `client_address_2` varchar(100) NOT NULL DEFAULT '',
            `client_city` varchar(50) NOT NULL DEFAULT '',
            `client_state` varchar(50) NOT NULL DEFAULT '',
            `client_zip` varchar(10) NOT NULL DEFAULT '',
            `client_country` varchar(50) NOT NULL DEFAULT '',
            `client_phone_number` varchar(25) NOT NULL DEFAULT '',
            `client_fax_number` varchar(25) NOT NULL DEFAULT '',
            `client_mobile_number` varchar(25) NOT NULL DEFAULT '',
            `client_email_address` varchar(100) NOT NULL DEFAULT '',
            `client_web_address` varchar(255) NOT NULL DEFAULT '',
            `client_notes` longtext CHARACTER SET utf8 COLLATE utf8_bin,
            `client_tax_id` varchar(25) NOT NULL DEFAULT '',
            `client_active` int(1) NOT NULL DEFAULT '1',
            PRIMARY KEY (`client_id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;",

			"CREATE TABLE `mcb_client_credits` (
			`client_credit_id` int(11) NOT NULL AUTO_INCREMENT,
			`client_credit_client_id` int(11) NOT NULL,
			`client_credit_date` varchar(14) NOT NULL DEFAULT '',
			`client_credit_amount` decimal(10,2) NOT NULL,
			`client_credit_note` longtext NOT NULL,
			PRIMARY KEY (`client_credit_id`),
			KEY `client_credit_client_id` (`client_credit_client_id`,`client_credit_date`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;",

			"CREATE TABLE `mcb_client_data` (
            `mcb_client_data_id` int(11) NOT NULL AUTO_INCREMENT,
            `client_id` int(11) NOT NULL DEFAULT '0',
            `mcb_client_key` varchar(50) NOT NULL DEFAULT '',
            `mcb_client_value` varchar(100) NOT NULL DEFAULT '',
            PRIMARY KEY (`mcb_client_data_id`),
            KEY `client_id` (`client_id`),
            KEY `mcb_client_key` (`mcb_client_key`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;",

			"CREATE TABLE `mcb_contacts` (
            `contact_id` int(11) NOT NULL AUTO_INCREMENT,
            `client_id` int(11) NOT NULL DEFAULT '0',
            `first_name` varchar(50) NOT NULL DEFAULT '',
            `last_name` varchar(50) NOT NULL DEFAULT '',
            `address` varchar(100) NOT NULL DEFAULT '',
            `address_2` varchar(100) NOT NULL DEFAULT '',
            `city` varchar(50) NOT NULL DEFAULT '',
            `state` varchar(50) NOT NULL DEFAULT '',
            `zip` varchar(10) NOT NULL DEFAULT '',
            `country` varchar(50) NOT NULL DEFAULT '',
            `phone_number` varchar(25) NOT NULL DEFAULT '',
            `fax_number` varchar(25) NOT NULL DEFAULT '',
            `mobile_number` varchar(25) NOT NULL DEFAULT '',
            `email_address` varchar(100) NOT NULL DEFAULT '',
            `web_address` varchar(255) NOT NULL DEFAULT '',
            `notes` longtext CHARACTER SET utf8 COLLATE utf8_bin,
            PRIMARY KEY (`contact_id`),
            KEY `client_id` (`client_id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;",

			"CREATE TABLE `mcb_data` (
            `mcb_data_id` int(11) NOT NULL AUTO_INCREMENT,
            `mcb_key` varchar(50) NOT NULL DEFAULT '',
            `mcb_value` varchar(100) NOT NULL DEFAULT '',
            PRIMARY KEY (`mcb_data_id`),
            UNIQUE KEY `mcb_data_key` (`mcb_key`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;",

			"CREATE TABLE `mcb_email_templates` (
			`email_template_id` int(11) NOT NULL AUTO_INCREMENT,
			`email_template_user_id` int(11) NOT NULL,
			`email_template_title` varchar(50) NOT NULL DEFAULT '',
			`email_template_body` longtext NOT NULL,
			`email_template_footer` longtext NOT NULL,
			PRIMARY KEY (`email_template_id`),
			KEY `email_template_user_id` (`email_template_user_id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;",

			"CREATE TABLE `mcb_fields` (
            `field_id` int(11) NOT NULL AUTO_INCREMENT,
            `object_id` int(11) NOT NULL DEFAULT '0',
            `field_name` varchar(50) NOT NULL DEFAULT '',
            `field_index` int(11) NOT NULL DEFAULT '0',
            `column_name` varchar(25) NOT NULL DEFAULT '',
            PRIMARY KEY (`field_id`),
            KEY `object_id` (`object_id`),
            KEY `field_index` (`field_index`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;",

			"CREATE TABLE `mcb_inventory` (
            `inventory_id` int(11) NOT NULL AUTO_INCREMENT,
            `inventory_type_id` int(11) NOT NULL DEFAULT '0',
            `inventory_tax_rate_id` int(11) NOT NULL DEFAULT '0',
            `inventory_name` varchar(255) NOT NULL DEFAULT '',
            `inventory_unit_price` decimal(10,2) NOT NULL DEFAULT '0.00',
            `inventory_description` longtext,
            `inventory_track_stock` int(1) NOT NULL DEFAULT '0',
            PRIMARY KEY (`inventory_id`),
            KEY `inventory_type_id` (`inventory_type_id`),
            KEY `inventory_tax_rate_id` (`inventory_tax_rate_id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;",

			"CREATE TABLE `mcb_inventory_stock` (
            `inventory_stock_id` int(11) NOT NULL AUTO_INCREMENT,
            `inventory_id` int(11) NOT NULL DEFAULT '0',
            `invoice_item_id` int(11) NOT NULL DEFAULT '0',
            `inventory_stock_quantity` decimal(10,2) NOT NULL DEFAULT '0.00',
            `inventory_stock_date` varchar(14) NOT NULL DEFAULT '',
            `inventory_stock_notes` longtext,
            PRIMARY KEY (`inventory_stock_id`),
            KEY `inventory_id` (`inventory_id`),
            KEY `invoice_item_id` (`invoice_item_id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;",

			"CREATE TABLE `mcb_inventory_types` (
            `inventory_type_id` int(11) NOT NULL AUTO_INCREMENT,
            `inventory_type` varchar(50) NOT NULL DEFAULT '',
            PRIMARY KEY (`inventory_type_id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;",

			"CREATE TABLE `mcb_invoices` (
			`invoice_id` int(11) NOT NULL AUTO_INCREMENT,
			`client_id` int(11) NOT NULL DEFAULT '0',
			`user_id` int(11) NOT NULL DEFAULT '0',
			`invoice_status_id` int(11) NOT NULL DEFAULT '0',
			`invoice_date_entered` varchar(14) NOT NULL DEFAULT '',
			`invoice_number` varchar(50) NOT NULL DEFAULT '',
			`invoice_notes` longtext CHARACTER SET utf8 COLLATE utf8_bin,
			`invoice_due_date` varchar(14) NOT NULL DEFAULT '',
			`invoice_is_quote` int(1) NOT NULL DEFAULT '0',
			`invoice_group_id` int(11) NOT NULL DEFAULT '0',
			PRIMARY KEY (`invoice_id`),
			KEY `client_id` (`client_id`),
			KEY `user_id` (`user_id`),
			KEY `invoice_status_id` (`invoice_status_id`),
			KEY `invoice_group_id` (`invoice_group_id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8;",

			"CREATE TABLE `mcb_invoice_amounts` (
            `invoice_amount_id` int(11) NOT NULL AUTO_INCREMENT,
            `invoice_id` int(11) NOT NULL DEFAULT '0',
            `invoice_item_subtotal` decimal(10,2) NOT NULL DEFAULT '0.00',
            `invoice_item_taxable` decimal(10,2) NOT NULL DEFAULT '0.00',
            `invoice_item_tax` decimal(10,2) NOT NULL DEFAULT '0.00',
            `invoice_subtotal` decimal(10,2) NOT NULL DEFAULT '0.00',
            `invoice_tax` decimal(10,2) NOT NULL DEFAULT '0.00',
            `invoice_shipping` decimal(10,2) NOT NULL DEFAULT '0.00',
            `invoice_discount` decimal(10,2) NOT NULL DEFAULT '0.00',
            `invoice_paid` decimal(10,2) NOT NULL DEFAULT '0.00',
            `invoice_total` decimal(10,2) NOT NULL DEFAULT '0.00',
            `invoice_balance` decimal(10,2) NOT NULL DEFAULT '0.00',
            PRIMARY KEY (`invoice_amount_id`),
            KEY `invoice_id` (`invoice_id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;",

			"CREATE TABLE `mcb_invoice_groups` (
            `invoice_group_id` int(11) NOT NULL AUTO_INCREMENT,
            `invoice_group_name` varchar(50) NOT NULL DEFAULT '',
            `invoice_group_prefix` varchar(10) NOT NULL DEFAULT '',
            `invoice_group_next_id` int(11) NOT NULL DEFAULT '0',
            `invoice_group_left_pad` int(2) NOT NULL DEFAULT '0',
            `invoice_group_prefix_year` int(1) NOT NULL DEFAULT '0',
            `invoice_group_prefix_month` int(1) NOT NULL DEFAULT '0',
            PRIMARY KEY (`invoice_group_id`),
            KEY `invoice_group_next_id` (`invoice_group_next_id`),
            KEY `invoice_group_left_pad` (`invoice_group_left_pad`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;",

			"CREATE TABLE `mcb_invoice_history` (
            `invoice_history_id` int(11) NOT NULL AUTO_INCREMENT,
            `invoice_id` int(11) NOT NULL DEFAULT '0',
            `user_id` int(11) NOT NULL DEFAULT '0',
            `invoice_history_date` varchar(14) NOT NULL DEFAULT '',
            `invoice_history_data` longtext,
            PRIMARY KEY (`invoice_history_id`),
            KEY `user_id` (`user_id`),
            KEY `invoice_id` (`invoice_id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;",

			"CREATE TABLE `mcb_invoice_items` (
            `invoice_item_id` int(11) NOT NULL AUTO_INCREMENT,
            `invoice_id` int(11) NOT NULL DEFAULT '0',
            `inventory_id` int(11) NOT NULL DEFAULT '0',
            `item_name` longtext CHARACTER SET utf8 COLLATE utf8_bin,
            `item_description` longtext,
            `item_date` varchar(14) NOT NULL DEFAULT '',
            `item_qty` decimal(10,2) NOT NULL DEFAULT '0.00',
            `item_price` decimal(10,2) NOT NULL DEFAULT '0.00',
            `tax_rate_id` int(11) NOT NULL DEFAULT '0',
            `is_taxable` int(1) NOT NULL DEFAULT '0',
            `item_tax_option` int(1) NOT NULL DEFAULT '0',
            `item_order` int(11) NOT NULL DEFAULT '0',
            PRIMARY KEY (`invoice_item_id`),
            KEY `invoice_id` (`invoice_id`),
            KEY `tax_rate_id` (`tax_rate_id`),
            KEY `inventory_id` (`inventory_id`),
            KEY `item_order` (`item_order`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;",

			"CREATE TABLE `mcb_invoice_item_amounts` (
            `invoice_item_amount_id` int(11) NOT NULL AUTO_INCREMENT,
            `invoice_item_id` int(11) NOT NULL DEFAULT '0',
            `item_subtotal` decimal(10,2) NOT NULL DEFAULT '0.00',
            `item_tax` decimal(10,2) NOT NULL DEFAULT '0.00',
            `item_total` decimal(10,2) NOT NULL DEFAULT '0.00',
            PRIMARY KEY (`invoice_item_amount_id`),
            KEY `invoice_item_id` (`invoice_item_id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;",

			"CREATE TABLE `mcb_invoice_statuses` (
            `invoice_status_id` int(11) NOT NULL AUTO_INCREMENT,
            `invoice_status` varchar(255) NOT NULL DEFAULT '',
            `invoice_status_type` int(1) NOT NULL DEFAULT '0',
            PRIMARY KEY (`invoice_status_id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;",

			"CREATE TABLE `mcb_invoice_tags` (
            `invoice_tag_id` int(11) NOT NULL AUTO_INCREMENT,
            `invoice_id` int(11) NOT NULL DEFAULT '0',
            `tag_id` int(11) NOT NULL DEFAULT '0',
            PRIMARY KEY (`invoice_tag_id`),
            KEY `invoice_id` (`invoice_id`,`tag_id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;",

			"CREATE TABLE `mcb_invoice_tax_rates` (
            `invoice_tax_rate_id` int(11) NOT NULL AUTO_INCREMENT,
            `invoice_id` int(11) NOT NULL DEFAULT '0',
            `tax_rate_id` int(11) NOT NULL DEFAULT '0',
            `tax_rate_option` int(1) NOT NULL DEFAULT '1',
            `tax_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
            PRIMARY KEY (`invoice_tax_rate_id`),
            KEY `invoice_id` (`invoice_id`,`tax_rate_id`),
            KEY `tax_rate_option` (`tax_rate_option`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;",

			"CREATE TABLE `mcb_merchant_responses` (
			`merchant_response_id` int(11) NOT NULL AUTO_INCREMENT,
			`merchant_response_payment_id` int(11) NOT NULL,
			`merchant_response_client_id` int(11) NOT NULL,
			`merchant_response_invoice_id` int(11) NOT NULL,
			`merchant_response_amount` decimal(10,2) NOT NULL,
			`merchant_response_method` varchar(25) NOT NULL DEFAULT '',
			`merchant_response_status` varchar(25) NOT NULL DEFAULT '',
			`merchant_response_payment_status` varchar(25) NOT NULL DEFAULT '',
			`merchant_response_payment_processed` int(1) NOT NULL DEFAULT '0',
			`merchant_response_post` longtext NOT NULL,
			PRIMARY KEY (`merchant_response_id`),
			KEY `merchant_response_payment_id` (`merchant_response_payment_id`,`merchant_response_client_id`,`merchant_response_invoice_id`),
			KEY `merchant_response_payment_processed` (`merchant_response_payment_processed`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8;",

			"CREATE TABLE `mcb_modules` (
            `module_id` int(11) NOT NULL AUTO_INCREMENT,
            `module_path` varchar(50) NOT NULL DEFAULT '',
            `module_name` varchar(50) NOT NULL DEFAULT '',
            `module_description` varchar(255) NOT NULL DEFAULT '',
            `module_enabled` int(1) NOT NULL DEFAULT '0',
            `module_author` varchar(50) NOT NULL DEFAULT '',
            `module_homepage` varchar(255) NOT NULL DEFAULT '',
            `module_version` varchar(25) NOT NULL DEFAULT '',
            `module_available_version` varchar(25) NOT NULL DEFAULT '',
            `module_config` longtext,
            `module_core` int(1) NOT NULL DEFAULT '0',
            `module_order` int(2) NOT NULL DEFAULT '99',
            PRIMARY KEY (`module_id`),
            KEY `module_order` (`module_order`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;",

			"CREATE TABLE `mcb_payments` (
            `payment_id` int(11) NOT NULL AUTO_INCREMENT,
            `invoice_id` int(11) NOT NULL DEFAULT '0',
            `payment_method_id` int(11) NOT NULL DEFAULT '0',
            `payment_date` varchar(14) NOT NULL DEFAULT '',
            `payment_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
            `payment_note` longtext CHARACTER SET utf8 COLLATE utf8_bin,
            PRIMARY KEY (`payment_id`),
            KEY `invoice_id` (`invoice_id`),
            KEY `payment_method_id` (`payment_method_id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;",

			"CREATE TABLE `mcb_payment_methods` (
            `payment_method_id` int(11) NOT NULL AUTO_INCREMENT,
            `payment_method` varchar(25) NOT NULL DEFAULT '',
            PRIMARY KEY (`payment_method_id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;",

			"CREATE TABLE `mcb_tags` (
            `tag_id` int(11) NOT NULL AUTO_INCREMENT,
            `tag` varchar(50) NOT NULL DEFAULT '',
            PRIMARY KEY (`tag_id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;",

			"CREATE TABLE `mcb_tax_rates` (
            `tax_rate_id` int(11) NOT NULL AUTO_INCREMENT,
            `tax_rate_name` varchar(25) NOT NULL DEFAULT '',
            `tax_rate_percent` decimal(5,2) NOT NULL DEFAULT '0.00',
            PRIMARY KEY (`tax_rate_id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;",

			"CREATE TABLE `mcb_userdata` (
			  `mcb_userdata_id` int(11) NOT NULL AUTO_INCREMENT,
			  `mcb_userdata_user_id` int(11) NOT NULL,
			  `mcb_userdata_key` varchar(50) NOT NULL DEFAULT '',
			  `mcb_userdata_value` varchar(100) NOT NULL DEFAULT '',
			  PRIMARY KEY (`mcb_userdata_id`),
			  KEY `mcb_data_key` (`mcb_userdata_key`),
			  KEY `mcb_userdata_user_id` (`mcb_userdata_user_id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;",

			"CREATE TABLE `mcb_users` (
            `user_id` int(11) NOT NULL AUTO_INCREMENT,
            `client_id` int(11) NOT NULL DEFAULT '0',
			`global_admin` int(1) NOT NULL DEFAULT '0',
            `username` varchar(25) NOT NULL DEFAULT '',
            `password` varchar(50) NOT NULL DEFAULT '',
            `first_name` varchar(50) NOT NULL DEFAULT '',
            `last_name` varchar(50) NOT NULL DEFAULT '',
            `address` varchar(100) NOT NULL DEFAULT '',
            `address_2` varchar(100) NOT NULL DEFAULT '',
            `city` varchar(50) NOT NULL DEFAULT '',
            `state` varchar(50) NOT NULL DEFAULT '',
            `zip` varchar(10) NOT NULL DEFAULT '',
            `country` varchar(50) NOT NULL DEFAULT '',
            `phone_number` varchar(25) NOT NULL DEFAULT '',
            `fax_number` varchar(25) NOT NULL DEFAULT '',
            `mobile_number` varchar(25) NOT NULL DEFAULT '',
            `email_address` varchar(100) NOT NULL DEFAULT '',
            `web_address` varchar(255) NOT NULL DEFAULT '',
            `company_name` varchar(255) NOT NULL DEFAULT '',
            `last_login` varchar(25) NOT NULL DEFAULT '',
            `tax_id_number` varchar(50) NOT NULL DEFAULT '',
            PRIMARY KEY (`user_id`),
            KEY `client_id` (`client_id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;"

		);

	}

	function db_upgrade() {

		$this->load->database();

		$return = array();

		if ($this->mdl_mcb_data->get('version') <> $this->install_version) {

			foreach ($this->upgrade_path as $path) {

				$app_version = $this->mdl_mcb_data->get('version');

				if ($path['from'] == $app_version) {

					if ($this->{$path['function']}()) {

						$return[] = 'Upgrade from ' . $path['from'] . ' to ' . $path['to'] . ' successful<br />';

					}

					else {

						$return[] = 'Upgrade from ' . $path['from'] . ' to ' . $path['to'] . ' FAILED. Script exiting.';

						return $return;

					}

				}

			}

			$return[] = $this->lang->line('upgrade_complete');

			$return[] = $this->lang->line('install_delete_folder');

			$return[] = APPPATH . 'modules_core/setup';

			$return[] = anchor('sessions/login', $this->lang->line('log_in'));

			$this->install_mcb_data();

			$this->mdl_mcb_modules->refresh();

			$this->mdl_invoice_amounts->adjust();

			return $return;

		}

		else {
			
			$return[] = anchor('sessions/login', $this->lang->line('log_in'));

			$return[] = $this->lang->line('install_already_current');

			return $return;

		}

	}

	function u090() {

		$queries = array(

			"CREATE TABLE `mcb_fields` (
			  `field_id` int(11) NOT NULL AUTO_INCREMENT,
			  `object_id` int(11) NOT NULL,
			  `field_name` varchar(50) NOT NULL DEFAULT '',
			  `field_index` int(11) NOT NULL,
			  `column_name` varchar(25) NOT NULL DEFAULT '',
			  PRIMARY KEY (`field_id`),
			  KEY `object_id` (`object_id`),
			  KEY `field_index` (`field_index`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8;",

			"ALTER TABLE `mcb_modules` ADD `module_order` INT( 2 ) NOT NULL DEFAULT '99',
			ADD INDEX ( `module_order` )",

			"ALTER TABLE `mcb_invoice_groups` ADD `invoice_group_prefix_year` INT( 1 ) NOT NULL DEFAULT '0',
			ADD `invoice_group_prefix_month` INT( 1 ) NOT NULL DEFAULT '0'"

		);

		if (!$this->run_queries($queries)) {

			return FALSE;

		}

		if ($this->db->field_exists('invoice_stored_description', 'mcb_invoice_stored_items')) {

			$this->db->query("ALTER TABLE `mcb_invoice_stored_items` CHANGE `invoice_stored_description` `invoice_stored_item_description` LONGTEXT NOT NULL");

		}

		$this->mdl_mcb_data->save('version', '0.9.0');

		return TRUE;

	}

	function u092() {

		$this->mdl_mcb_data->save('version', '0.9.2');

		return TRUE;

	}

	function u0921() {

		$queries = array(
			"ALTER TABLE `mcb_clients` CHANGE `client_name` `client_name` varchar(255) NOT NULL DEFAULT '' AFTER client_id",
			"ALTER TABLE `mcb_clients` CHANGE `client_country` `client_country` VARCHAR( 50 ) NOT NULL DEFAULT ''"
		);

		if (!$this->run_queries($queries)) {

			return FALSE;

		}

		$this->mdl_mcb_data->save('version', '0.9.2.1');

		return TRUE;

	}

	function u093() {

		$this->mdl_mcb_data->save('version', '0.9.3');

		return TRUE;

	}

	function u0931() {

		$this->mdl_mcb_data->save('version', '0.9.3.1');

		return TRUE;

	}

	function u0932() {

		$this->mdl_mcb_data->save('version', '0.9.3.2');

		return TRUE;

	}

	function u0933() {

		$this->mdl_mcb_data->save('version', '0.9.3.3');

		return TRUE;

	}

	function u094() {

		$this->mdl_mcb_data->save('version', '0.9.4');

		return TRUE;

	}

	function u0941() {

		$queries = array(
			"ALTER TABLE `mcb_invoice_items` ADD `item_tax_option` INT( 1 ) NOT NULL DEFAULT '0'"
		);

		$this->run_queries($queries);

		$this->mdl_mcb_data->save('version', '0.9.4.1');

		return TRUE;

	}

	function u0942() {

		$this->mdl_mcb_data->save('version', '0.9.4.2');

		return TRUE;

	}

	function u0943() {

		$queries = array(

			"RENAME TABLE `mcb_invoice_stored_items` TO `mcb_inventory`",

			"ALTER TABLE `mcb_inventory`
            CHANGE `invoice_stored_item_id` `inventory_id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
            CHANGE `invoice_stored_item` `inventory_name` VARCHAR( 255 ) NOT NULL DEFAULT '',
            CHANGE `invoice_stored_unit_price` `inventory_unit_price` DECIMAL( 10, 2 ) NOT NULL DEFAULT '0.00',
            CHANGE `invoice_stored_item_description` `inventory_description` LONGTEXT NOT NULL,
            ADD `inventory_type_id` INT NOT NULL AFTER `inventory_id` ,
            ADD `inventory_track_stock` int(1) NOT NULL DEFAULT '0',
            ADD `tax_rate_id` INT NOT NULL AFTER `inventory_type_id`,
            ADD INDEX ( `inventory_type_id` ),
            ADD INDEX ( `tax_rate_id` )",

			"ALTER TABLE `mcb_invoice_items` ADD `inventory_id` INT NOT NULL AFTER `invoice_id` ,
            ADD INDEX ( `inventory_id` )",

			"CREATE TABLE `mcb_inventory_stock` (
            `inventory_stock_id` int(11) NOT NULL AUTO_INCREMENT,
            `inventory_id` int(11) NOT NULL,
            `invoice_item_id` int(11) NOT NULL,
            `inventory_stock_quantity` decimal(10,2) NOT NULL DEFAULT '0.00',
            `inventory_stock_date` varchar(14) NOT NULL DEFAULT '',
            `inventory_stock_notes` LONGTEXT NOT NULL,
            PRIMARY KEY (`inventory_stock_id`),
            KEY `inventory_id` (`inventory_id`),
            KEY `invoice_item_id` (`invoice_item_id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;",

			"CREATE TABLE `mcb_inventory_types` (
            `inventory_type_id` int(11) NOT NULL AUTO_INCREMENT,
            `inventory_type` varchar(50) NOT NULL DEFAULT '',
            PRIMARY KEY (`inventory_type_id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;",

			"ALTER TABLE `mcb_invoice_items` ADD `item_order` INT NOT NULL ,
            ADD INDEX ( `item_order` )",

			"ALTER TABLE `mcb_users` ADD `client_id` INT NOT NULL AFTER `user_id` ,
            ADD INDEX ( `client_id` ) "

		);

		$this->run_queries($queries);

		$this->db->select('invoice_item_id, invoice_id, item_order');
		$this->db->order_by('invoice_item_id');
		$items = $this->db->get('mcb_invoice_items')->result();

		foreach ($items as $item) {

			if (!isset($tmp_invoice_id) or isset($tmp_invoice_id) and $tmp_invoice_id <> $item->invoice_id) {

				$x = 1;

			}

			$this->db->where('invoice_item_id', $item->invoice_item_id);
			$this->db->set('item_order', $x);
			$this->db->update('mcb_invoice_items');

			$x++;

			$tmp_invoice_id = $item->invoice_id;

		}

		if ($this->db->table_exists('mcb_client_center')) {

			$client_accounts = $this->db->get('mcb_client_center')->result();

			foreach ($client_accounts as $user) {

				if ($user->client_id) {

					$db_array = array(
						'client_id' => $user->client_id,
						'username' => $user->username,
						'password' => $user->password,
						'last_login' => $user->last_login
					);

					$this->db->insert('mcb_users', $db_array);

				}

			}

			$this->load->dbforge();

			$this->dbforge->drop_table('mcb_client_center');

		}

		$this->mdl_mcb_data->save('version', '0.9.4.3');

		return TRUE;

	}

	function u0944() {

		$queries = array(
			"ALTER TABLE `mcb_users` CHANGE `client_id` `client_id` INT( 11 ) NOT NULL DEFAULT '0'"
		);

		$this->run_queries($queries);

		$this->mdl_mcb_data->save('version', '0.9.4.4');

		return TRUE;

	}

	function u0945() {

		$this->mdl_mcb_data->save('version', '0.9.4.5');

		return TRUE;

	}

	function u0946() {

		$this->mdl_mcb_data->save('version', '0.9.4.6');

		return TRUE;

	}

	function u095() {

		$this->db->query('UPDATE mcb_invoice_items SET inventory_id = (SELECT inventory_id FROM mcb_inventory WHERE mcb_inventory.inventory_name = mcb_invoice_items.item_name)');

		$this->mdl_mcb_data->save('version', '0.9.5');

		return TRUE;

	}

	function u0951() {

		$queries = array(

			"ALTER TABLE `mcb_client_data` CHANGE `client_id` `client_id` INT( 11 ) NOT NULL DEFAULT '0'",

			"ALTER TABLE `mcb_contacts` CHANGE `client_id` `client_id` INT( 11 ) NOT NULL DEFAULT '0',
            CHANGE `country` `country` VARCHAR( 50 ) NOT NULL DEFAULT ''",

			"ALTER TABLE `mcb_fields` CHANGE `object_id` `object_id` INT( 11 ) NOT NULL DEFAULT '0',
            CHANGE `field_index` `field_index` INT( 11 ) NOT NULL DEFAULT '0'",

			"ALTER TABLE `mcb_inventory` CHANGE `inventory_type_id` `inventory_type_id` INT( 11 ) NOT NULL DEFAULT '0',
            CHANGE `tax_rate_id` `tax_rate_id` INT( 11 ) NOT NULL DEFAULT '0',
            CHANGE `inventory_description` `inventory_description` LONGTEXT NULL DEFAULT NULL",

			"ALTER TABLE `mcb_inventory_stock` CHANGE `inventory_id` `inventory_id` INT( 11 ) NOT NULL DEFAULT '0',
            CHANGE `invoice_item_id` `invoice_item_id` INT( 11 ) NOT NULL DEFAULT '0',
            CHANGE `inventory_stock_date` `inventory_stock_date` VARCHAR( 14 ) NOT NULL DEFAULT '',
            CHANGE `inventory_stock_notes` `inventory_stock_notes` LONGTEXT NULL DEFAULT NULL",

			"ALTER TABLE `mcb_invoices` CHANGE `client_id` `client_id` INT( 11 ) NOT NULL DEFAULT '0',
            CHANGE `user_id` `user_id` INT( 11 ) NOT NULL DEFAULT '0',
            CHANGE `invoice_status_id` `invoice_status_id` INT( 11 ) NOT NULL DEFAULT '0',
            CHANGE `invoice_group_id` `invoice_group_id` INT( 11 ) NOT NULL DEFAULT '0'",

			"ALTER TABLE `mcb_invoice_amounts` CHANGE `invoice_id` `invoice_id` INT( 11 ) NOT NULL DEFAULT '0'",

			"ALTER TABLE `mcb_invoice_history` CHANGE `invoice_id` `invoice_id` INT( 11 ) NOT NULL DEFAULT '0',
            CHANGE `user_id` `user_id` INT( 11 ) NOT NULL DEFAULT '0',
            CHANGE `invoice_history_date` `invoice_history_date` VARCHAR( 14 ) NOT NULL DEFAULT '',
            CHANGE `invoice_history_data` `invoice_history_data` LONGTEXT NULL DEFAULT NULL",

			"ALTER TABLE `mcb_invoice_items` CHANGE `invoice_id` `invoice_id` INT( 11 ) NOT NULL DEFAULT '0',
            CHANGE `inventory_id` `inventory_id` INT( 11 ) NOT NULL DEFAULT '0',
            CHANGE `item_description` `item_description` LONGTEXT NULL DEFAULT NULL ,
            CHANGE `item_date` `item_date` VARCHAR( 14 ) NOT NULL DEFAULT '',
            CHANGE `tax_rate_id` `tax_rate_id` INT( 11 ) NOT NULL DEFAULT '0',
            CHANGE `is_taxable` `is_taxable` INT( 1 ) NOT NULL DEFAULT '0',
            CHANGE `item_order` `item_order` INT( 11 ) NOT NULL DEFAULT '0'",

			"ALTER TABLE `mcb_invoice_item_amounts` CHANGE `invoice_item_id` `invoice_item_id` INT( 11 ) NOT NULL DEFAULT '0',
            CHANGE `item_subtotal` `item_subtotal` DECIMAL( 10, 2 ) NOT NULL DEFAULT '0.00',
            CHANGE `item_tax` `item_tax` DECIMAL( 10, 2 ) NOT NULL DEFAULT '0.00',
            CHANGE `item_total` `item_total` DECIMAL( 10, 2 ) NOT NULL DEFAULT '0.00'",

			"ALTER TABLE `mcb_invoice_statuses` CHANGE `invoice_status` `invoice_status` VARCHAR( 255 ) NOT NULL DEFAULT '',
            CHANGE `invoice_status_type` `invoice_status_type` INT( 1 ) NOT NULL DEFAULT '0'",

			"ALTER TABLE `mcb_invoice_tags` CHANGE `invoice_id` `invoice_id` INT( 11 ) NOT NULL DEFAULT '0',
            CHANGE `tag_id` `tag_id` INT( 11 ) NOT NULL DEFAULT '0'",

			"ALTER TABLE `mcb_invoice_tax_rates` CHANGE `invoice_id` `invoice_id` INT( 11 ) NOT NULL DEFAULT '0',
            CHANGE `tax_rate_id` `tax_rate_id` INT( 11 ) NOT NULL DEFAULT '0',
            CHANGE `tax_amount` `tax_amount` DECIMAL( 10, 2 ) NOT NULL DEFAULT '0.00'",

			"ALTER TABLE `mcb_modules` CHANGE `module_config` `module_config` LONGTEXT NULL DEFAULT NULL",

			"ALTER TABLE `mcb_payments` CHANGE `invoice_id` `invoice_id` INT( 11 ) NOT NULL DEFAULT '0',
            CHANGE `payment_method_id` `payment_method_id` INT( 11 ) NOT NULL DEFAULT '0'",

			"ALTER TABLE `mcb_payment_methods` CHANGE `payment_method` `payment_method` VARCHAR( 25 ) NOT NULL DEFAULT ''",

			"ALTER TABLE `mcb_tags` CHANGE `tag` `tag` VARCHAR( 50 ) NOT NULL DEFAULT ''",

			"ALTER TABLE `mcb_users` CHANGE `address_2` `address_2` VARCHAR( 100 ) NOT NULL DEFAULT '',
            CHANGE `country` `country` VARCHAR( 50 ) NOT NULL DEFAULT ''"
		);

		$this->run_queries($queries);

		$this->mdl_mcb_data->save('version', '0.9.5.1');

		return TRUE;

	}

	function u0952() {

		$this->mdl_mcb_data->save('version', '0.9.5.2');

		return TRUE;

	}

	function u0953() {

		$this->mdl_mcb_data->save('version', '0.9.5.3');

		return TRUE;

	}

	function u0954() {

		$queries = array(
			"CREATE TABLE `mcb_userdata` (
			`mcb_userdata_id` int(11) NOT NULL AUTO_INCREMENT,
			`mcb_userdata_user_id` int(11) NOT NULL,
			`mcb_userdata_key` varchar(50) NOT NULL DEFAULT '',
			`mcb_userdata_value` varchar(100) NOT NULL DEFAULT '',
			PRIMARY KEY (`mcb_userdata_id`),
			KEY `mcb_data_key` (`mcb_userdata_key`),
			KEY `mcb_userdata_user_id` (`mcb_userdata_user_id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;"

		);

		$this->run_queries($queries);

		$this->mdl_mcb_data->save('version', '0.9.5.4');

		return TRUE;

	}

	function u0955() {

		$this->mdl_mcb_data->save('version', '0.9.5.5');

		return TRUE;

	}

	function u0956() {

		$queries = array(

			"ALTER TABLE `mcb_inventory` CHANGE `tax_rate_id` `inventory_tax_rate_id` INT( 11 ) NOT NULL DEFAULT '0'"

		);

		$this->run_queries($queries);

		$this->mdl_mcb_data->save('version', '0.9.5.6');

		return TRUE;

	}

	function u0957() {

		$queries = array(
			"CREATE TABLE `mcb_client_credits` (
			`client_credit_id` int(11) NOT NULL AUTO_INCREMENT,
			`client_credit_client_id` int(11) NOT NULL,
			`client_credit_date` varchar(14) NOT NULL DEFAULT '',
			`client_credit_amount` decimal(10,2) NOT NULL,
			`client_credit_note` longtext NOT NULL,
			PRIMARY KEY (`client_credit_id`),
			KEY `client_credit_client_id` (`client_credit_client_id`,`client_credit_date`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;"
		);

		$this->run_queries($queries);

		$this->mdl_mcb_data->save('version', '0.9.5.7');

		return TRUE;

	}

	function u0958() {

		$this->mdl_mcb_data->save('version', '0.9.5.8');

		return TRUE;

	}

	function u0959() {

		$this->mdl_mcb_data->save('version', '0.9.5.9');

		return TRUE;

	}

	function u010() {

		$this->mdl_mcb_data->save('version', '0.10');

		return TRUE;

	}

	function u0101() {

		$queries = array(
			"CREATE TABLE `mcb_merchant_responses` (
			`merchant_response_id` int(11) NOT NULL AUTO_INCREMENT,
			`merchant_response_payment_id` int(11) NOT NULL,
			`merchant_response_client_id` int(11) NOT NULL,
			`merchant_response_invoice_id` int(11) NOT NULL,
			`merchant_response_amount` decimal(10,2) NOT NULL,
			`merchant_response_method` varchar(25) NOT NULL DEFAULT '',
			`merchant_response_status` varchar(25) NOT NULL DEFAULT '',
			`merchant_response_payment_status` varchar(25) NOT NULL DEFAULT '',
			`merchant_response_payment_processed` int(1) NOT NULL DEFAULT '0',
			`merchant_response_post` longtext NOT NULL,
			PRIMARY KEY (`merchant_response_id`),
			KEY `merchant_response_payment_id` (`merchant_response_payment_id`,`merchant_response_client_id`,`merchant_response_invoice_id`),
			KEY `merchant_response_payment_processed` (`merchant_response_payment_processed`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8;"
		);

		$this->run_queries($queries);

		$this->mdl_mcb_data->save('version', '0.10.1');

		return TRUE;

	}
	
	function u0102() {

		$queries = array(
			"CREATE TABLE `mcb_email_templates` (
			`email_template_id` int(11) NOT NULL AUTO_INCREMENT,
			`email_template_user_id` int(11) NOT NULL,
			`email_template_title` varchar(50) NOT NULL DEFAULT '',
			`email_template_body` longtext NOT NULL,
			`email_template_footer` longtext NOT NULL,
			PRIMARY KEY (`email_template_id`),
			KEY `email_template_user_id` (`email_template_user_id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;"
		);

		$this->run_queries($queries);

		$this->mdl_mcb_data->save('version', '0.10.2');

		return TRUE;

	}

	function u0103() {

		$this->mdl_mcb_data->save('version', '0.10.3');

		return TRUE;

	}

	function u011() {

		$this->mdl_mcb_data->save('version', '0.11');

		return TRUE;

	}

	function u012() {

		$this->mdl_mcb_data->save('version', '0.12');

		return TRUE;

	}

	function install_mcb_data() {

		$this->mdl_mcb_data->save('application_title', $this->lang->line('myclientbase'), TRUE);
		$this->mdl_mcb_data->save('cc_enable_client_tax_id', 0, TRUE);
		$this->mdl_mcb_data->save('cc_enable_client_address', 0, TRUE);
		$this->mdl_mcb_data->save('cc_enable_client_address_2', 0, TRUE);
		$this->mdl_mcb_data->save('cc_enable_client_city', 0, TRUE);
		$this->mdl_mcb_data->save('cc_enable_client_state', 0, TRUE);
		$this->mdl_mcb_data->save('cc_enable_client_zip', 0, TRUE);
		$this->mdl_mcb_data->save('cc_enable_client_country', 0, TRUE);
		$this->mdl_mcb_data->save('cc_enable_client_phone_number', 0, TRUE);
		$this->mdl_mcb_data->save('cc_enable_client_fax_number', 0, TRUE);
		$this->mdl_mcb_data->save('cc_enable_client_mobile_number', 0, TRUE);
		$this->mdl_mcb_data->save('cc_enable_client_email_address', 0, TRUE);
		$this->mdl_mcb_data->save('cc_enable_client_web_address', 0, TRUE);
		$this->mdl_mcb_data->save('cc_edit_enabled', 0, TRUE);
		$this->mdl_mcb_data->save('cron_key', '', TRUE);
		$this->mdl_mcb_data->save('currency_symbol', '$', TRUE);
		$this->mdl_mcb_data->save('currency_symbol_placement', 'before', TRUE);
		$this->mdl_mcb_data->save('dashboard_override', '', TRUE);
		$this->mdl_mcb_data->save('dashboard_show_closed_invoices', 'TRUE', TRUE);
		$this->mdl_mcb_data->save('dashboard_show_open_invoices', 'TRUE', TRUE);
		$this->mdl_mcb_data->save('dashboard_show_overdue_invoices', 'TRUE', TRUE);
		$this->mdl_mcb_data->save('dashboard_show_pending_invoices', 'TRUE', TRUE);
		$this->mdl_mcb_data->save('dashboard_total_paid_cutoff_date', '', TRUE);
		$this->mdl_mcb_data->save('decimal_symbol', '.', TRUE);
		$this->mdl_mcb_data->save('decimal_taxes_num', 2, TRUE);
		$this->mdl_mcb_data->save('default_bcc', '', TRUE);
		$this->mdl_mcb_data->save('default_cc', '', TRUE);
		$this->mdl_mcb_data->save('default_closed_status_id', 3, TRUE);
		$this->mdl_mcb_data->save('default_date_format', 'm/d/Y', TRUE);
		$this->mdl_mcb_data->save('default_date_format_mask', '99/99/9999', TRUE);
		$this->mdl_mcb_data->save('default_date_format_picker', 'mm/dd/yy', TRUE);
		$this->mdl_mcb_data->save('default_email_body', '', TRUE);
		$this->mdl_mcb_data->save('default_invoice_group_id', 1, TRUE);
		$this->mdl_mcb_data->save('default_invoice_template', 'default', TRUE);
		$this->mdl_mcb_data->save('default_item_tax_rate_id', 1, TRUE);
		$this->mdl_mcb_data->save('default_item_tax_rate_option', 0, TRUE);
		$this->mdl_mcb_data->save('default_language', 'english', TRUE);
		$this->mdl_mcb_data->save('default_open_status_id', 1, TRUE);
		$this->mdl_mcb_data->save('default_quote_group_id', 1, TRUE);
		$this->mdl_mcb_data->save('default_quote_template', 'default_quote', TRUE);
		$this->mdl_mcb_data->save('default_receipt_template', 'default', TRUE);
		$this->mdl_mcb_data->save('default_tax_rate_id', 1, TRUE);
		$this->mdl_mcb_data->save('default_tax_rate_option', 1, TRUE);
		$this->mdl_mcb_data->save('disable_invoice_audit_history', 0, TRUE);
		$this->mdl_mcb_data->save('display_quantity_decimals', 1, TRUE);
		$this->mdl_mcb_data->save('email_protocol', 'php_mail_function', TRUE);
		$this->mdl_mcb_data->save('enable_profiler', 0, TRUE);
		$this->mdl_mcb_data->save('include_logo_on_invoice', 'FALSE', TRUE);
		$this->mdl_mcb_data->save('invoices_due_after', '30', TRUE);
		$this->mdl_mcb_data->save('merchant_currency_code', 'USD', TRUE);
		$this->mdl_mcb_data->save('merchant_driver', 'Paypal', TRUE);
		$this->mdl_mcb_data->save('merchant_enabled', 0, TRUE);
		$this->mdl_mcb_data->save('pdf_plugin', 'dompdf', TRUE);
		$this->mdl_mcb_data->save('results_per_page', 15, TRUE);
		$this->mdl_mcb_data->save('sendmail_path', '', TRUE);
		$this->mdl_mcb_data->save('smtp_host', '', TRUE);
		$this->mdl_mcb_data->save('smtp_pass', '', TRUE);
		$this->mdl_mcb_data->save('smtp_port', '', TRUE);
		$this->mdl_mcb_data->save('smtp_timeout', '', TRUE);
		$this->mdl_mcb_data->save('smtp_user', '', TRUE);
		$this->mdl_mcb_data->save('thousands_separator', ',', TRUE);

	}

	function install_table_data() {

		$this->db->insert('mcb_tax_rates', array('tax_rate_id'=>1,'tax_rate_name'=>$this->lang->line('no_tax'),'tax_rate_percent'=>'0.00'));

		$this->db->insert('mcb_payment_methods', array('payment_method'=>$this->lang->line('cash')));
		$this->db->insert('mcb_payment_methods', array('payment_method'=>$this->lang->line('check')));
		$this->db->insert('mcb_payment_methods', array('payment_method'=>$this->lang->line('credit')));

		$this->db->insert('mcb_invoice_statuses', array('invoice_status_id'=>1,'invoice_status'=>$this->lang->line('open'),'invoice_status_type'=>1));
		$this->db->insert('mcb_invoice_statuses', array('invoice_status_id'=>2,'invoice_status'=>$this->lang->line('pending'),'invoice_status_type'=>2));
		$this->db->insert('mcb_invoice_statuses', array('invoice_status_id'=>3,'invoice_status'=>$this->lang->line('closed'),'invoice_status_type'=>3));

		$this->db->insert('mcb_invoice_groups', array('invoice_group_name'=>$this->lang->line('simple_increment'),'invoice_group_next_id'=>1));

	}

	function run_queries($queries) {

		foreach ($queries as $query) {

			if (!$this->db->query($query)) {

				return FALSE;

			}

		}

		return TRUE;

	}

}

?>