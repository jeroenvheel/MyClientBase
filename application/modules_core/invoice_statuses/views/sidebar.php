<div class="section_wrapper">

	<h3 class="title_white"><?php echo $this->lang->line('invoice_statuses'); ?></h3>

	<ul class="quicklinks content toggle">
		<li><?php echo anchor('invoice_statuses', $this->lang->line('view_invoice_statuses')); ?></li>
		<li class="last"><?php echo anchor('invoice_statuses/form', $this->lang->line('add_invoice_status')); ?></li>
	</ul>

</div>