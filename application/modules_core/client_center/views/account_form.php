<?php $this->load->view('header'); ?>

<script type="text/javascript">
	$(function(){
		$('#tabs').tabs({ selected: <?php echo $tab_index; ?> });
	});
</script>

<?php $this->load->view('dashboard/jquery_clear_password'); ?>

<div class="container_10" id="center_wrapper">

	<div class="grid_7" id="content_wrapper">

		<div class="section_wrapper">

			<h3 class="title_black"><?php echo $this->lang->line('client_form'); ?></h3>

			<?php $this->load->view('dashboard/system_messages'); ?>

			<div class="content toggle">

				<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">

					<dl>
						<dt><label><?php echo $this->lang->line('client_name'); ?>: </label></dt>
						<dd><?php echo $client_name; ?></dd>
					</dl>

					<dl>
						<dt><label><?php echo $this->lang->line('street_address'); ?>: </label></dt>
						<dd><?php if (!$this->mdl_mcb_data->setting('cc_enable_client_address')) { echo $this->mdl_client_account->form_value('client_address'); } else { ?>
							<input type="text" name="client_address" id="client_address" value="<?php echo $this->mdl_client_account->form_value('client_address'); ?>" />
							<?php } ?>
						</dd>
					</dl>

					<dl>
						<dt><label><?php echo $this->lang->line('street_address_2'); ?>: </label></dt>
						<dd><?php if (!$this->mdl_mcb_data->setting('cc_enable_client_address_2')) { echo $this->mdl_client_account->form_value('client_address_2'); } else { ?>
							<input type="text" name="client_address_2" id="client_address_2" value="<?php echo $this->mdl_client_account->form_value('client_address_2'); ?>" />
							<?php } ?>
						</dd>
					</dl>

					<dl>
						<dt><label><?php echo $this->lang->line('city'); ?>: </label></dt>
						<dd><?php if (!$this->mdl_mcb_data->setting('cc_enable_client_city')) { echo $this->mdl_client_account->form_value('client_city'); } else { ?>
							<input type="text" name="client_city" id="client_city" value="<?php echo $this->mdl_client_account->form_value('client_city'); ?>" />
							<?php } ?>
						</dd>
					</dl>

					<dl>
						<dt><label><?php echo $this->lang->line('state'); ?>: </label></dt>
						<dd><?php if (!$this->mdl_mcb_data->setting('cc_enable_client_state')) { echo $this->mdl_client_account->form_value('client_state'); } else { ?>
							<input type="text" name="client_state" id="client_state" value="<?php echo $this->mdl_client_account->form_value('client_state'); ?>" />
							<?php } ?>
						</dd>
					</dl>

					<dl>
						<dt><label><?php echo $this->lang->line('zip'); ?>: </label></dt>
						<dd><?php if (!$this->mdl_mcb_data->setting('cc_enable_client_zip')) { echo $this->mdl_client_account->form_value('client_zip'); } else { ?>
							<input type="text" name="client_zip" id="client_zip" value="<?php echo $this->mdl_client_account->form_value('client_zip'); ?>" />
							<?php } ?>
						</dd>
					</dl>

					<dl>
						<dt><label><?php echo $this->lang->line('country'); ?>: </label></dt>
						<dd><?php if (!$this->mdl_mcb_data->setting('cc_enable_client_country')) { echo $this->mdl_client_account->form_value('client_country'); } else { ?>
							<input type="text" name="client_country" id="client_country" value="<?php echo $this->mdl_client_account->form_value('client_country'); ?>" />
							<?php } ?>
						</dd>
					</dl>

					<dl>
						<dt><label><?php echo $this->lang->line('phone_number'); ?>: </label></dt>
						<dd><?php if (!$this->mdl_mcb_data->setting('cc_enable_client_phone_number')) { echo $this->mdl_client_account->form_value('client_phone_number'); } else { ?>
							<input type="text" name="client_phone_number" id="client_phone_number" value="<?php echo $this->mdl_client_account->form_value('client_phone_number'); ?>" />
							<?php } ?>
						</dd>
					</dl>

					<dl>
						<dt><label><?php echo $this->lang->line('fax_number'); ?>: </label></dt>
						<dd><?php if (!$this->mdl_mcb_data->setting('cc_enable_client_fax_number')) { echo $this->mdl_client_account->form_value('client_fax_number'); } else { ?>
							<input type="text" name="client_fax_number" id="client_fax_number" value="<?php echo $this->mdl_client_account->form_value('client_fax_number'); ?>" />
							<?php } ?>
						</dd>
					</dl>

					<dl>
						<dt><label><?php echo $this->lang->line('mobile_number'); ?>: </label></dt>
						<dd><?php if (!$this->mdl_mcb_data->setting('cc_enable_client_mobile_number')) { echo $this->mdl_client_account->form_value('client_mobile_number'); } else { ?>
							<input type="text" name="client_mobile_number" id="client_mobile_number" value="<?php echo $this->mdl_client_account->form_value('client_mobile_number'); ?>" />
							<?php } ?>
						</dd>
					</dl>

					<dl>
						<dt><label><?php echo $this->lang->line('email_address'); ?>: </label></dt>
						<dd><?php if (!$this->mdl_mcb_data->setting('cc_enable_client_email_address')) { echo $this->mdl_client_account->form_value('client_email_address'); } else { ?>
							<input type="text" name="client_email_address" id="client_email_address" value="<?php echo $this->mdl_client_account->form_value('client_email_address'); ?>" />
							<?php } ?>
						</dd>
					</dl>

					<dl>
						<dt><label><?php echo $this->lang->line('web_address'); ?>: </label></dt>
						<dd><?php if (!$this->mdl_mcb_data->setting('cc_enable_client_web_address')) { echo $this->mdl_client_account->form_value('client_web_address'); } else { ?>
							<input type="text" name="client_web_address" id="client_web_address" value="<?php echo $this->mdl_client_account->form_value('client_web_address'); ?>" />
							<?php } ?>
						</dd>
					</dl>

					<dl>
						<dt><label><?php echo $this->lang->line('tax_id_number'); ?>: </label></dt>
						<dd><?php if (!$this->mdl_mcb_data->setting('cc_enable_client_tax_id')) { echo $this->mdl_client_account->form_value('client_tax_id'); } else { ?>
							<input type="text" name="client_tax_id" id="client_tax_id" value="<?php echo $this->mdl_client_account->form_value('client_tax_id'); ?>" />
							<?php } ?>
						</dd>
					</dl>

                    <div style="clear: both;">&nbsp;</div>

					<?php if ($this->mdl_mcb_data->setting('cc_edit_enabled')) { ?>
					<input type="submit" id="btn_submit" name="btn_submit" value="<?php echo $this->lang->line('submit'); ?>" />
					<input type="submit" id="btn_cancel" name="btn_cancel" value="<?php echo $this->lang->line('cancel'); ?>" />
					<?php } ?>

					<div style="clear: both;">&nbsp;</div>

				</form>

			</div>

		</div>

	</div>
</div>

<?php $this->load->view('dashboard/sidebar', array('side_block'=>'client_center/sidebar_change_pw')); ?>

<?php $this->load->view('dashboard/footer'); ?>