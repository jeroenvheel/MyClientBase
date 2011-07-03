<?php $this->load->view('dashboard/header'); ?>

<?php $this->load->view('dashboard/jquery_date_picker'); ?>

<div class="grid_7" id="content_wrapper">

	<div class="section_wrapper">

		<h3 class="title_black"><?php echo $this->lang->line('quote_to_invoice'); ?></h3>

		<div class="content toggle">
			
			<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">

				<dl>
					<dt><label><?php echo $this->lang->line('invoice_date'); ?>: </label></dt>
					<dd><input id="datepicker" type="text" name="invoice_date_entered" value="<?php echo date($this->mdl_mcb_data->setting('default_date_format')); ?>" /></dd>
				</dl>
				<dl>
					<dt><label><?php echo $this->lang->line('client'); ?>: </label></dt>
					<dd><?php echo $invoice->client_name; ?></dd>
				</dl>
				<dl>
					<dt><label><?php echo $this->lang->line('invoice_group'); ?>: </label></dt>
					<dd>
						<select name="invoice_group_id" id="invoice_group_id">
							<?php foreach ($invoice_groups as $invoice_group) { ?>
							<option value="<?php echo $invoice_group->invoice_group_id; ?>" <?php if ($this->mdl_mcb_data->setting('default_invoice_group_id') == $invoice_group->invoice_group_id) { ?>selected="selected"<?php } ?>><?php echo $invoice_group->invoice_group_name; ?></option>
							<?php } ?>
						</select>
					</dd>
				</dl>

                <div style="clear: both;">&nbsp;</div>

				<input type="submit" id="btn_submit" name="btn_submit" value="<?php echo $this->lang->line('create_invoice'); ?>" />
				<input type="submit" id="btn_cancel" name="btn_cancel" value="<?php echo $this->lang->line('cancel'); ?>" />

			</form>

		</div>

	</div>

</div>

<?php $this->load->view('dashboard/sidebar', array('side_block'=>'invoices/sidebar')); ?>

<?php $this->load->view('dashboard/footer'); ?>