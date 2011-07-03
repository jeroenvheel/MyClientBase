<table style="width: 100%;">

    <tr>
        <th scope="col" class="first"><?php echo $this->lang->line('item'); ?></th>
        <th scope="col"><?php echo $this->lang->line('quantity'); ?></th>
        <th scope="col" class="last"><?php echo $this->lang->line('amount'); ?></th>
    </tr>

    <?php foreach ($items as $item) { ?>

    <tr>
        <td class="first"><?php echo $item->inventory_name; ?></td>
        <td><?php echo format_number($item->inventory_sum_quantity); ?></td>
        <td class="last"><?php echo display_currency($item->inventory_sum_amount); ?></td>
    </tr>

    <?php } ?>

</table>