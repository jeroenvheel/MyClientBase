<script type="text/javascript">

    $(function() {

        $('#client_id').change(function() {

            client_id = $('#client_id').val();

			<?php if ($this->uri->segment(3) == 'quote') { ?>
				d_type = 'quote';
			<?php } else { ?>
				d_type = 'invoice';
			<?php } ?>

            $.post('<?php echo site_url('invoices/jquery_client_invoice_group'); ?>/' + client_id + '/' + d_type, {}, function(invoice_group_id) {
                $('#invoice_group_id').val(invoice_group_id);
            });

        });

    });

</script>