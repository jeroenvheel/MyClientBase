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

					<h3 class="title_black"><?php echo $this->lang->line('myclientbase') . ' ' . $this->lang->line('setup'); ?></h3>

					<?php if ($database_config_file_error) { ?>
					<div class="error"><?php echo $this->lang->line('database_config_file_error'); ?></div>
					<?php } ?>

					<div class="content toggle">

						<h3><?php echo $this->lang->line('database_configuration'); ?></h3>

						<p style="margin-left: 20px;"><?php echo $this->lang->line('database_config_copy_paste'); ?></p>
						<p style="margin-left: 20px;"><?php echo APPPATH; ?>config/database.php</p>

						<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">

							<textarea style="width: 100%; height: 400px;" readonly><?php $this->load->view('ci_db_config'); ?></textarea>

							<input type="hidden" name="setup_type" value="<?php echo $setup_type; ?>" />
							<input type="hidden" name="hostname" value="<?php echo $hostname; ?>" />
							<input type="hidden" name="username" value="<?php echo $username; ?>" />
							<input type="hidden" name="password" value="<?php echo $password; ?>" />
							<input type="hidden" name="database" value="<?php echo $database; ?>" />
							<input type="submit" name="btn_continue_setup" value="<?php echo $this->lang->line('continue'); ?>" />

						</form>

					</div>

						<div style="clear: both;">&nbsp;</div>

					</div>

				</div>

			</div>
		</div>


	</body>
</html>