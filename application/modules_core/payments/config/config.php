<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

$config = array(
	'module_name'	=>	$this->lang->line('payments'),
	'module_path'	=>	'payments',
	'module_order'	=>	4,
	'module_config'	=>	array(
		'settings_view'	=>	'payments/payment_settings/display',
		'settings_save'	=>	'payments/payment_settings/save'
	)
);

?>