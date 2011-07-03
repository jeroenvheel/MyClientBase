<?php $this->load->view('dashboard/header', array('header_insert'=>'clients/details_header')); ?>

<?php echo modules::run('invoices/widgets/generate_dialog'); ?>

<script type="text/javascript">
	$(function(){
		$('#tabs').tabs({ selected: <?php echo isset($tab_index) ? $tab_index : 0; ?> });
	});
</script>

<div class="container_10" id="center_wrapper">

	<div class="grid_10" id="content_wrapper">

		<div class="section_wrapper">

			<h3 class="title_black"><?php echo $client->client_name; ?>
				
				<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>" style="display: inline;">
				<input type="submit" name="btn_add_contact" style="float: right; margin-top: 10px; margin-right: 10px;" value="<?php echo $this->lang->line('add_contact'); ?>" />
				<input type="submit" name="btn_edit_client" style="float: right; margin-top: 10px; margin-right: 10px;" value="<?php echo $this->lang->line('edit_client'); ?>" />
				<?php if ($client->client_active) { ?>
                <input type="submit" name="btn_add_invoice" style="float: right; margin-top: 10px; margin-right: 10px;" value="<?php echo $this->lang->line('create_invoice'); ?>" />
				<input type="submit" name="btn_add_quote" style="float: right; margin-top: 10px; margin-right: 10px;" value="<?php echo $this->lang->line('create_quote'); ?>" />
                <?php } ?>
				</form>

			</h3>

			<div class="content toggle">

				<div id="tabs">

					<ul>
						<li><a href="#tab_client"><?php echo $this->lang->line('client'); ?></a></li>
						<li><a href="#tab_contacts"><?php echo $this->lang->line('contacts'); ?></a></li>
						<li><a href="#tab_invoices"><?php echo $this->lang->line('invoices'); ?></a></li>
					</ul>

					<div id="tab_client">

						<div class="left_box">

							<dl>
								<dt><?php echo $this->lang->line('street_address'); ?>: </dt>
								<dd><?php echo $client->client_address; ?><?php if ($client->client_address_2) { ?><br /><?php echo $client->client_address_2;} ?></dd>
							</dl>

							<dl>
								<dt><?php echo $this->lang->line('city'); ?>: </dt>
								<dd><?php echo $client->client_city; ?></dd>
							</dl>

							<dl>
								<dt><?php echo $this->lang->line('state'); ?>: </dt>
								<dd><?php echo $client->client_state; ?></dd>
							</dl>

							<dl>
								<dt><?php echo $this->lang->line('zip'); ?>: </dt>
								<dd><?php echo $client->client_zip; ?></dd>
							</dl>

							<dl>
								<dt><?php echo $this->lang->line('country'); ?>: </dt>
								<dd><?php echo $client->client_country; ?></dd>
							</dl>

							<dl>
								<dt><?php echo $this->lang->line('email_address'); ?>: </dt>
								<dd><?php echo auto_link($client->client_email_address); ?></dd>
							</dl>

							<dl>
								<dt><?php echo $this->lang->line('web_address'); ?>: </dt>
								<dd><?php echo auto_link($client->client_web_address, 'both', TRUE); ?></dd>
							</dl>

							<dl>
								<dt><?php echo $this->lang->line('phone_number'); ?>: </dt>
								<dd><?php echo $client->client_phone_number; ?></dd>
							</dl>

							<dl>
								<dt><?php echo $this->lang->line('fax_number'); ?>: </dt>
								<dd><?php echo $client->client_fax_number; ?></dd>
							</dl>

							<dl>
								<dt><?php echo $this->lang->line('mobile_number'); ?>: </dt>
								<dd><?php echo $client->client_mobile_number; ?></dd>
							</dl>

						</div>

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
								<dt><?php echo $this->lang->line('tax_id_number'); ?>: </dt>
								<dd><?php echo $client->client_tax_id; ?></dd>
							</dl>
							<dl>
								<dt><?php echo $this->lang->line('notes'); ?>: </dt>
								<dd><?php echo nl2br($client->client_notes); ?></dd>
							</dl>

						</div>

						<div style="clear: both;">&nbsp;</div>


					</div>

					<div id="tab_contacts">

						<?php $this->load->view('contact_table'); ?>

					</div>

					<div id="tab_invoices">
						<?php $this->load->view('invoices/invoice_table'); ?>
					</div>

				</div>

			</div>

		</div>

	</div>

</div>

<?php $this->load->view('dashboard/footer'); ?>