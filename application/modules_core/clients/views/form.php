<?php $this->load->view('dashboard/header', array('header_insert'=>array('clients/details_header'))); ?>

<?php echo modules::run('invoices/widgets/generate_dialog'); ?>

<script type="text/javascript">
	$(function(){
		$('#tabs').tabs({ selected: <?php echo isset($tab_index) ? $tab_index : 0; ?> });
	});
</script>

<div class="container_10" id="center_wrapper">

	<div class="grid_10" id="content_wrapper">

		<div class="section_wrapper">
			<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">
			<?php if ($client) { ?>
			<h3 class="title_black"><?php echo $client->client_name; ?>
				<span style="font-size: 60%;">
				<input type="submit" name="btn_add_contact" class="uibutton" style="float: right; margin-top: 10px; margin-right: 10px;" value="<?php echo $this->lang->line('add_contact'); ?>" />
				<?php if ($client->client_active) { ?>
                <input type="submit" name="btn_add_invoice" class="uibutton" style="float: right; margin-top: 10px; margin-right: 10px;" value="<?php echo $this->lang->line('create_invoice'); ?>" />
				<input type="submit" name="btn_add_quote" class="uibutton" style="float: right; margin-top: 10px; margin-right: 10px;" value="<?php echo $this->lang->line('create_quote'); ?>" />
                <?php } ?>
				</span>
			</h3>
			<?php } else { ?>
			<h3 class="title_black"><?php echo $this->lang->line('client_form'); ?></h3>
			<?php } ?>
			</form>
			<?php $this->load->view('dashboard/system_messages'); ?>

			<div class="content toggle">

				<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">

				<div id="tabs">

					<ul>
						<li><a href="#tab_client"><?php echo $this->lang->line('client'); ?></a></li>
						<li><a href="#tab_settings"><?php echo $this->lang->line('settings'); ?></a></li>
						<?php if ($client) { ?>
						<li><a href="#tab_contacts"><?php echo $this->lang->line('contacts'); ?></a></li>
						<li><a href="#tab_quotes"><?php echo $this->lang->line('quotes'); ?></a></li>
						<li><a href="#tab_invoices"><?php echo $this->lang->line('invoices'); ?></a></li>
						<?php } ?>
						
					</ul>

					<div id="tab_client">

						<div class="left_box">
							
							<dl>
								<dt><?php echo $this->lang->line('active_client'); ?>: </dt>
								<dd><input type="checkbox" name="client_active" id="client_active" value="1" <?php if ($this->mdl_clients->form_value('client_active') or (!$_POST and !uri_assoc('client_id'))) { ?>checked="checked"<?php } ?> /></dd>
							</dl>

							<dl>
								<dt>* <?php echo $this->lang->line('client_name'); ?>: </dt>
								<dd><input type="text" name="client_name" id="client_name" value="<?php echo $this->mdl_clients->form_value('client_name'); ?>" /></dd>
							</dl>

							<dl>
								<dt><?php echo $this->lang->line('street_address'); ?>: </dt>
								<dd><input type="text" name="client_address" id="client_address" value="<?php echo $this->mdl_clients->form_value('client_address'); ?>" /></dd>
							</dl>

							<dl>
								<dt><?php echo $this->lang->line('street_address_2'); ?>: </dt>
								<dd><input type="text" name="client_address_2" id="client_address_2" value="<?php echo $this->mdl_clients->form_value('client_address_2'); ?>" /></dd>
							</dl>

							<dl>
								<dt><?php echo $this->lang->line('city'); ?>: </dt>
								<dd><input type="text" name="client_city" id="client_city" value="<?php echo $this->mdl_clients->form_value('client_city'); ?>" /></dd>
							</dl>

							<dl>
								<dt><?php echo $this->lang->line('state'); ?>: </dt>
								<dd><input type="text" name="client_state" id="client_state" value="<?php echo $this->mdl_clients->form_value('client_state'); ?>" /></dd>
							</dl>

							<dl>
								<dt><?php echo $this->lang->line('zip'); ?>: </dt>
								<dd><input type="text" name="client_zip" id="client_zip" value="<?php echo $this->mdl_clients->form_value('client_zip'); ?>" /></dd>
							</dl>

							<dl>
								<dt><?php echo $this->lang->line('country'); ?>: </dt>
								<dd><input type="text" name="client_country" id="client_country" value="<?php echo $this->mdl_clients->form_value('client_country'); ?>" /></dd>
							</dl>

							<dl>
								<dt><?php echo $this->lang->line('phone_number'); ?>: </dt>
								<dd><input type="text" name="client_phone_number" id="client_phone_number" value="<?php echo $this->mdl_clients->form_value('client_phone_number'); ?>" /></dd>
							</dl>

							<dl>
								<dt><?php echo $this->lang->line('fax_number'); ?>: </dt>
								<dd><input type="text" name="client_fax_number" id="client_fax_number" value="<?php echo $this->mdl_clients->form_value('client_fax_number'); ?>" /></dd>
							</dl>

							<dl>
								<dt><?php echo $this->lang->line('mobile_number'); ?>: </dt>
								<dd><input type="text" name="client_mobile_number" id="client_mobile_number" value="<?php echo $this->mdl_clients->form_value('client_mobile_number'); ?>" /></dd>
							</dl>

							<dl>
								<dt><?php echo $this->lang->line('email_address'); ?>: </dt>
								<dd><input type="text" name="client_email_address" id="client_email_address" value="<?php echo $this->mdl_clients->form_value('client_email_address'); ?>" /></dd>
							</dl>

							<dl>
								<dt><?php echo $this->lang->line('web_address'); ?>: </dt>
								<dd><input type="text" name="client_web_address" id="client_web_address" value="<?php echo $this->mdl_clients->form_value('client_web_address'); ?>" /></dd>
							</dl>

							<dl>
								 <dt><?php echo $this->lang->line('tax_id_number'); ?>: </dt>
								 <dd><input type="text" name="client_tax_id" id="client_tax_id" value="<?php echo $this->mdl_clients->form_value('client_tax_id'); ?>" /></dd>
							</dl>
							
							<dl>
								<dt></dt>
								<dd><input type="submit" name="btn_submit" value="<?php echo $this->lang->line('submit'); ?>" /> <input type="submit" name="btn_cancel" value="<?php echo $this->lang->line('cancel'); ?>" /></dd>
							</dl>

						</div>

						<?php if ($client) { ?>
						<div class="right_box">

							<dl>
								<dt><?php echo $this->lang->line('total_billed'); ?>: </dt>
								<dd><?php echo display_currency($client->client_total_invoice); ?></dd>
							</dl>

							<dl>
								<dt><?php echo $this->lang->line('total_paid'); ?>: </dt>
								<dd><?php echo display_currency($client->client_total_payment); ?></dd>
							</dl>

							<dl>
								<dt><?php echo $this->lang->line('total_balance'); ?>: </dt>
								<dd><?php echo display_currency($client->client_total_balance); ?></dd>
							</dl>
							<dl>
								<dt><?php echo $this->lang->line('notes'); ?>: </dt>
								<dd><?php echo nl2br($client->client_notes); ?></dd>
							</dl>

							<?php foreach ($custom_fields as $field) { ?>
							<dl>
								<dt><?php echo $field->field_name ?>: </dt>
								<dd><input type="text" id="<?php echo $field->column_name; ?>" name="<?php echo $field->column_name; ?>" value="<?php echo $this->mdl_clients->form_value($field->column_name); ?>" /></dd>
							</dl>
							<?php } ?>

						</div>
						<?php } ?>

						<div style="clear: both;">&nbsp;</div>

					</div>

					<div id="tab_settings">
						<dl>
							<dt><?php echo $this->lang->line('default_invoice_template'); ?>: </dt>
							<dd>
								<select name="client_settings[default_invoice_template]" id="default_invoice_template">
									<option value=""></option>
									<?php foreach ($invoice_templates as $template) { ?>
									<option value="<?php echo $template; ?>" <?php if ($this->mdl_mcb_client_data->setting('default_invoice_template') == $template) { ?>selected="selected"<?php } ?>><?php echo $template; ?></option>
									<?php } ?>
								</select>
							</dd>
						</dl>

						<dl>
							<dt><?php echo $this->lang->line('default_quote_template'); ?>: </dt>
							<dd>
								<select name="client_settings[default_quote_template]" id="default_invoice_template">
									<option value=""></option>
									<?php foreach ($invoice_templates as $template) { ?>
									<option value="<?php echo $template; ?>" <?php if ($this->mdl_mcb_client_data->setting('default_quote_template') == $template) { ?>selected="selected"<?php } ?>><?php echo $template; ?></option>
									<?php } ?>
								</select>
							</dd>
						</dl>

						<dl>
							<dt><?php echo $this->lang->line('default_invoice_group'); ?>: </dt>
							<dd>
								<select name="client_settings[default_invoice_group_id]" id="default_invoice_group_id">
									<option value=""></option>
									<?php foreach ($invoice_groups as $group) { ?>
									<option value="<?php echo $group->invoice_group_id; ?>" <?php if ($this->mdl_mcb_client_data->setting('default_invoice_group_id') == $group->invoice_group_id) { ?>selected="selected"<?php } ?>><?php echo $group->invoice_group_name; ?></option>
									<?php } ?>
								</select>
							</dd>
						</dl>

						<dl>
							<dt><?php echo $this->lang->line('default_quote_group'); ?>: </dt>
							<dd>
								<select name="client_settings[default_quote_group_id]" id="default_quote_group_id">
									<option value=""></option>
									<?php foreach ($invoice_groups as $group) { ?>
									<option value="<?php echo $group->invoice_group_id; ?>" <?php if ($this->mdl_mcb_client_data->setting('default_quote_group_id') == $group->invoice_group_id) { ?>selected="selected"<?php } ?>><?php echo $group->invoice_group_name; ?></option>
									<?php } ?>
								</select>
							</dd>
						</dl>

						<dl>
							<dt></dt>
							<dd><input type="submit" name="btn_submit" value="<?php echo $this->lang->line('submit'); ?>" /> <input type="submit" name="btn_cancel" value="<?php echo $this->lang->line('cancel'); ?>" /></dd>
						</dl>

					</div>

					<?php if ($client) { ?>

					<div id="tab_contacts">
						<?php $this->load->view('contact_table'); ?>
					</div>

					<div id="tab_quotes">
						<?php $this->load->view('invoices/invoice_table', array('invoices'=>$quotes)); ?>
					</div>

					<div id="tab_invoices">
						<?php $this->load->view('invoices/invoice_table', array('invoices'=>$invoices)); ?>
					</div>

					<?php } ?>

				</div>

			</form>
				
			</div>

		</div>

		</form>

	</div>

</div>

<?php $this->load->view('dashboard/footer'); ?>