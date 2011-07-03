<div class="section_wrapper">

	<h3 class="title_black"><?php echo $this->lang->line('quicklinks'); ?></h3>

	<ul class="quicklinks content toggle">
		<li><?php echo anchor('clients/form', $this->lang->line('new_client')); ?></li>
		<li><?php echo anchor('invoices/create', $this->lang->line('create_invoice')); ?></li>
		<li><?php echo anchor('payments/form', $this->lang->line('enter_payment')); ?></li>
		<li><?php echo anchor('invoice_search', $this->lang->line('invoice_search')); ?></li>

		<?php if ($this->session->userdata('global_admin')) { ?>
		<li class="last"><?php echo anchor('settings', $this->lang->line('system_settings')); ?></li>
		<?php } ?>
	</ul>

</div>