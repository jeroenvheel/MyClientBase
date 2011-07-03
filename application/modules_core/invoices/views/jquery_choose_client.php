<script type="text/javascript">

    $(function() {

        $('#client_id').change(function() {

            client_id = $('#client_id').val();

            d_type = '<?php echo $this->uri->segment(3); ?>';

            if (!d_type) {

                d_type = 'invoice';

            }

            $.get('<?php echo site_url('invoices/jquery_client_invoice_group'); ?>/' + client_id + '/' + d_type, {}, function(invoice_group_id) {
                $('#invoice_group_id').val(invoice_group_id);
            });

        });

    });

</script>