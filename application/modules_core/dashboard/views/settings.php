<dl>
	<dt><?php echo $this->lang->line('dashboard_override'); ?>: </dt>
	<dd><input type="text" name="dashboard_override" value="<?php echo $this->mdl_mcb_data->setting('dashboard_override'); ?>" /></dd>
</dl>

<dl>
	<dt><?php echo $this->lang->line('dashboard_show_overdue_invoices'); ?>: </dt>
	<dd><input type="checkbox" name="dashboard_show_overdue_invoices" value="TRUE" <?php if($this->mdl_mcb_data->setting('dashboard_show_overdue_invoices') == "TRUE"){ ?>checked="checked"<?php } ?> /></dd>
</dl>

<dl>
	<dt><?php echo $this->lang->line('dashboard_show_quotes'); ?>: </dt>
	<dd><input type="checkbox" name="dashboard_show_quotes" value="TRUE" <?php if($this->mdl_mcb_data->setting('dashboard_show_quotes') == "TRUE"){ ?>checked="checked"<?php } ?> /></dd>
</dl>

<dl>
	<dt><?php echo $this->lang->line('dashboard_show_open_invoices'); ?>: </dt>
	<dd><input type="checkbox" name="dashboard_show_open_invoices" value="TRUE" <?php if($this->mdl_mcb_data->setting('dashboard_show_open_invoices') == "TRUE"){ ?>checked="checked"<?php } ?> /></dd>
</dl>

<dl>
	<dt><?php echo $this->lang->line('dashboard_show_pending_invoices'); ?>: </dt>
	<dd><input type="checkbox" name="dashboard_show_pending_invoices" value="TRUE" <?php if($this->mdl_mcb_data->setting('dashboard_show_pending_invoices') == "TRUE"){ ?>checked="checked"<?php } ?> /></dd>
</dl>

<dl>
	<dt><?php echo $this->lang->line('dashboard_show_closed_invoices'); ?>: </dt>
	<dd><input type="checkbox" name="dashboard_show_closed_invoices" value="TRUE" <?php if($this->mdl_mcb_data->setting('dashboard_show_closed_invoices') == "TRUE"){ ?>checked="checked"<?php } ?> /></dd>
</dl>



<dl>
    <dt><?php echo $this->lang->line('total_paid_widget_cutoff_date'); ?>: </dt>
    <dd><input id="datepicker" type="text" name="dashboard_total_paid_cutoff_date" value="<?php echo date($this->mdl_mcb_data->setting('dashboard_total_paid_cutoff_date')); ?>" /></dd>
</dl>