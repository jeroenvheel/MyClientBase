<?php $this->load->view('dashboard/header'); ?>

<?php echo modules::run('invoices/widgets/generate_dialog'); ?>

<div class="grid_7" id="content_wrapper">

	<?php $this->load->view('dashboard/system_messages'); ?>

	<?php if ($this->mdl_mcb_data->setting('dashboard_show_overdue_invoices') == "TRUE" and $overdue_invoices) { ?>

	<div class="section_wrapper">

		<h3 class="title_black"><?php echo $this->lang->line('overdue_invoices'); ?>
		<span style="font-size: 60%;">
		<?php $this->load->view('dashboard/btn_add', array('btn_name'=>'btn_email_reminders', 'btn_value'=>$this->lang->line('email_reminders'))); ?>
		</span>
		</h3>

		<div class="content toggle no_padding">

			<?php echo modules::run('invoices/display_invoice_table', $overdue_invoices); ?>

		</div>

	</div>

	<?php } ?>

	<?php if ($this->mdl_mcb_data->setting('dashboard_show_quotes') == "TRUE") { ?>

	<div class="section_wrapper">

		<h3 class="title_black"><?php echo $this->lang->line('quotes'); ?></h3>

		<div class="content toggle no_padding">

			<?php echo modules::run('invoices/display_invoice_table', $quotes, TRUE); ?>
			

		</div>

	</div>

	<?php } ?>

	<?php if ($this->mdl_mcb_data->setting('dashboard_show_open_invoices') == "TRUE") { ?>

	<div class="section_wrapper">

		<h3 class="title_black"><?php echo $this->lang->line('open_invoices'); ?></h3>

		<div class="content toggle no_padding">

			<?php echo modules::run('invoices/display_invoice_table', $open_invoices); ?>

		</div>

	</div>

	<?php } ?>

	<?php if ($this->mdl_mcb_data->setting('dashboard_show_pending_invoices') == "TRUE") { ?>

	<div class="section_wrapper">

		<h3 class="title_black"><?php echo $this->lang->line('pending_invoices'); ?></h3>

		<div class="content toggle no_padding">

			<?php echo modules::run('invoices/display_invoice_table', $pending_invoices); ?>

		</div>

	</div>

	<?php } ?>

	<?php if ($this->mdl_mcb_data->setting('dashboard_show_closed_invoices') == "TRUE") { ?>

	<div class="section_wrapper">

		<h3 class="title_black"><?php echo $this->lang->line('recently_closed_invoices'); ?></h3>

		<div class="content toggle no_padding">

			<?php echo modules::run('invoices/display_invoice_table', $closed_invoices); ?>

		</div>

	</div>

	<?php } ?>

	<?php echo modules::run('dashboard/show_widgets'); ?>

</div>

<?php
$this->load->view('dashboard/sidebar',
	array(
	'side_widgets'=>array(
		'dashboard/dashboard_widgets/total_balance',
		'dashboard/dashboard_widgets/total_paid'
	)));
?>

<?php $this->load->view('dashboard/footer'); ?>