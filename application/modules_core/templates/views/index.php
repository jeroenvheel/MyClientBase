<?php $this->load->view('dashboard/header'); ?>

<div class="grid_7" id="content_wrapper">

	<div class="section_wrapper">

		<h3 class="title_black"><?php echo $page_title; ?>
			<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>" style="display: inline;">
				<input type="submit" style="float: right; margin-top: 10px; margin-right: 10px;" name="btn_create_template" value="<?php echo $this->lang->line('add'); ?>" <?php if(!$dir_is_writable) { ?>disabled<?php } ?>>
			</form>
		</h3>

		<?php $this->load->view('dashboard/system_messages'); ?>

		<div class="content toggle no_padding">

			<?php if (!$dir_is_writable) { ?>

				<p><?php echo $this->lang->line('template_dir_not_writable'); ?></p>
				<p><?php echo $template_dir; ?></p>

			<?php } else { ?>

				<table>
					<tr>
						<th scope="col" class="first"><?php echo $this->lang->line('template_name'); ?></th>
						<th scope="col" class="last"><?php echo $this->lang->line('actions'); ?></th>
					</tr>
					<?php foreach ($templates as $template) { ?>
					<tr>
						<td class="first"><?php echo $template; ?></td>
						<td class="last">
							<a href="<?php echo site_url('templates/form/type/' . uri_assoc('type') . '/template_name/' . $template); ?>" title="<?php echo $this->lang->line('edit'); ?>">
								<?php echo icon('edit'); ?>
							</a>
							<a href="<?php echo site_url('templates/delete/type/' . uri_assoc('type') . '/template_name/' . $template); ?>" title="<?php echo $this->lang->line('delete'); ?>" onclick="javascript:if(!confirm('<?php echo $this->lang->line('confirm_delete'); ?>')) return false">
								<?php echo icon('delete'); ?>
							</a>
						</td>
					</tr>
					<?php } ?>
				</table>

			<?php } ?>

		</div>

	</div>

</div>

<?php $this->load->view('dashboard/sidebar'); ?>

<?php $this->load->view('dashboard/footer'); ?>