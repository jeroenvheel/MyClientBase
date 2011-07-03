<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

$config = array(
	'module_name'	=>	$this->lang->line('invoices'),
	'module_path'	=>	'invoices',
	'module_order'	=>	3,
	'module_config'	=>	array(
		'settings_view'	=>	'invoices/invoice_settings/display',
		'settings_save'	=>	'invoices/invoice_settings/save'
	)
);

?>