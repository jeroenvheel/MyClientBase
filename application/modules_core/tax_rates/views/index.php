<?php $this->load->view('dashboard/header'); ?>

<div class="grid_7" id="content_wrapper">

	<div class="section_wrapper">

		<h3 class="title_black"><?php echo $this->lang->line('tax_rates'); ?><?php $this->load->view('dashboard/btn_add', array('btn_value'=>$this->lang->line('add_tax_rate'))); ?></h3>

		<?php $this->load->view('dashboard/system_messages'); ?>

		<div class="content toggle no_padding">

			<table>
				<tr>
					<th scope="col" class="first"><?php echo $this->lang->line('id'); ?></th>
					<th scope="col"><?php echo $this->lang->line('tax_rate_name'); ?></th>
					<th scope="col"><?php echo $this->lang->line('tax_rate_percent'); ?></th>
					<th scope="col" class="last"><?php echo $this->lang->line('actions'); ?></th>
				</tr>
				<?php foreach ($tax_rates as $tax_rate) { ?>
				<tr>
					<td class="first"><?php echo $tax_rate->tax_rate_id; ?></td>
					<td><?php echo $tax_rate->tax_rate_name; ?></td>
					<td><?php echo $tax_rate->tax_rate_percent; ?>%</td>
					<td class="last">
						<a href="<?php echo site_url('tax_rates/form/tax_rate_id/' . $tax_rate->tax_rate_id); ?>" title="<?php echo $this->lang->line('edit'); ?>">
							<?php echo icon('edit'); ?>
						</a>
						<a href="<?php echo site_url('tax_rates/delete/tax_rate_id/' . $tax_rate->tax_rate_id); ?>" title="<?php echo $this->lang->line('delete'); ?>" onclick="javascript:if(!confirm('<?php echo $this->lang->line('confirm_delete'); ?>')) return false">
							<?php echo icon('delete'); ?>
						</a>
					</td>
				</tr>
				<?php } ?>
			</table>

			<?php if ($this->mdl_tax_rates->page_links) { ?>
			<div id="pagination">
				<?php echo $this->mdl_tax_rates->page_links; ?>
			</div>
			<?php } ?>

		</div>

	</div>

</div>

<?php $this->load->view('dashboard/sidebar', array('side_block'=>array('tax_rates/sidebar', 'settings/sidebar'),'hide_quicklinks'=>TRUE)); ?>

<?php $this->load->view('dashboard/footer'); ?>