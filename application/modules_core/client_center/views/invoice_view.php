<?php $this->load->view('header'); ?>

<?php $this->load->view('jquery_invoice_generate'); ?>

<script type="text/javascript">
	$(function(){
		$('#tabs').tabs();
	});
</script>

<div class="grid_10" id="content_wrapper">

	<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">

	<div class="section_wrapper">

		<h3 class="title_black"><?php echo $this->lang->line('invoice_number') . ' ' . $invoice->invoice_number; ?></h3>

		<div class="content toggle">

				<div id="tabs">
					<ul>
						<li><a href="#tab_general"><?php echo $this->lang->line('summary'); ?></a></li>
						<li><a href="#tab_items"><?php echo $this->lang->line('items'); ?></a></li>
						<li><a href="#tab_payments"><?php echo $this->lang->line('payments'); ?></a></li>
						<li><a href="#tab_taxes"><?php echo $this->lang->line('tax_and_other'); ?></a></li>
						<li><a href="#tab_notes"><?php echo $this->lang->line('notes'); ?></a></li>
					</ul>
					<div id="tab_general">
						<?php $this->load->view('invoice_view_tab_general'); ?>
					</div>

					<div id="tab_items">
						<?php $this->load->view('invoice_view_tab_items'); ?>
					</div>

					<div id="tab_payments">
						<?php $this->load->view('payment_table'); ?>
					</div>

					<div id="tab_taxes">
						<?php $this->load->view('invoice_view_tab_taxes'); ?>
					</div>

					<div id="tab_notes">
						<?php $this->load->view('invoice_view_tab_notes'); ?>
					</div>

				</div>

			</form>

			<div style="clear: both;">&nbsp;</div>

		</div>

	</div>

</div>

<?php $this->load->view('footer'); ?>
