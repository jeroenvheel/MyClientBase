<script type="text/javascript">

	$(function() {

		$('#output_dialog_receipt').dialog({
			modal: true,
			draggable: false,
			resizable: false,
			autoOpen: false,
			title: '<?php echo $this->lang->line('payment_receipt'); ?>',
			buttons: {
				'<?php echo $this->lang->line('generate'); ?>': function() {
					$(this).dialog('close');
					generate_receipt();
				},
				'<?php echo $this->lang->line('cancel'); ?>': function() {
					$(this).dialog('close');
				}
			}
		});

		$('.output_link_receipt').click(function() {

			items = $(this).attr('id').split('-');

			invoice_id = items[0];
			payment_id = items[1];

			$('#output_dialog_receipt').dialog('open');

		});

		function generate_receipt() {

			var output_type = $('#output_type').val();

			var receipt_template = $('#receipt_template').val();

			if (output_type != 'email') {

				download_url = '<?php echo site_url('payments/receipt/type'); ?>/' + output_type + '/invoice_id/' + invoice_id + '/payment_id/' + payment_id + '/receipt_template/' + receipt_template;

				window.open(download_url);

			}

			else {

				var email_url = '<?php echo site_url('mailer/payment_mailer/form/invoice_id'); ?>' + '/' + invoice_id + '/receipt_template/' + receipt_template;

				window.location = email_url;

			}

		}

	});

</script>

<div id="output_dialog_receipt">
	<table style="width: 100%;">
		<tr>
			<td><?php echo $this->lang->line('output_type'); ?>: </td>
			<td>
				<select name="output_type" id="output_type">
					<option value="pdf"><?php echo $this->lang->line('pdf'); ?></option>
					<option value="html"><?php echo $this->lang->line('html'); ?></option>
					<option value="email"><?php echo $this->lang->line('email'); ?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo $this->lang->line('template'); ?>: </td>
			<td>
				<select name="receipt_template" id="receipt_template">
					<?php foreach ($templates as $template) { ?>
					<option <?php if ($template == $this->mdl_mcb_data->setting('default_receipt_template')) { ?>selected="selected"<?php } ?>><?php echo $template; ?></option>
					<?php } ?>
				</select>
			</td>
		</tr>
	</table>
</div>