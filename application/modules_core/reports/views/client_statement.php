<?php $this->load->view('dashboard/header'); ?>

<script type="text/javascript">
	$(function() {

        $('#btn_submit').click(function() {

           var include_closed_invoices = $('#include_closed_invoices').attr('checked');
		   
		   var include_quotes = $('#include_quotes').attr('checked');

           var output_type = $('#output_type').val();

           var client_id = $('#client_id').val();

           if (output_type == 'view') {

               $('#results').load('<?php echo site_url('reports/client_statement/jquery_display_results'); ?>' + '/' + output_type + '/' + client_id + '/' + include_closed_invoices + '/' + include_quotes);

           }

           else {

               window.open('<?php echo site_url('reports/client_statement/jquery_display_results'); ?>' + '/' + output_type + '/' + client_id + '/' + include_closed_invoices + '/' + include_quotes);

           }
           

        });

	});
</script>

<div class="grid_10" id="content_wrapper">

	<div class="section_wrapper">

		<h3 class="title_black"><?php echo $this->lang->line('client_statement'); ?></h3>

		<div class="content toggle">

			<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">

                <dl>
                    <dt><label><?php echo $this->lang->line('client'); ?>: </label></dt>
                    <dd>
                        <select name="client_id" id="client_id">

                            <option value=""></option>

                            <?php foreach ($clients as $client) { ?>

                            <option value="<?php echo $client->client_id; ?>"><?php echo $client->client_name; ?></option>

                            <?php } ?>

                        </select>
                    </dd>
                </dl>

                <dl>
                    <dt><label><?php echo $this->lang->line('include_closed_invoices'); ?></label></dt>
                    <dd><input type="checkbox" name="include_closed_invoices" id="include_closed_invoices" value="1" /></dd>
                </dl>
				
				<dl>
                    <dt><label><?php echo $this->lang->line('include_quotes'); ?></label></dt>
                    <dd><input type="checkbox" name="include_quotes" id="include_quotes" value="1" /></dd>
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