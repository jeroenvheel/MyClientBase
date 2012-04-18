<dl>
    <dt><?php echo $this->lang->line('default_invoice_group'); ?>: </dt>
    <dd>
	<select name="default_invoice_group_id">
	    <?php foreach ($invoice_groups as $invoice_group) { ?>
	    <option value="<?php echo $invoice_group->invoice_group_id; ?>" <?php if($this->mdl_mcb_data->setting('default_invoice_group_id') == $invoice_group->invoice_group_id) { ?>selected="selected"<?php } ?>><?php echo $invoice_group->invoice_group_name; ?></option>
	    <?php } ?>
	</select>
    </dd>
</dl>

<dl>
    <dt><?php echo $this->lang->line('default_quote_group'); ?>: </dt>
    <dd>
        <select name="default_quote_group_id">
            <?php foreach ($invoice_groups as $invoice_group) { ?>
            <option value="<?php echo $invoice_group->invoice_group_id; ?>" <?php if($this->mdl_mcb_data->setting('default_quote_group_id') == $invoice_group->invoice_group_id) { ?>selected="selected"<?php } ?>><?php echo $invoice_group->invoice_group_name; ?></option>
            <?php } ?>
        </select>
    </dd>
</dl>

<dl>
    <dt><?php echo $this->lang->line('default_invoice_tax_rate'); ?>: </dt>
    <dd>
	<select name="default_tax_rate_id">
	    <?php foreach ($tax_rates as $tax_rate) { ?>
	    <option value="<?php echo $tax_rate->tax_rate_id; ?>" <?php if($this->mdl_mcb_data->setting('default_tax_rate_id') == $tax_rate->tax_rate_id) { ?>selected="selected"<?php } ?>><?php echo format_number($tax_rate->tax_rate_percent, TRUE, $this->mdl_mcb_data->setting('decimal_taxes_num')); ?>% - <?php echo $tax_rate->tax_rate_name; ?></option>
	    <?php } ?>
	</select>
    </dd>
</dl>

<dl>
    <dt><?php echo $this->lang->line('default_invoice_tax_placement'); ?>: </dt>
    <dd>
		<select name="default_tax_rate_option">
			<option value="1" <?php if ($this->mdl_mcb_data->setting('default_tax_rate_option') == 1) { ?>selected="selected"<?php } ?>><?php echo $this->lang->line('invoice_tax_option_1'); ?></option>
			<option value="2" <?php if ($this->mdl_mcb_data->setting('default_tax_rate_option') == 2) { ?>selected="selected"<?php } ?>><?php echo $this->lang->line('invoice_tax_option_2'); ?></option>
		</select>
    </dd>
</dl>

<dl>
    <dt><?php echo $this->lang->line('default_item_tax_rate'); ?>: </dt>
    <dd>
	<select name="default_item_tax_rate_id">
	    <?php foreach ($tax_rates as $tax_rate) { ?>
	    <option value="<?php echo $tax_rate->tax_rate_id; ?>" <?php if($this->mdl_mcb_data->setting('default_item_tax_rate_id') == $tax_rate->tax_rate_id) { ?>selected="selected"<?php } ?>><?php echo format_number($tax_rate->tax_rate_percent, TRUE, $this->mdl_mcb_data->setting('decimal_taxes_num')); ?>% - <?php echo $tax_rate->tax_rate_name; ?></option>
	    <?php } ?>
	</select>
    </dd>
</dl>

<dl>
	<dt><?php echo $this->lang->line('default_item_tax_option'); ?></dt>
	<dd>
	<select name="default_item_tax_option">
		<option value=""></option>
		<option value="0" <?php if ($this->mdl_mcb_data->setting('default_item_tax_option') == "0") { ?>selected="selected"<?php } ?>><?php echo $this->lang->line('item_tax_option_0'); ?></option>
		<option value="1" <?php if ($this->mdl_mcb_data->setting('default_item_tax_option') == "1") { ?>selected="selected"<?php } ?>><?php echo $this->lang->line('item_tax_option_1'); ?></option>
	</select>
	</dd>
</dl>

<dl>
    <dt><?php echo $this->lang->line('default_apply_invoice_tax'); ?>: </dt>
    <dd><input type="checkbox" name="default_apply_invoice_tax" value="1" <?php if ($this->mdl_mcb_data->setting('default_apply_invoice_tax')) { ?>checked="checked"<?php } ?>/></dd>
</dl>

<dl>
    <dt><?php echo $this->lang->line('default_open_invoice_status'); ?>: </dt>
    <dd>
	<select name="default_open_status_id">
	    <?php foreach ($open_invoice_statuses as $status) { ?>
	    <option value="<?php echo $status->invoice_status_id; ?>" <?php if($this->mdl_mcb_data->setting('default_open_status_id') == $status->invoice_status_id) { ?>selected="selected"<?php } ?>><?php echo $status->invoice_status; ?></option>
	    <?php } ?>
	</select>
    </dd>
</dl>

<dl>
    <dt><?php echo $this->lang->line('default_closed_invoice_status'); ?>: </dt>
    <dd>
	<select name="default_closed_status_id">
	    <?php foreach ($closed_invoice_statuses as $status) { ?>
	    <option value="<?php echo $status->invoice_status_id; ?>" <?php if($this->mdl_mcb_data->setting('default_closed_status_id') == $status->invoice_status_id) { ?>selected="selected"<?php } ?>><?php echo $status->invoice_status; ?></option>
	    <?php } ?>
	</select>
    </dd>
</dl>

<dl>
    <dt><?php echo $this->lang->line('invoices_due_after'); ?>: </dt>
    <dd><input type="text" name="invoices_due_after" value="<?php echo $this->mdl_mcb_data->setting('invoices_due_after'); ?>" /></dd>
</dl>

<dl>
    <dt><?php echo $this->lang->line('default_invoice_template'); ?>: </dt>
    <dd>
	<select name="default_invoice_template">
	    <?php foreach ($templates as $template) { ?>
	    <option <?php if($this->mdl_mcb_data->setting('default_invoice_template') == $template) { ?>selected="selected"<?php } ?>><?php echo $template; ?></option>
	    <?php } ?>
	</select>
    </dd>
</dl>

<dl>
    <dt><?php echo $this->lang->line('default_quote_template'); ?>: </dt>
    <dd>
	<select name="default_quote_template">
	    <?php foreach ($templates as $template) { ?>
	    <option <?php if($this->mdl_mcb_data->setting('default_quote_template') == $template) { ?>selected="selected"<?php } ?>><?php echo $template; ?></option>
	    <?php } ?>
	</select>
    </dd>
</dl>

<dl>
    <dt><?php echo $this->lang->line('tax_rate_decimals'); ?>: </dt>
    <dd>
	<select name="decimal_taxes_num">
	    <option value="2" <?php if ($this->mdl_mcb_data->setting('decimal_taxes_num') == 2) { ?>selected="selected"<?php } ?>>2</option>
	    <option value="3" <?php if ($this->mdl_mcb_data->setting('decimal_taxes_num') == 3) { ?>selected="selected"<?php } ?>>3</option>
	</select>
	<input type="checkbox" name="update_decimal_taxes" value="1" /> <?php echo $this->lang->line('update'); ?>
    </dd>
</dl>

<dl>
    <dt><?php echo $this->lang->line('invoice_logo'); ?>: </dt>
    <dd>
	<?php if ($this->mdl_mcb_data->setting('invoice_logo')) { ?>
	<img src="<?php echo base_url(); ?>uploads/invoice_logos/<?php echo $this->mdl_mcb_data->setting('invoice_logo'); ?>" /><br />
	    <?php echo anchor('invoices/upload_logo', $this->lang->line('upload_another_invoice_logo')) . ' | ' . anchor('invoices/upload_logo/delete/invoice_logo/' . $this->mdl_mcb_data->setting('invoice_logo'), $this->lang->line('delete_invoice_logo'));
	} else {
    echo anchor('invoices/upload_logo', $this->lang->line('upload_invoice_logo'));
} ?>
    </dd>
</dl>
<?php if (count($invoice_logos)) { ?>
<dl>
    <dt><?php echo $this->lang->line('change_invoice_logo'); ?>: </dt>
    <dd>
	<select name="invoice_logo">
		<?php foreach ($invoice_logos as $logo) { ?>
	    <option <?php if ($logo == $this->mdl_mcb_data->setting('invoice_logo')) { ?>selected="selected"<?php } ?>><?php echo $logo; ?></option>
	<?php } ?>
	</select>
    </dd>
</dl>
<?php } ?>

<?php if ($this->mdl_mcb_data->setting('invoice_logo')) { ?>
<dl>
    <dt><?php echo $this->lang->line('include_logo_on_invoice'); ?>: </dt>
    <dd><input type="checkbox" name="include_logo_on_invoice" value="TRUE" <?php if($this->mdl_mcb_data->setting('include_logo_on_invoice') == "TRUE") { ?>checked="checked"<?php } ?> /></dd>
</dl>
<?php } ?>

<dl>
    <dt><?php echo $this->lang->line('recalculate_invoices'); ?>: </dt>
    <dd><?php echo anchor('invoices/recalculate', $this->lang->line('recalculate_invoices')); ?></dd>
</dl>

<dl>
    <dt><?php echo $this->lang->line('display_quantity_decimals'); ?>: </dt>
    <dd><input type="checkbox" name="display_quantity_decimals" value="1" <?php if ($this->mdl_mcb_data->setting('display_quantity_decimals')) { ?>checked="checked"<?php } ?>/></dd>
</dl>

<dl>
	<dt><?php echo $this->lang->line('disable_invoice_audit_history'); ?>: </dt>
	<dd><input type="checkbox" name="disable_invoice_audit_history" value="1" <?php if ($this->mdl_mcb_data->setting('disable_invoice_audit_history')) { ?>checked="checked"<?php } ?>/></dd>
</dl>