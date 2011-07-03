<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

$config = array(
	'module_name'	=>	$this->lang->line('dashboard'),
	'module_path'	=>	'dashboard',
	'module_order'	=>	2,
	'module_config'	=>	array(
		'settings_view'	=>	'dashboard/dashboard_settings/display',
		'settings_save'	=>	'dashboard/dashboard_settings/save'
	)
);

?>