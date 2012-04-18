<dl>
    <dt><?php echo $this->lang->line('default_invoice_tax_rate'); ?></dt>
    <dd>
	<select name="user_settings[default_tax_rate_id]">
		<option value="0"></option>
	    <?php foreach ($tax_rates as $tax_rate) { ?>
		<option value="<?php echo $tax_rate->tax_rate_id; ?>" <?php if($this->mdl_users->form_value('default_tax_rate_id') == $tax_rate->tax_rate_id) { ?>selected="selected"<?php } ?>><?php echo format_number($tax_rate->tax_rate_percent, TRUE, $this->mdl_mcb_data->setting('decimal_taxes_num')); ?>% - <?php echo $tax_rate->tax_rate_name; ?></option>
	    <?php } ?>
	</select>
    </dd>
</dl>

<dl>
    <dt><?php echo $this->lang->line('default_invoice_tax_placement'); ?></dt>
    <dd>
		<select name="user_settings[default_tax_rate_option]">
			<option value="0"></option>
			<option value="1" <?php if ($this->mdl_users->form_value('default_tax_rate_option') == 1) { ?>selected="selected"<?php } ?>><?php echo $this->lang->line('invoice_tax_option_1'); ?></option>
			<option value="2" <?php if ($this->mdl_users->form_value('default_tax_rate_option') == 2) { ?>selected="selected"<?php } ?>><?php echo $this->lang->line('invoice_tax_option_2'); ?></option>
		</select>
    </dd>
</dl>

<dl>
    <dt><?php echo $this->lang->line('default_item_tax_rate'); ?></dt>
    <dd>
	<select name="user_settings[default_item_tax_rate_id]">
		<option value="0"></option>
	    <?php foreach ($tax_rates as $tax_rate) { ?>
	    <option value="<?php echo $tax_rate->tax_rate_id; ?>" <?php if($this->mdl_users->form_value('default_item_tax_rate_id') == $tax_rate->tax_rate_id) { ?>selected="selected"<?php } ?>><?php echo format_number($tax_rate->tax_rate_percent, TRUE, $this->mdl_mcb_data->setting('decimal_taxes_num')); ?>% - <?php echo $tax_rate->tax_rate_name; ?></option>
	    <?php } ?>
	</select>
    </dd>
</dl>

<dl>
	<dt><?php echo $this->lang->line('default_item_tax_option'); ?></dt>
	<dd>
	<select name="user_settings[default_item_tax_option]">
		<option value=""></option>
		<option value="0" <?php if ($this->mdl_users->form_value('default_item_tax_option') == "0") { ?>selected="selected"<?php } ?>><?php echo $this->lang->line('item_tax_option_0'); ?></option>
		<option value="1" <?php if ($this->mdl_users->form_value('default_item_tax_option') == "1") { ?>selected="selected"<?php } ?>><?php echo $this->lang->line('item_tax_option_1'); ?></option>
	</select>
	</dd>
</dl>

<div style="clear: both;">&nbsp;</div>

<input type="submit" id="btn_submit" name="btn_submit" value="<?php echo $this->lang->line('submit'); ?>" />
<input type="submit" id="btn_cancel" name="btn_cancel" value="<?php echo $this->lang->line('cancel'); ?>" />

<div style="clear: both;">&nbsp;</div>