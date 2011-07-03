<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

$config = array(
	'module_name'	=>	$this->lang->line('email'),
	'module_path'	=>	'mailer',
	'module_order'	=>	5,
	'module_config'	=>	array(
		'settings_view'	=>	'mailer/display_settings',
		'settings_save'	=>	'mailer/save_settings'
	)
);

?>