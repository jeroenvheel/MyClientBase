<dl>
	<dt><label><?php echo $this->lang->line('tax_rate'); ?>: </label></dt>
	<dd>
		<a href="#" class="copy" rel=".tax_rate"><?php echo $this->lang->line('add_tax_rate'); ?></a><br />
		<?php $x = 1; foreach ($invoice_tax_rates as $invoice_tax_rate) { ?>
		<div class="tax_rate" style="margin-left: 200px;">
		<select name="tax_rate_id[]">
			<?php foreach ($tax_rates as $tax_rate) { ?>
			<option value="<?php echo $tax_rate->tax_rate_id; ?>" <?php if($invoice_tax_rate->tax_rate_id == $tax_rate->tax_rate_id) { ?>selected="selected"<?php } ?>><?php echo $tax_rate->tax_rate_percent . '% - ' . $tax_rate->tax_rate_name; ?></option>
			<?php } ?>
		</select>
		<select name="tax_rate_option[]">
			<option value="1" <?php if ($invoice_tax_rate->tax_rate_option == 1) { ?>selected="selected"<?php } ?>><?php echo $this->lang->line('invoice_tax_option_1'); ?></option>
			<option value="2" <?php if ($invoice_tax_rate->tax_rate_option == 2) { ?>selected="selected"<?php } ?>><?php echo $this->lang->line('invoice_tax_option_2'); ?></option>
		</select>
		<?php if ($x > 1) { ?>
		<a class="remove" href="#" onclick="$(this).parent().remove(); return false"><?php echo $this->lang->line('delete'); ?></a>
		<?php } ?>
		</div>
		<?php $x++;} ?>
	</dd>
</dl>

<dl>
	<dt><label><?php echo $this->lang->line('shipping'); ?>: </label></dt>
	<dd><input type="text" name="invoice_shipping" value="<?php echo format_number($invoice->invoice_shipping); ?>" /></dd>
</dl>

<dl>
	<dt><label><?php echo $this->lang->line('discount'); ?>: </label></dt>
	<dd><input type="text" name="invoice_discount" value="<?php echo format_number($invoice->invoice_discount); ?>" /></dd>
</dl>

<dl>
	<dt></dt>
	<dd><input type="submit" name="btn_submit_options_tax" value="<?php echo $this->lang->line('save_options'); ?>" /></dd>
</dl>

<div style="clear: both;">&nbsp;</div>