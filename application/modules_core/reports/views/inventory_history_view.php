<table style="width: 100%;">

    <tr>
        <th scope="col" class="first" style="width: 15%;"><?php echo $this->lang->line('date'); ?></th>
        <th scope="col" style="width: 30%;"><?php echo $this->lang->line('item'); ?></th>
        <th scope="col" style="width: 15%;" class="col_amount"><?php echo $this->lang->line('quantity'); ?></th>
        <th scope="col" class="last" style="width: 40%;"><?php echo $this->lang->line('notes'); ?></th>
    </tr>

    <?php foreach ($inventory_history as $history) { ?>

    <tr>
        <td class="first"><?php echo format_date($history->inventory_stock_date); ?></td>
        <td><?php echo $history->inventory_name; ?></td>
        <td class="col_amount"a><?php echo $history->inventory_stock_quantity; ?></td>
        <td><?php echo ($history->inventory_stock_notes) ? $history->inventory_stock_notes : '&nbsp'; ?></td>
    </tr>

    <?php } ?>

</table>