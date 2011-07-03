<?php $this->load->view('css'); ?>

<h1><?php echo $this->lang->line('inventory_sales'); ?></h1>

<table style="width: 100%;">

    <tr>
        <th><?php echo $this->lang->line('item'); ?></th>
        <th><?php echo $this->lang->line('quantity'); ?></th>
        <th><?php echo $this->lang->line('amount'); ?></th>
    </tr>

    <?php foreach ($items as $item) { ?>

    <tr>
        <td><?php echo $item->inventory_name; ?></td>
        <td><?php echo format_number($item->inventory_sum_quantity); ?></td>
        <td><?php echo display_currency($item->inventory_sum_amount); ?></td>
    </tr>

    <?php } ?>

</table>