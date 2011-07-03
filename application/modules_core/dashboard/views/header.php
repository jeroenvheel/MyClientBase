<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo application_title(); ?></title>
		<link href="<?php echo base_url(); ?>assets/style/css/styles.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="<?php echo base_url(); ?>assets/style/css/superfish.css" rel="stylesheet" type="text/css" media="screen" />
		<!--[if IE 6]><link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/style/css/ie6.css" /><![endif]-->
		<!--[if IE 7]><link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/style/css/ie7.css" /><![endif]-->
		<link type="text/css" href="<?php echo base_url(); ?>assets/jquery/ui-themes/myclientbase1/jquery-ui-1.8.4.custom.css" rel="stylesheet" />
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery/jquery-1.4.2.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery/jquery-ui-1.8.4.custom.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/jquery/jquery.maskedinput-1.2.2.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>assets/jquery/superfish.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>assets/jquery/supersubs.js" type="text/javascript"></script>

		<?php if (isset($header_insert)) { $this->load->view($header_insert); } ?>
        <script>

            $(document).ready(function(){
                $("ul.sf-menu").supersubs({
                    minWidth:    12,   // minimum width of sub-menus in em units
                    maxWidth:    38,   // maximum width of sub-menus in em units
                    extraWidth:  1     // extra width can ensure lines don't sometimes turn over
                                       // due to slight rounding differences and font-family
                }).superfish();  // call supersubs first, then superfish, so that subs are
                                 // not display:none when measuring. Call before initialising
                                 // containing tabs for same reason.
            });

        </script>

	</head>
	<body>

		<div id="header_wrapper">

			<div class="container_10" id="header_content">

				<h1><?php echo application_title(); ?></h1>

			</div>

		</div>

		<div id="navigation_wrapper">

			<ul class="sf-menu" id="navigation">

                <?php echo modules::run('mcb_menu/header_menu/display', array('view'=>'dashboard/header_menu')); ?>

			</ul>

		</div>

		<div class="container_10" id="center_wrapper">