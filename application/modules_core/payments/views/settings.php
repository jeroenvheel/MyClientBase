<dl>
	<dt><?php echo $this->lang->line('default_receipt_template'); ?></dt>
	<dd>
	<select name="payment_settings[default_receipt_template]">
		<?php foreach ($receipt_templates as $template) { ?>
			<option value="<?php echo $template; ?>" <?php if($this->mdl_mcb_data->setting('default_receipt_template') == $template){ ?>selected="selected"<?php } ?>><?php echo $template; ?></option>
		<?php } ?>
	</select>
	</dd>
</dl>