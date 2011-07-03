<div class="left_box">

	<dl>
		<dt><label><?php echo $this->lang->line('invoice_status'); ?>: </label></dt>
		<dd><?php echo $invoice->invoice_status; ?></dd>
	</dl>

	<dl>
		<dt><label><?php echo $this->lang->line('invoice_date'); ?>: </label></dt>
		<dd><?php echo format_date($invoice->invoice_date_entered); ?></dd>
	</dl>

	<dl>
		<dt><label><?php echo $this->lang->line('due_date'); ?>: </label></dt>
		<dd><?php echo format_date($invoice->invoice_due_date); ?></dd>
	</dl>

	<dl>
		<dt><label><?php echo $this->lang->line('client'); ?>: </label></dt>
		<dd><?php echo $invoice->client_name; ?></dd>
	</dl>


	<?php if ($invoice->invoice_is_overdue and $invoice->invoice_days_overdue > 0) { ?>
	<dl>
		<dt><label style="color: red; font-weight: bold;"><?php echo $this->lang->line('days_overdue'); ?>: </label></dt>
		<dd><span style="color: red; font-weight: bold;"><?php echo $invoice->invoice_days_overdue; ?></span></dd>
	</dl>
	<?php } elseif ($invoice->invoice_days_overdue <= 0) { ?>
	<dl>
		<dt><label><?php echo $this->lang->line('days_until_due'); ?>: </label></dt>
		<dd><?php echo ($invoice->invoice_days_overdue * -1); ?></dd>
	</dl>
	<?php } ?>

	<dl>
		<dt><label><?php echo $this->lang->line('generate'); ?>: </label></dt>
		<dd>
			<a href="javascript:void(0)" class="output_link" id="<?php echo $invoice->invoice_id; ?>"><?php echo $this->lang->line('generate'); ?></a>
		</dd>
	</dl>

</div>

<div class="right_box">

	<dl>
		<dt><label><?php echo $this->lang->line('subtotal'); ?>: </label></dt>
		<dd><?php echo invoice_subtotal($invoice); ?></dd>
	</dl>

	<dl>
		<dt><label><?php echo $this->lang->line('tax'); ?>: </label></dt>
		<dd><?php echo invoice_tax_total($invoice); ?></dd>
	</dl>

	<?php if ($invoice->invoice_shipping > 0) { ?>
	<dl>
		<dt><label><?php echo $this->lang->line('shipping'); ?>: </label></dt>
		<dd><?php echo invoice_shipping($invoice); ?></dd>
	</dl>
	<?php } ?>

	<?php if ($invoice->invoice_discount > 0) { ?>
	<dl>
		<dt><label><?php echo $this->lang->line('discount'); ?>: </label></dt>
		<dd><?php echo invoice_discount($invoice); ?></dd>
	</dl>
	<?php } ?>

	<dl>
		<dt><label><?php echo $this->lang->line('grand_total'); ?>: </label></dt>
		<dd><?php echo invoice_total($invoice); ?></dd>
	</dl>

	<dl>
		<dt><label><?php echo $this->lang->line('paid'); ?>: </label></dt>
		<dd><?php echo invoice_paid($invoice); ?></dd>
	</dl>

	<dl>
		<dt><label><?php echo $this->lang->line('invoice_balance'); ?>: </label></dt>
		<dd><?php echo invoice_balance($invoice); ?></dd>
	</dl>

</div>

<div style="clear: both;">&nbsp;</div>