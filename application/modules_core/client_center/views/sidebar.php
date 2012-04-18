<div class="grid_3" id="sidebar">

	<div class="section_wrapper">

		<h3 class="title_black"><?php echo $this->lang->line('quicklinks'); ?></h3>

		<ul class="quicklinks content toggle" id="quicklinks_client_center">
			<li><?php echo anchor('client_center', $this->lang->line('client_center')); ?></li>
			<li><?php echo anchor('client_center/invoices', $this->lang->line('invoices')); ?></li>
			<li><?php echo anchor('client_center/account', $this->lang->line('my_account')); ?></li>
			<li class="last"><?php echo anchor('sessions/logout', $this->lang->line('log_out')); ?></li>
		</ul>

	</div>

</div>