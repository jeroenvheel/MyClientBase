<dl>
	<dt><?php echo $this->lang->line('active_client'); ?>: </dt>
	<dd><input type="checkbox" name="client_active" id="client_active" value="1" <?php if ($this->mdl_clients->form_value('client_active') or (!$_POST and !uri_assoc('client_id'))) { ?>checked="checked"<?php } ?> /></dd>
</dl>

<dl>
	<dt><?php echo $this->lang->line('client_name'); ?>: </dt>
	<dd><input type="text" name="client_name" id="client_name" value="<?php echo $this->mdl_clients->form_value('client_name'); ?>" /></dd>
</dl>

<dl>
	<dt><?php echo $this->lang->line('tax_id_number'); ?>: </dt>
	<dd><input type="text" name="client_tax_id" id="client_tax_id" value="<?php echo $this->mdl_clients->form_value('client_tax_id'); ?>" /></dd>
</dl>

<dl>
	<dt><?php echo $this->lang->line('street_address'); ?>: </dt>
	<dd><input type="text" name="client_address" id="client_address" value="<?php echo $this->mdl_clients->form_value('client_address'); ?>" /></dd>
</dl>

<dl>
	<dt><?php echo $this->lang->line('street_address_2'); ?>: </dt>
	<dd><input type="text" name="client_address_2" id="client_address_2" value="<?php echo $this->mdl_clients->form_value('client_address_2'); ?>" /></dd>
</dl>

<dl>
	<dt><?php echo $this->lang->line('city'); ?>: </dt>
	<dd><input type="text" name="client_city" id="client_city" value="<?php echo $this->mdl_clients->form_value('client_city'); ?>" /></dd>
</dl>

<dl>
	<dt><?php echo $this->lang->line('state'); ?>: </dt>
	<dd><input type="text" name="client_state" id="client_state" value="<?php echo $this->mdl_clients->form_value('client_state'); ?>" /></dd>
</dl>

<dl>
	<dt><?php echo $this->lang->line('zip'); ?>: </dt>
	<dd><input type="text" name="client_zip" id="client_zip" value="<?php echo $this->mdl_clients->form_value('client_zip'); ?>" /></dd>
</dl>

<dl>
	<dt><?php echo $this->lang->line('country'); ?>: </dt>
	<dd><input type="text" name="client_country" id="client_country" value="<?php echo $this->mdl_clients->form_value('client_country'); ?>" /></dd>
</dl>

<dl>
	<dt><?php echo $this->lang->line('phone_number'); ?>: </dt>
	<dd><input type="text" name="client_phone_number" id="client_phone_number" value="<?php echo $this->mdl_clients->form_value('client_phone_number'); ?>" /></dd>
</dl>

<dl>
	<dt><?php echo $this->lang->line('fax_number'); ?>: </dt>
	<dd><input type="text" name="client_fax_number" id="client_fax_number" value="<?php echo $this->mdl_clients->form_value('client_fax_number'); ?>" /></dd>
</dl>

<dl>
	<dt><?php echo $this->lang->line('mobile_number'); ?>: </dt>
	<dd><input type="text" name="client_mobile_number" id="client_mobile_number" value="<?php echo $this->mdl_clients->form_value('client_mobile_number'); ?>" /></dd>
</dl>

<dl>
	<dt><?php echo $this->lang->line('email_address'); ?>: </dt>
	<dd><input type="text" name="client_email_address" id="client_email_address" value="<?php echo $this->mdl_clients->form_value('client_email_address'); ?>" /></dd>
</dl>

<dl>
	<dt><?php echo $this->lang->line('web_address'); ?>: </dt>
	<dd><input type="text" name="client_web_address" id="client_web_address" value="<?php echo $this->mdl_clients->form_value('client_web_address'); ?>" /></dd>
</dl>

<dl>
	<dt><?php echo $this->lang->line('notes'); ?>: </dt>
	<dd><textarea name="client_notes" id="client_notes" rows="5" cols="40"><?php echo form_prep($this->mdl_clients->form_value('client_notes')); ?></textarea></dd>
</dl>

<?php foreach ($custom_fields as $custom_field) { ?>
<dl>
	<dt><?php echo $custom_field->field_name; ?>: </dt>
	<dd><input type="text" name="<?php echo $custom_field->column_name; ?>" id="<?php echo $custom_field->column_name; ?>" value="<?php echo $this->mdl_clients->form_value($custom_field->column_name); ?>" /></dd>
</dl>
<?php } ?>

<div style="clear: both;">&nbsp;</div>

<input type="submit" id="btn_submit" name="btn_submit" value="<?php echo $this->lang->line('submit'); ?>" />
<input type="submit" id="btn_cancel" name="btn_cancel" value="<?php echo $this->lang->line('cancel'); ?>" />

<div style="clear: both;">&nbsp;</div>