<?php $this->load->view('css'); ?>

<h1><?php echo $this->lang->line('inventory_history'); ?></h1>

<table style="width: 100%;">

    <tr>
        <th style="width: 15%;"><?php echo $this->lang->line('date'); ?></th>
        <th style="width: 30%;"><?php echo $this->lang->line('item'); ?></th>
        <th style="width: 15%;"><?php echo $this->lang->line('quantity'); ?></th>
        <th style="width: 40%;"><?php echo $this->lang->line('notes'); ?></th>
    </tr>

    <?php foreach ($inventory_history as $history) { ?>

    <tr>
        <td class="first"><?php echo format_date($history->inventory_stock_date); ?></td>
        <td><?php echo $history->inventory_name; ?></td>
        <td><?php echo $history->inventory_stock_quantity; ?></td>
        <td><?php echo $history->inventory_stock_notes; ?></td>
    </tr>

        <?php } ?>

</table>