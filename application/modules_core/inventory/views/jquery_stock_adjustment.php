<script type="text/javascript">

	$(function() {

		$('#stock_adjust_dialog').dialog({
			modal: true,
			draggable: false,
			resizable: false,
			autoOpen: false,
			title: '<?php echo $this->lang->line('adjust_stock'); ?>',
			buttons: {
				'<?php echo $this->lang->line('submit'); ?>': function() {
					$(this).dialog('close');
					adjust_stock();
				},
				'<?php echo $this->lang->line('cancel'); ?>': function() {
					$(this).dialog('close');
				}
			}
		});

		$('.stock_adjust_link').click(function() {

			inventory_id = $(this).attr('id');

			$('#stock_adjust_dialog').dialog('open');

		});

		function adjust_stock() {

            $.post('<?php echo site_url('inventory/jquery_adjust_stock'); ?>', {

                inventory_id: inventory_id,
                inventory_stock_quantity: $('#inventory_stock_quantity').val(),
                inventory_stock_notes: $('#inventory_stock_notes').val()

            }, function() {

                $('#inventory_stock_quantity').val('');
                $('#inventory_stock_notes').val('');

                $('#' + inventory_id).load('<?php echo site_url('inventory/jquery_refresh_stock'); ?>', {

                    inventory_id: inventory_id

                });

            });

		}

	});

</script>

<div id="stock_adjust_dialog">
	<table style="width: 100%;">
		<tr>
			<td><?php echo $this->lang->line('quantity'); ?>: </td>
			<td><input type="text" name="inventory_stock_quantity" id="inventory_stock_quantity" /></td>
		</tr>
		<tr>
			<td style="vertical-align: top;"><?php echo $this->lang->line('notes'); ?>: </td>
			<td><input type="text" name="inventory_stock_notes" id="inventory_stock_notes" /></td>
		</tr>
	</table>
</div>