<div class="section_wrapper">

	<h3 class="title_white"><?php echo $this->lang->line('invoices'); ?></h3>

	<ul class="quicklinks content toggle">
		<li><?php echo anchor('invoices/index', $this->lang->line('view_invoices')); ?></li>
		<li><?php echo anchor('invoices/create', $this->lang->line('create_invoice')); ?></li>
		<li><?php echo anchor('invoices/index/is_quote/1', $this->lang->line('view_quotes')); ?></li>
		<li><?php echo anchor('invoice_items', $this->lang->line('invoice_items')); ?></li>
		<li><?php echo anchor('invoice_search', $this->lang->line('invoice_search')); ?></li>
		<li class="last"><?php echo anchor('templates/index/type/invoices', $this->lang->line('invoice_templates')); ?></li>
	</ul>

</div>