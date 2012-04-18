<?php if ($this->uri->segment(2) <> 'profile') { ?>

<?php if ($this->session->userdata('global_admin')) { ?>
<dl>
	<dt><label><?php echo $this->lang->line('global_administrator'); ?>: </label></dt>
	<dd><input type="checkbox" name="global_admin" id="global_admin" value="1" <?php if($this->mdl_users->form_value('global_admin')){ ?>checked="checked"<?php } ?> /></dd>
</dl>
<?php } ?>

<dl>
	<dt><label>* <?php echo $this->lang->line('username'); ?>: </label></dt>
	<dd><input type="text" name="username" id="username" value="<?php echo $this->mdl_users->form_value('username'); ?>" /></dd>
</dl>
<?php } else { ?>

	<input type="hidden" name="username" id="username" value="<?php echo $this->mdl_users->form_value('username'); ?>" />
	<input type="hidden" name="global_admin" id="global_admin" value="<?php echo $this->mdl_users->form_value('global_admin'); ?>" />

	<dt><label><?php echo $this->lang->line('username'); ?>: </label></dt>
	<dd><?php echo $this->mdl_users->form_value('username'); ?></dd>

<?php } ?>

<?php if (uri_assoc('user_id') or $this->uri->segment(2) == 'profile') { ?>

<dl>
	<dt><label><?php echo $this->lang->line('password'); ?>: </label></dt>
	<dd><?php echo anchor(($this->uri->segment(2) == 'profile') ? 'users/profile/change_password' : 'users/change_password/user_id/' . uri_assoc('user_id'), $this->lang->line('change_password')); ?></dd>
</dl>

<?php } else { ?>

<dl>
	<dt><label>* <?php echo $this->lang->line('password'); ?> : </label></dt>
	<dd><input type="password" name="password" id="password" /></dd>
</dl>

<dl>
	<dt><label>* <?php echo $this->lang->line('password_verify'); ?>: </label></dt>
	<dd><input type="password" name="passwordv" id="passwordv" /></dd>
</dl>

<?php } ?>

<dl>
	<dt><label>* <?php echo $this->lang->line('first_name'); ?>: </label></dt>
	<dd><input type="text" name="first_name" id="first_name" value="<?php echo $this->mdl_users->form_value('first_name'); ?>" /></dd>
</dl>

<dl>
	<dt><label>* <?php echo $this->lang->line('last_name'); ?>: </label></dt>
	<dd><input type="text" name="last_name" id="last_name" value="<?php echo $this->mdl_users->form_value('last_name'); ?>" /></dd>
</dl>

<dl>
	<dt><label><?php echo $this->lang->line('company_name'); ?>: </label></dt>
	<dd><input type="text" name="company_name" id="company_name" value="<?php echo $this->mdl_users->form_value('company_name'); ?>" /></dd>
</dl>

<dl>
	<dt><label><?php echo $this->lang->line('street_address'); ?>: </label></dt>
	<dd><input type="text" name="address" id="address" value="<?php echo $this->mdl_users->form_value('address'); ?>" /></dd>
</dl>
<dl>
	<dt><label><?php echo $this->lang->line('street_address_2'); ?>: </label></dt>
	<dd><input type="text" name="address_2" id="address_2" value="<?php echo $this->mdl_users->form_value('address_2'); ?>" /></dd>
</dl>

<dl>
	<dt><label><?php echo $this->lang->line('city'); ?>: </label></dt>
	<dd><input type="text" name="city" id="city" value="<?php echo $this->mdl_users->form_value('city'); ?>" /></dd>
</dl>

<dl>
	<dt><label><?php echo $this->lang->line('state'); ?>: </label></dt>
	<dd><input type="text" name="state" id="state" value="<?php echo $this->mdl_users->form_value('state'); ?>" /></dd>
</dl>

<dl>
	<dt><label><?php echo $this->lang->line('zip'); ?>: </label></dt>
	<dd><input type="text" name="zip" id="zip" value="<?php echo $this->mdl_users->form_value('zip'); ?>" /></dd>
</dl>

<dl>
	<dt><label><?php echo $this->lang->line('country'); ?>: </label></dt>
	<dd><input type="text" name="country" id="country" value="<?php echo $this->mdl_users->form_value('country'); ?>" /></dd>
</dl>

<dl>
	<dt><label><?php echo $this->lang->line('phone_number'); ?>: </label></dt>
	<dd><input type="text" name="phone_number" id="phone_number" value="<?php echo $this->mdl_users->form_value('phone_number'); ?>" /></dd>
</dl>

<dl>
	<dt><label><?php echo $this->lang->line('fax_number'); ?>: </label></dt>
	<dd><input type="text" name="fax_number" id="fax_number" value="<?php echo $this->mdl_users->form_value('fax_number'); ?>" /></dd>
</dl>

<dl>
	<dt><label><?php echo $this->lang->line('mobile_number'); ?>: </label></dt>
	<dd><input type="text" name="mobile_number" id="mobile_number" value="<?php echo $this->mdl_users->form_value('mobile_number'); ?>" /></dd>
</dl>

<dl>
	<dt><label><?php echo $this->lang->line('email_address'); ?>: </label></dt>
	<dd><input type="text" name="email_address" id="email_address" value="<?php echo $this->mdl_users->form_value('email_address'); ?>" /></dd>
</dl>

<dl>
	<dt><label><?php echo $this->lang->line('web_address'); ?>: </label></dt>
	<dd><input type="text" name="web_address" id="web_address" value="<?php echo $this->mdl_users->form_value('web_address'); ?>" /></dd>
</dl>

<dl>
	<dt><label><?php echo $this->lang->line('tax_id_number'); ?>: </label></dt>
	<dd><input type="text" name="tax_id_number" id="tax_id_number" value="<?php echo $this->mdl_users->form_value('tax_id_number'); ?>" /></dd>
</dl>

<?php foreach ($custom_fields as $custom_field) { ?>
<dl>
	<dt><label><?php echo $custom_field->field_name; ?>: </label></dt>
	<dd><input type="text" name="<?php echo $custom_field->column_name; ?>" id="<?php echo $custom_field->column_name; ?>" value="<?php echo $this->mdl_users->form_value($custom_field->column_name); ?>" /></dd>
</dl>
<?php } ?>

<input type="submit" id="btn_submit" name="btn_submit" value="<?php echo $this->lang->line('submit'); ?>" />
<input type="submit" id="btn_cancel" name="btn_cancel" value="<?php echo $this->lang->line('cancel'); ?>" />