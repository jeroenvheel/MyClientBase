<?php $this->load->view('dashboard/header'); ?>

<div class="grid_7" id="content_wrapper">

	<div class="section_wrapper">

		<h3 class="title_black"><?php echo $this->lang->line('custom_fields'); ?><?php $this->load->view('dashboard/btn_add'); ?></h3>

		<?php $this->load->view('dashboard/system_messages'); ?>

		<div class="content toggle no_padding">

			<table>
				<tr>
					<th scope="col" class="first"><?php echo $this->lang->line('id'); ?></th>
					<th scope="col"><?php echo $this->lang->line('object'); ?></th>
					<th scope="col"><?php echo $this->lang->line('field_name'); ?></th>
					<th scope="col" class="last"><?php echo $this->lang->line('actions'); ?></th>
				</tr>
				<?php foreach ($fields as $field) { ?>
				<tr>
					<td class="first"><?php echo $field->field_id; ?></td>
					<td><?php echo $objects[$field->object_id] . '.' . $field->column_name; ?></td>
					<td><?php echo $field->field_name; ?></td>
					<td class="last">
						<a href="<?php echo site_url('fields/form/field_id/' . $field->field_id); ?>" title="<?php echo $this->lang->line('edit'); ?>">
							<?php echo icon('edit'); ?>
						</a>
						<a href="<?php echo site_url('fields/delete/field_id/' . $field->field_id); ?>" title="<?php echo $this->lang->line('delete'); ?>" onclick="javascript:if(!confirm('<?php echo $this->lang->line('confirm_delete'); ?>')) return false">
							<?php echo icon('delete'); ?>
						</a>
					</td>
				</tr>
				<?php } ?>
			</table>

			<?php if ($this->mdl_fields->page_links) { ?>
			<div id="pagination">
				<?php echo $this->mdl_fields->page_links; ?>
			</div>
			<?php } ?>

		</div>

	</div>

</div>

<?php $this->load->view('dashboard/sidebar', array('side_block'=>array('fields/sidebar', 'settings/sidebar'),'hide_quicklinks'=>TRUE)); ?>

<?php $this->load->view('dashboard/footer'); ?>