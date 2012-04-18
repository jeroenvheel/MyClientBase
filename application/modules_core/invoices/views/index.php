<?php $this->load->view('dashboard/header', array('header_insert'=>array('invoices/jquery_invoice_search', 'dashboard/jquery_date_picker', 'invoices/jquery_client_ac'))); ?>

<?php echo modules::run('invoices/widgets/generate_dialog'); ?>

<div class="grid_10" id="content_wrapper">

	<?php if (!uri_assoc('is_quote')) { ?>
	<div class="section_wrapper" id="invoice_search" style="display: none;">

		<form method="post" action="<?php echo site_url('invoice_search'); ?>" style="display: inline;">
			<input type="hidden" name="output_type" value="index" />

			<h3 class="title_black"><?php echo $this->lang->line('search'); ?>
				<span style="font-size: 60%;">

					<input type="submit" id="btn_submit_search" name="btn_submit_search" class="uibutton" style="float: right; margin-top: 10px; margin-right: 10px;" value="<?php echo $this->lang->line('submit'); ?>" />
					<input type="submit" id="btn_close_search" name="btn_close_search" class="uibutton" style="float: right; margin-top: 10px; margin-right: 10px;" value="<?php echo $this->lang->line('close'); ?>" />

				</span>
			</h3>

			<div class="content toggle">

				<table style="width: 100%;">
					<tr>
						<td>
							<label><?php echo $this->lang->line('invoice_number'); ?>: </label>
							<input type="text" name="invoice_number" />
						</td>
						<td>
							<label><?php echo $this->lang->line('client'); ?>: </label>
							<input type="text" id="client_id_autocomplete_label" name="client_id_autocomplete_label" />
							<input type="hidden" id="client_id_autocomplete_hidden" name="client_id" />
						</td>
						<td>
							<label><?php echo $this->lang->line('from_date'); ?>: </label>
							<input type="text" class="datepicker" name="from_date" />
						</td>
						<td>
							<label><?php echo $this->lang->line('to_date'); ?>: </label>
							<input type="text" class="datepicker" name="to_date" />
						</td>
					</tr>
				</table>

                <div style="clear: both;">&nbsp;</div>

			</div>

		</form>

	</div>
	<?php } ?>

	<div class="section_wrapper">

		<h3 class="title_black"><?php echo (!uri_assoc('is_quote') ? $this->lang->line('invoices') : $this->lang->line('quotes')); ?>
		<span style="font-size: 60%;">
			<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>" style="display: inline;">
				<input type="submit" name="<?php echo (!uri_assoc('is_quote')) ? 'btn_add_invoice' : 'btn_add_quote'; ?>" class="uibutton" style="float: right; margin-top: 10px; margin-right: 10px;" value="<?php echo (!uri_assoc('is_quote')) ? $this->lang->line('create_invoice') : $this->lang->line('create_quote'); ?> " />
				<?php if (!uri_assoc('is_quote')) { ?><input type="submit" id="btn_show_search" onclick="javascript:return false;" name="btn_show_search" class="uibutton" style="float: right; margin-top: 10px; margin-right: 10px;" value="<?php echo $this->lang->line('search'); ?>" />
				<input type="submit" name="btn_calendar_view" class="uibutton" style="float: right; margin-top: 10px; margin-right: 10px;" value="<?php echo $this->lang->line('calendar_view'); ?>" /><?php } ?>
			</form>
		</span>
		</h3>

		<div class="content toggle no_padding">

			<?php $this->load->view('dashboard/system_messages'); ?>

			<?php echo modules::run('invoices/display_invoice_table', $invoices, FALSE, TRUE); ?>

		</div>

	</div>

</div>

<?php $this->load->view('dashboard/footer'); ?>