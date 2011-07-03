<?php $this->load->view('dashboard/header'); ?>

<div class="grid_7" id="content_wrapper">

    <div class="section_wrapper">

        <h3 class="title_black"><?php echo $this->lang->line('clients'); ?><?php $this->load->view('dashboard/btn_add', array('btn_name'=>'btn_add_client', 'btn_value'=>$this->lang->line('add_client'))); ?></h3>

        <?php $this->load->view('dashboard/system_messages'); ?>

        <div class="content toggle no_padding">

            <table>
                <tr>
                    <th scope="col" class="first">
                        <?php if ($this->uri->segment(4) == 'client_id_desc') {
                            echo anchor('clients/index/order_by/client_id_asc', $this->lang->line('id'));
                        } else {
                            echo anchor('clients/index/order_by/client_id_desc', $this->lang->line('id'));
                        } ?>
                    </th>
                    <th scope="col" >
                        <?php if ($this->uri->segment(4) == 'client_name_desc') {
                            echo anchor('clients/index/order_by/client_name_asc', $this->lang->line('name'));
                        } else {
                            echo anchor('clients/index/order_by/client_name_desc', $this->lang->line('name'));
                        } ?>
                    </th>
                    <th scope="col" >
                        <?php if ($this->uri->segment(4) == 'balance_desc') {
                            echo anchor('clients/index/order_by/balance_asc', $this->lang->line('balance'));
                        } else {
                            echo anchor('clients/index/order_by/balance_desc', $this->lang->line('balance'));
                        } ?>
                    </th>
                    <th scope="col" class="last"><?php echo $this->lang->line('actions'); ?></th>
                </tr>
                <?php foreach ($clients as $client) { ?>
                <tr class="hoverall">
                    <td class="first"><?php echo $client->client_id; ?></td>
                    <td nowrap="nowrap"><?php echo $client->client_name; ?></td>
                    <td><?php echo display_currency($client->client_total_balance); ?></td>
                    <td class="last">
                        <a href="<?php echo site_url('clients/details/client_id/' . $client->client_id); ?>" title="<?php echo $this->lang->line('view'); ?>">
                        <?php echo icon('zoom'); ?>
                        </a>
                        <a href="<?php echo site_url('clients/form/client_id/' . $client->client_id); ?>" title="<?php echo $this->lang->line('edit'); ?>">
                        <?php echo icon('edit'); ?>
                        </a>
                        <a href="<?php echo site_url('clients/delete/client_id/' . $client->client_id); ?>" title="<?php echo $this->lang->line('delete'); ?>" onclick="javascript:if(!confirm('<?php echo $this->lang->line('client_delete_warning'); ?>')) return false">
                        <?php echo icon('delete'); ?>
                        </a>
                        <?php if  ($client->client_active) { ?>
                        <a href="<?php echo site_url('invoices/create/client_id/' . $client->client_id); ?>" title="<?php echo $this->lang->line('create_invoice'); ?>">
                        <?php echo icon('invoice'); ?>
                        </a>
                        <a href="<?php echo site_url('invoices/create/quote/client_id/' . $client->client_id); ?>" title="<?php echo $this->lang->line('create_quote'); ?>">
                        <?php echo icon('quote'); ?>
                        </a>
                        <?php } ?>
                    </td>
                </tr>
                    <?php } ?>
            </table>

            <?php if ($this->mdl_clients->page_links) { ?>
            <div id="pagination">
            <?php echo $this->mdl_clients->page_links; ?>
            </div>
            <?php } ?>

        </div>

    </div>

</div>

<?php $this->load->view('dashboard/sidebar', array('side_block'=>'clients/sidebar')); ?>

<?php $this->load->view('dashboard/footer'); ?>