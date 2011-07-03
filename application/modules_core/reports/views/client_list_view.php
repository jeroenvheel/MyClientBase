<table style="width: 100%;">

    <tr>
        <th scope="col" class="first"><?php echo $this->lang->line('client'); ?></th>
        <th scope="col"><?php echo $this->lang->line('street_address'); ?></th>
        <th scope="col"><?php echo $this->lang->line('city'); ?></th>
        <th scope="col"><?php echo $this->lang->line('state'); ?></th>
        <th scope="col"><?php echo $this->lang->line('zip'); ?></th>
        <th scope="col" class="last"><?php echo $this->lang->line('phone_number'); ?></th>
    </tr>

    <?php foreach ($clients as $client) { ?>

    <tr>
        <td class="first"><?php echo $client->client_name; ?></td>
        <td><?php echo $client->client_address; ?></td>
        <td><?php echo $client->client_city; ?></td>
        <td><?php echo $client->client_state; ?></td>
        <td><?php echo $client->client_zip; ?></td>
        <td class="last"><?php echo $client->client_phone_number; ?></td>
    </tr>

    <?php } ?>

</table>