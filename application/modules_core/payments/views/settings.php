<dl>
	<dt><?php echo $this->lang->line('default_payment_method'); ?>: </dt>
	<dd>
	<select name="payment_settings[default_payment_method]">
		<option value=""></option>
		<?php foreach ($payment_methods as $payment_method) { ?>
			<option value="<?php echo $payment_method->payment_method_id; ?>" <?php if($this->mdl_mcb_data->setting('default_payment_method') == $payment_method->payment_method_id){ ?>selected="selected"<?php } ?>><?php echo $payment_method->payment_method; ?></option>
		<?php } ?>
	</select>
	</dd>
</dl>

<dl>
	<dt><?php echo $this->lang->line('default_receipt_template'); ?>: </dt>
	<dd>
	<select name="payment_settings[default_receipt_template]">
		<?php foreach ($receipt_templates as $template) { ?>
			<option value="<?php echo $template; ?>" <?php if($this->mdl_mcb_data->setting('default_receipt_template') == $template){ ?>selected="selected"<?php } ?>><?php echo $template; ?></option>
		<?php } ?>
	</select>
	</dd>
</dl>

<dl>
	<dt><?php echo $this->lang->line('merchant_enabled'); ?>: </dt>
	<dd>
		<select name="payment_settings[merchant_enabled]">
			<option value="0" <?php if ($this->mdl_mcb_data->setting('merchant_enabled') == 0) { ?>selected="selected"<?php } ?>><?php echo $this->lang->line('no'); ?></option>
			<option value="1" <?php if ($this->mdl_mcb_data->setting('merchant_enabled') == 1) { ?>selected="selected"<?php } ?>><?php echo $this->lang->line('yes'); ?></option>
		</select>
	</dd>
</dl>

<dl>
	<dt><?php echo $this->lang->line('merchant_driver'); ?>: </dt>
	<dd>
	<select name="payment_settings[merchant_driver]">
		<?php foreach ($merchant_drivers as $driver) { ?>
			<option value="<?php echo $driver; ?>" <?php if($this->mdl_mcb_data->setting('merchant_driver') == $driver){ ?>selected="selected"<?php } ?>><?php echo $driver; ?></option>
		<?php } ?>
	</select>
	</dd>
</dl>

<dl>
    <dt><?php echo $this->lang->line('merchant_account_id'); ?>: </dt>
    <dd><input type="text" name="payment_settings[merchant_account_id]" value="<?php echo $this->mdl_mcb_data->setting('merchant_account_id'); ?>" /></dd>
</dl>

<dl>
    <dt><?php echo $this->lang->line('merchant_currency_code'); ?>: </dt>
    <dd><input type="text" name="payment_settings[merchant_currency_code]" value="<?php echo $this->mdl_mcb_data->setting('merchant_currency_code'); ?>" /></dd>
</dl>