<?php if (isset($fields)) { foreach ($fields as $field) { ?>
<dl>
	<dt><label><?php echo $field->field_name; ?>: </label></dt>
	<dd><input type="text" name="custom_fields[<?php echo $field->field_id; ?>]" id="custom_fields[<?php echo $field->field_id; ?>]" value="<?php echo $field->field_value; ?>" /></dd>
</dl>
<?php } } ?>