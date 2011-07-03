<?php $this->load->view('dashboard/header'); ?>

<script type="text/javascript">
	$(function() {

        $('#btn_submit').click(function() {

           var include_closed_invoices = $('#include_closed_invoices').attr('checked');

           var output_type = $('#output_type').val();

           var client_id = $('#client_id').val();

           if (output_type == 'view') {

               $('#results').load('<?php echo site_url('reports/inventory_sales/jquery_display_results'); ?>' + '/' + output_type + '/' + client_id + '/' + include_closed_invoices);

           }

           else {

               window.open('<?php echo site_url('reports/inventory_sales/jquery_display_results'); ?>' + '/' + output_type + '/' + client_id + '/' + include_closed_invoices);

           }
           

        });

	});
</script>

<div class="grid_10" id="content_wrapper">

	<div class="section_wrapper">

		<h3 class="title_black"><?php echo $this->lang->line('inventory_sales'); ?></h3>

		<div class="content toggle">

			<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">

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