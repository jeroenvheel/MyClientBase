<?php $this->load->view('dashboard/header'); ?>

<div class="grid_7" id="content_wrapper">

	<div class="section_wrapper">

		<h3 class="title_black"><?php echo $this->lang->line('payment_methods'); ?><?php $this->load->view('dashboard/btn_add', array('btn_value'=>$this->lang->line('add_payment_method'))); ?></h3>

		<div class="content toggle no_padding">

			<table>
				<tr>
					<th scope="col" class="first" width="10%;"><?php echo $this->lang->line('id'); ?></th>
					<th scope="col" width="70%"><?php echo $this->lang->line('payment_method'); ?></th>
					<th scope="col" class="last" width="20%;"><?php echo $this->lang->line('actions'); ?></th>
				</tr>
				<?php foreach ($payment_methods as $payment_method) { ?>
				<tr>
					<td class="first"><?php echo $payment_method->payment_method_id; ?></td>
					<td><?php echo $payment_method->payment_method; ?></td>
					<td class="last">
						<a href="<?php echo site_url('payments/payment_methods/form/payment_method_id/' . $payment_method->payment_method_id); ?>" title="<?php echo $this->lang->line('edit'); ?>">
							<?php echo icon('edit'); ?>
						</a>
						<a href="<?php echo site_url('payments/payment_methods/delete/payment_method_id/' . $payment_method->payment_method_id); ?>" title="<?php echo $this->lang->line('delete'); ?>" onclick="javascript:if(!confirm('<?php echo $this->lang->line('confirm_delete'); ?>')) return false">
							<?php echo icon('delete'); ?>
						</a>
					</td>

				</tr>
				<?php } ?>
			</table>

			<?php if ($this->mdl_payment_methods->page_links) { ?>
			<div id="pagination">
				<?php echo $this->mdl_payment_methods->page_links; ?>
			</div>
			<?php } ?>

		</div>

	</div>

</div>

<?php $this->load->view('dashboard/sidebar'); ?>

<?php $this->load->view('dashboard/footer'); ?>