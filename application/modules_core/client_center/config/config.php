<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

$config = array(
	'module_name'			=>	'Client Center',
	'module_path'			=>	'client_center',
	'module_description'	=>	'Allows clients to log in and view invoices.',
	'module_config'			=>	array(
		'settings_view'		=>	'client_center/admin_settings/display',
		'settings_save'		=>	'client_center/admin_settings/save'
	)
);

?>