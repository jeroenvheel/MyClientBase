<?php $this->load->view('dashboard/header', array('header_insert'=>'invoices/invoice_edit_header')); ?>

<?php echo modules::run('invoices/widgets/generate_dialog'); ?>

<?php echo modules::run('payments/payment_widgets/generate_dialog'); ?>

<?php $this->load->view('dashboard/jquery_date_picker'); ?>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery/jquery.relcopy.js"></script>

<script type="text/javascript">
	$(function(){
		var append_to_clone = ' <a class="remove" href="#" onclick="$(this).parent().remove(); return false"><?php echo $this->lang->line('delete'); ?></a>';
		$('a.copy').relCopy({append: append_to_clone});
		$('#tabs').tabs({ selected: <?php echo $tab_index; ?> });
	});
</script>

<div class="grid_10" id="content_wrapper">

	<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">

	<div class="section_wrapper">

		<h3 class="title_black"><?php echo ($invoice->invoice_is_quote == 1 ? $this->lang->line('quote_number') : $this->lang->line('invoice_number')) . ' ' . $invoice->invoice_number; ?>

			<?php if (!$invoice->invoice_is_quote) { ?>
			<input type="submit" name="btn_add_payment" style="float: right; margin-top: 10px; margin-right: 10px;" value="<?php echo $this->lang->line('enter_payment'); ?>" />
			<?php } else { ?>
			<input type="submit" name="btn_quote_to_invoice" style="float: right; margin-top: 10px; margin-right: 10px;" value="<?php echo $this->lang->line('quote_to_invoice'); ?>" />
			<?php } ?>
			<input type="submit" name="btn_add_new_item" style="float: right; margin-top: 10px; margin-right: 10px;" value="<?php echo $this->lang->line('add_invoice_item'); ?>" />
			
		</h3>

		<?php $this->load->view('dashboard/system_messages'); ?>

		<div class="content toggle">

				<div id="tabs">
					<ul>
						<li><a href="#tab_general"><?php echo $this->lang->line('summary'); ?></a></li>
						<li><a href="#tab_items"><?php echo $this->lang->line('items'); ?></a></li>
						<?php if (!$invoice->invoice_is_quote) { ?>
						<li><a href="#tab_payments"><?php echo $this->lang->line('payments'); ?></a></li>
						<?php } ?>
						<li><a href="#tab_taxes"><?php echo $this->lang->line('tax_and_other'); ?></a></li>
						<li><a href="#tab_notes"><?php echo $this->lang->line('notes'); ?></a></li>
						<?php if (!$this->mdl_mcb_data->setting('disable_invoice_audit_history')) { ?>
						<li><a href="#tab_history"><?php echo $this->lang->line('history'); ?></a></li>
						<?php } ?>
					</ul>
					<div id="tab_general">
						<?php $this->load->view('tab_general'); ?>
					</div>

					<div id="tab_items">
						<?php $this->load->view('item_table'); ?>
					</div>

					<?php if (!$invoice->invoice_is_quote) { ?>
					<div id="tab_payments">
						<?php $this->load->view('payments/table'); ?>
					</div>
					<?php } ?>

					<div id="tab_taxes">
						<?php $this->load->view('tab_taxes'); ?>
					</div>

					<div id="tab_notes">
						<?php $this->load->view('tab_notes'); ?>
					</div>

					<?php if (!$this->mdl_mcb_data->setting('disable_invoice_audit_history')) { ?>
					<div id="tab_history">
						<?php $this->load->view('tab_history'); ?>
					</div>
					<?php } ?>

				</div>

			<div style="clear: both;">&nbsp;</div>

		</div>

	</div>

	</form>

</div>

<?php $this->load->view('dashboard/footer'); ?>