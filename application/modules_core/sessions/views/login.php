<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo application_title(); ?></title>
		<link href="<?php echo base_url(); ?>assets/style/css/styles.css" rel="stylesheet" type="text/css" media="screen" />
		<!--[if IE 6]><link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/style/css/ie6.css" /><![endif]-->
		<!--[if IE 7]><link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/style/css/ie7.css" /><![endif]-->
		<link type="text/css" href="<?php echo base_url(); ?>assets/jquery/ui-themes/smoothness/jquery-ui-1.8.4.custom.css" rel="stylesheet" />
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery/jquery-1.4.2.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery/jquery-ui-1.8.4.custom.min.js"></script>
	</head>
	<body>

		<?php $this->load->view('dashboard/jquery_set_focus', array('id'=>'username')); ?>

		<div class="container_10" id="center_wrapper">

			<div class="grid_5 push_2" id="content_wrapper">

				<div class="section_wrapper">

					<h3 class="title_black"><?php echo application_title() . ' ' . $this->lang->line('log_in'); ?></h3>

					<?php $this->load->view('dashboard/system_messages'); ?>

					<div class="content toggle">

						<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">
							<dl>
								<dt><label><?php echo $this->lang->line('username'); ?>: </label></dt>
								<dd><input type="text" value="" id="username" name="username" /></dd>
							</dl>
							<dl>
								<dt><label><?php echo $this->lang->line('password'); ?>: </label></dt>
								<dd><input type="password" value="" id="password" name="password" /></dd>
							</dl>
							<input type="submit" value="<?php echo $this->lang->line('log_in'); ?>" name="btn_submit" id="btn_submit" />

                            <dl>
                                <dt>&nbsp;</dt>
                                <dd><?php echo anchor('sessions/recover', $this->lang->line('trouble_logging_in'), array('style'=>'font-size: 85%;')); ?></dd>
                            </dl>

						</form>

                        

						<div style="clear: both;">&nbsp;</div>

					</div>

				</div>

			</div>
		</div>


	</body>
</html>
