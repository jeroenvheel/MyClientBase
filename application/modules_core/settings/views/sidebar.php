<div class="section_wrapper">

	<h3 class="title_white"><?php echo $this->lang->line('system'); ?></h3>

	<ul class="quicklinks content toggle">
		<li><?php echo anchor('settings', $this->lang->line('system_settings')); ?></li>
		<li><?php echo anchor('users', $this->lang->line('user_accounts')); ?></li>
		<li><?php echo anchor('tax_rates', $this->lang->line('tax_rates')); ?></li>
		<li><?php echo anchor('invoice_statuses', $this->lang->line('invoice_statuses')); ?></li>
		<li><?php echo anchor('invoices/invoice_groups', $this->lang->line('invoice_groups')); ?></li>
		<li class="last"><?php echo anchor('mcb_modules', $this->lang->line('modules')); ?></li>
	</ul>

</div>