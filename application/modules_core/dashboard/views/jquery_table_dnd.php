<script src="<?php echo base_url(); ?>assets/jquery/jquery.tablednd_0_5.js" type="text/javascript"></script>

<script type="text/javascript">

    $(document).ready(function() {
        $("#dnd").tableDnD({
            onDrop: function(table, row) {
                $.post('<?php echo site_url('invoices/items/jquery_save_order'); ?>', {
                    data: $.tableDnD.serialize()
                });
            }
        });
    });
</script>