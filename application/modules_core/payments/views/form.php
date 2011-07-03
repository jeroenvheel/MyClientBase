<?php $this->load->view('dashboard/header'); ?>

<?php $this->load->view('dashboard/jquery_date_picker'); ?>

<div class="grid_7" id="content_wrapper">

	<div class="section_wrapper">

		<h3 class="title_black"><?php echo $this->lang->line('payment_form'); ?></h3>

		<?php $this->load->view('dashboard/system_messages'); ?>

		<div class="content toggle">

		<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">

			<dl>
				<dt><label><?php echo $this->lang->line('invoice'); ?>: </label></dt>
				<dd>
					<?php if (!uri_assoc('invoice_id')) { ?>
					<select name="invoice_id" id="invoice_id">
						<option value=""><?php echo $this->lang->line('choose_an_invoice'); ?></option>
						<?php foreach ($invoices as $invoice) { ?>
						<option value="<?php echo $invoice->invoice_id; ?>" <?php if ($invoice->invoice_id == $this->mdl_payments->form_value('invoice_id')) { ?>selected="selected"<?php } ?>>
							#<?php echo invoice_id($invoice); ?> <?php echo display_currency($invoice->invoice_balance); ?> (<?php echo character_limiter($invoice->client_name, 20); ?>)
						</option>
						<?php } ?>
					</select>
					<?php } else { ?>
						#<?php echo invoice_id($invoice); ?> <?php echo display_currency($invoice->invoice_balance); ?> (<?php echo $invoice->client_name; ?>)
					<?php } ?>
				</dd>
			</dl>

			<dl>
				<dt><label><?php echo $this->lang->line('amount'); ?>: </label></dt>
				<dd><input type="text" name="payment_amount" value="<?php echo format_number($this->mdl_payments->form_value('payment_amount')); ?>" /></dd>
			</dl>

			<dl>
				<dt><label><?php echo $this->lang->line('payment_date'); ?>: </label></dt>
				<dd><input type="text" name="payment_date" class="datepicker" value="<?php echo $this->mdl_payments->form_value('payment_date'); ?>" /></dd>
			</dl>

			<dl>
				<dt><label><?php echo $this->lang->line('payment_method'); ?>: </label></dt>
				<dd>
					<select name="payment_method_id">
						<option <?php if (!$this->mdl_payments->form_value('payment_method_id')) { ?>selected="selected"<?php } ?>></option>
						<?php foreach ($payment_methods as $payment_method) { ?>
						<option value="<?php echo $payment_method->payment_method_id; ?>" <?php if ($this->mdl_payments->form_value('payment_method_id') == $payment_method->payment_method_id) { ?>selected="selected"<?php } ?>><?php echo $payment_method->payment_method; ?></option>
						<?php } ?>
					</select>
				</dd>
			</dl>

			<dl>
				<dt><label><?php echo $this->lang->line('note'); ?>: </label></dt>
				<dd><textarea name="payment_note" rows="5" cols="40"><?php echo $this->mdl_payments->form_value('payment_note'); ?></textarea></dd>
			</dl>

			<?php foreach ($custom_fields as $custom_field) { ?>
			<dl>
				<dt><label><?php echo $custom_field->field_name; ?>: </label></dt>
				<dd><input type="text" name="<?php echo $custom_field->column_name; ?>" id="<?php echo $custom_field->column_name; ?>" value="<?php echo $this->mdl_payments->form_value($custom_field->column_name); ?>" /></dd>
			</dl>
			<?php } ?>

            <div style="clear: both;">&nbsp;</div>

			<input type="submit" id="btn_submit" name="btn_submit_single_payment" value="<?php echo $this->lang->line('submit'); ?>" />
			<input type="submit" id="btn_cancel" name="btn_cancel" value="<?php echo $this->lang->line('cancel'); ?>" />

        </form>

		</div>

	</div>

</div>

<?php $this->load->view('dashboard/sidebar', array('side_block'=>'payments/sidebar')); ?>

<?php $this->load->view('dashboard/footer'); ?>