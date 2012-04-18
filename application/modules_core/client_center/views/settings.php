<p style="font-weight: bold;"><?php echo $this->lang->line('allow_clients_change_data'); ?>:</p>
<dl>
	<dt><?php echo $this->lang->line('tax_id_number');?>: </dt>
	<dd>
		<input type="checkbox" name="cc_settings[cc_enable_client_tax_id]" value="1" <?php if($this->mdl_mcb_data->setting('cc_enable_client_tax_id')){?>checked<?php }?> />
	</dd>
</dl>

<dl>
	<dt><?php echo $this->lang->line('street_address');?>: </dt>
	<dd>
		<input type="checkbox" name="cc_settings[cc_enable_client_address]" value="1" <?php if($this->mdl_mcb_data->setting('cc_enable_client_address')){?>checked<?php }?> />
	</dd>
</dl>

<dl>
	<dt><?php echo $this->lang->line('street_address_2');?>: </dt>
	<dd>
		<input type="checkbox" name="cc_settings[cc_enable_client_address_2]" value="1" <?php if($this->mdl_mcb_data->setting('cc_enable_client_address_2')){?>checked<?php }?> />
	</dd>
</dl>

<dl>
	<dt><?php echo $this->lang->line('city');?>: </dt>
	<dd>
		<input type="checkbox" name="cc_settings[cc_enable_client_city]" value="1" <?php if($this->mdl_mcb_data->setting('cc_enable_client_city')){?>checked<?php }?> />
	</dd>
</dl>

<dl>
	<dt><?php echo $this->lang->line('state');?>: </dt>
	<dd>
		<input type="checkbox" name="cc_settings[cc_enable_client_state]" value="1" <?php if($this->mdl_mcb_data->setting('cc_enable_client_state')){?>checked<?php }?> />
	</dd>
</dl>

<dl>
	<dt><?php echo $this->lang->line('zip');?>: </dt>
	<dd>
		<input type="checkbox" name="cc_settings[cc_enable_client_zip]" value="1" <?php if($this->mdl_mcb_data->setting('cc_enable_client_zip')){?>checked<?php }?> />
	</dd>
</dl>

<dl>
	<dt><?php echo $this->lang->line('country');?>: </dt>
	<dd>
		<input type="checkbox" name="cc_settings[cc_enable_client_country]" value="1" <?php if($this->mdl_mcb_data->setting('cc_enable_client_country')){?>checked<?php }?> />
	</dd>
</dl>

<dl>
	<dt><?php echo $this->lang->line('phone_number');?>: </dt>
	<dd>
		<input type="checkbox" name="cc_settings[cc_enable_client_phone_number]" value="1" <?php if($this->mdl_mcb_data->setting('cc_enable_client_phone_number')){?>checked<?php }?> />
	</dd>
</dl>

<dl>
	<dt><?php echo $this->lang->line('fax_number');?>: </dt>
	<dd>
		<input type="checkbox" name="cc_settings[cc_enable_client_fax_number]" value="1" <?php if($this->mdl_mcb_data->setting('cc_enable_client_fax_number')){?>checked<?php }?> />
	</dd>
</dl>

<dl>
	<dt><?php echo $this->lang->line('mobile_number');?>: </dt>
	<dd>
		<input type="checkbox" name="cc_settings[cc_enable_client_mobile_number]" value="1" <?php if($this->mdl_mcb_data->setting('cc_enable_client_mobile_number')){?>checked<?php }?> />
	</dd>
</dl>

<dl>
	<dt><?php echo $this->lang->line('email_address');?>: </dt>
	<dd>
		<input type="checkbox" name="cc_settings[cc_enable_client_email_address]" value="1" <?php if($this->mdl_mcb_data->setting('cc_enable_client_email_address')){?>checked<?php }?> />
	</dd>
</dl>

<dl>
	<dt><?php echo $this->lang->line('web_address');?>: </dt>
	<dd>
		<input type="checkbox" name="cc_settings[cc_enable_client_web_address]" value="1" <?php if($this->mdl_mcb_data->setting('cc_enable_client_web_address')){?>checked<?php }?> />
	</dd>
</dl>