<?php $this->load->view('dashboard/header'); ?>

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
						<select name="client_id">
							<?php foreach ($clients as $client) { ?>
							<option value="<?php echo $client->client_id; ?>" <?php if ($this->mdl_client_center->form_value('client_id') == $client->client_id) { ?>selected<?php } ?>><?php echo $client->client_name; ?></option>
							<?php } ?>
						</select>
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

                <div style="clear: both;">&nbsp;</div>

				<input type="submit" id="btn_submit" name="btn_submit" value="<?php echo $this->lang->line('submit'); ?>" />
				<input type="submit" id="btn_cancel" name="btn_cancel" value="<?php echo $this->lang->line('cancel'); ?>" />

				</form>

			</div>

		</div>

	</div>
</div>

<?php $this->load->view('dashboard/footer'); ?>