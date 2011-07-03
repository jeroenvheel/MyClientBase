<dl>
    <dt><?php echo $this->lang->line('default_invoice_template'); ?>: </dt>
    <dd>
        <select name="client_settings[default_invoice_template]" id="default_invoice_template">
            <option value=""></option>
            <?php foreach ($invoice_templates as $template) { ?>
            <option value="<?php echo $template; ?>" <?php if ($this->mdl_mcb_client_data->setting('default_invoice_template') == $template) { ?>selected="selected"<?php } ?>><?php echo $template; ?></option>
            <?php } ?>
        </select>
    </dd>
</dl>

<dl>
    <dt><?php echo $this->lang->line('default_quote_template'); ?>: </dt>
    <dd>
        <select name="client_settings[default_quote_template]" id="default_invoice_template">
            <option value=""></option>
            <?php foreach ($invoice_templates as $template) { ?>
            <option value="<?php echo $template; ?>" <?php if ($this->mdl_mcb_client_data->setting('default_quote_template') == $template) { ?>selected="selected"<?php } ?>><?php echo $template; ?></option>
            <?php } ?>
        </select>
    </dd>
</dl>

<dl>
    <dt><?php echo $this->lang->line('default_invoice_group'); ?>: </dt>
    <dd>
        <select name="client_settings[default_invoice_group_id]" id="default_invoice_group_id">
            <option value=""></option>
            <?php foreach ($invoice_groups as $group) { ?>
            <option value="<?php echo $group->invoice_group_id; ?>" <?php if ($this->mdl_mcb_client_data->setting('default_invoice_group_id') == $group->invoice_group_id) { ?>selected="selected"<?php } ?>><?php echo $group->invoice_group_name; ?></option>
            <?php } ?>
        </select>
    </dd>
</dl>

<dl>
    <dt><?php echo $this->lang->line('default_quote_group'); ?>: </dt>
    <dd>
        <select name="client_settings[default_quote_group_id]" id="default_quote_group_id">
            <option value=""></option>
            <?php foreach ($invoice_groups as $group) { ?>
            <option value="<?php echo $group->invoice_group_id; ?>" <?php if ($this->mdl_mcb_client_data->setting('default_quote_group_id') == $group->invoice_group_id) { ?>selected="selected"<?php } ?>><?php echo $group->invoice_group_name; ?></option>
            <?php } ?>
        </select>
    </dd>
</dl>

<div style="clear: both;">&nbsp;</div>

<input type="submit" id="btn_submit" name="btn_submit" value="<?php echo $this->lang->line('submit'); ?>" />
<input type="submit" id="btn_cancel" name="btn_cancel" value="<?php echo $this->lang->line('cancel'); ?>" />

<div style="clear: both;">&nbsp;</div>