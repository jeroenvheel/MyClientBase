<?php $this->load->view('dashboard/header'); ?>

<?php $this->load->view('dashboard/jquery_date_picker'); ?>

<script type="text/javascript">

	$(document).ready(function() {

		url = '<?php echo site_url('reports/standardize_date'); ?>';

		$('#btn_submit').click(function() {

			output_type = $('#output_type').val();
			from_date = $('#from_date').val();
			to_date = $('#to_date').val();

			$.ajaxSetup({async:false});

			$.post(url, {date: from_date }, function(data) {
				ts_from_date = data;
			});

			$.post(url, {date: to_date }, function(data) {
				ts_to_date = data;
			});

			if (!ts_from_date) {
				ts_from_date = 0;
			}

			if (!ts_to_date) {
				ts_to_date = 0;
			}

           if (output_type == 'view') {

               $('#results').load('<?php echo site_url('reports/sales_by_customer/jquery_display_results'); ?>' + '/' + output_type + '/' + ts_from_date + '/' + ts_to_date);

           }

           else {

               window.open('<?php echo site_url('reports/sales_by_customer/jquery_display_results'); ?>' + '/' + output_type + '/' + ts_from_date + '/' + ts_to_date);

           }

		});

	});

</script>

<div class="grid_10" id="content_wrapper">

	<div class="section_wrapper">

		<h3 class="title_black"><?php echo $this->lang->line('sales_by_customer'); ?></h3>

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