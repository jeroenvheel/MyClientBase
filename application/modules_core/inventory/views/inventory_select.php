<script type="text/javascript">

	$(document).ready(function(){

		$("#inventory_id").change(function(){

			if ($('#inventory_id').val() != 'please_select') {

				$('#dl_save_as_inventory').hide();

			}

			else {

				$('#dl_save_as_inventory').show();

			}

			$.post("<?php echo site_url('inventory/jquery_item_data'); ?>",{

				inventory_id: $("#inventory_id").val()

			}, function(data) {

				var json_data = "invoice_item = " + data;

				eval(json_data);

				$('#item_name').val(invoice_item.item_name);
				$('#item_price').val(invoice_item.item_cost);
				$('#item_description').val(invoice_item.item_description);
                $('#tax_rate_id').val(invoice_item.tax_rate_id);
				$('#item_qty').val(1);

			});
			return false;
		});

	});

</script>