<?php $this->load->view('dashboard/header', array('header_insert'=>array('invoices/jquery_client_ac'))); ?>

<script type="text/javascript">
	$(function() {

        $('#btn_submit').click(function() {

           var include_closed_invoices = $('#include_closed_invoices').attr('checked');
		   
		   var include_quotes = $('#include_quotes').attr('checked');

           var output_type = $('#output_type').val();

           var client_id = $('#client_id_autocomplete_hidden').val();

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
						<input type="text" id="client_id_autocomplete_label" name="client_id_autocomplete_label" value="<?php echo $this->lang->line('all_clients'); ?>" />
						<input type="hidden" id="client_id_autocomplete_hidden" name="client_id" value="0"/>
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