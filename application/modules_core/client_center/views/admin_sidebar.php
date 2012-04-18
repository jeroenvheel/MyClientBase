<div class="grid_3" id="sidebar">

	<div class="section_wrapper">

		<h3 class="title_black"><?php echo $this->lang->line('quicklinks'); ?></h3>

		<ul class="quicklinks content toggle" id="client_center_sidebar">
			<li><?php echo anchor('client_center/admin', $this->lang->line('view_accounts')); ?></li>
			<li class="last"><?php echo anchor('client_center/admin/form', $this->lang->line('create_account')); ?></li>
		</ul>

	</div>

</div>