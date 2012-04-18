<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo application_title(); ?></title>
		<link href="<?php echo base_url(); ?>assets/style/css/styles.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="<?php echo base_url(); ?>assets/style/css/superfish.css" rel="stylesheet" type="text/css" media="screen" />
		<!--[if IE 6]><link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/style/css/ie6.css" /><![endif]-->
		<!--[if IE 7]><link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/style/css/ie7.css" /><![endif]-->
		<link type="text/css" href="<?php echo base_url(); ?>assets/jquery/ui-themes/myclientbase/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery/jquery-ui-1.8.16.custom.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/jquery/jquery.maskedinput-1.2.2.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>assets/jquery/superfish.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>assets/jquery/supersubs.js" type="text/javascript"></script>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
        <script>

            $(document).ready(function(){
                $("ul.sf-menu").supersubs({
                    minWidth:    12,
                    maxWidth:    38,
                    extraWidth:  1
                }).superfish();

				$( "input:submit.uibutton").button();

            });

        </script>

		<?php if (isset($header_insert)) { if (!is_array($header_insert)) { $this->load->view($header_insert); } else { foreach ($header_insert as $insert) { $this->load->view($insert); } } } ?>

	</head>
	<body>

		<div id="header_wrapper">

			<div class="container_10" id="header_content">

				<h1><?php echo application_title(); ?></h1>

			</div>

		</div>

		<div id="navigation_wrapper">

			<ul class="sf-menu" id="navigation">

                <?php echo modules::run('mcb_menu/display', array('view'=>'dashboard/header_menu')); ?>

			</ul>

		</div>

		<div class="container_10" id="center_wrapper">