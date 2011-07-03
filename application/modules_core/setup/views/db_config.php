<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo $this->lang->line('myclientbase'); ?></title>
		<link href="<?php echo base_url(); ?>assets/style/css/styles.css" rel="stylesheet" type="text/css" media="screen" />
		<!--[if IE 6]><link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/style/css/ie6.css" /><![endif]-->
		<!--[if IE 7]><link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/style/css/ie7.css" /><![endif]-->
		<link type="text/css" href="<?php echo base_url(); ?>assets/jquery/ui-themes/smoothness/jquery-ui-1.8.4.custom.css" rel="stylesheet" />
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery/jquery-1.4.2.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery/jquery-ui-1.8.4.custom.min.js"></script>
	</head>
	<body>

		<div class="container_10" id="center_wrapper">

			<div class="grid_10" id="content_wrapper">

				<div class="section_wrapper">

					<h3 class="title_black"><?php echo $this->lang->line('myclientbase') . ' ' . $this->lang->line('installation'); ?></h3>

					<?php $this->load->view('dashboard/system_messages'); ?>

					<?php if (isset($database_error)) { ?>

					<div class="error"><?php echo $database_error; ?></div>

					<?php } ?>

					<div class="content toggle">

						<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">

							<h3><?php echo $this->lang->line('database_configuration'); ?></h3>

							<dl>
								<dt><label><?php echo $this->lang->line('database_server'); ?>: </label></dt>
								<dd><input type="text" name="hostname" value="<?php echo $this->mdl_setup->form_value('hostname'); ?>" /></dd>
							</dl>

							<dl>
								<dt><label><?php echo $this->lang->line('database_name'); ?>: </label></dt>
								<dd><input type="text" name="database" value="<?php echo $this->mdl_setup->form_value('database'); ?>" /></dd>
							</dl>

							<dl>
								<dt><label><?php echo $this->lang->line('database_username'); ?>: </label></dt>
								<dd><input type="text" name="username" value="<?php echo $this->mdl_setup->form_value('username'); ?>" /></dd>
							</dl>

							<dl>
								<dt><label><?php echo $this->lang->line('database_password'); ?>: </label></dt>
								<dd><input type="password" name="password" value="<?php echo $this->mdl_setup->form_value('password'); ?>" /></dd>
							</dl>

							<input type="submit" id="btn_submit" name="btn_test_db" value="<?php echo $this->lang->line('submit'); ?>" />

							<div style="clear: both;">&nbsp;</div>

						</form>

					</div>

					</div>

				</div>

			</div>
		</div>


	</body>
</html>