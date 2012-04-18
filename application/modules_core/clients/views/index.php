<?php $this->load->view('dashboard/header'); ?>

<div class="grid_10" id="content_wrapper">

    <div class="section_wrapper">

        <h3 class="title_black"><?php echo $this->lang->line('clients'); ?>
			<span style="font-size: 60%;">
			<?php $this->load->view('dashboard/btn_add', array('btn_name'=>'btn_add_client', 'btn_value'=>$this->lang->line('add_client'))); ?>
			</span>
		</h3>

        <?php $this->load->view('dashboard/system_messages'); ?>

        <div class="content toggle no_padding">

            <table style="width: 100%;">
                <tr>
                    <th scope="col" class="first"><?php echo $table_headers['client_id']; ?></th>
                    <th scope="col" ><?php echo $table_headers['client_name']; ?></th>
					<th scope="col"><?php echo $table_headers['client_email']; ?></th>
					<th scope="col"><?php echo $table_headers['client_phone']; ?></th>
                    <th scope="col" class="col_amount"><?php echo $table_headers['credit_amount']; ?></th>
                    <th scope="col" class="col_amount"><?php echo $table_headers['balance']; ?></th>
					<th scope="col"><?php echo $table_headers['client_active']; ?></th>
					<th scope="col" class="last"><?php echo $this->lang->line('actions'); ?></th>
                </tr>
                <?php foreach ($clients as $client) { ?>
                <tr class="hoverall">
                    <td class="first"><?php echo $client->client_id; ?></td>
                    <td nowrap="nowrap"><?php echo $client->client_name; ?></td>
					<td><?php echo auto_link($client->client_email_address) . '&nbsp;'; ?></td>
					<td><?php echo $client->client_phone_number . '&nbsp;'; ?></td>
					<td class="col_amount"><?php echo display_currency($client->client_credit_amount); ?></td>
                    <td class="col_amount"><?php echo display_currency($client->client_total_balance); ?></td>
					<td><?php echo ($client->client_active) ? anchor('clients/index/show/active', $this->lang->line('yes')) : anchor('clients/index/show/inactive', $this->lang->line('no')); ?></td>
                    <td class="last">
                        <a href="<?php echo site_url('clients/form/client_id/' . $client->client_id); ?>" title="<?php echo $this->lang->line('edit'); ?>">
                        <?php echo icon('edit'); ?>
                        </a>
                        <a href="<?php echo site_url('clients/delete/client_id/' . $client->client_id); ?>" title="<?php echo $this->lang->line('delete'); ?>" onclick="javascript:if(!confirm('<?php echo $this->lang->line('client_delete_warning'); ?>')) return false">
                        <?php echo icon('delete'); ?>
                        </a>
                        <a href="<?php echo site_url('invoices/create/client_id/' . $client->client_id); ?>" title="<?php echo $this->lang->line('create_invoice'); ?>">
                        <?php echo icon('invoice'); ?>
                        </a>
                        <a href="<?php echo site_url('invoices/create/quote/client_id/' . $client->client_id); ?>" title="<?php echo $this->lang->line('create_quote'); ?>">
                        <?php echo icon('quote'); ?>
                        </a>
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

<?php $this->load->view('dashboard/footer'); ?>