<?php $this->load->view('dashboard/header'); ?>

<div class="grid_10" id="content_wrapper">

	<div class="section_wrapper">

		<h3 class="title_black"><?php echo $this->lang->line('email_template_form'); ?></h3>

		<?php $this->load->view('dashboard/system_messages'); ?>

		<div class="content toggle">

			<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">

				<dl>
					<dt><label>* <?php echo $this->lang->line('email_template_title'); ?>: </label></dt>
					<dd><input type="text" name="email_template_title" id="email_template_title" value="<?php echo $this->mdl_email_templates->form_value('email_template_title'); ?>" /></dd>
				</dl>

				<dl>
					<dt><label><?php echo $this->lang->line('email_body'); ?>: </label></dt>
					<dd><textarea name="email_template_body" rows="10" cols="80"><?php echo $this->mdl_email_templates->form_value('email_template_body'); ?></textarea></dd>
				</dl>

				<dl>
					<dt><label><?php echo $this->lang->line('email_footer'); ?>: </label></dt>
					<dd><textarea name="email_template_footer" rows="10" cols="80"><?php echo $this->mdl_email_templates->form_value('email_template_footer'); ?></textarea></dd>
				</dl>

                <div style="clear: both;">&nbsp;</div>

				<input type="submit" id="btn_submit" name="btn_submit" value="<?php echo $this->lang->line('submit'); ?>" />
				<input type="submit" id="btn_cancel" name="btn_cancel" value="<?php echo $this->lang->line('cancel'); ?>" />

			</form>

		</div>

	</div>

</div>

<?php $this->load->view('dashboard/footer'); ?>