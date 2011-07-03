<?php $this->load->view('dashboard/header'); ?>

<?php echo modules::run('payments/payment_widgets/generate_dialog'); ?>

<div class="grid_7" id="content_wrapper">

	<div class="section_wrapper">

		<h3 class="title_black"><?php echo $this->lang->line('invoice_payments'); ?><?php $this->load->view('dashboard/btn_add', array('btn_value'=>$this->lang->line('enter_payment'))); ?></h3>

		<?php $this->load->view('dashboard/system_messages'); ?>

		<div class="content toggle no_padding">

			<?php $this->load->view('table'); ?>

		</div>

	</div>

</div>

<?php $this->load->view('dashboard/sidebar', array('side_block'=>'payments/sidebar')); ?>

<?php $this->load->view('dashboard/footer'); ?>