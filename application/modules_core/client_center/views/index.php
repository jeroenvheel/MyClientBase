<?php $this->load->view('header'); ?>

<?php $this->load->view('jquery_invoice_generate'); ?>

<div class="grid_7" id="content_wrapper">

	<div class="section_wrapper">

		<h3 class="title_black"><?php echo $this->lang->line('open_invoices'); ?></h3>

		<div class="content toggle no_padding">

			<?php $this->load->view('invoice_table', array('invoices'=>$open_invoices)); ?>

		</div>

	</div>

	<div class="section_wrapper">

		<h3 class="title_black"><?php echo $this->lang->line('pending_invoices'); ?></h3>

		<div class="content toggle no_padding">

			<?php $this->load->view('invoice_table', array('invoices'=>$pending_invoices)); ?>

		</div>

	</div>

	<div class="section_wrapper">

		<h3 class="title_black"><?php echo $this->lang->line('recently_closed_invoices'); ?></h3>

		<div class="content toggle no_padding">

			<?php $this->load->view('invoice_table', array('invoices'=>$closed_invoices)); ?>

		</div>

	</div>

</div>

<?php $this->load->view('sidebar'); ?>

<?php $this->load->view('footer'); ?>