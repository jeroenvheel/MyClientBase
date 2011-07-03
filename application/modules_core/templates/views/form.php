<?php $this->load->view('dashboard/header'); ?>

<div class="grid_10" id="content_wrapper">

	<div class="section_wrapper">

		<h3 class="title_black"><?php echo $page_title; ?></h3>

		<?php $this->load->view('dashboard/system_messages'); ?>

		<div class="content toggle">

			<?php if (!$dir_is_writable) { ?>

				<p><?php echo $this->lang->line('template_dir_not_writable'); ?></p>
				<p><?php echo $template_dir; ?></p>

			<?php } else { ?>

				<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">

				<label><?php echo $this->lang->line('template_name'); ?>: </label>

				<br />

				<input type="text" name="template_name" id="template_name" value="<?php echo $this->mdl_templates->form_value('template_name'); ?>" />

				<?php if (uri_assoc('template_name')) { ?>

					<p>* <?php echo $this->lang->line('changing_template_name'); ?></p>

				<?php } ?>

				<br /><br />

				<label><?php echo $this->lang->line('template_content'); ?>: </label>

				<br />

				<textarea name="template_content" style="width: 850px; height: 650px;"><?php echo $this->mdl_templates->form_value('template_content'); ?></textarea>

				<div style="clear: both;">&nbsp;</div>

				<input type="submit" id="btn_submit" name="btn_submit" value="<?php echo $this->lang->line('submit'); ?>" />&nbsp;<input type="submit" id="btn_cancel" name="btn_cancel" value="<?php echo $this->lang->line('cancel'); ?>" />

			</form>

			<?php } ?>

		</div>

	</div>

</div>

<?php $this->load->view('dashboard/footer'); ?>