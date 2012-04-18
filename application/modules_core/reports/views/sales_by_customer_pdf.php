<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<?php $this->load->view('css'); ?>

	</head>
	<body>

		<h1><?php echo $this->lang->line('sales_by_customer'); ?></h1>

		<?php $this->load->view('sales_by_customer_view'); ?>

	</body>
</html>