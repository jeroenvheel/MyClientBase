<dl>
	<dt><label><?php echo $this->lang->line('tax_rate'); ?>: </label></dt>
	<dd>
		<?php foreach ($invoice_tax_rates as $invoice_tax_rate) { ?>
		<div class="tax_rate" style="margin-left: 200px;">
			<?php echo $invoice_tax_rate->tax_rate_percent . '% - ' . $invoice_tax_rate->tax_rate_name; ?> (
			<?php if ($invoice_tax_rate->tax_rate_option == 1) { echo $this->lang->line('invoice_tax_option_1'); }
			elseif ($invoice_tax_rate->tax_rate_option == 2) { echo $this->lang->line('invoice_tax_option_2'); } ?>)<br />
		</div>
		<?php } ?>
	</dd>
</dl>

<dl>
	<dt><label><?php echo $this->lang->line('shipping'); ?>: </label></dt>
	<dd><?php echo $invoice->invoice_shipping; ?></dd>
</dl>

<dl>
	<dt><label><?php echo $this->lang->line('discount'); ?>: </label></dt>
	<dd><?php echo $invoice->invoice_discount; ?></dd>
</dl>