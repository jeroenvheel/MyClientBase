<?php $this->load->view('dashboard/header', array('header_insert'=>array('invoices/jquery_client_ac'))); ?>

<?php $this->load->view('dashboard/jquery_date_picker'); ?>

<script type="text/javascript">

	$(document).ready(function() {

		url = '<?php echo site_url('reports/standardize_date'); ?>';

		$('#btn_all_clients').click(function() {
			$('#client_id_autocomplete_label').val('<?php echo $this->lang->line('all_clients'); ?>');
			$('#client_id_autocomplete_hidden').val('0');
		});

		$('#btn_submit').click(function() {

			output_type = $('#output_type').val();
			from_date = $('#from_date').val();
			to_date = $('#to_date').val();
			client_id = $('#client_id_autocomplete_hidden').val();

			$.post('<?php echo site_url('reports/sales/jquery_display_results'); ?>', {
				output_type: output_type,
				from_date: from_date,
				to_date: to_date,
				client_id: client_id
			}, function(data) {
				if (output_type == 'view') {
					$('#results').html(data);
				}
				else {
					window.open(data);
				}
			});

		});

	});

</script>

<div class="grid_10" id="content_wrapper">

	<div class="section_wrapper">

		<h3 class="title_black"><?php echo $this->lang->line('sales_report'); ?></h3>

		<div class="content toggle">

			<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">

                <dl>
                    <dt><label><?php echo $this->lang->line('from_date'); ?>: </label></dt>
                    <dd><input type="text" name="from_date" id="from_date" class="datepicker" /></dd>
                </dl>

                <dl>
                    <dt><label><?php echo $this->lang->line('to_date'); ?>: </label></dt>
                    <dd><input type="text" name="to_date" id="to_date" class="datepicker" /></dd>
                </dl>

                <dl>
                    <dt><label><?php echo $this->lang->line('client'); ?>: </label></dt>
                    <dd>
						<input type="text" id="client_id_autocomplete_label" name="client_id_autocomplete_label" value="<?php echo $this->lang->line('all_clients'); ?>" /> <input type="button" name="btn_all_clients" id="btn_all_clients" value="<?php echo $this->lang->line('all_clients'); ?>" />
						<input type="hidden" id="client_id_autocomplete_hidden" name="client_id" value="0"/>
                    </dd>
                </dl>

				<?php $this->load->view('partial_output_type'); ?>

				<input type="button" id="btn_submit" name="btn_submit" value="<?php echo $this->lang->line('submit'); ?>" />

				<div style="clear: both;">&nbsp;</div>

			</form>

		</div>

	</div>

    <div class="section_wrapper">
        <div class="content toggle no_padding" id="results">
        </div>
    </div>

</div>

<?php $this->load->view('dashboard/footer'); ?>