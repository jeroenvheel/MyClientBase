<?php $this->load->view('dashboard/header'); ?>

<?php echo modules::run('invoices/widgets/generate_dialog'); ?>

<div class="grid_10" id="content_wrapper">

	<div class="section_wrapper">

		<h3 class="title_black"><?php echo $this->lang->line('invoice_search'); ?>
			<span style="font-size: 60%;">
				<?php $this->load->view('dashboard/btn_add', array('btn_name'=>'btn_add_invoice', 'btn_value'=>$this->lang->line('create_invoice'))); ?>
			</span>

		</h3>

		<div class="content toggle no_padding">

			<?php $this->load->view('dashboard/system_messages'); ?>

			<?php $this->load->view('invoices/invoice_table'); ?>

		</div>

	</div>

</div>

<?php $this->load->view('dashboard/footer'); ?>