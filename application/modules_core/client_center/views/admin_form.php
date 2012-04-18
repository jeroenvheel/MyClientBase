<?php $this->load->view('dashboard/header', array('header_insert'=>array('client_center/jquery_client_ac'))); ?>

<div class="container_10" id="center_wrapper">

	<div class="grid_10" id="content_wrapper">

		<div class="section_wrapper">

			<h3 class="title_black"><?php echo $this->lang->line('client_center_form'); ?></h3>

			<?php $this->load->view('dashboard/system_messages'); ?>

			<div class="content toggle">

				<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">

				<dl>
					<dt><label><?php echo $this->lang->line('client'); ?>: </label></dt>
					<dd>
						<input type="text" id="client_id_autocomplete_label" name="client_id_autocomplete_label" value="<?php echo $this->mdl_client_center->form_value('client_id_autocomplete_label'); ?>" />
						<input type="hidden" id="client_id_autocomplete_hidden" name="client_id" value="<?php echo $this->mdl_client_center->form_value('client_id'); ?>"/>
					</dd>
				</dl>

				<dl>
					<dt><label><?php echo $this->lang->line('username'); ?>: </label></dt>
					<dd><input type="text" name="username" id="username" value="<?php echo $this->mdl_client_center->form_value('username'); ?>" /></dd>
				</dl>

				<dl>
					<dt><label><?php echo $this->lang->line('password'); ?>: </label></dt>
					<dd><input type="password" name="password" id="password" /></dd>
				</dl>

				<dl>
					<dt><label><?php echo $this->lang->line('password_verify'); ?>: </label></dt>
					<dd><input type="password" name="passwordv" id="passwordv" /></dd>
				</dl>

				<dl>
					<dt><label><?php echo $this->lang->line('email_address'); ?></label></dt>
					<dd><input type="text" name="email_address" id="email" value="<?php echo $this->mdl_client_center->form_value('email_address'); ?>" /></dd>
				</dl>

                <div style="clear: both;">&nbsp;</div>

				<input type="submit" id="btn_submit" name="btn_submit" value="<?php echo $this->lang->line('submit'); ?>" />
				<input type="submit" id="btn_cancel" name="btn_cancel" value="<?php echo $this->lang->line('cancel'); ?>" />

				</form>

			</div>

		</div>

	</div>
</div>

<?php $this->load->view('dashboard/footer'); ?>